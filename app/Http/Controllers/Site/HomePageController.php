<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index(){
        $categories = Category::where('featured',1)->take(4)->get();
        $products = Product::with(['brand' , 'images'])->where('featured',1)->take(8)->orderBy('price')->get();

        return view('site.pages.homepage', compact('categories' , 'products') );
    }
}
