<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Helper;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JustOrangeController extends Controller
{
    public ?array $global;

    public function __construct()
    {
        $this->global['currentUrl'] = url()->current();
    }

    public function index(): \Inertia\Response
    {
        $props['products'] = Product::limit(8)->orderBy('id', 'desc')->get();
        $props['categories'] = Category::where('active', true)->get();
        $props['posts'] = Post::limit(6)->orderBy('id', 'desc')->get();
        $props['global'] = $this->global;

        $data['props'] = $props;
        return Inertia::render('justorange-default', $data);
    }
    public function about(): \Inertia\Response
    {

        return Inertia::render('about');
    }
    public function contact(): \Inertia\Response
    {

        return Inertia::render('contact');
    }



    /**--------------------------- VIEW POST SECTION -------------------------- */
    public function post(Request $request): \Inertia\Response
    {
        $post = Post::where('slug', $request->slug)->first();

        if (!$post) {
            return to_route('/');
        }


        $relatedPosts = DB::table('posts')
            ->whereExists(function ($query) use ($post) {
                $query->select(DB::raw(1))
                    ->from(DB::raw('json_each(posts.tags)'))
                    ->whereNotNull('json_each.value');
            })
            ->where('id', '!=', $post->id)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $props['post'] = $post;
        $props['posts'] = $relatedPosts;
        $props['global'] = $this->global;
        $data['props'] = $props;

        return Inertia::render('Posts/detail', $data);
    }
    public function posts(Request $request): \Inertia\Response
    {
        $props['posts'] = Post::orderBy('id', 'desc')->get();
        $props['global'] = $this->global;
        $data['props'] = $props;
        return Inertia::render('Posts/index', $data);
    }
    /**--------------------------- VIEW POST SECTION -------------------------- */



    /**--------------------------- VIEW PRODUCT SECTION -------------------------- */
    public function product(Request $request): \Inertia\Response
    {
        Helper::productViewUpdated($request->slug);
        $props['product'] = Product::where('slug', $request->slug)->with('category')->first();
        $props['global'] = $this->global;
        $data['props'] = $props;
        return Inertia::render('Products/detail', $data);
    }
    public function products(Request $request): \Inertia\Response
    {
        $props['products'] = Product::orderBy('id', 'desc')->with('category')->get();
        $props['categories'] = Category::where('active', true)->get();
        $props['global'] = $this->global;


        $data['props'] = $props;
        return Inertia::render('Products/index', $data);
    }
    /**--------------------------- VIEW PRODUCT SECTION -------------------------- */
}
