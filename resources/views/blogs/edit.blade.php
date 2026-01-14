@extends('layouts.admin')
@section('title', 'Editer le blog')

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

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titre" value="{{ $blog->title }}" required>
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="categories">Sélectionner les catégories</label>
                        <select class="form-control select2" id="categories" data-toggle="select2" multiple="multiple" name="categories[]" required>
                            @foreach($categories as $categorie)
                                @foreach($blog->categories as $cate)
                                    @if($cate->category->id == $categorie->id)
                                        <option value="{{ $categorie->id }}" selected>{{ $categorie->title }}</option>
                                    @else
                                        <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-12 mb-3">
                        <label for="summernote-basic">Contenu</label>
                        <div class="input-group">
                            <textarea class="w-100" name="content" id="summernote-basic">{{ $blog->content }}</textarea>
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