@extends('site.app')
@section('title', $product->name)
@section('content')

<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page"></h2>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">{{ $product->name }}</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                        <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Accueil</a></li>
                        <li class="breadcrumb-item " aria-current="page"><a href="{{ route('products') }}">Produits</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        @if (Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
        @endif
        <div class="row mb-5">
            <div class="col-lg-6">
                <!-- PRODUCT SLIDER-->
                <div class="row m-sm-0">

                    <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                        <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                            @if($product->images->count() < 0 ) <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0 active"><img class="w-100" src="https://via.placeholder.com/200"></div>
                        @else
                        @foreach ($product->images as $image )
                        <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0 {{ $loop->first ? 'active' : '' }}"><img class="w-100" src="{{ asset('storage/'.$image->full) }}"></div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-sm-10 order-1 order-sm-2">
                    <div class="owl-carousel product-slider owl-loaded owl-drag" data-slider-id="1">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1680px;">
                                @if($product->images->count() < 1) <div class="owl-item active" style="width: 420px;"><a class="d-block" href="https://via.placeholder.com/200" data-lightbox="product" title="{{ $product->name }}"><img class="img-fluid" src="https://via.placeholder.com/200" alt="..."></a></div>
                            @else
                            @foreach ($product->images as $image )

                            <div class="owl-item" style="width: 420px;"><a class="d-block" href="{{ asset('storage/'.$image->full) }}" data-lightbox="product" title="{{ $product->name }}"><img class="img-fluid" src="{{ asset('storage/'.$image->full) }}" alt="..."></a></div>


                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="owl-nav disabled">
                        <div class="owl-prev">prev</div>
                        <div class="owl-next">next</div>
                    </div>
                    <div class="owl-dots">
                        <div class="owl-dot active"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS-->
    <div class="col-lg-6">
        <h1>{{ $product->name }}</h1>
        @if ($product->sale_price)
        <div class="text-muted lead">
            <del class="text-danger">{{ $product->price }} {{ config('settings.currency_symbol') }}</del> {{ $product->sale_price }} {{ config('settings.currency_symbol') }}
        </div>
        @else
        <p class="text-muted lead">
            {{ $product->price }} {{ config('settings.currency_symbol') }}
        </p>
        @endif

        <p class="text-small mb-4">{{ $product->description }}</p>
        @foreach($attributes as $attribute)
        @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
        @php
        if ($product->attributes->count() > 0) {
        $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray());
        } else {
        $attributeCheck = [];
        }
        @endphp
        @endforeach
        <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
            @csrf
            <ul class="list-unstyled small d-inline-block">
                <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">SKU:</strong><span class="ml-2 text-muted">{{ $product->sku }}</span></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">catégories:</strong><a class="reset-anchor ml-2" href="#">
                        @foreach ($product->categories as $categories)
                        {{ $categories->name }} ,
                        @endforeach
                    </a>
                </li>
            </ul>
            @if ($attributeCheck)
            <dt>{{ $attribute->name }}: </dt>
            <dd>
                <select class="form-control form-control-sm option" style="width:180px;" name="{{ strtolower($attribute->name ) }}">
                    <option data-price="0" value="0"> Select a {{ $attribute->name }}</option>
                    @foreach($product->attributes as $attributeValue)
                    @if ($attributeValue->attribute_id == $attribute->id)
                    <option data-price="{{ $attributeValue->price }}" value="{{ $attributeValue->value }}"> {{ ucwords($attributeValue->value . ' +'. $attributeValue->price) }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </dd>
            @endif

            <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                    <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                        <div class="quantity">
                            <input class="form-control border-0 shadow-0 p-0" type="number" value="1" max="{{ $product->quantity }}" name="qty" min="1">
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">

                        </div>
                    </div>
                </div>
                <div class="col-sm-3 pl-sm-0"><button type="submit" class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0">Ajouter au panier</button></div>
            </div>
        </form>




    </div>
    </div>
    <!-- DETAILS TABS-->
    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
        <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>

        <li class="nav-item">
            <a class="nav-link" id="magasin-tab" data-toggle="tab" href="#magasin" role="tab" aria-controls="magasin" aria-selected="false">magasin</a>
        </li>
    </ul>


    <div class="tab-content mb-5" id="myTabContent">
        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
            <div class="p-4 p-lg-5 bg-white">
                <h6 class="text-uppercase">Description du produit </h6>
                <p class="text-muted text-small mb-0">{!! $product->description !!}</p>
            </div>
        </div>
        <div class="tab-pane fade " id="magasin" role="tabpanel" aria-labelledby="magasin-tab">
            <div class="p-4 p-lg-5 bg-white">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="media mb-3">
                            @if($product->brand->logo)

                            <img class="rounded-circle" src="{{ asset('storage/'.$product->brand->logo) }}" alt="" width="50">

                            @endif
                            <div class="media-body ml-3">
                                <h6 class="mb-2 text-uppercase">{{ $product->brand->name }} ( {{ $product->brand->abr }} )</h6>
                                <p class="small text-muted mb-2 text-uppercase">{{ $product->brand->adress }} , {{ $product->brand->town }} </p>
                                <p class="mb-2 text-success"><a href="{{ $product->brand->mapsLink }} " target="_blank"> <i class="fas fa-map-marker"></i> Google Maps</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#addToCart').submit(function(e) {
            if ($('.option').val() == 0) {
                e.preventDefault();
                alert('Sélectionnez une option');
            }
        });
        $('.option').change(function() {
            $('#productPrice').html("{{ $product->sale_price != '' ? $product->sale_price : $product->price }}");
            let extraPrice = $(this).find(':selected').data('price');
            let price = parseFloat($('#productPrice').html());
            let finalPrice = (Number(extraPrice) + price).toFixed(2);
            $('#finalPrice').val(finalPrice);
            $('#productPrice').html(finalPrice);
        });
    });

</script>
@endpush
