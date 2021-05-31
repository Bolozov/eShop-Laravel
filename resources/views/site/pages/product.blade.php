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

<section class="section-content bg padding-y border-top" id="site">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row no-gutters">
                        <aside class="col-sm-5 border-right">
                            <article class="gallery-wrap">
                                @if ($product->images->count() > 0)
                                <div class="img-big-wrap">
                                    <div class="padding-y">
                                        <a href="{{ asset('storage/'.$product->images->first()->full) }}" data-fancybox="">
                                            <img src="{{ asset('storage/'.$product->images->first()->full) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="img-big-wrap">
                                    <div>
                                        <a href="https://via.placeholder.com/200" data-fancybox=""><img src="https://via.placeholder.com/200"></a>
                                    </div>
                                </div>
                                @endif
                                @if ($product->images->count() > 0)
                                <div class="img-small-wrap">
                                    @foreach($product->images as $image)
                                    <div class="item-gallery">
                                        <img src="{{ asset('storage/'.$image->full) }}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </article>
                        </aside>
                        <aside class="col-sm-7">
                            <article class="p-5">
                                <h3 class="title mb-3">{{ $product->name }}</h3>
                                <dl class="row">
                                    <dt class="col-sm-3">SKU</dt>
                                    <dd class="col-sm-9">{{ $product->sku }}</dd>
                                </dl>
                                <div class="mb-3">
                                    @if ($product->sale_price > 0)
                                    <var class="price h3 text-danger">
                                        <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->sale_price }}</span>
                                        <del class="price-old"> {{ config('settings.currency_symbol') }}{{ $product->price }}</del>
                                    </var>
                                    @else
                                    <var class="price h3 text-success">
                                        <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->price }}</span>
                                    </var>
                                    @endif
                                </div>
                                <hr>
                                <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <dl class="dlist-inline">
                                                @foreach($attributes as $attribute)
                                                @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                                @php
                                                if ($product->attributes->count() > 0) {
                                                $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray());
                                                } else {
                                                $attributeCheck = [];
                                                }
                                                @endphp

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
                                                @endforeach
                                            </dl>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <dl class="dlist-inline">
                                                <dt>Quantity: </dt>
                                                <dd>
                                                    <input class="form-control" type="number" min="1" value="1" max="{{ $product->quantity }}" name="qty" style="width:70px;">
                                                    <input type="hidden" name="productId" value="{{ $product->id }}">
                                                    <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                                </form>
                            </article>
                        </aside>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <article class="card mt-4">
                    <div class="card-body">
                        {!! $product->description !!}
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@stop

{{-- @section('content')
<section class="py-5">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-6">
              <!-- PRODUCT SLIDER-->
              <div class="row m-sm-0">
                <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                  <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0 active"><img class="w-100" src="img/product-detail-1.jpg" alt="..."></div>
                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="img/product-detail-2.jpg" alt="..."></div>
                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="img/product-detail-3.jpg" alt="..."></div>
                    <div class="owl-thumb-item flex-fill mb-2"><img class="w-100" src="img/product-detail-4.jpg" alt="..."></div>
                  </div>
                </div>
                <div class="col-sm-10 order-1 order-sm-2">
                  <div class="owl-carousel product-slider owl-loaded owl-drag" data-slider-id="1"><div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1680px;"><div class="owl-item active" style="width: 420px;"><a class="d-block" href="img/product-detail-1.jpg" data-lightbox="product" title="Product item 1"><img class="img-fluid" src="img/product-detail-1.jpg" alt="..."></a></div><div class="owl-item" style="width: 420px;"><a class="d-block" href="img/product-detail-2.jpg" data-lightbox="product" title="Product item 2"><img class="img-fluid" src="img/product-detail-2.jpg" alt="..."></a></div><div class="owl-item" style="width: 420px;"><a class="d-block" href="img/product-detail-3.jpg" data-lightbox="product" title="Product item 3"><img class="img-fluid" src="img/product-detail-3.jpg" alt="..."></a></div><div class="owl-item" style="width: 420px;"><a class="d-block" href="img/product-detail-4.jpg" data-lightbox="product" title="Product item 4"><img class="img-fluid" src="img/product-detail-4.jpg" alt="..."></a></div></div></div><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div><div class="owl-dots"><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div></div></div>
                </div>
              </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">

              <h1>{{ $product->name }}</h1>
              <p class="text-muted lead">{{ $product->price }}</p>
              <p class="text-small mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam convallis.</p>
              <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                    <div class="quantity">
                      <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                      <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                      <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="cart.html">Add to cart</a></div>
              </div><a class="btn btn-link text-dark p-0 mb-4" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a><br>
              <ul class="list-unstyled small d-inline-block">
                <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">SKU:</strong><span class="ml-2 text-muted">039</span></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ml-2" href="#">Demo Products</a></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Tags:</strong><a class="reset-anchor ml-2" href="#">Innovation</a></li>
              </ul>
            </div>
          </div>
          <!-- DETAILS TABS-->
          <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a></li>
          </ul>
          <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <div class="p-4 p-lg-5 bg-white">
                <h6 class="text-uppercase">Product description </h6>
                <p class="text-muted text-small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="p-4 p-lg-5 bg-white">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="media mb-3"><img class="rounded-circle" src="img/customer-1.png" alt="" width="50">
                      <div class="media-body ml-3">
                        <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                        <ul class="list-inline mb-1 text-xs">
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                        </ul>
                        <p class="text-small mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      </div>
                    </div>
                    <div class="media"><img class="rounded-circle" src="img/customer-2.png" alt="" width="50">
                      <div class="media-body ml-3">
                        <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                        <ul class="list-inline mb-1 text-xs">
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                        </ul>
                        <p class="text-small mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
@endsection --}}
@push('scripts')
<script>
    $(document).ready(function() {
        $('#addToCart').submit(function(e) {
            if ($('.option').val() == 0) {
                e.preventDefault();
                alert('Please select an option');
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
