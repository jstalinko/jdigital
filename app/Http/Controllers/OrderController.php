<?php

namespace App\Http\Controllers;

use App\Helper;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Nekoding\Tripay\Tripay;
use Illuminate\Http\Request;
use Nekoding\Tripay\Signature;
use Illuminate\Support\Collection;
use Nekoding\Tripay\Networks\HttpClient;


class OrderController extends Controller
{

    protected function paymentChannel(): Collection
    {

        $tripay = new Tripay(new HttpClient(env('TRIPAY_API_KEY')));

        return $tripay->getChannelPembayaran();
    }
    public function createTransaction(Request $request): JsonResponse
    {
        /**
         * GET PRODUCT DETAILS.
         */
        $product = Product::find($request->product_id);
        if (!$product) abort(404);
        ////////////////////////////////////////////////
        $userDetail = Helper::getUserOrder($request->phone);

        $invoice = Helper::generateInvoice();
        $method = $request->methodCode;
        $methodName = $request->methodName;
        // dd(config('tripay.tripay_private_key'));

        $data = [
            'method'         => $method,
            'merchant_ref'   => $invoice,
            'amount'         => $product->price,
            'customer_name'  => $userDetail['name'],
            'customer_email' => $userDetail['email'],
            'customer_phone' => $userDetail['phone'],
            'order_items'    => [
                [
                    'sku'         => '#P' . $product->id,
                    'name'        => $product->name,
                    'price'       => $product->price,
                    'quantity'    => 1,
                    'product_url' => url('/product/' . $product->slug),
                    'image_url'   => Helper::imageUrl($product->image),
                ]
            ],
            'return_url'   => url('/order/' . $invoice),
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => Signature::generate($invoice . $product->price)
        ];

        // dengan facade

        $tripay = (new Tripay(new HttpClient(env('TRIPAY_API_KEY'))));

        $create = $tripay->createTransaction($data, Tripay::CLOSE_TRANSACTION)->getResponse();
        if ($create['success']) {
            $res = $create['data'];
            $destination = "";
            if ($res['pay_url'] != null) {
                $destination = $res['pay_url'];
            } elseif ($res['pay_code'] != null) {
                $destination = $res['pay_code'];
            } elseif ($res['qr_url'] !== null) {
                $destination = $res['qr_url'];
            }

            $order = new Order();
            $order->product_id = $product->id;
            $order->user_id = $userDetail['id'];
            $order->guest_phone = $request->phone;
            $order->invoice = $invoice;
            $order->payment_method_code = $method;
            $order->payment_method_name = $methodName;
            $order->amount = $product->price;
            $order->fee = $request->fee;
            $order->total = $request->amountTotal;
            $order->payment_instructions = json_encode($res['instructions']);
            $order->payment_destination = $destination;
            $order->status = 'unpaid';
            $order->reference = $res['reference'];
            $order->save();

            return response()->json(['success' => true, 'redirect' => '/invoice/' . $invoice], 200, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json($create, 200, [], JSON_PRETTY_PRINT);
        }
    }

    public function checkoutProduct(Request $request): \Inertia\Response
    {
        $props['product'] = Product::where('slug', $request->slug)->with('category')->first();
        if (!$props['product']) to_route('/');
        $props['paymentChannel'] = $this->paymentChannel();
        $props['userData'] = Helper::getUserOrder('');
        $data['props'] = $props;

        return Inertia::render('Products/checkout', $data);
    }
    public function getInvoice(Request $request): \Inertia\Response
    {
        $props['order'] = Order::where('invoice', $request->invoice)->with('product')->first();
        $data['props'] = $props;
        return Inertia::render('Products/invoice', $data);
    }
    public function getTransaction(Request $request): JsonResponse
    {
        $tripay = (new Tripay(new HttpClient(env('TRIPAY_API_KEY'))));
        if (!$request->invoice) return response()->json(['success' => false, 'msg' => 'Please provide invoice']);

        $order =  Order::where('invoice', $request->invoice)->first();
        if (!$order) return response()->json(['success' => false, 'msg' => 'Invoice not found']);

        $ref = $order->reference;

        $response = $tripay->getDetailTransaction($ref, Tripay::CLOSE_TRANSACTION)->getResponse();
        $responseData = $response['data'];
        if(Order::PURCHASING_STATUS_TEXT[$order->status] != $responseData['status'])
        {
            $order->status = Order::PURCHASING_STATUS[$responseData['status']];
            $order->save();
        }
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    


    public function downloadProduct(Request $request)
    {
        $product_id = $request->product_id; 
        $order_id = base64_decode($request->sig);
        $product_file = $request->file;

        if(!$product_id || !$order_id) return 'Download link not exists';

        $product = Product::find($product_id);
        $order = Order::find($order_id);

        if(!$product|| !$order) return 'Product or order not found';
        if($order->user_id != auth()->user()->id) return 'Permission denied';
        if(!file_exists(storage_path('app/repositories/'.$product_file)) && $product_file !== 'github') return 'File not found';
        if($product->product_type !== 'github'){
        return response()->download(storage_path('app/repositories/'.$product_file));
        }else{
            $ghdata = json_decode($product->github_data,true);
            $gh = (new \App\Http\Controllers\GithubController)->ghCollection('download' , ['repoName' => $ghdata['repo'],'assetId' => $ghdata['asset_id'] ]);
            $fname = sys_get_temp_dir().'/[JavaraDigital]_'.$ghdata['asset_id'].'-'.$product->slug.'.zip';
            @file_put_contents($fname,$gh);
            return response()->download($fname);
        }
    }
}
