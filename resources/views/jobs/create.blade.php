@extends('layouts.admin')
@section('title', 'Créer un emploi')

@section('links')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'jobs',
                'items' => [
                    ['label' => 'Gestion des emplois', 'route' => 'jobs'],
                    ['label' => 'Créer un emploi', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer un emploi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('jobs.create.update') }}" class="row w-100" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="create" />

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Titre" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                            <label class="w-100" for="categories">Sélectionner les catégories</label>
                            <select class="form-control select2" id="categories" name="job_category" required>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="location">Localisation</label>
                            <input type="text" class="form-control" name="location" id="location" placeholder="Localisation" value="{{ old('location') }}" required>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="date_from">Date du</label>
                            <input type="text" class="form-control date" name="date_from" id="date_from" required />
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="date_to">Date à</label>
                            <input type="text" class="form-control date" name="date_to" id="date_to" required>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="experience">Expérience</label>
                            <input type="text" class="form-control" name="experience" id="experience" placeholder="Experience" value="{{ old('experience') }}" required>
                        </div>

                        <div class="form-group col-lg-12 mb-3">
                            <label for="summernote-basic">Contenu</label>
                            <div class="input-group">
                                <textarea class="w-100" name="description" id="summernote-basic"></textarea>
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });

        $('#summernote-basic').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('#date_from').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        $('#date_to').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>
@endsection