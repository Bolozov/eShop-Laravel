@extends('site.app')
@section('title', 'Order Completed')
@section('content')
    <div class="container">
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Succès ! </h1>
                </div>

            </div>
        </div>
    </section>
    </div>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <main class="col-sm-12">
                    <p class="alert alert-success">Votre commande est enregistrée avec succès.Votre numéro de commande est : {{ $order->order_number }}.</p></main>
            </div>
        </div>
    </section>
@stop
