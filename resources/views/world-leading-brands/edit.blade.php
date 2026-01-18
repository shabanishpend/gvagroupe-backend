@extends('layouts.admin')
@section('title', 'Editer une nouvelle marque leader mondiale')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'wlb',
                'items' => [
                    ['label' => 'Gestion des marques leaders', 'route' => 'wlb'],
                    ['label' => 'Editer une nouvelle marque leader mondiale', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Editer une nouvelle marque leader mondiale</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form method="POST" action="{{ route('wlb.update') }}" class="row w-100" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"  />
                            <input type="hidden" name="type" value="edit"  />
                            <input type="hidden" name="id" value="{{ $world_leading_brand->id }}"  />

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="w-100" for="name">Image</label>
                                @if($world_leading_brand->image)
                                    <img alt="Image" src="/back/img/world-leading-brands/{{ $world_leading_brand->image }}" width="200" height="200" class="object-cover mb-2"  />
                                @endif
                                <input type="file" class="form-control"  accept="image/png, image/jpeg, image/svg" id="image" name="image" style="width: fit-content; padding-top: 4px; padding-left: 4px;">
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="description">Titre</label>
                                <div class="input-group">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Titre" value="{{ $world_leading_brand->title }}">
                                </div>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="description">Link</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="{{ $world_leading_brand->link }}">
                                </div>
                            </div>

                            <div class="form-group col-lg-12 mb-3">
                                <label for="description">Description</label>
                                <div class="input-group">
                                <textarea rows="5" name="description" class="form-control" id="description">{{ $world_leading_brand->description }}</textarea>
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

@section('custom_script')
<!-- <script>
    $('form').submit(function(){
        $('.full-page-loader').css('display', 'flex')
    });
</script> -->
@endsection