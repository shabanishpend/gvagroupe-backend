@extends('layouts.admin')
@section('title', 'Créer un nouveau témoignage')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'testimonials',
                'items' => [
                    ['label' => 'Gestion des témoignages', 'route' => 'testimonials'],
                    ['label' => 'Modifier un témoignage', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier un témoignage</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                <form method="POST" action="{{ route('testimonials.update') }}" class="needs-validation row w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"  />
                    <input type="hidden" name="type" value="edit"  />
                    <input name="testimonial_id" value="{{ $testimonial->id }}" type="hidden" />

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="name">Image</label>
                        @if($testimonial->user_image)
                            <img alt="Image" src="/back/img/testimonials/{{ $testimonial->user_image }}" width="200" height="200" class="object-cover mb-2"  />
                        @endif
                        <input type="file" class="form-control"  accept="image/png, image/jpeg" id="image" name="image" style="width: fit-content; padding-top: 4px; padding-left: 4px;">
                    </div>

                    <div class="form-group col-lg-6 mb-3">
                        <label for="description">Titre</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titre" value="{{ $testimonial->title }}">
                        </div>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="name">Nom complet</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nom complet" value="{{ $testimonial->user_full_name }}" required>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="surname">Position</label>
                        <input type="text" class="form-control" name="position" id="position" placeholder="Position" value="{{ $testimonial->user_position }}" required>
                    </div>

                    <div class="form-group col-lg-12 mb-3">
                        <label for="description">Description</label>
                        <div class="input-group">
                        <textarea rows="5" name="description" class="form-control" id="description">{{ $testimonial->description }}</textarea>
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

@endsection

@section('custom_script')
<!-- <script>
    $('form').submit(function(){
        $('.full-page-loader').css('display', 'flex')
    });
</script> -->
@endsection