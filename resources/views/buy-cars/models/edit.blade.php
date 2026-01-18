@extends('layouts.admin')
@section('title', 'Modifier le modèle')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'buy-cars.models',
                'items' => [
                    ['label' => 'Gestion des modèles', 'route' => 'buy-cars.models'],
                    ['label' => 'Modèles', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier le modèle</h5>
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('buy-cars.models.update') }}" class="row w-100">
                    @csrf
                    <input type="hidden" name="type" value="edit" />
                    <input type="hidden" name="id" value="{{ $model->id }}" />

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
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="{{ $model->name }}" required />
                                </div>

                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label class="w-100" for="categories">Sélectionner la marque</label>
                                    <select class="form-control select2" id="mark" data-bs-toggle="select2" name="mark" required>
                                        @foreach($marks as $mark)
                                            @if($mark->id == $model->buy_cars_marks_id)
                                                <option value="{{ $mark->id }}" selected>{{ $mark->name }}</option>
                                            @else
                                                <option value="{{ $mark->id }}">{{ $mark->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description" name="description" rows="5">{{ $model->description }}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade p-0" id="english">

                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nom" value="@if($model->translation && $model->translation->name_en) {{$model->translation->name_en}} @endif" />
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description_en" name="description_en" rows="5">@if($model->translation && $model->translation->description_en) {{$model->translation->description_en}} @endif</textarea>
                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane fade p-0" id="deutch">

                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" id="name_de" name="name_de" placeholder="Nom" value="@if($model->translation && $model->translation->name_de) {{$model->translation->name_de}} @endif" />
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description_de" name="description_de" rows="5">@if($model->translation && $model->translation->description_de) {{$model->translation->description_de}} @endif</textarea>
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
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection