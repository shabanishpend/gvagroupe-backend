@extends('layouts.admin')
@section('title', 'Modifier un Offre')

@section('links')
<style>
    .box{
        background-color: #fff;
        padding: 2rem;
    }
    .logo_header{
        object-fit: contain;
        width: 200px;
        height: 60px;
    }
    p{
        color: #000;
        margin-bottom: 0px;
    }
    .w_50{
        width: 50%;
        display: flex;
        flex-direction: column;
    }
    .w_100{
        width: 100%;
    }
    .box .header{
        display: flex;
    }
    .box .header .right{
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        flex-direction: column;
        padding-top: 2rem;
    }
    .box .header .right input{
        font-size: 16px;
    }
    .box input{
        margin-top: 5px;
        min-width: 250px;
        border: 0px;
        outline: 0;
        color: #000;
        font-size: 14px;
    }
    table input {
        min-width: 150px !important;
        width: 150px !important;
    }
    .select{
        min-width: 250px;
        max-width: 250px;
    }
    .select2{
        margin-bottom: 10px !important;  
    }
    .title{
        margin-top: 4rem;
    }
    .color-black{
        color: #000;
    }
    .d_inline{
        display: inline-block;
    }
    .auto_detail p{
    }
    .auto_detail_title{
        max-width: 90px;
        width: 90px;
    }
    .auto_detail_grid input{
        min-width: 200px;
    }
    .intervenation{
        font-weight: 700;
    }
    .attention{
        margin-top: 3rem;
        color: red;
    }
    .mt_2{margin-top: 2rem;}
    .font_bold{font-weight: 700;}
    .add_row{
        margin-bottom: 1rem;
        text-align: right;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        color: #000;
        padding-top: 18px;
        padding-bottom: 18px;
    }

    .chf_input{
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translate(0, -50%);
    }
    .input_price input{
        padding-right: 40px;
    }
    .remove_button{
        position: absolute;
        right: 4px;
        top: 14px;
        padding: 0;
        transform: translate(0, -50%);
        background: transparent !important;
        border:0;
        outline: 0;
        box-shadow: unset;

    }
    textarea{
        margin-top: 0px !important;
        width: 100%;
        border: 0px;
        outline: 0;
        color: #000;
        font-size: 14px;
        min-width: 300px;
    }
    .select2-container, .selection, .select2{width: 250px !important;}
    .select2-container--default .select2-selection--single .select2-selection__clear{
        z-index: 2;
        margin-right: 5px;
    }
    .select2.select2-container{
        width: 250px !important;
    }
    .text-right {text-align: right;}
    .text-center{text-align: center;}
    .fs_14{font-size: 14px;}
    .fs_16{font-size: 16px !important;}
    .fs_18{font-size: 18px;}
    .fs_20{font-size: 20px;}
    .fs_22{font-size: 22px;}
    .fs_24{font-size: 24px;}
    .position_relative{position: relative;}
    input:disabled{background: transparent !important;}
</style>
@endsection

