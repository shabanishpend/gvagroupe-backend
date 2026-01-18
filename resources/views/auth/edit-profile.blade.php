@inject('userService', 'App\Services\UserService')
@extends('layouts.admin')
@section('title', 'Profil')

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
                'backRoute' => 'dashboard',
                'backRouteParams' => [request()->route('website') ?? 'gvagroupe'],
                'items' => [
                    ['label' => 'Profil', 'route' => 'profile'],
                    ['label' => 'Modifier le profil', 'active' => true]
                ]
            ])    

            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier le profil</h5>
                </div>
                <div class="card-body">
                    <div class="row m-0">
                        <form method="POST" action="{{ route('profile-update') }}" class="needs-validation row w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"  />
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="name">Image</label>
                        @if(Auth::user()->image)
                            <img src="/back//img/users/{{ Auth::user()->image }}" width="200" height="200" class="object-cover mb-2"  />
                        @endif
                        <input type="file" class="form-control"  accept="image/png, image/jpeg" id="image" name="image" style="width: fit-content; padding-top: 4px; padding-left: 4px;">
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="name">
                            @if(Auth::user()->type !== 'company')
                                Prénom
                            @else
                                Nom de la société
                            @endif
                        </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="First name" value="{{ Auth::user()->name }}" required>
                    </div>
                    @if(Auth::user()->type !== 'company')
                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="surname">Nom de famille</label>
                        <input type="text" class="form-control" name="surname" id="surname" placeholder="Last name" value="{{ Auth::user()->surname }}">
                    </div>
                    @endif
                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="email">E-mail</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="email">Téléphone</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Téléphone" value="{{ Auth::user()->phone }}" required>
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="email">Addresse</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ Auth::user()->address }}" >
                            <input type="hidden" class="form-control" name="latitude" id="latitude" placeholder="latitude" value="{{ Auth::user()->latitude }}">
                            <input type="hidden" class="form-control" name="longitude" id="longitude" placeholder="longitude" value="{{ Auth::user()->longitude }}">
                            <input type="hidden" class="form-control" name="country" id="country" placeholder="country" value="{{ Auth::user()->country }}">
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="email">Ville</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ Auth::user()->city }}" >
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="email">Code Postal</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Postal Code" value="{{ Auth::user()->postal_code }}" >
                        </div>
                    </div>

                    <div class="form-group col-lg-12 mb-3">
                        <label for="description">Description</label>
                        <div class="input-group">
                            <textarea rows="5" class="form-control" name="description" id="description" required>{{Auth::user()->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-lg-4 mb-3">
                        <button class="btn btn-primary" type="submit">Soumettre</button>
                    </div>
        
                </form>   
                </div>
            </div>

        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<!-- <script>
    $('form').submit(function(){
        $('.full-page-loader').css('display', 'flex')
    });
</script> -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    var input = document.getElementById('address');

    var options = {
        types: ['address']  // Restrict the search results to addresses only
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);


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