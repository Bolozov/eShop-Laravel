<?php

namespace App\Http\Controllers\Site;

use App\Contracts\AttributeContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    protected $attributeRepository;

    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }
    public function index()
    {
        $products = Product::with(['images', 'brand'])->paginate(12);
        return view('site.pages.products', compact('products'));
    }

    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        return view('site.pages.product', compact('product', 'attributes'));
    }

    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'productId', 'price', 'qty');

        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

        return redirect()->back()->with('message', 'Article ajouté au panier avec succès.
        ');
    }

    public function search(Request $request)
    {
        $q = $request->q;
        //dd($q);
        $products = Product::where('name', 'LIKE', '%'.$q.'%')->with(['images', 'brand'])->orderBy('price','asc')->paginate(5);
        return view('site.pages.products', compact('products'));

    }
}
