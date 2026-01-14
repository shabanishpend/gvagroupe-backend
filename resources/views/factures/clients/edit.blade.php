@extends('layouts.admin')
@section('title', 'Modifier le client')

@section('links')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxgYvfuZo9_KtH5VQlEFw6RKZJvj1W0L8&libraries=places"></script>
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'factures.clients',
                'backRouteParams' => [$website ?? 'gvacars'],
                'items' => [
                    ['label' => 'Gestion des clients', 'route' => 'factures.clients', 'routeParams' => [$website ?? 'gvacars']],
                    ['label' => 'Clients', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier le client</h5>
                </div>
                <div class="card-body">
        <form method="POST" action="{{ route('factures.clients.update', [$website]) }}" class="row w-100" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="edit" />
            <input type="hidden" name="user_id" value="{{ $user->id }}" />
            <input type="hidden" name="type_user" value="client" />

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="name">Prénom</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Prénom" value="{{ $user->name }}" required>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="surname">Nom</label>
                <input type="text" class="form-control" name="surname" id="surname" placeholder="Nom" value="{{ $user->surname }}">
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="email">Téléphone</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Téléphone" value="{{ $user->phone }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="description">Email</label>
                <div class="input-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="email">Addresse</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ $user->address }}" required>
                    <input type="hidden" class="form-control" name="latitude" id="latitude" placeholder="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" class="form-control" name="longitude" id="longitude" placeholder="longitude" value="{{ old('longitude') }}">
                    <input type="hidden" class="form-control" name="country" id="country" placeholder="country" value="{{ old('country') }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="email">Ville</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ $user->city }}" required>
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="email">Code Postal</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Postal Code" value="{{ $user->postal_code }}" required>
                </div>
            </div>

            <div class="form-group col-lg-12 mb-3">
                <button class="btn btn-primary" type="submit">Soumettre le formulaire</button>
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
document.addEventListener("DOMContentLoaded", function () {
    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
        }
        
        let address = '';
        let city = '';
        let state = '';
        let postal_code = ''
        let lat = '';
        let lng = '';
        
        // Iterating through address components to assign values based on their types
        place.address_components.forEach(function(component) {
            const types = component.types;
            if (types.includes('route')) {
                address += component.long_name;
            } else if (types.includes('street_number')) {
                address += ' ' + component.long_name;
            } else if (types.includes('locality')) {
                city = component.long_name;
            } else if (types.includes('country')) {
                state = component.long_name;
            }else if (types.includes('postal_code')) {
                postal_code = component.long_name;
            }
        });
        

        var addressInput = document.getElementById('address')
        var cityInput = document.getElementById('city')
        var countryInput = document.getElementById('country')
        var postalCodeInput = document.getElementById('postal_code')
        var latitudeInput = document.getElementById('latitude')
        var longitudeInput = document.getElementById('longitude')

        cityInput.value = city
        addressInput.value = place.name
        countryInput.value = state
        postalCodeInput.value = postal_code;
        latitudeInput.value = place.geometry.location.lat();
        longitudeInput.value = place.geometry.location.lng();
    });
});
</script>
@endsection