@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
        <p>{{ $subTitle }}</p>
    </div>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary pull-right">Ajouter un magasin</a>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Nom </th>
                            <th> Slug </th>
                            <th> Abriviation </th>
                            <th> Adresse </th>
                            <th> Maps </th>
                            <th> Nb. des produits </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->slug }}</td>
                            <td>{{ $brand->abr }}</td>
                            <td>{{ $brand->adress .' , '. ucfirst($brand->town) }}</td>
                            <td> <a href="{{ $brand->mapsLink}}" target="_blank"> Afficher</a></td>
                            <td>{{ $brand->products()->count()}}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.brands.delete', $brand->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('voulez vous supprimez ce magasin?');"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable({
        language: {
            url: '{{ asset("backend/js/French.json") }}'
        }
    });

</script>@endpush
