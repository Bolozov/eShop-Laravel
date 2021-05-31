@extends('site.app')
@section('title', 'Checkout')
@section('content')
<section class="section-pagetop">
    <div class="container clearfix">
        <h2 class="title-page">Checkout</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
            </div>
        </div>


        <section class="py-5">
            <!-- BILLING ADDRESS-->
            <h2 class="h5 text-uppercase mb-4">Détails de la facturation</h2>
            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ route('checkout.place.order') }}" method="POST" role="form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="first_name">Prénom</label>
                                <input class="form-control form-control-lg" name="first_name" value='{{ Auth::user()->first_name}}' type="text" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="last_name">Nom</label>
                                <input class="form-control form-control-lg" name="last_name" value='{{ Auth::user()->last_name}}' type="text" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="email">Addresse Email </label>
                                <input class="form-control form-control-lg" name="email" type="email" value=' {{  Auth::user()->email }}' disabled required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="phone_number">Num. Téléphone</label>
                                <input class="form-control form-control-lg" name="phone_number" type="tel" placeholder="e.g. +216 24001001" required>
                            </div>


                            <div class="col-lg-12 form-group">
                                <label class="text-small text-uppercase" for="address">Addresse</label>
                                <input class="form-control form-control-lg" name="address" value='{{ Auth::user()->address}}' type="text" required>
                            </div>

                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="city">Ville</label>
                                <input class="form-control form-control-lg" name="city" value='{{ Auth::user()->city}}' type="text" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="post_code">Code Postale</label>
                                <input class="form-control form-control-lg" name="post_code" type="number" required>
                                <input type="hidden" class="form-control" name="country" value='{{ Auth::user()->country}}'>

                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="text-small text-uppercase" for="note">Remarques</label>
                                <textarea class="form-control" name="notes" rows="6"></textarea>

                            </div>


                            @if(\Cart::getSubTotal() > 0)

                            <div class="col-lg-12 form-group">
                                <button class="btn btn-dark" type="submit">Passer la commande</button>
                            </div>

                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Votre commande</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach(\Cart::getContent() as $item)
                                <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold">{{ Str::words($item->name,20) }} * {{ $item->quantity }}</strong><span class="text-muted small">{{ ( $item->price * $item->quantity ) .' ' . config('settings.currency_symbol') }}</span></li>
                                <li class="border-bottom my-2"></li>
                                @endforeach
                                <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Total</strong><span>{{ \Cart::getSubTotal() }} {{ config('settings.currency_symbol') }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @endsection
