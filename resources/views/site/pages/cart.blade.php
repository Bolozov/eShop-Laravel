@extends('site.app')
@section('title', 'Panier')
@section('content')

<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Panier</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Page d'accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Panier</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Mon panier d'achat</h2>
        <div class="row">
            @if (Session::has('message'))
            <p class="alert alert-success col-lg-8 mb-4 mb-lg-0">{{ Session::get('message') }}</p>
            @endif
            <div class="col-lg-8 mb-4 mb-lg-0">
                @if (\Cart::isEmpty())
                <p class="alert alert-warning mt-5">Votre panier est vide.</p>
                @else
                <!-- CART TABLE-->
                <div class="table-responsive mb-4">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Produit</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Prix</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantité</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                                <th class="border-0" scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\Cart::getContent() as $item)
                            <tr>
                                <th class="pl-0 border-0" scope="row">
                                    <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" >
                                        <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" >{{ Str::words($item->name,20) }}</a></strong></div>
                                        @foreach($item->attributes as $key => $value)
                                        <dl class="dlist-inline small">
                                            <dt>{{ ucwords($key) }}: </dt>
                                            <dd>{{ ucwords($value) }}</dd>
                                        </dl>
                                        @endforeach
                                    </div>
                                </th>
                                <td class="align-middle border-0">
                                    <p class="mb-0 small">{{$item->price . config('settings.currency_symbol') }}</p>
                                </td>
                                <td class="align-middle border-0">
                                    <p class="mb-0 small">{{$item->quantity }}</p>

                                </td>
                                <td class="align-middle border-0">
                                    <p class="mb-0 small">{{ ( $item->price * $item->quantity ) .  config('settings.currency_symbol') }}</p>
                                </td>
                                <td class="align-middle border-0 text-danger"><a class="reset-anchor" href="{{ route('checkout.cart.remove', $item->id) }}"><i class="fas fa-trash-alt small text-muted"></i></a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                @endif
                <!-- CART NAV-->
                <div class="bg-light px-4 py-3">
                    <div class="row align-items-center text-center">
                        <div class="col-md-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="{{route('products')}}"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Continuer mes achats</a></div>
                        @if (! \Cart::isEmpty())
                        <div class="col-md-6 text-md-right"><a class="btn btn-outline-dark btn-sm" href="{{ route('checkout.index') }}">Commander<i class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
                <div class="card border-0 rounded-0 p-lg-4 bg-light">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-4">Panier total</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="border-bottom my-2"></li>
                            <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>{{ \Cart::getSubTotal() }} {{ config('settings.currency_symbol') }}</span></li>
                        </ul>
                    </div>
                    @if(! \Cart::isEmpty())
                    <div class="form-group mb-0">
                        <a class="btn btn-outline-danger btn-sm btn-block" href="{{ route('checkout.cart.clear') }}" onclick="return confirm('Voulez vous videz votre panier ?')"> <i class="fas fa-trash mr-2"></i>Vider Mon Panier</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
