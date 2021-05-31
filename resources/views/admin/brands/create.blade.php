@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
    </div>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="tile">
            <h3 class="tile-title">{{ $subTitle }}</h3>
            <form action="{{ route('admin.brands.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="name">Nom <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}" />
                        @error('name') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="abr">Abreviation <span class="m-l-5 text-danger"></span></label>
                        <input class="form-control @error('abr') is-invalid @enderror" type="text" name="abr" id="abr" value="{{ old('abr') }}" />
                        @error('abr') {{ $message }} @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label class="control-label" for="adress">Adresse <span class="m-l-5 text-danger"></span></label>
                            <input class="form-control @error('adress') is-invalid @enderror" type="text" name="adress" id="adress" value="{{ old('adress') }}" />
                            @error('adress') {{ $message }} @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="town">Ville <span class="m-l-5 text-danger"></span></label>
                            <select class="custom-select" name="town" id="town">
                                <option value="">Ville</option>
                                <option value="tunis">Tunis</option>
                                <option value="bizerte">Bizerte</option>
                                <option value="autres">Autres</option>
                            </select>
                            @error('town') <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="mapsLink">Lien vers Maps <span class="m-l-5 text-danger"></span></label>
                        <input class="form-control @error('mapsLink') is-invalid @enderror" type="url" name="mapsLink" id="mapsLink" value="{{ old('mapsLink') }}" />
                        @error('mapsLink') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label">Logo Magasin </label>
                        <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" />
                        @error('logo') {{ $message }} @enderror
                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Sauvgarder</button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('admin.brands.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush
