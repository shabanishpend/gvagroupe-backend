@extends('layouts.admin')
@section('title', 'Créer une nouvelle catégorie de blog')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'blogs-categories',
                'items' => [
                    ['label' => 'Gestion des catégories de blogs', 'route' => 'blogs-categories'],
                    ['label' => 'Créer une nouvelle catégorie de blog', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer une nouvelle catégorie de blog</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                <form method="POST" action="{{ route('blogs-categories-update') }}" class="row w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="create" />

                    <div class="form-group col-lg-12 mb-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="fr-tab" data-bs-toggle="tab" data-bs-target="#fr" type="button" role="tab">Français <span class="text-danger">*</span></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en" type="button" role="tab">English</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="de-tab" data-bs-toggle="tab" data-bs-target="#de" type="button" role="tab">Deutsch</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="sq-tab" data-bs-toggle="tab" data-bs-target="#sq" type="button" role="tab">Shqip</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="it-tab" data-bs-toggle="tab" data-bs-target="#it" type="button" role="tab">Italiano</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="fr" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_fr">Titre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title_fr" name="title_fr" placeholder="Titre" value="{{ old('title_fr') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_fr">Description</label>
                                    <textarea class="form-control" id="description_fr" name="description_fr" rows="5">{{ old('description_fr') }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_en">Title</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Title" value="{{ old('title_en') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_en">Description</label>
                                    <textarea class="form-control" id="description_en" name="description_en" rows="5">{{ old('description_en') }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="de" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_de">Titel</label>
                                    <input type="text" class="form-control" id="title_de" name="title_de" placeholder="Titel" value="{{ old('title_de') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_de">Beschreibung</label>
                                    <textarea class="form-control" id="description_de" name="description_de" rows="5">{{ old('description_de') }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sq" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_sq">Titulli</label>
                                    <input type="text" class="form-control" id="title_sq" name="title_sq" placeholder="Titulli" value="{{ old('title_sq') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_sq">Përshkrimi</label>
                                    <textarea class="form-control" id="description_sq" name="description_sq" rows="5">{{ old('description_sq') }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="it" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_it">Titolo</label>
                                    <input type="text" class="form-control" id="title_it" name="title_it" placeholder="Titolo" value="{{ old('title_it') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_it">Descrizione</label>
                                    <textarea class="form-control" id="description_it" name="description_it" rows="5">{{ old('description_it') }}</textarea>
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
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>
</script>
@endsection