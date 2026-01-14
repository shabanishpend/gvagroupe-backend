@extends('layouts.admin')
@section('title', 'Modifier la catégorie du blog')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'blogs-categories',
                'items' => [
                    ['label' => 'Gestion des catégories de blogs', 'route' => 'blogs-categories'],
                    ['label' => 'Modifier une catégorie de blog', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier une catégorie de blog</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                <form method="POST" action="{{ route('blogs-categories-update') }}" class="row w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="edit" />
                    <input type="hidden" name="blog_id" value="{{ $blogCategory->id }}" />
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="name">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="{{ $blogCategory->title }}" required>
                    </div>

                    <div class="form-group col-lg-12 mb-3">
                        <label for="description">Description</label>
                        <div class="input-group">
                            <textarea class="form-control" id="description" name="description" rows="5">{{ $blogCategory->description }}</textarea>
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