@extends('layouts.admin')
@section('title', "Créer un nouveau membre de l'équipe")

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'team-members',
                'items' => [
                    ['label' => 'Gestion des membres de l\'équipe', 'route' => 'team-members'],
                    ['label' => 'Créer un nouveau membre de l\'équipe', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer un nouveau membre de l'équipe</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form method="POST" action="{{ route('team-member-create-new') }}" class="row w-100" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"  />

                            <div class="w-100">
                                <!-- Nav pills -->
                                <ul class="nav nav-pills pl-2 pr-2">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="pill" href="#french">French</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="pill" href="#english">English</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="pill" href="#deutch">Deutch</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content mt-3">

                                    <div class="tab-pane active p-0" id="french">
                                        <div class="row">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                                <label class="w-100" for="name">Image</label>
                                                <input type="file" class="form-control"  accept="image/png, image/jpeg" id="image" name="image" style="width: fit-content; padding-top: 4px; padding-left: 4px;" required>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                                <label for="name">Prénom</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="First name" value="{{ old('name') }}" required>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                                <label for="surname">Nom de famille</label>
                                                <input type="text" class="form-control" name="surname" id="surname" placeholder="Last name" value="{{ old('surname') }}" required>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                                <label for="email">Position</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="position" id="position" placeholder="Position" value="{{ old('position') }}" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6 mb-3">
                                                <label for="description">LinkedIn</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="LinkedIn" value="{{ old('linkedin') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade p-0" id="english">
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                                <label for="email">Position</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="position_en" id="position_en" placeholder="Position" value="{{ old('position_en') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade p-0" id="deutch">
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                                <label for="email">Position</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="position_de" id="position_de" placeholder="Position" value="{{ old('position_de') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>

</script>
@endsection