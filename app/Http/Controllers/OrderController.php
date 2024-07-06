<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Nekoding\Tripay\Networks\HttpClient;
use Nekoding\Tripay\Tripay;


class OrderController extends Controller
{
    protected function paymentChannel(): Collection
    {

        $tripay = new Tripay(new HttpClient('DEV-h9WRz6gl4Ttcgq3eAnIoypdXGHOLEBxyxkcwfjWM'));

        return $tripay->getChannelPembayaran();
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
