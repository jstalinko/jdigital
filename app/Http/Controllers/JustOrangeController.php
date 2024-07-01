<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class JustOrangeController extends Controller
{
    public function index(): \Inertia\Response
    {
        $data['products'] = Product::limit(8)->orderBy('id','desc')->get();
        $data['categories'] = Category::where('active',true)->get();
        return Inertia::render('justorange-default',$data);
    }
}
