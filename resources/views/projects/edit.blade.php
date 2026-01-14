@extends('layouts.admin')
@section('title', 'Editer le projet')

@section('links')

@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'projects',
                'items' => [
                    ['label' => 'Gestion des projets', 'route' => 'projects'],
                    ['label' => 'Modifier un projet', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier un projet</h5>
                </div>
                <div class="card-body">
                    <div class="row m-0">
                <form method="POST" action="{{ route('projects-update') }}" class="row w-100" enctype="multipart/form-data">
                    @csrf

                    <input name="type" value="edit" type="hidden" />
                    <input name="project_id" value="{{ $project->id }}" type="hidden" />

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
                                    @if($project->image)
                                        <img alt="Image" src="/back/img/projects/{{ $project->image }}" width="200" height="200" class="object-cover mb-2"  />
                                    @endif
                                    <input type="file" class="form-control"  accept="image/png, image/jpeg" id="image" name="image" style="width: fit-content; padding-top: 4px; padding-left: 4px;">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="name">Titre</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="{{ $project->title }}" required>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="surname">Année</label>
                                    <input type="text" class="form-control" name="year" id="year" placeholder="Année" value="{{ $project->year }}" required>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="email">Visiter le lien</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="visit" id="visit" placeholder="Visiter le lien" value="{{ $project->visit }}" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="surname">Client</label>
                                    <input type="text" class="form-control" name="client" id="client" placeholder="Client" value="{{ $project->client }}" required>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="email">Service</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="service" id="service" placeholder="Service" value="{{ $project->service }}" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="video_url">Url vidéo</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="video_url" id="video_url" placeholder="Url vidéo" value="{{ $project->video_url }}">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="summernote-basic">Contenu</label>
                                    <div class="input-group">
                                        <textarea class="w-100" name="content" id="summernote-basic-french">{{ $project->content }}</textarea>
                                    </div>
                                </div>

                                </div>
                            </div>

                            <div class="tab-pane fade p-0" id="english">
                                <div class="row">

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="name">Titre</label>
                                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Titre" value="@if($project->translation && $project->translation->title_en){{$project->translation->title_en}}@endif" >
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="email">Service</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="service_en" id="service_en" placeholder="Service" value="@if($project->translation && $project->translation->service_en){{$project->translation->service_en}}@endif" >
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12 mb-3">
                                        <label for="summernote-basic">Contenu</label>
                                        <div class="input-group">
                                            <textarea class="w-100 summernote-basic" name="content_en" id="summernote-basic-english">@if($project->translation && $project->translation->content_en){{$project->translation->content_en}}@endif</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade p-0" id="deutch">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="name">Titre</label>
                                        <input type="text" class="form-control" id="title_de" name="title_de" placeholder="Titre" value="@if($project->translation && $project->translation->title_en){{$project->translation->title_en}}@endif" >
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="email">Service</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="service_de" id="service_de" placeholder="Service" value="@if($project->translation && $project->translation->service_de){{$project->translation->service_de}}@endif" >
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12 mb-3">
                                        <label for="summernote-basic">Contenu</label>
                                        <div class="input-group">
                                            <textarea class="w-100 summernote-basic" name="content_de" id="summernote-basic-deutch">@if($project->translation && $project->translation->content_de){{$project->translation->content_de}}@endif</textarea>
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
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>
    $('form').submit(function(){
        $('.full-page-loader').css('display', 'flex')
    });
</script>
<script>
    // Initialize CKEditor for French content
    ClassicEditor
        .create(document.querySelector('#summernote-basic-french'), {
            ckfinder: {
                // uploadUrl: '/api/blog/summernote/upload/image?_token=' + '{{ csrf_token() }}'
            }
        })
        .then(editor => {
            window.ckeditor = editor;
        })
        .catch(error => {
            console.error(error);
    });

    // Initialize CKEditor for English content
    ClassicEditor
        .create(document.querySelector('#summernote-basic-english'), {
            ckfinder: {
                // uploadUrl: '/api/blog/summernote/upload/image?_token=' + '{{ csrf_token() }}'
            }
        })
        .then(editor => {
            window.ckeditor_english = editor;
        })
        .catch(error => {
            console.error(error);
    });

      // Initialize CKEditor for English content
      ClassicEditor
        .create(document.querySelector('#summernote-basic-deutch'), {
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

@section('scripts')

@endsection