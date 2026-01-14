@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('links')
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('custom_css')
<style>
    .select2-container{width: 250px !important;}
    .select2-container--default .select2-selection--single .select2-selection__clear{
        z-index: 2;
        margin-right: 5px;
    }
    .raport_filter{
        display:flex;
        align-items:center;
    }
    .raport_filter input{
        margin-left: 10px;
        margin-right: 10px;
    }
</style>
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'items' => [
                    ['label' => 'Gestion des offres', 'route' => 'offres', 'routeParams' => [$website ?? 'gvacars']],
                    ['label' => 'Offres', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')   
            @include('factures.raports.index')
        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>
    var raportsTable = $('.rapports').DataTable({
        ordering: false,
        searching: false,
        language: {
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing":     "Traitement...",
            "sSearch":         "Rechercher:",
            "sZeroRecords":    "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst":    "Premier",
                "sLast":     "Dernier",
                "sNext":     "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            }
        }
    });

    $(document).ready(function() {
        $('#raportsClients').select2({
            placeholder: 'Select a client',
            allowClear: true  // Enable clear button
        }).val("").trigger('change');
    });

    // Function to format date using JavaScript Date object
    function formatDateToDMY(dateString) {
        const date = new Date(dateString);  // Convert string to Date object
        const day = String(date.getDate()).padStart(2, '0');  // Add leading zero for day
        const month = String(date.getMonth() + 1).padStart(2, '0');  // Months are zero-based, so +1
        const year = date.getFullYear();
        return `${day}.${month}.${year}`;  // Return formatted date as "day.month.year"
    }

    function formatNumber(number) {
        const parts = number.toFixed(2).split('.');  // Ensure two decimal places
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "'");  // Add thousands separator
        return parts.join('.');  // Join integer part and decimal part with a dot
    }

    onChangeFromDate(null)

    function onChangeFromDate(element){
        const csrfToken = document.querySelector('input[name="_token"]').value;
        const dateFrom = document.getElementById('from_date_reports').value;
        let dateTo = document.getElementById('to_date_reports').value;
        let dateToElement = document.getElementById('to_date_reports');
        const rapports_body_table = document.getElementById('rapports_body_table');
        const totalPriceElement = document.getElementById('totalPriceElement');
        const raportsClients = document.getElementById('raportsClients');
        const totalPriceElementDepenses = document.getElementById('totalPriceElementDepenses');
        const totalPriceElementGains = document.getElementById('totalPriceElementGains');

        // Set the minimum selectable date for the "To Date" input
        dateToElement.setAttribute('min', dateFrom);

        if(!element){
            const today = new Date().toISOString().split('T')[0];
            dateToElement.value = today;
            document.getElementById('previewDateTo').value = today;
            document.getElementById('downloadDateTo').value = today;
        }

        fetch("{{ route('rapports.factures') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                dateFrom: dateFrom,
                dateTo: dateTo,
                client: raportsClients.value,
            })
        })
        .then(response => response.json())
        .then(data => {
            let factures = data.factures;
            totalPriceElement.innerHTML = formatNumber(Number(data.total_price));
            totalPriceElementDepenses.innerHTML = formatNumber(Number(data.total_price_depenses));
            totalPriceElementGains.innerHTML = formatNumber(Number(data.total_price) - Number(data.total_price_depenses));
            // console.log("data Raports", data)
            raportsTable.clear().draw();
            if(factures.length > 0){
                for(let i = 0; i < factures.length; i++){
                    let facture = factures[i];
                    if(facture.type_of_facture == 'cost'){
                        raportsTable.row.add([
                            i + 1,  // Auto-increment row number
                            `${facture?.category_atached?.name} / ${facture?.category_atached?.sub_category?.name}`,  // Full name
                            `DE-${facture.id}`,  // Facture name
                            formatDateToDMY(facture?.payed_date),
                            '',
                            formatNumber(Number(facture?.total_price)),
                            'Dépenses'
                        ]).draw(false);
                    }else if(facture.type_of_facture == 'facture'){
                        console.log("facture", facture)
                        raportsTable.row.add([
                            i + 1,  // Auto-increment row number
                            `${facture?.client?.name || ''} ${facture?.client?.surname || ''}`,  // Full name
                            facture?.name,  // Facture name
                            formatDateToDMY(facture?.factured_date),
                            formatNumber(Number(facture?.total_ttc)),
                            '',
                            'Facture'
                        ]).draw(false);
                    }
                }
            }

        })
        .catch(error => {
            raportsTable.clear().draw();
            console.error('Error fetching blogs:', error);
        });

        document.getElementById('previewDateFrom').value = dateFrom;
        document.getElementById('previewDateTo').value = dateTo;
        document.getElementById('downloadDateFrom').value = dateFrom;
        document.getElementById('downloadDateTo').value = dateTo;
        document.getElementById('clientPreview').value = raportsClients.value;
        document.getElementById('clientDownload').value = raportsClients.value;
        // Excel
        document.getElementById('excelDateFrom').value = dateFrom;
        document.getElementById('excelDateTo').value = dateTo;
        document.getElementById('excelClient').value = raportsClients.value;
    }

</script>
@endsection

@section('scripts')
<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!--french datatable-->
<script src="https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr.json"></script>

 <!--select2 cdn-->
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- <script src="/assets/js/pages/datatables.init.js"></script> -->
@endsection
