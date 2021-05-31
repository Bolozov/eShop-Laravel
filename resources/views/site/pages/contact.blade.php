@extends('site.app')
@section('title', 'Contact')
@section('content')

<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <h1 class="h2 text-uppercase mb-0">Nous Contactez</h1>
            </div>

        </div>
    </div>
</section>
<section class="section-content bg padding-y mb-5 mt-5">
    <div class="container">
        <form action="">

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Nom</label>
                    <input class="form-control" id="name" name="name" type="text" placeholder="Votre nom" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Prénom</label>
                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Votre prénom" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="Votre email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Numéro Téléphone</label>
                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="26 001 001" required>
                </div>
            </div>
            <div class="row">
                <div class=" form-group col-lg-12">
                    <label class="text-small text-uppercase" for="note">message</label>
                    <textarea class="form-control" name="message" rows="6" required></textarea>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 form-group text-center">
                    <button class="btn btn-dark" type="submit">Envoyer !</button>
                </div>
            </div>

    </div>
    </div>

    </form>
</section>
@stop
