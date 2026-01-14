@extends('layouts.admin')
@section('title', 'Créer un sub catégorie')

@section('links')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxgYvfuZo9_KtH5VQlEFw6RKZJvj1W0L8&libraries=places"></script>
@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'costs.sub.categories',
                'items' => [
                    ['label' => 'Gestion des dépenses', 'route' => 'costs.sub.categories'],
                    ['label' => 'Sous-catégories', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer une sous-catégorie</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                <form method="POST" action="{{ route('costs.sub.categories.update') }}" class="row w-100">
                    @csrf
                    <input type="hidden" name="type_form" value="create" />

                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                        <label class="w-100" for="category">Catégorie</label>
                        <select class="form-control select2" id="catgory_id" data-toggle="select2" name="catgory_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="nr_plaques">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
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
            </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>

@endsection

@section('custom_script')
<script>
    $('#catgory_id').select2();
</script>
@endsection