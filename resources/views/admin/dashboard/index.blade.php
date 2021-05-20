@extends('admin.app')
@section('title') Tableau de bord @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon">
            <i class="icon fa fa-users fa-3x"></i>
            <div class="info">
                <h4>Utilisateurs</h4>
                <p><b>{{ $usersCount }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon">
            <i class="icon fa fa-bar-chart fa-3x"></i>
            <div class="info">
                <h4>Commandes</h4>
                <p><b>{{ $ordersCount }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon">
            <i class="icon fa fa-shopping-bag fa-3x"></i>
            <div class="info">
                <h4>Produits</h4>
                <p><b>{{ $productsCount }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon">
            <i class="icon fa fa-star fa-3x"></i>
            <div class="info">
                <h4>Catégories</h4>
                <p><b>{{ $categoriesCount }}</b></p>
            </div>
        </div>
    </div>
</div>


<div class="card border-secondary mb-3">
    <div class="card-header text-primary">
        <h5> <i class="fa fa-file "></i> Commandes reçu en {{now()->year}} ( {{ $ordersCount }} )</h5>
    </div>
    <div class="card-body text-secondary">
        {!! $chart->container() !!}
    </div>
</div>
<div class="card border-secondary mb-3">
    <div class="card-header text-primary">
        <h5> <i class="fa fa-file "></i> Nouveau Clients en {{now()->year}} ( {{ $usersCount }} )</h5>
    </div>
    <div class="card-body text-secondary">
        {!! $newUsersChart->container() !!}
    </div>
</div>
</div> --}}

<script src="{{ LarapexChart::cdn() }}"></script>
{{ $chart->script() }}
{{ $newUsersChart->script() }}

@endsection
