@extends('layouts.admin')
@section('title', 'Location d\'automobiles')


@section('links')
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'items' => [
                    ['label' => 'Location d\'automobiles', 'route' => 'auto-rental.index'],
                    ['label' => 'Location d\'automobiles', 'active' => true]
                ]
            ])    

            @include('layouts.alerts')

            <div class="w-100 mb-3">
                <a href="{{ route('auto-rental.create') }}" class="btn btn-info">Créer une nouvelle voiture de location</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Location d'automobiles</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="basic-datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Date et heure du</th>
                            <th>Date et heure jusqu'à</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($rentals) > 0)
                        @foreach($rentals as $rental)
                        <tr>
                            <td style="vertical-align: middle;">{{ $rental->name }}</td>
                            <td style="vertical-align: middle;">{{ $rental->price }}</td>
                            <td style="vertical-align: middle;">{{ $rental->date_from }} {{ $rental->time_from }}</td>
                            <td style="vertical-align: middle;">{{ $rental->date_to }} {{ $rental->time_to }}</td>
                            <td style="vertical-align: middle;">
                            @if($rental->status == 0)
                            <div class="alert alert-primary bg-primary text-white border-0 p-0 text-center" role="alert">
                                    Disponible
                                </div>
                            @endif
                            @if($rental->status == 1)
                            <div class="alert alert-primary bg-danger text-white border-0 p-0 text-center" role="alert">
                                    Occupée
                                </div>
                            @endif
                            </td>
                            <td style="vertical-align: middle;">
                                <div>
                                    <a href="{{ route('auto-rental.edit', [$rental->id]) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript: void(0);" class="action-icon"  data-bs-toggle="modal" data-bs-target="#fill-danger-modal" onclick="onDelete({{ $rental->id }})"> <i class="mdi mdi-delete"></i></a>
                                </div>
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
    @include('layouts.footer')
</div>

<div id="fill-danger-modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Suppression d'une voiture de location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                    Êtes-vous sûr de vouloir supprimer cette voiture de location ?
                </h5>
                <p class="text-muted">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('auto-rental.delete') }}" method="POST">   
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
    let cat_id = $('#id');
    cat_id.val(id);
}
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
