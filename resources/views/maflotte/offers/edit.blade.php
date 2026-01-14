@extends('layouts.admin')
@section('title', "Modifier un Offre")

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'offres',
                'backRouteParams' => [$website ?? 'maflotte'],
                'items' => [
                    ['label' => 'Gestion des offres', 'route' => 'offres', 'routeParams' => [$website ?? 'maflotte']],
                    ['label' => 'Modifier une offre', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier une offre</h5>
                </div>
                <div class="card-body">
    <div class="row">
        <form method="POST" action="{{ route('offres.update', ['maflotte']) }}" class="row w-100" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"  />
            <input type="hidden" name="type_action" value="edit"  />
            <input type="hidden" name="id" value="{{ $offre->id }}"  />

            <div class="w-100">
                <!-- Tab panes -->
                <div class="tab-content mt-3">
                    <div class="tab-pane active p-0" id="french">
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="type">Type</label>
                                <select class="form-control select2" id="type" data-toggle="select2" name="type">
                                    <option value="year">Annual</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="cars_number">Nombre de voiture</label>
                                <input type="number" class="form-control" name="cars_number" id="cars_number" placeholder="Nombre de voiture" value="{{ $offre->cars_number }}" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="price">Prix</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Prix" value="{{ $offre->price }}" required>
                                </div>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="price_discount">Prix d'escompte</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price_discount" id="price_discount" placeholder="Prix" value="{{ $offre->price_discount }}" required>
                                </div>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="services">Services</label>
                                <div class="input-group w-100">
                                    <textarea rows="7" class="form-control" name="services">{{ $offre->services }}</textarea>
                                </div>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="conditions">Conditions</label>
                                <div class="input-group w-100">
                                    <textarea rows="7" class="form-control" name="conditions">{{ $offre->conditions }}</textarea>
                                </div>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="signature_footer">Signature</label>
                                <div class="input-group w-100">
                                    <textarea rows="7" class="form-control" name="signature_footer">{{ $offre->signature_footer }}</textarea>
                                </div>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="footer_text">Footer Text</label>
                                <div class="input-group w-100">
                                    <textarea rows="7" class="form-control" name="footer_text">{{ $offre->footer_text }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-12 mb-3">
                <button class="btn btn-primary" type="submit">Soumettre le formulaire</button>
            </div>
            </div>
        </form>   
    </div>
    </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection