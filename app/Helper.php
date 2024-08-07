<?php

namespace App;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;


class Helper
{
    public static function productViewUpdated(string $slug): void
    {
        // Cek apakah cookie sudah ada
        $viewedProducts = Cookie::get('viewed_products', []);
        if (!is_array($viewedProducts)) {
            $viewedProducts = json_decode($viewedProducts, true) ?: [];
        }

        // Jika produk sudah ada dalam cookie, tidak perlu menambah view
        if (in_array(sha1($slug), $viewedProducts)) {
            return;
        }

        // Perbarui jumlah tampilan produk
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $product->views += 1;
            $product->save();

            // Tambahkan ID produk ke dalam cookie
            $viewedProducts[] = sha1($slug);
            Cookie::queue(Cookie::make('viewed_products', json_encode($viewedProducts), 60 * 24)); // Cookie berlaku selama 1 hari
        }
    }

    public static function generateInvoice()
    {
        // Generate a random string
        $randomString = bin2hex(random_bytes(8));

        // Get the current date
        $datePrefix = date('Ymd'); // Format: YYYYMMDD

        // Combine the date prefix with the random string
        $invoiceNumber = 'INV-' . $datePrefix . strtoupper($randomString);

        return $invoiceNumber;
    }

    public static function imageUrl($string)
    {
        if (preg_match("/^http/", $string)) {
            $url = $string;
        } else {
            $url = url('/storage/' . $string);
        }
        return $url;
    }

    public static function getUserOrder($phone = null)
    {
        if (auth()->check()) {
            return [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone
            ];
        } else {
            $user = new User();
            $email = $phone . '@c.us';
            $name = 'user' . $phone;

            $checkUser = $user->where('email', $email)->orWhere('name', $name)->first();

            if (!$checkUser && $phone !== '') {

                $user->name = 'user' . $phone;
                $user->email = $phone . '@c.us';
                $user->password = bcrypt($phone);
                $user->save();
                auth()->login($user,true);
            }

            return [
                'id' => $user?->id ?? $checkUser?->id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ];
        }
    }
}
