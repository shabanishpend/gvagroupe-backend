@extends('layouts.admin')
@section('title', 'Editer le blog')

@section('links')

@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
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
                    <h5 class="card-title mb-0">Editer le blog</h5>
                </div>
                <div class="card-body">
                    <div class="row">
            <div class="row">
                <form method="POST" action="{{ route('blogs-update') }}" class="row m-0 w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="edit" />
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}" />

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="name">Image</label>
                        @if($blog->image)
                            <img alt="Image" src="/back/img/blogs/{{ $blog->image }}" width="200" height="200" class="object-cover mb-2"  />
                        @endif
                        <input type="file" class="form-control"  accept="image/png, image/jpeg, image/jpg" id="image" name="image" value="{{ $blog->image }}" style="width: fit-content; padding-top: 4px; padding-left: 4px;">
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="categories">Sélectionner les catégories</label>
                        <select class="form-control select2" id="categories" data-toggle="select2" multiple="multiple" name="categories[]" required>
                            @foreach($categories as $categorie)
                                @php
                                    $isSelected = false;
                                    foreach($blog->categories as $cate) {
                                        if($cate->category->id == $categorie->id) {
                                            $isSelected = true;
                                            break;
                                        }
                                    }
                                @endphp
                                <option value="{{ $categorie->id }}" {{ $isSelected ? 'selected' : '' }}>{{ $categorie->title }}</option>
                            @endforeach
                        </select>
                    </div>

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
                                    <input type="text" class="form-control" name="title_fr" id="title_fr" placeholder="Titre" value="{{ old('title_fr', $blog->title_fr ?? $blog->title) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="content_fr">Contenu <span class="text-danger">*</span></label>
                                    <textarea class="w-100" name="content_fr" id="summernote-fr">{{ old('content_fr', $blog->content_fr ?? $blog->content) }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_en">Title</label>
                                    <input type="text" class="form-control" name="title_en" id="title_en" placeholder="Title" value="{{ old('title_en', $blog->title_en) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="content_en">Content</label>
                                    <textarea class="w-100" name="content_en" id="summernote-en">{{ old('content_en', $blog->content_en) }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="de" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_de">Titel</label>
                                    <input type="text" class="form-control" name="title_de" id="title_de" placeholder="Titel" value="{{ old('title_de', $blog->title_de) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="content_de">Inhalt</label>
                                    <textarea class="w-100" name="content_de" id="summernote-de">{{ old('content_de', $blog->content_de) }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sq" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_sq">Titulli</label>
                                    <input type="text" class="form-control" name="title_sq" id="title_sq" placeholder="Titulli" value="{{ old('title_sq', $blog->title_sq) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="content_sq">Përmbajtja</label>
                                    <textarea class="w-100" name="content_sq" id="summernote-sq">{{ old('content_sq', $blog->content_sq) }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="it" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_it">Titolo</label>
                                    <input type="text" class="form-control" name="title_it" id="title_it" placeholder="Titolo" value="{{ old('title_it', $blog->title_it) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="content_it">Contenuto</label>
                                    <textarea class="w-100" name="content_it" id="summernote-it">{{ old('content_it', $blog->content_it) }}</textarea>
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
    </div> 
    @include('layouts.footer')
    </div>        
</div>
@endsection

@section('scripts')

@endsection

@section('custom_script')
<script>
    // init select2
    $('.select2').select2();
    
    // Initialize CKEditor for all language content fields
    const editors = {};
    const editorIds = ['summernote-fr', 'summernote-en', 'summernote-de', 'summernote-sq', 'summernote-it'];
    
    editorIds.forEach(editorId => {
        const element = document.querySelector('#' + editorId);
        if(element) {
            ClassicEditor
                .create(element, {
                    ckfinder: {
                        // uploadUrl: '/api/blog/summernote/upload/image?_oken=' + '{{ csrf_token() }}'
                    }
                })
                .then(editor => {
                    editors[editorId] = editor;
                })
                .catch(error => {
                    console.error('Error initializing editor for ' + editorId + ':', error);
                });
        }
    });
</script>
@endsection