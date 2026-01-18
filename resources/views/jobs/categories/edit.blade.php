@extends('layouts.admin')
@section('title', 'Modifier la catégorie d\'emploi')

@section('links')

@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'jobs.categories',
                'items' => [
                    ['label' => 'Gestion des emplois', 'route' => 'jobs.categories'],
                    ['label' => 'Catégories d\'emploi', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier la catégorie d'emploi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('jobs.categories.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="edit" />
                        <input type="hidden" name="id" value="{{ $jobCategory->id }}" />

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           placeholder="Entrez le titre de la catégorie" 
                                           value="{{ $jobCategory->title }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('jobs.categories.index') }}" class="btn btn-secondary me-1">Annuler</a>
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

@section('custom_script')

@endsection