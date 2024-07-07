<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class TripayWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->json()->all();

        // validate signature
        $merchant_ref = $data['merchant_ref'];
        $merchant_code = config('tripay.tripay_merchant_code');
        $total_amount = $data['total_amount'];
        $callbackSignature = $request->header('X-Callback-Signature');
        $signature = hash_hmac('sha256', $request->getContent(), config('tripay.tripay_private_key'));

        // if signature is not valid, return 403
        if ($callbackSignature !== $signature) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid signature',
                'data' => [
                    'signature' => $signature,
                    'json' => $request->getContent(),
                    'private_key' => config('tripay.tripay_private_key'),
                ]
            ], 403);
        }

        $order = Order::where('invoice', $data['merchant_ref'])->first();

        if (!$order) {
            return response()->json([
                'status' => 'success',
                'message' => 'Invoice not found'
            ], 404);
        }

        $order->status = Order::PURCHASING_STATUS[$data['status']];
        $order->save();

        $product = Product::find($order->product_id);
        $product->sold = $product->sold + 1;
        $product->views = $product->views + 1;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Order status updated',
        ], 200);
    }
}
