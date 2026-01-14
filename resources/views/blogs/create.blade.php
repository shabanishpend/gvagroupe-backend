@extends('layouts.admin')
@section('title', 'Créer un nouveau blog')

@section('links')

@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'blogs',
                'items' => [
                    ['label' => 'Gestion des blogs', 'route' => 'blogs'],
                    ['label' => 'Blogs', 'active' => true]
                ]
            ])
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer un nouveau blog</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                <form method="POST" action="{{ route('blogs-update') }}" class="row m-0 w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="create" />

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="name">Image</label>
                        <input type="file" class="form-control"  accept="image/png, image/jpeg" id="image" name="image" value="{{ old('image') }}" style="width: fit-content; padding-top: 4px; padding-left: 4px;" required>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titre" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="categories">Sélectionner les catégories</label>
                        <select class="form-control select2 select" id="categories" data-bs-toggle="select2" multiple="multiple" name="categories[]" required>
                            @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-12 mb-3">
                        <label for="summernote-basic">Contenu</label>
                        <div class="input-group">
                            <textarea class="w-100" name="content" id="summernote-basic"></textarea>
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

@section('scripts')

@endsection

@section('custom_script')
<script>
    // init select2
    $('.select2').select2();
    // Initialize CKEditor for French content
        ClassicEditor
        .create(document.querySelector('#summernote-basic'), {
            ckfinder: {
                // uploadUrl: '/api/blog/summernote/upload/image?_oken=' + '{{ csrf_token() }}'
            }
        })
        .then(editor => {
            window.ckeditor_english = editor;
        })
        .catch(error => {
            console.error(error);
    });
</script>
@endsection