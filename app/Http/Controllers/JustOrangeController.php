<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class JustOrangeController extends Controller
{
    public function index(): \Inertia\Response
    {
        $props['products'] = Product::limit(8)->orderBy('id','desc')->get();
        $props['categories'] = Category::where('active',true)->get();
        $props['posts'] = Post::limit(6)->orderBy('id','desc')->get();
        
        $data['props'] =$props;
        return Inertia::render('justorange-default',$data);
    }






    /**--------------------------- VIEW POST SECTION -------------------------- */
    public function post(Request $request): \Inertia\Response
    {
        $props['post'] = Post::where('slug',$request->slug)->first();
        
        $data['props'] = $props;
        return Inertia::render('Posts/detail',$data);
    }
    public function posts(Request $request): \Inertia\Response
    {
        $props['posts'] = Post::orderBy('id','desc')->get();
        
        $data['props'] = $props;
        return Inertia::render('Posts/index',$data);
    }
    /**--------------------------- VIEW POST SECTION -------------------------- */



    /**--------------------------- VIEW PRODUCT SECTION -------------------------- */
    public function product(Request $request): \Inertia\Response
    {
        $props['product'] = Product::where('slug',$request->slug)->first();
        
        $data['props'] = $props;
        return Inertia::render('Products/detail',$data);
    }
    public function products(Request $request): \Inertia\Response
    {
        $props['products'] = Post::orderBy('id','desc')->get();
        
        $data['props'] = $props;
        return Inertia::render('Products/detail',$data);
    }
    /**--------------------------- VIEW PRODUCT SECTION -------------------------- */

}
