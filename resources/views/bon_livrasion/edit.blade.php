@extends('layouts.admin')
@section('title', 'Créer bon de livraison')

@section('links')

@endsection

@section('custom_css')
<style>
    .remove_button{
        position: absolute;
        right: -33px;
        background: transparent !important;
        outline: 0;
        border: 0;
        box-shadow: none !important;
        top: 50%;
        transform: translate(0%, -50%);
        width: fit-content;
    }
</style>
@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'bonLivrasion',
                'backRouteParams' => [$website ?? 'gvacars'],
                'items' => [
                    ['label' => 'Gestion des bon de livraison', 'route' => 'bonLivrasion', 'routeParams' => [$website ?? 'gvacars']],
                    ['label' => 'Modifier un bon de livraison ' . $bon_livrasion->id, 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modifier un bon de livraison</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                <form method="POST" action="{{ route('bonLivrasion.update', ['maflotte']) }}" class="row w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type_form" value="edit" />
                    <input type="hidden" name="id" value="{{ $bon_livrasion->id }}" />

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="pu_kw">Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="date" id="date" placeholder="Payed Date" value="{{ $bon_livrasion->date }}">
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="client_id">Client</label>
                        <select class="form-control select2" id="client_id" data-toggle="select2" name="client_id" required>
                            <option value=""></option>
                            @if(isset($clients) && count($clients) > 0)
                                @foreach($clients as $client)
                                    <option 
                                        value="{{ $client->id }}" 
                                        @if($bon_livrasion->client_id == $client->id) selected @endif
                                    >
                                        {{ $client->name }} {{ $client->surname }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                        <label for="article">Article</label>
                        <input type="text" class="form-control" id="article" name="article" placeholder="Article" value="{{ $bon_livrasion->article }}">
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label for="article_description">Article Description</label>
                        <div class="input-group w-100">
                            <textarea rows="7" class="form-control" name="article_description">{{ $bon_livrasion->article_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3 mt-5">
                        <a class="btn btn-info" id="add_item" onclick="addItem()">Ajouter un article</a>
                    </div>

                    <div class="items w-100">
                        @if(isset($bon_livrasion->items))
                            @if(count($bon_livrasion->items) > 0)
                            @foreach($bon_livrasion->items as $item)
                            <div class="item position-relative row w-100 m-0">
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="title">Désignation</label>
                                    <input type="text" class="form-control" id="title" name="items[{{ $loop->index }}][title]" placeholder="Désignation" value="{{ $item->title }}">
                                </div>

                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="imei">IMEI du traceur</label>
                                    <input type="text" class="form-control" id="imei" name="items[{{ $loop->index }}][imei]" placeholder="IMEI du traceur" value="{{ $item->imei }}">
                                </div>


                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="nr_cart_sim">Numéro de la carte SIM</label>
                                    <input type="text" class="form-control" id="nr_cart_sim"  name="items[{{ $loop->index }}][nr_cart_sim]" placeholder="Numéro de la carte SIM" value="{{ $item->nr_cart_sim }}">
                                </div>

                                <button type="button" class="btn btn-danger remove_button" onclick="removeRow(this)">
                                    @include('factures.svg.remove')
                                </button>
                            </div>
                            @endforeach
                            @else
                            <div class="item position-relative row w-100 m-0">
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="title">Désignation</label>
                                    <input type="text" class="form-control" id="title" name="items[0][title]" placeholder="Désignation" value="">
                                </div>

                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="imei">IMEI du traceur</label>
                                    <input type="text" class="form-control" id="imei" name="items[0][imei]" placeholder="IMEI du traceur" value="">
                                </div>


                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <label for="nr_cart_sim">Numéro de la carte SIM</label>
                                    <input type="text" class="form-control" id="nr_cart_sim"  name="items[0][nr_cart_sim]" placeholder="Numéro de la carte SIM" value="">
                                </div>
                            </div>
                            @endif
                        @endif

                    </div>

                    <div class="form-group col-lg-12 mb-3 mt-5">
                        <button class="btn btn-primary" type="submit">Soumettre le formulaire</button>
                    </div>
                    </div>
                </form>   
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        // $('#client_id').val(null).trigger('change');
        $('#client_id').select2({
            tags: false, // This makes the select writable
            placeholder: "Select or write a value",
            allowClear: true // Allows the user to clear the selection
        });
    });
</script>
<script>
function removeRow(element){
    // Find the closest parent <tr> element
    var row = element.closest('.item');

    // Check if there are any remaining items
    const remainingItems = document.querySelectorAll('.item').length;

    // If no items are left, add an empty one
    if (remainingItems === 1) {
        addItem();
    }

    // Remove the <tr> element
    if (row) {
        row.remove();
    }
}

function addItem(){
    const addItemButton = document.getElementById('add_item');
    const itemsContainer = document.querySelector('.items');

    // Get the current number of items
    const itemCount = document.querySelectorAll('.items .item').length;

    // Clone the first item
    const newItem = itemsContainer.children[0].cloneNode(true);

     // Update the name attributes in the cloned item
     newItem.querySelectorAll('input').forEach(input => {
        const name = input.getAttribute('name');
        
        if (name) {
            // Replace the index inside the name attribute (items[0][field]) with the new index
            const newName = name.replace(/\[0\]/, `[${itemCount}]`);
            input.setAttribute('name', newName);
            input.value = ""; // Clear the value for the new input
        }
    });

    // Add a remove button to the new item
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.className = 'btn btn-danger remove_button';
    removeButton.innerHTML = `<svg fill="#000000" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
        viewBox="0 0 27.965 27.965" xml:space="preserve">
    <g>
        <g id="c142_x">
            <path d="M13.98,0C6.259,0,0,6.261,0,13.983c0,7.721,6.259,13.982,13.98,13.982c7.725,0,13.985-6.262,13.985-13.982
                C27.965,6.261,21.705,0,13.98,0z M19.992,17.769l-2.227,2.224c0,0-3.523-3.78-3.786-3.78c-0.259,0-3.783,3.78-3.783,3.78
                l-2.228-2.224c0,0,3.784-3.472,3.784-3.781c0-0.314-3.784-3.787-3.784-3.787l2.228-2.229c0,0,3.553,3.782,3.783,3.782
                c0.232,0,3.786-3.782,3.786-3.782l2.227,2.229c0,0-3.785,3.523-3.785,3.787C16.207,14.239,19.992,17.769,19.992,17.769z"/>
        </g>
        <g id="Capa_1_104_">
        </g>
    </g>
    </svg>` 
        
    // Optional: Add SVG if required
    removeButton.onclick = function () {
        removeRow(this);
    };

    // Append the remove button to the new item
    newItem.appendChild(removeButton);

    // Append the new item to the items container
    itemsContainer.appendChild(newItem);

}

</script>
@endsection