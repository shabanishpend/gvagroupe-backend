@extends('layouts.admin')
@inject('userService', 'App\Services\UserService')

@section('title', 'Modifier un utilisateur')

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
                    ['label' => 'Utilisateurs', 'route' => 'users'],
                    ['label' => $user->name . ' ' . $user->surname, 'active' => true]
                ]
            ])  

            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier un utilisateur</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users-create-new') }}" class="row w-100" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="edit" />
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                        <input type="hidden" name="type_user" value="user" />

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <label class="w-100" for="name">Image</label>
                            @if($user->image)
                                <img alt="Image" src="/back/img/users/{{ $user->image }}" width="200" height="200" class="object-cover mb-2"  />
                            @endif
                            <input type="file" class="form-control"  accept="image/png, image/jpeg" id="image" name="image" value="{{ old('image') }}" style="width: fit-content; padding-top: 4px; padding-left: 4px;">
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="name">Prénom</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Prénom" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="surname">Nom</label>
                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Nom" value="{{ $user->surname }}" required>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="email">Téléphone</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Téléphone" value="{{ $user->phone }}" required>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="description">Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="description">Rôle</label>
                            <div class="input-group">
                                <select class="form-control" id="role" name="role">
                                    @if(count($roles) > 0)
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @if($user->role->role_id == $role->id) selected @endif>{{ $role->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="email">Mot de passe</label>
                            <div class="input-group">
                                <input type="password" minlength="8" class="form-control" name="password" id="password" placeholder="Password" value="">
                            </div>
                        </div>

                        <div class="form-group col-lg-12 mb-3">
                            <label for="description">Description</label>
                            <div class="input-group">
                                <textarea class="form-control" id="description" name="description" rows="5">{{ $user->description }}</textarea>
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
</script>
@endsection