@section('content')
<div class="container-fluid">  

    @include('layouts.breadcrump', [
        'title' => $website == 'maflotte' ? 'Maflotte' : 'GVACARS',
        'showBackButton' => true,
        'backRoute' => 'offres',
        'backRouteParams' => [$website ?? 'gvacars'],
        'items' => [
            ['label' => 'Gestion des offres', 'route' => 'offres', 'routeParams' => [$website ?? 'gvacars']],
            ['label' => 'Modifier un Offre', 'active' => true]
        ]
    ])

    <form class="box" action="{{ route('factures.update', [$website]) }}" method="POST" id="pdf_form">
        @csrf
        <input type="hidden" name="type_form" value="edit" />
        <input type="hidden" name="id" value="{{ $facture->id }}" />
        <input type="hidden" name="type_of_facture" value="{{ $type_of_facture }}" />

        <div class="header d_flex">

           <div class="w_50 left">
                <div>
                    {{-- <img 
                        class="logo_header" 
                        src="/front/assets/img/logo.webp" 
                    > --}}
                </div>
                <div>
                    {{-- <p>Impasse du Tilleul 12</p>
                    <p>1510 Moudon</p>
                    <p>Tél: 076/265.33.97</p>
                    <p>CHE-430.201.315 TVA</p>
                    --}}
                </div>
           </div>

           <div class="w_50 right">
            <select class="form-control select2 select" data-toggle="select2" id="clients">
                    @foreach($clients as $client)
                    <option 
                        value="{{ $client->id }}" 
                        data-id="{{ $client->id }}"
                        data-surname="{{ $client->surname }}"
                        data-address="{{ $client->address }}"
                        data-city="{{ $client->city }}"
                        data-name="{{ $client->name }}"
                        data-postal-code="{{ $client->postal_code }}"
                        @if($facture->client_id == $client->id) selected @endif
                    >
                        {{ $client->name }} {{ $client->surname }}
                    </option>
                    @endforeach
                </select>

                @if($website == 'gvacars')
                <select class="form-control select2 select" data-toggle="select2" name="car" id="cars" data-placeholder="Sélectionner un voiture">
             
                </select>
                @else
                    <input type="hidden" value="" name="car" />
                @endif

                <input 
                    type="hidden"
                    name="company_name"
                    id="company_name"
                    placeholder="Écrire Company Name"
                    value="{{ $facture->company_to_name }}"
                />
                <input 
                    type="hidden"
                    name="client_id"
                    id="client_id"
                    value="{{ $facture->client_id }}"
                />
                <input 
                    type="text"
                    name="company_address"
                    id="company_address"
                    placeholder="Écrire Company Address"
                    value="{{ $client->address }}"
                    disabled
                />
                <input 
                    type="text"
                    name="company_postal_code"
                    id="company_postal_code"
                    placeholder="Écrire Postal Code"
                    value="{{ $client->postal_code }}, {{ $client->city }}"
                    disabled
                />

                <input 
                    type="text"
                    name="factured_city"
                    id="factured_city"
                    value="{{ $facture->factured_city }}"
                    placeholder="Ville facturée"
                    style="margin-top: 2rem;"
                />

                <input 
                    type="date"
                    name="factured_date"
                    id="factured_date"
                    value="{{ $facture->factured_date }}"
                    placeholder="Date de facturation"
                />


                <!-- <input 
                    type="text"
                    name="company_city_date"
                    id="company_city_date"
                    placeholder="Écrire City and Date"
                    value="{{ $facture->company_to_city_date }}"
                />             -->
           </div>

        </div>

        <h2 class="title color-black">Offre</h2>

        @if($website == 'gvacars')
        <div class="mb-1">
            Masquer les détails de la voiture
            <select name="hide_car_details" id="hide_car_details">
                <option value="0" @if($facture->hide_car_details == 0) selected @endif>Non</option>
                <option value="1" @if($facture->hide_car_details == 1) selected @endif>Oui</option>
            </select>
        </div>
        @else
        <input type="hidden" name="hide_car_details" value="1" />
        @endif 

        @if($website == 'gvacars')
        <div id="car_details">
            <div class="auto_detail_grid d_inline">
                <div class="auto_detail">
                    <div class="auto_detail_title d_inline">
                        <p>N° plaques</p>
                    </div>
                    <input 
                        class="d_inline"
                        placeholder="Écrire plaque"
                        name="plaque"
                        id="nr_plaque"
                        value="@if($facture->car) {{ $facture->car->nr_plaques }} @else {{ $facture->nr_plaque }} @endif"
                    />
                </div>

                <div class="auto_detail">
                    <div class="auto_detail_title d_inline">
                        <p>KM Voiture</p>
                    </div>
                    <input 
                        class="d_inline"
                        placeholder="Écrire KM Voiture"
                        name="km_voiture"
                        id="km_voiture"
                        value="{{ $facture->km_voiture }}"
                    />
                </div>

                <div class="auto_detail">
                    <div class="auto_detail_title d_inline">
                        <p>PU. KW</p>
                    </div>
                    <input 
                        class="d_inline"
                        placeholder="Écrire PU. KW"
                        name="pu_km"
                        id="pu_kw"
                        value="@if($facture->car) {{ $facture->car->pu_kw }} @else {{ $facture->pu_kw }} @endif"
                    />
                </div>
                
                <div class="auto_detail">
                    <div class="auto_detail_title d_inline">
                        <p>Année</p>
                    </div>
                    <input 
                        class="d_inline"
                        placeholder="Écrire Année"
                        name="year"
                        id="annee"
                        value="@if($facture->car) {{ $facture->car->annee }} @else {{ $facture->annee }} @endif"
                    />
                </div>

            </div>

            <div class="auto_detail_grid d_inline" style="margin-bottom: 4rem !important;">

                <div class="auto_detail">
                    <div class="auto_detail_title d_inline">
                        <p>Marque</p>
                    </div>
                    <input 
                        class="d_inline"
                        placeholder="Écrire Marque"
                        name="marque"
                        id="marquee"
                        value="@if($facture->car) {{ $facture->car->marque }} @else {{ $facture->marque }} @endif"
                    />
                </div>

                <div class="auto_detail">
                    <div class="auto_detail_title d_inline">
                        <p>Type</p>
                    </div>
                    <input 
                        class="d_inline"
                        placeholder="Écrire Type"
                        name="type"
                        id="type"
                        value="@if($facture->car) {{ $facture->car->type }} @else {{ $facture->type }} @endif"
                    />
                </div>

                <div class="auto_detail">
                    <div class="auto_detail_title d_inline">
                        <p>Châssis</p>
                    </div>
                    <input 
                        class="d_inline"
                        placeholder="Écrire Châssis"
                        name="chassis"
                        id="chassis"
                        value="@if($facture->car) {{ $facture->car->chassis }} @else {{ $facture->chassis }} @endif"
                    />
                </div>
                
                <div class="auto_detail">
                    <div class="auto_detail_title d_inline">
                        <p>HML</p>
                    </div>
                    <input 
                        class="d_inline"
                        placeholder="Écrire HML"
                        name="hml"
                        id="hml"
                        value="@if($facture->car) {{ $facture->car->hml }} @else {{ $facture->hml }} @endif"
                    />
                </div>

            </div>
        </div>
        @endif
                        
        @php
            $date = \Carbon\Carbon::parse($facture->intervenation_date, null, false);
            $isDate = $date instanceof \Carbon\Carbon;
        @endphp

        @if($website == 'gvacars')
        <p class="intervenation">Intervention le 
        @if($isDate)
            <input type="date" style="min-width: 112px;" class="font_bold" placeholder="Écrire date" name="intervenation_date" value="{{ \Carbon\Carbon::parse($facture->intervenation_date)->format('Y-m-d') }}" />
        @else
            <input type="date" style="min-width: 112px;" class="font_bold" placeholder="Écrire date" name="intervenation_date" value="{{ $facture->intervenation_date }}" />
        @endif
        </p>
        @endif


        @if($facture->website == 'maflotte')
        <p class="intervenation">Payable jusqu'au: <input style="min-width: 112px;" class="font_bold" type="date" placeholder="Écrire date" name="payable_end_time" value="{{ $facture->payable_end_time }}"  /></p>
        @endif

        <div class="mt_2 add_row">
            <button 
                class="btn btn-info"
                onclick="addRow()"
                type="button"
            >
                @include('factures.svg.plus')
                Ajouter une rangée
            </button>
        </div>
        <div class="responsive" style="width: 100%; overflow-x: auto;">
            <table style="width: 100%;">
                <tr>
                    <th>Désignation</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total CHF</th>
                </tr>
                @if(isset($facture->items) && count($facture->items))
                @foreach($facture->items as $item)
                <tr class="item">
                    <td>
                        <textarea 
                            placeholder = "Écrire title"
                            name="items[{{$loop->index}}][title]"
                            onkeyup="calculateFields()"
                            class="title"
                            oninput="autoResize(this)"
                        >{!! html_entity_decode($item->title) !!}</textarea>
                    </td>
                    <td class="position_relative input_price">
                        <input 
                            placeholder = "Écrire prix unitaire"
                            name="items[{{$loop->index}}][prix_unitaire]"
                            onkeyup="calculateFields()"
                            class="prix_unitaire"
                            value="{{ $item->prix_unitaire }}"
                        />
                        <span class="chf_input">CHF</span>
                    </td>
                    <td class="position_relative input_price">
                        <input 
                            placeholder = "Écrire Quantité"
                            name="items[{{$loop->index}}][quantity]"
                            onkeyup="calculateFields()"
                            class="quantity"
                            value="{{ $item->quantity }}"
                        />
                        <span class="chf_input">CHF</span>
                    </td>
                    <td class="position_relative input_price">
                        <input 
                            placeholder = "Total CHF"
                            name="items[{{$loop->index}}][total_chf]"
                            class="total_chf"
                            value="{{ $item->total_chf }}"
                            readonly
                        />
                        <span class="chf_input">CHF</span>
                        <button class="btn btn-danger remove_button" onclick="removeRow(this)">
                            @include('factures.svg.remove')
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
                <tr id="add_before_here">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>Total hors TVA</strong></td>
                    <td class="position_relative input_price">
                        <input 
                            name="total_hors_tva"
                            class="total_hors_tva font_bold fs_16"
                            id="total_hors_tva"
                            value="{{ $facture->total_hors_tva }}"
                            readonly
                        />
                        <span class="chf_input"><strong>CHF</strong></span>
                    </td>
                    <td>
                        <input 
                            id="total_hors_quantity" 
                            name="total_hors_quantity"  
                            class="font_bold fs_16" 
                            value="{{ $facture->total_hors_quantity }}"
                            readonly
                        />
                    </td>
                    <td class="position_relative input_price">
                        <input 
                            name="total_hors_price"
                            class="total_hors_price font_bold fs_16"
                            id="total_hors_price"
                            value="{{ $facture->total_hors_price }}"
                            readonly
                        />
                        <span class="chf_input"><strong>CHF</strong></span>
                    </td>
                </tr>
                <tr @if($facture->tvsh == 0) style="display:none" @endif>
                    <td class="fs_18">
                        <span class="d_inline" style="float:left;"><strong>TVA</strong></span>
                        <span class="d_inline" style="float:right;">
                            <input 
                                name = "tvsh"
                                id="tvsh"
                                style="min-width: 45px;width: 45px; font-size: 18px;margin-top: 0px;";
                                class="font_bold"
                                onkeyup="calculateFields()"
                                value="{{ $facture->tvsh }}"
                                @if($facture->tvsh == 0) disabled @endif
                            />
                            %
                        </span>
                    </td>
                    <td class="fs_18 text-center" colspan="3">
                        <strong><span id="total_tva">{{ $facture->total_tva }}</span> CHF</strong>
                        <input type="hidden" name="total_tva" id="total_tva_hidden" value="{{ $facture->total_tva }}" />
                    </td>
                </tr>
                <tr>
                    <td class="fs_18"><strong>Total TTC</strong></td>
                    <td class="fs_18 text-center" colspan="3">
                        <strong><span id="total_ttc">{{ $facture->total_ttc }}</span> CHF</strong>
                        <input type="hidden" name="total_ttc" id="total_ttc_hidden"  value="{{ $facture->total_ttc }}" />
                    </td>
                </tr>
            </table>
        </div>

        <p class="mt_2 fs_18">Cordialement</p>
        <p class="fs_18">
            <input type="text" value="{{ $facture->cordialement }}" name="cordialement" id="cordialement" style="font-size: 18px !important;border-bottom: 1px solid black;" />
        </p>

        <div class="mt_2 add_row">
            <button
                class="btn bg-light"
                type="button"
                onclick="preview('download')"
            >
                Download PDF
            </button>
            <button
                class="btn btn-info"
                type="button"
                onclick="preview('preview')"
            >
                Preview PDF
            </button>
            <button 
                class="btn btn-primary"
                type="button"
                onclick="preview('print')"
            >
                Preview Print
            </button>
            <button 
                class="btn btn-success"
                type="button"
                onclick="preview('update')"
            >
                Edit
            </button>
        </div>
    </form>

