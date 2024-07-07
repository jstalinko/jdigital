<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
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
    public function createTransaction(Request $request)
    {
        $data = [
            'method'         => 'BRIVA',
            'merchant_ref'   => 'KODE INVOICE',
            'amount'         => 50000,
            'customer_name'  => 'Nama Pelanggan',
            'customer_email' => 'emailpelanggan@domain.com',
            'customer_phone' => '081234567890',
            'order_items'    => [
                [
                    'sku'         => 'FB-06',
                    'name'        => 'Nama Produk 1',
                    'price'       => 50000,
                    'quantity'    => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    'image_url'   => 'https://tokokamu.com/product/nama-produk-1.jpg',
                ]
            ],
            'return_url'   => 'https://domainanda.com/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => Signature::generate('KODE INVOICE' . 50000)
        ];
        
        // dengan facade
        
        $tripay = (new Tripay(new HttpClient(env('TRIPAY_API_KEY'))));

        return $tripay->createTransaction($data,Tripay::CLOSE_TRANSACTION);
    }

    public function checkoutProduct(Request $request): \Inertia\Response
    {
        $props['product'] = Product::where('slug', $request->slug)->with('category')->first();
        if (!$props['product']) to_route('/');
        $props['paymentChannel'] = $this->paymentChannel();

        $data['props'] = $props;
        return Inertia::render('Products/checkout', $data);
    }
}
