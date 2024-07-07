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
        if(!$product) abort(404);
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
                    'sku'         => '#P'.$product->id,
                    'name'        => $product->name,
                    'price'       => $product->price,
                    'quantity'    => 1,
                    'product_url' => url('/product/'.$product->slug),
                    'image_url'   => Helper::imageUrl($product->image),
                ]
            ],
            'return_url'   => url('/order/'.$invoice),
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => Signature::generate($invoice.$product->price)
        ];

        // dengan facade

        $tripay = (new Tripay(new HttpClient(env('TRIPAY_API_KEY'))));

        $create= $tripay->createTransaction($data, Tripay::CLOSE_TRANSACTION)->getResponse();
        if($create['success'])
        {
            $res = $create['data'];
            $destination = "";
            if($res['pay_url'] != null)
            {
                $destination = $res['pay_url'];
            }elseif($res['pay_code'] != null)
            {
                $destination = $res['pay_code'];
            }elseif($res['qr_url'] !== null)
            {
                $destination = $res['qr_url'];
            }

            $order = new Order();
            $order->product_id = $product->id;
            $order->user_id = (auth()->check() ? auth()->user()->id : null);
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
            $order->save();

            return response()->json(['success' => true,'redirect' => '/invoice/'.$invoice] , 200,[],JSON_PRETTY_PRINT);
        }else{
            return response()->json($create , 200,[],JSON_PRETTY_PRINT);
        }
    }

    public function checkoutProduct(Request $request): \Inertia\Response
    {
        $props['product'] = Product::where('slug', $request->slug)->with('category')->first();
        if (!$props['product']) to_route('/');
        $props['paymentChannel'] = $this->paymentChannel();

        $data['props'] = $props;
        return Inertia::render('Products/checkout', $data);
    }
    public function getInvoice(Request $request): \Inertia\Response
    {
        $props['order'] = Order::where('invoice',$request->invoice)->with('product')->first();
        $data['props'] = $props;
        return Inertia::render('Products/invoice',$data);
    }
}
