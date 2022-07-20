<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'product_Category' => Category::whereStatus(1)->whereNull('parent_id')->inRandomOrder()->get(),
        ];
        return view('website.index', $data);
    }

    public function product($slug)
    {
        $data = [
            'product' => Product::whereSlug($slug)->get(),
        ];
        return view('website.product.product', $data);
    }
}
