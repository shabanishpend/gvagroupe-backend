@extends('layouts.admin')
@section('title', 'Créer un client')

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
                'backRoute' => 'costs',
                'items' => [
                    ['label' => 'Gestion des dépenses', 'route' => 'costs'],
                    ['label' => 'Dépenses', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer une dépense</h5>
                </div>
                <div class="card-body">
                    <div class="row">
    <div class="row m-0">
        <form method="POST" action="{{ route('costs.update') }}" class="row w-100" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type_form" value="edit" />
            <input type="hidden" name="id" value="{{ $cost->id }}" />

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="hml">Catégorie</label>
                <select class="form-control select2 select" data-toggle="select2" id="category" name="category" required>
                    @if(count($categories) > 0)
                    @foreach($categories as $category)
                        <option 
                            value="{{ $category->id }}" 
                            @if($category->id == $cost->catgory_id) selected @endif
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="hml">Sub Catégorie</label>
                <select class="form-control select2 select" data-toggle="select2" id="subcategory" name="subcategory" required>
                </select>
            </div>


            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="nr_plaques">Prix ​​total</label>
                <input type="text" class="form-control" id="total_price" name="total_price" placeholder="Total Price" value="{{ $cost->total_price }}">
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="pu_kw">Date</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="payed_date" id="payed_date" placeholder="Payed Date" value="{{ date('Y-m-d', strtotime($cost->payed_date)) }}">
                </div>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="mode_payment">Mode de paiment</label>
                <select class="form-control select2 select" data-toggle="select2" id="mode_payment" name="mode_payment" required>
                    <option @if($cost->mode_payment == "Virement bancaire") selected @endif value="Virement bancaire">Virement bancaire</option>
                    <option @if($cost->mode_payment == "Carte de crédit") selected @endif  value="Carte de crédit">Carte de crédit</option>
                    <option @if($cost->mode_payment == "Espèces") selected @endif value="Espèces bancaire">Espèces</option>
                </select>
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="observations">Observations</label>
                <input type="text" class="form-control" id="observations" name="observations" placeholder="Observations" value="{{ $cost->observations }}">
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ $cost->description }}">
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <label for="marque">File</label>
                @if($cost->file)
                <div style="width: 100%;margin-bottom: 1rem;">
                    <a href="/back/files/dépenses/{{ $cost->file }}" target="_blank">Ouvrir le fichier</a>
                </div>
                @endif
                <div class="input-group">
                    <input type="file" class="form-control" name="file" id="file" placeholder="File" value="{{ old('file') }}">
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
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        $('#category').select2({
            tags: false, // This makes the select writable
            placeholder: "Select or write a value",
            allowClear: true // Allows the user to clear the selection
        });

        $('#mode_payment').select2({
            tags: false, // This makes the select writable
            placeholder: "Sélectionner le mode de paiement",
            allowClear: true // Allows the user to clear the selection
        });
    });
</script>
<script>
    
    var subcategory = $('#subcategory');
    subcategory.select2({
        placeholder: "Sélectionner la sous-catégorie"
    }).val(null).trigger("change");

    $('#category').on('change', function() {
        const selectedValue = $(this).val();
        getSubCategoriesByCategory(selectedValue);
    });

    getSubCategoriesByCategory("{{ $cost->catgory_id }}");

    function getSubCategoriesByCategory(category_id){
        // Prepare the data to send
        const data = {
            category_id: category_id,
            _token: '{{ csrf_token() }}' // Assuming you're using Laravel and need CSRF protection
        };

        // Send the AJAX request
        fetch(`{{ route('costs.sub.categories.api', ['gvacars']) }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': data._token // Include CSRF token in headers
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            var html = [];
            subcategory.html('');
            if(data?.categories?.length > 0){
                let categories = data.categories;
                for(var i = 0; i < categories.length; i++){
                    let category = categories[i];
                    let id = category.id;
                    let name = category.name;
                    let selected = null;
                    console.log(id, "{{ $cost->sub_catgory_id }}")
                    if(id == "{{ $cost->sub_catgory_id }}"){
                        selected = 'selected'
                    }
                    let option = `<option value="${id}" ${selected}>${name}</option>`
                    html.push(option)
                }
                subcategory.append(html);
                if(categories.length === 0){
                    subcategory.html('');
                }
                subcategory.select2();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle any errors that occurred during the fetch
        });
    }
</script>
@endsection