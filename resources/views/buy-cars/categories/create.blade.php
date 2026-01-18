@extends('layouts.admin')
@section('title', 'Nouvelle catégorie de voiture')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'buy-cars.categories',
                'items' => [
                    ['label' => 'Gestion des catégories de voitures', 'route' => 'buy-cars.categories'],
                    ['label' => 'Catégories de voitures', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer une nouvelle catégorie de voiture</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('buy-cars.categories.update') }}">
                        @csrf
                        <input type="hidden" name="type" value="create" />

                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#french" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                    Français
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#english" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    Anglais
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#deutch" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    Allemand
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="french">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                class="form-control @error('name') is-invalid @enderror" 
                                                id="name" 
                                                name="name" 
                                                placeholder="Entrez le nom de la catégorie" 
                                                value="{{ old('name') }}" 
                                                required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                    id="description" 
                                                    name="description" 
                                                    rows="5" 
                                                    placeholder="Entrez la description de la catégorie">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="english">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name_en" class="form-label">Nom</label>
                                            <input type="text" 
                                                class="form-control @error('name_en') is-invalid @enderror" 
                                                id="name_en" 
                                                name="name_en" 
                                                placeholder="Enter category name" 
                                                value="{{ old('name_en') }}">
                                            @error('name_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description_en" class="form-label">Description</label>
                                            <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                                    id="description_en" 
                                                    name="description_en" 
                                                    rows="5" 
                                                    placeholder="Enter category description">{{ old('description_en') }}</textarea>
                                            @error('description_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="deutch">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name_de" class="form-label">Nom</label>
                                            <input type="text" 
                                                class="form-control @error('name_de') is-invalid @enderror" 
                                                id="name_de" 
                                                name="name_de" 
                                                placeholder="Kategorienamen eingeben" 
                                                value="{{ old('name_de') }}">
                                            @error('name_de')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description_de" class="form-label">Description</label>
                                            <textarea class="form-control @error('description_de') is-invalid @enderror" 
                                                    id="description_de" 
                                                    name="description_de" 
                                                    rows="5" 
                                                    placeholder="Kategoriebeschreibung eingeben">{{ old('description_de') }}</textarea>
                                            @error('description_de')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Enregistrer
                            </button>
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
    <script>
        $(document).ready(function() {
            // Initialize any select2 dropdowns if needed
        });
    </script>
@endsection