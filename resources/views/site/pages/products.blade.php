@extends('site.app')
@section('title', 'Produits')
@section('content')
<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Produits</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produits</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container p-0">
            <div class="row">
                <!-- SHOP SIDEBAR-->
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">Catégories</strong></div>
                    <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                        @foreach (\App\Models\Category::all() as $category)
                        @if($category->featured == 1 && $category->name !== "Root")
                        <li class="mb-2"><a class="reset-anchor text-success" href="{{ route('category.show', $category->slug) }}"> <i class="fa fa-star"></i> {{ $category->name }}</a></li>
                        @elseif($category->name !== "Root")
                        <li class="mb-2"><a class="reset-anchor " href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></li>
                        @endif
                        @endforeach
                    </ul>

                </div>
                <!-- SHOP LISTING-->
                <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">

                    <div class="row">
                        @forelse($products as $product)
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="mb-3 position-relative">
                                    <div class="badge text-white badge-"></div><a class="d-block" href="{{ route('product.show', $product->slug) }}">
                                        @if ($product->images->count() > 0)
                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$product->images->first()->full) }}" alt="...">

                                        @else
                                        <img class="img-fluid w-100" src="https://via.placeholder.com/176" alt="...">

                                        @endif
                                    </a>
                                    <div class="product-overlay">
                                        <ul class="mb-0 list-inline">
                                            {{-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li> --}}
                                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="{{ route('product.show', $product->slug) }}">Afficher les détails</a></li>
                                            {{-- <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li> --}}
                                        </ul>

                                    </div>
                                </div>
                                <h6> <a class="reset-anchor" href="{{ route('product.show', $product->slug) }}">{{ $product->name}}</a></h6>
                                @if ($product->sale_price)
                                <del class="text-danger">{{ $product->price}} DT</del> {{ $product->sale_price}} DT
                                @else
                                {{ $product->price}} DT
                                @endif
                                <p class="small text-muted">{{ $product->brand->name}}</p>
                            </div>
                        </div>
                        @empty
                        <p>0 Produit Trouvé.</p>
                        @endforelse


                    </div>
                    <!-- PAGINATION-->
                    <nav aria-label="Page navigation example">
                        {{ $products->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
