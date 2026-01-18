@extends('layouts.admin')
@section('title', 'Offres')

@section('links')
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'items' => [
                    ['label' => 'Gestion des offres', 'route' => 'offres', 'routeParams' => [$website ?? 'gvagroupe']],
                    ['label' => 'Offres', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')   

            <div class="w-100 mb-3">
                <a href="{{ route('offers.create') }}" class="btn btn-info">Créer une Offre</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Offres</h5>
                </div>
                <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">    
                    <thead>
                        <tr>
                            <th style="width: 10%">#</th>
                            <th style="width: 20%">Entreprise / Nom et Prénom</th>
                            <th style="width: 20%">Référence</th>
                            <th style="width: 20%">Prix ​​total</th>
                            <th style="width: 20%">Date de l'offre</th>
                            <th style="width: 20%">Utilisateur</th>
                            <th style="text-align: right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($factures) > 0)
                            @foreach($factures as $facture)
                            <tr id="facture-{{ $facture->id }}">
                                <td style="vertical-align: middle;">{{ $loop->index + 1 }}</td>
                                <td style="vertical-align: middle;">{{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }}</td>
                                <td style="vertical-align: middle;">{{ $facture->name }}</td>
                                <td style="vertical-align: middle;">{{ $facture->total_ttc }} CHF</td>
                                <td style="vertical-align: middle;">{{ date('d-m-Y', strtotime($facture->factured_date)) }}</td>
                                <td style="vertical-align: middle;">
                                    @if(isset($facture->user->name))
                                        {{$facture->user->name}} {{$facture->user->surname}}
                                    @endif
                                </td>
                                <td style="vertical-align: middle;text-align: right">

                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('offers.edit', [$facture->id]) }}">Modifier</a>
                                            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('download').submit();">Exporter PDF</a>
                                            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('print').submit();">Imprimer</a>
                                            <a href="#" class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('preview-pdf').submit();">Aperçu PDF</a>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#fill-danger-modal" onclick="onDelete({{ $facture->id }})">Supprimer</a>
                                        </div>
                                    </div>
            
                                <form target="_blank" id="preview-pdf" action="{{ route('factures.preview') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $facture->id }}" />
                                    </form>
                                    <form target="_blank" id="print" action="{{ route('factures.print') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $facture->id }}" />
                                    </form>
                                    <form target="_blank" id="download" action="{{ route('factures.download') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $facture->id }}" />
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            </div>    
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>

<div id="fill-danger-modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Suppression d'une offre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                    Êtes-vous sûr de vouloir supprimer cette offre ?
                </h5>
                <p class="text-muted">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('offres.destroy') }}" method="POST">   
                    @csrf
                    <input type="hidden" name="id" value="" id="id" />
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary ">Supprimer</button>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('custom_script')
<script>
function onDelete(id) {
    let facture_id = $('#id');
    facture_id.val(id);
}
</script>
<script>
$(document).ready(function() {
    $("tbody").sortable({
        handle: 'tr',
        placeholder: "ui-state-highlight",
        helper: function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width());
            });
            return $helper;
        },
        stop: function(event, ui) {
            // Handle the order update if needed, e.g., send AJAX request to save new order
        }
    }).disableSelection();
});
</script>
<script>
    $(document).ready(function() {
        var usersTable = $('#basic-datatable').DataTable({
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
    });
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