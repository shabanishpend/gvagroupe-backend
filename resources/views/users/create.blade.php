@extends('layouts.admin')
@inject('userService', 'App\Services\UserService')

@section('title', 'Créer un nouvel utilisateur')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'users',
                'items' => [
                    ['label' => 'Gestion des utilisateurs', 'route' => 'users'],
                    ['label' => 'Créer un nouvel utilisateur', 'active' => true]
                ]
            ])  

            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer un nouvel utilisateur</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                    <form method="POST" action="{{ route('users-create-new') }}" class="row w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="create" />
                    <input type="hidden" name="type_user" value="user" />

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="name">Image</label>
                        <input type="file" class="form-control"  accept="image/png, image/jpeg" id="image" name="image" value="{{ old('image') }}" style="width: fit-content; padding-top: 4px; padding-left: 4px;">
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="name">Prénom</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Prénom" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="surname">Nom</label>
                        <input type="text" class="form-control" name="surname" id="surname" placeholder="Nom" value="{{ old('surname') }}" required>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="email">Téléphone</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Téléphone" value="{{ old('phone') }}" required>
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="description">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="description">Rôle</label>
                        <div class="input-group">
                            <select class="form-control" id="role" name="role">
                                @if(count($roles) > 0)
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="email">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" minlength="8" class="form-control" name="password" id="password" placeholder="Password" value="{{ old('password') }}" required>
                        </div>
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
        
                    </form> 
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>
</script>
@endsection