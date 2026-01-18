@extends('layouts.admin')
@section('title', 'Modifier la marque')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'buy-cars.marks',
                'items' => [
                    ['label' => 'Gestion des marques', 'route' => 'buy-cars.marks'],
                    ['label' => 'Marques', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier la marque</h5>
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('buy-cars.marks.update') }}" class="row w-100">
                    @csrf
                    <input type="hidden" name="type" value="edit" />
                    <input type="hidden" name="id" value="{{ $mark->id }}" />

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
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="{{ $mark->name }}" required />
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description" name="description" rows="5">{{ $mark->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade p-0" id="english">

                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nom" value="@if($mark->translation && $mark->translation->name_en) {{$mark->translation->name_en}} @endif" />
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description_en" name="description_en" rows="5">@if($mark->translation && $mark->translation->description_en) {{$mark->translation->description_en}} @endif</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade p-0" id="deutch">

                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" id="name_de" name="name_de" placeholder="Nom" value="@if($mark->translation && $mark->translation->name_de) {{$mark->translation->name_de}} @endif" />
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description_de" name="description_de" rows="5">@if($mark->translation && $mark->translation->description_de) {{$mark->translation->description_de}} @endif</textarea>
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
</script>
@endsection