</div>

@endsection

@section('custom_script')
<script>
    // Find the row to insert before and its parent
    var existingRow = document.getElementById('add_before_here');

    function removeRow(element){
        // Find the closest parent <tr> element
        var row = element.closest('tr');

        // Remove the <tr> element
        if (row) {
            row.remove();
            calculateFields()
        }
    }

    function preview(type){
        const pdf_form = document.getElementById('pdf_form');
        let url = "";

        if(type == 'download'){
            url = "{{ route('factures.download') }}";
            pdf_form.target = "_blank";
        }else if(type == 'preview'){
            url = "{{ route('factures.preview') }}";
            pdf_form.target = "_blank";
        }else if(type == 'print'){
            url = "{{ route('factures.print') }}";
            pdf_form.target = "_blank";
        }else if(type == 'update'){
            pdf_form.removeAttribute('target');
            url = "{{ route('factures.update', [$website]) }}"
        }
         // Set the form's action to the new URL
        pdf_form.action = url;

        // Set the form's target to '_blank' to open in a new tab/window
        // pdf_form.target = "_blank";

        // Optional: If you need to submit the form automatically upon clicking, you can do so
        pdf_form.submit();
    }

    function printPDF() {
        var win = window.open("{{ route('factures.print') }}", '_blank');
        win.focus();
        win.onload = function() {
            win.print();
        };
    }
    
    function addRow() {
        // Determine the current index based on existing '.item' rows
        var items = document.querySelectorAll('.item');
        var index = items.length;

        // Create the new row
        var newRow = document.createElement('tr');
        newRow.className = 'item';

        // Define the placeholders, names for the inputs, and which inputs need the 'CHF' span
        var placeholders = ["Écrire title", "Écrire prix unitaire", "Écrire Quantité", "Total CHF"];
        var names = ["title", "prix_unitaire", "quantity", "total_chf"];
        var needsChfSpan = [false, true, true, true]; // Indicate which inputs need the 'CHF' span

        names.forEach(function(name, i) {
            var cell = newRow.insertCell(i);
            // Create a textarea for the title, and input for other fields
            var input;
            if (name === 'title') {
                input = document.createElement('textarea');
                input.className = 'title';
                input.placeholder = placeholders[i];
                input.name = `items[${index}][${name}]`;
                input.setAttribute('oninput', 'autoResize(this)');
                input.classList.add('auto-resize');
            } else {
                input = document.createElement('input');
                input.placeholder = placeholders[i];
                input.name = `items[${index}][${name}]`;
                input.className = name;

                if (name !== 'total_chf') {
                    input.setAttribute('onkeyup', 'calculateFields()');
                    input.setAttribute('required', true);
                }

                if (name === 'total_chf') {
                    input.setAttribute('readonly', true);
                }
            }

            cell.appendChild(input);

            if (needsChfSpan[i]) {
                cell.className = "position_relative input_price";
                var span = document.createElement('span');
                span.className = "chf_input";
                span.textContent = "CHF";
                cell.appendChild(span);
            }

            // Condition to append the remove button in the 'total_chf' cell
            if (name === 'total_chf') {
                var removeButton = document.createElement('button');
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
                                        </svg>`;
                removeButton.className = "btn btn-danger remove_button";
                removeButton.setAttribute('type', 'button');
                removeButton.setAttribute('onclick', 'removeRow(this)');
                cell.appendChild(removeButton);
            }
        });

        var existingRow = document.getElementById('add_before_here');
        existingRow.parentNode.insertBefore(newRow, existingRow);
    }

    function calculateFields(){
        let fields = document.querySelectorAll('.item');
        let total_hors_tva = document.getElementById('total_hors_tva')
        let total_hors_quantity = document.getElementById('total_hors_quantity')
        let total_hors_price = document.getElementById('total_hors_price')
        let tvsh = document.getElementById('tvsh')
        let total_tva = document.getElementById('total_tva')
        let total_ttc = document.getElementById('total_ttc');
        let total_tva_hidden = document.getElementById('total_tva_hidden')
        let total_ttc_hidden = document.getElementById('total_ttc_hidden')

        let sumOfQuantities = 0;
        let sumOfTotal = 0;
        let sumOfTotalHorsTVA = 0

        fields.forEach(function(field, i) {
            let prix_unitaire = field.querySelector('.prix_unitaire').value;
            let quantity = field.querySelector('.quantity').value;
            let total_chf = field.querySelector('.total_chf');

            // Check if the conversion results are valid numbers
            if (!isNaN(prix_unitaire) && !isNaN(quantity)) {

                let calculateTotalCHF = Number(prix_unitaire * quantity);
                total_chf.value = Number(calculateTotalCHF).toFixed(2);
                sumOfQuantities += Number(quantity); 
                sumOfTotal += Number(calculateTotalCHF); 
                sumOfTotalHorsTVA += Number(prix_unitaire)

                // Proceed with calculations as all values are numbers
                // Example calculation
                // total_chf = prix_unitaire * quantity;
                // You can then use these values for further calculations
            } else {
                // Handle the case where one or more conversions were not successful
                console.error(`Row ${i}: Invalid number input.`);
                // Optionally, set defaults or show an error
                // prix_unitaire = prix_unitaire || 0; // Example fallback to 0
                // quantity = quantity || 0; // Example fallback to 0
                // total_chf = total_chf || 0; // Example fallback to 0
            }

        });

        total_hors_quantity.value = sumOfQuantities;
        total_hors_price.value = sumOfTotal.toFixed(2);
        total_hors_tva.value = sumOfTotalHorsTVA.toFixed(2);

        // Constants
        const tvaRate = Number(tvsh.value / 100);
        const totalPrice = Number(sumOfTotal); // Total price in CHF

        // Calculate TVA amount
        let tvaAmount = Number(totalPrice * tvaRate);
        @if($facture->tvsh == 0)
        tvaAmount = Number(totalPrice)
        @endif
        total_tva.innerHTML = "";
        total_tva.innerHTML = Number(tvaAmount).toFixed(2);
        total_tva_hidden.value =  Number(tvaAmount).toFixed(2);
        // Calculate total price including TVA (TTC)
        let totalTtc = Number(totalPrice + tvaAmount);
        @if($facture->tvsh == 0)
        totalTtc = Number(totalPrice)
        @endif
        total_ttc.innerHTML = "";
        total_ttc.innerHTML = Number(totalTtc).toFixed(2);
        total_ttc_hidden.value = Number(totalTtc).toFixed(2);
    }
</script>

<script>
     document.addEventListener('DOMContentLoaded', function() {
        const textareas = document.querySelectorAll('textarea.title');
        textareas.forEach(function(textarea) {
            autoResize(textarea);
        });
    });
    function autoResize(textarea) {
        textarea.style.height = 'auto'; // Reset height to auto to shrink if necessary
        textarea.style.height = (textarea.scrollHeight) + 'px'; // Set new height based on scrollHeight
    }
</script>

<script>
$('#cars').select2({placeholder: "Sélectionner un voiture", allowClear: true }).val("").trigger('change');

$(document.body).on("change","#cars",function(){
    const selectedCar = $(this).find('option:selected');
    const name = selectedCar.attr('data-marquee');
    const id =  selectedCar.attr('value');
    const plaque =  selectedCar.attr('data-nr_plaque');
    const km_voiture = selectedCar.attr('data-km_voiture');
    const pu_kw = selectedCar.attr('data-pu_kw');
    const anne =  selectedCar.attr('data-anne');
    const type =  selectedCar.attr('data-type');
    const chassis =  selectedCar.attr('data-chassis');
    const hml =  selectedCar.attr('data-hml');
    const client_id =  selectedCar.attr('data-client_id');
    const facture_client_car_id = "{{ $facture->client_car_id }}"

    if(id){
        $('#nr_plaque').val(plaque)
        console.log("km_voiture", km_voiture)
        if(km_voiture != 'null' && km_voiture){
            $('#km_voiture').val(km_voiture)
        }
        $('#pu_kw').val(pu_kw)
        $('#annee').val(anne)
        $('#type').val(type)
        $('#chassis').val(chassis)
        $('#marquee').val(name)
        $('#hml').val(hml)
    }
});

$(document).ready(function() {

    function getCarsByClient(id){
        $('#cars').select2();
        $('#cars').select2('destroy').empty();
        $.ajax({
            url: `/admin/clients/cars/${id}`,
            type: 'GET',
            success: function(data) {
                const facture_client_car_id = "{{ $facture->client_car_id }}"
                var models = data.cars;
                var html = [];

                for(var i = 0; i < models.length; i++){
                    let name = models[i].marque;
                    let id = models[i].id;
                    let plaque = models[i].nr_plaques;
                    let km_voiture = models[i].km_voiture;
                    let pu_kw = models[i].pu_kw;
                    let anne = models[i].annee;
                    let type = models[i].type;
                    let chassis = models[i].chassis;
                    let hml = models[i].hml;
                    let client_id = models[i].client_id;
                    
                    let option = `<option 
                        value="${id}"
                        data-nr_plaque="${plaque}"
                        data-km_voiture="${km_voiture}"
                        data-pu_kw="${pu_kw}"
                        data-anne="${anne}"
                        data-type="${type}"
                        data-chassis="${chassis}"
                        data-hml="${hml}"
                        data-marquee="${name}"
                        data-client_id="${client_id}"
                        ${facture_client_car_id && facture_client_car_id == id ?  "selected" : ""}
                    >
                        ${name}
                    </option>`
                    html.push(option)
                }
                $('#cars').append(html);
                if(models.length === 0){
                    $('#cars').val(null).trigger('change');
                }
                if(facture_client_car_id){

                }else{
                    $('#cars').val(null).trigger('change');
                }
                $('#cars').select2();
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }

    // Initialize Select2, if not already initialized
    $('#clients').select2({
        placeholder: "Sélectionner un client", // Your placeholder text
        allowClear: true // Allows a clear button to appear if a value is selected
    }).on("change", function(e) {
        // Assuming you have the client's name and surname as part of the option value or data attributes
        var selectedClient = $(this).find('option:selected');
        var selectedClientName = selectedClient.attr('data-name')
        var selectedClientSurname = selectedClient.attr('data-surname')
        var selectedClientAddress = selectedClient.attr('data-address')
        var selectedClientCity = selectedClient.attr('data-city')
        var selectedClientPostalCode= selectedClient.attr('data-postal-code')
        var selectedClientID = selectedClient.attr('data-id');

        var address = $('#company_address');
        var postalcode = $('#company_postal_code');
        var city_date = $('#company_city_date');
        var name = $('#company_name');
        var clientID = $('#client_id');

        if(selectedClientID){
            clientID.val(selectedClientID)
        }else{
            clientID.val(null);
        }

        if(selectedClientName){
            name.val(selectedClientName+' '+selectedClientSurname);
        }else{
            name.val(null)
        }
        if(selectedClientAddress){
            address.val(selectedClientAddress)
        }else{
            address.val(null)
        }
        if(selectedClientPostalCode){
            postalcode.val(selectedClientPostalCode +", "+ selectedClientCity)
        }else{
            postalcode.val(null)
        }

        getCarsByClient(selectedClientID)
    });

    @if(isset($facture->client_id))
        $('#clients').val('{{ $facture->client_id }}').trigger('change');
    @else
        $('#clients').val(null).trigger('change');
    @endif
});
</script>
<script>
    @if($website == 'gvacars')
        @if($facture->hide_car_details == 0)
            document.getElementById('car_details').style.display = 'none';
        @endif
    
        document.getElementById('hide_car_details').addEventListener('change', function() {
            var carDetails = document.getElementById('car_details');
            if (this.value == '1') {
                carDetails.style.display = 'block';
            } else {
                carDetails.style.display = 'none';
            }
        });
    @endif
</script>
@endsection

@section('scripts')

@endsection