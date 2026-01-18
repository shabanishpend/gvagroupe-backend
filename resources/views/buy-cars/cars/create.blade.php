@extends('layouts.admin')
@section('title', 'Créer un nouveau véhicule')

@section('links')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'buy-cars.cars',
                'items' => [
                    ['label' => 'Gestion des voitures', 'route' => 'buy-cars.cars'],
                    ['label' => 'Créer un nouveau véhicule', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer un nouveau véhicule</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('buy-cars.cars.update') }}" class="row w-100" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="create" />

                        <div class="w-100">
                            <!-- Nav pills -->
                            <ul class="nav nav-pills nav-justified mb-3" style="display: none;">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="pill" href="#french">French</a>
                                </li>
                               {{-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#english">English</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#deutch">Deutch</a>
                                </li> --}}
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div class="tab-pane active" id="french">
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_1">Image 1</label>
                                            <input type="file" class="form-control" id="image_1" name="image_1" value="{{ old('image_1') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_2">Image 2</label>
                                            <input type="file" class="form-control" id="image_2" name="image_2" value="{{ old('image_2') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_3">Image 3</label>
                                            <input type="file" class="form-control" id="image_3" name="image_3" value="{{ old('image_3') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_4">Image 4</label>
                                            <input type="file" class="form-control" id="image_4" name="image_4" value="{{ old('image_4') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_5">Image 5</label>
                                            <input type="file" class="form-control" id="image_5" name="image_5" value="{{ old('image_5') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_6">Image 6</label>
                                            <input type="file" class="form-control" id="image_6" name="image_6" value="{{ old('image_6') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_7">Image 7</label>
                                            <input type="file" class="form-control" id="image_7" name="image_7" value="{{ old('image_7') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_8">Image 8</label>
                                            <input type="file" class="form-control" id="image_8" name="image_8" value="{{ old('image_8') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_9">Image 9</label>
                                            <input type="file" class="form-control" id="image_9" name="image_9" value="{{ old('image_9') }}" />
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="image_10">Image 10</label>
                                            <input type="file" class="form-control" id="image_10" name="image_10" value="{{ old('image_10') }}" />
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                            <label for="name">Nom</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="{{ old('name') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="price">Prix</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Prix" value="{{ old('price') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="fuel">Carburant</label>
                                            <input type="text" class="form-control" id="fuel" name="fuel" placeholder="Carburant" value="{{ old('fuel') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="mileage">Kilométrage</label>
                                            <input type="text" class="form-control" id="mileage" name="mileage" placeholder="Kilométrage" value="{{ old('mileage') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="transmission">Transmission</label>
                                            <input type="text" class="form-control" id="transmission" name="transmission" placeholder="Transmission" value="{{ old('transmission') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="performance">Performance</label>
                                            <input type="text" class="form-control" id="performance" name="performance" placeholder="Performance" value="{{ old('performance') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="seats">Sièges</label>
                                            <input type="text" class="form-control" id="seats" name="seats" placeholder="Sièges" value="{{ old('seats') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label for="doors">Portes</label>
                                            <input type="text" class="form-control" id="doors" name="doors" placeholder="Portes" value="{{ old('doors') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Année</label>
                                            <input type="text" class="form-control" id="year" name="year" placeholder="Année" value="{{ old('year') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Châssis no</label>
                                            <input type="text" class="form-control" id="chasie_number" name="chasie_number" placeholder="Châssis no" value="{{ old('chasie_number') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Charroserie</label>
                                            <input type="text" class="form-control" id="carroserie" name="carroserie" placeholder="Carroserie" value="{{ old('chasie_number') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Charroserie code <code></code></label>
                                            <input type="text" class="form-control" id="carroserie_code" name="carroserie_code" placeholder="Carroserie code" value="{{ old('carroserie_code') }}" />
                                        </div>
                                        
                                        <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                            <label class="w-100" for="expertise">Expertise</label>
                                            <select class="form-control select2" id="expertise" name="expertise">
                                                <option value="0" selected>Non</option>
                                                <option value="1">Oui</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Couleur</label>
                                            <input type="text" class="form-control" id="color" name="color" placeholder="Couleur" value="{{ old('color') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Matricule</label>
                                            <input type="text" class="form-control" id="registration_number" name="registration_number" placeholder="Matricule" value="{{ old('registration_number') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Reception par type</label>
                                            <input type="text" class="form-control" id="type_approval" name="type_approval" placeholder="Reception par type" value="{{ old('type_approval') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Cilindre</label>
                                            <input type="text" class="form-control" id="cilindre" name="cilindre" placeholder="Cilindre" value="{{ old('cilindre') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Power</label>
                                            <input type="text" class="form-control" id="power_kw" name="power_kw" placeholder="Power" value="{{ old('power_kw') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Poids a vide</label>
                                            <input type="text" class="form-control" id="weight_no_loaded" name="weight_no_loaded" placeholder="Poids a vide" value="{{ old('weight_no_loaded') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Charge utile</label>
                                            <input type="text" class="form-control" id="weight_loaded" name="weight_loaded" placeholder="Charge utile" value="{{ old('weight_loaded') }}" />
                                        </div>
                                        
                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Poids total</label>
                                            <input type="text" class="form-control" id="weight_full_loaded" name="weight_full_loaded" placeholder="Poids total" value="{{ old('weight_full_loaded') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Charge sur la toit</label>
                                            <input type="text" class="form-control" id="roof_weight" name="roof_weight" placeholder="Charge sur la toit" value="{{ old('roof_weight') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                            <label>Code emissions</label>
                                            <input type="text" class="form-control" id="emission_code" name="emission_code" placeholder="Poids total" value="{{ old('emission_code') }}" />
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                            <label class="w-100" for="category">Statut</label>
                                            <select class="form-control select2" id="status" name="status">
                                                <option value="0" selected>Non vendu</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                            <label class="w-100" for="category">Catégorie</label>
                                            <select class="form-control select2" id="category" name="category">
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                            <label class="w-100" for="mark">Marque</label>
                                            <select class="form-control select2" id="mark" name="mark">
                                                @foreach($marks as $mark)
                                                    <option value="{{ $mark->id }}">{{ $mark->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                            <label class="w-100" for="model">Modèle</label>
                                            <select class="form-control select2" id="model" name="model">
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-12 mb-3">
                                            <label for="description">Description</label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 mb-3">
                                            <button class="btn btn-primary" type="submit">Soumettre le formulaire</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });

        $('#mark').on('change', function() {
            var markId = $(this).val();
            if(markId) {
                $.ajax({
                    url: '/get-models/' + markId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#model').empty();
                        $.each(data, function(key, value) {
                            $('#model').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#model').select2({
                            width: '100%'
                        });
                    }
                });
            } else {
                $('#model').empty();
            }
        });
    });
</script>
@endsection
