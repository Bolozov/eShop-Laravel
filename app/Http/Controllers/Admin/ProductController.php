<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Contracts\BrandContract;
use App\Contracts\ProductContract;
use App\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreProductFormRequest;

class ProductController extends BaseController
{
    protected $brandRepository;

    protected $categoryRepository;

    protected $productRepository;

    public function __construct(
        BrandContract $brandRepository,
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    ) {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->listProducts();

        $this->setPageTitle('Produits', 'Liste de produits');
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = Category::all()->except([1]);

        $this->setPageTitle('Produits', 'Ajouter un Produit');
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(StoreProductFormRequest $request)
    {

        $params = $request->except('_token');



        $product = $this->productRepository->createProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de la création de produit.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Produit ajouté avec succès', 'success', false, false);
    }

    public function edit($id)
    {
        $product = $this->productRepository->findProductById($id);
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Products', 'Edit Product');
        return view('admin.products.edit', compact('categories', 'brands', 'product'));
    }

    public function update(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de la mise à jour du produit.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Produit mis à jour avec succès', 'success', false, false);
    }

    public function inactif($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->responseRedirectBack('Une erreur s\'est produite', 'error', true, true);
        }
        $product->status = 0;
        $product->save();
        return $this->responseRedirect('admin.products.index', 'Status du Produit : inactif.', 'success', false, false);

    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de la suppression  du produit.', 'error', true, true);
        }

        $product->delete();
        return $this->responseRedirect('admin.products.index', 'Produit supprimé.', 'success', false, false);

    }

}
