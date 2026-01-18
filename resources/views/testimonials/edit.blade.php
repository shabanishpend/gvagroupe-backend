@extends('layouts.admin')
@section('title', 'Créer un nouveau témoignage')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
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

                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="name">Nom complet</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nom complet" value="{{ $testimonial->user_full_name }}" required>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="surname">Position</label>
                        <input type="text" class="form-control" name="position" id="position" placeholder="Position" value="{{ $testimonial->user_position }}" required>
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
                                    <input type="text" class="form-control" name="title_fr" id="title_fr" placeholder="Titre" value="{{ old('title_fr', $testimonial->title_fr ?? $testimonial->title) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_fr">Description <span class="text-danger">*</span></label>
                                    <textarea rows="5" name="description_fr" class="form-control" id="description_fr">{{ old('description_fr', $testimonial->description_fr ?? $testimonial->description) }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_en">Title</label>
                                    <input type="text" class="form-control" name="title_en" id="title_en" placeholder="Title" value="{{ old('title_en', $testimonial->title_en) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_en">Description</label>
                                    <textarea rows="5" name="description_en" class="form-control" id="description_en">{{ old('description_en', $testimonial->description_en) }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="de" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_de">Titel</label>
                                    <input type="text" class="form-control" name="title_de" id="title_de" placeholder="Titel" value="{{ old('title_de', $testimonial->title_de) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_de">Beschreibung</label>
                                    <textarea rows="5" name="description_de" class="form-control" id="description_de">{{ old('description_de', $testimonial->description_de) }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sq" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_sq">Titulli</label>
                                    <input type="text" class="form-control" name="title_sq" id="title_sq" placeholder="Titulli" value="{{ old('title_sq', $testimonial->title_sq) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_sq">Përshkrimi</label>
                                    <textarea rows="5" name="description_sq" class="form-control" id="description_sq">{{ old('description_sq', $testimonial->description_sq) }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="it" role="tabpanel">
                                <div class="form-group mb-3">
                                    <label for="title_it">Titolo</label>
                                    <input type="text" class="form-control" name="title_it" id="title_it" placeholder="Titolo" value="{{ old('title_it', $testimonial->title_it) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description_it">Descrizione</label>
                                    <textarea rows="5" name="description_it" class="form-control" id="description_it">{{ old('description_it', $testimonial->description_it) }}</textarea>
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

@endsection

@section('custom_script')
<!-- <script>
    $('form').submit(function(){
        $('.full-page-loader').css('display', 'flex')
    });
</script> -->
@endsection