@extends('layouts.admin')
@section('title', 'Créer un client')

@section('links')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxgYvfuZo9_KtH5VQlEFw6RKZJvj1W0L8&libraries=places"></script>
@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'clients.cars',
                'items' => [
                    ['label' => 'Gestion des voitures clients', 'route' => 'clients.cars'],
                    ['label' => 'Créer une voiture client', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer une voiture client</h5>
                </div>
                <div class="card-body">
                    <div class="row">
        <form method="POST" action="{{ route('clients.cars.update') }}" class="row w-100" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type_form" value="create" />

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="nr_plaques">N° plaques</label>
                <input type="text" class="form-control" id="nr_plaques" name="nr_plaques" placeholder="N° plaques" value="{{ old('nr_plaques') }}">
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="pu_kw">PU. KW</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="pu_kw" id="pu_kw" placeholder="PU. KW" value="{{ old('pu_kw') }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="annee">Année</label>
                <div class="input-group">
                    <input type="annee" class="form-control" name="annee" id="annee" placeholder="Année" value="{{ old('annee') }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="marque">Marque</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="marque" id="marque" placeholder="Marque" value="{{ old('marque') }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="type">Type</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="{{ old('type') }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="chassis">Châssis</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="chassis" id="chassis" placeholder="Châssis" value="{{ old('chassis') }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="hml">HML</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="hml" id="hml" placeholder="HML" value="{{ old('hml') }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="hml">Client</label>
                <select class="form-control select2 select" data-toggle="select2" id="clients" name="client_id" required>
                    @foreach($clients as $client)
                    <option 
                        value="{{ $client->id }}" 
                        data-id="{{ $client->id }}"
                        data-surname="{{ $client->surname }}"
                        data-address="{{ $client->address }}"
                        data-city="{{ $client->city }}"
                        data-name="{{ $client->name }}"
                        data-postal-code="{{ $client->postal_code }}"
                    >
                        {{ $client->name }} {{ $client->surname }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-12 mb-3">
                <button class="btn btn-primary" type="submit">Soumettre le formulaire</button>
            </div>
                    </div>
                </div>
            </form>   
        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>
    $('#clients').val(null).trigger('change');
</script>
@endsection