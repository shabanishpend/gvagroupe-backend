@extends('layouts.admin')
@section('title', 'Bon de livraison')
@inject('userService', 'App\Services\UserService')


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
                    ['label' => 'Gestion des bon de livraison', 'route' => 'bonLivrasion', 'routeParams' => [$website ?? 'gvacars']],
                    ['label' => 'Bon de livraison', 'active' => true]
                ]
            ])    
            @include('layouts.alerts') 
    
            @if($userService->isAdmin())
            <div class="w-100 mb-3">
                <a href="{{ route('bonLivrasion.create', ['maflotte']) }}" class="btn btn-info">Ajouter bon de livraison</a>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Bon de livraison</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="basic-datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>Number de bon</th>
                            <th>Article</th>
                            <th>Article Description</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Actes</th>
                        </tr>
                    </thead>

                    <tbody>
                    @if(count($bon_livrasions) > 0)
                        @foreach($bon_livrasions as $bon_livrasion)
                        <tr>
                            <td style="vertical-align: middle;">
                                {{ $bon_livrasion->id }}
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $bon_livrasion->article }}
                            </td>
                            <td style="vertical-align: middle;">{{ $bon_livrasion->article_description }}</td>
                            <td style="vertical-align: middle;">{{ date('d-m-Y', strtotime($bon_livrasion->date)) }}</td>
                            <td style="vertical-align: middle;">{{ $bon_livrasion->client->name }} {{ $bon_livrasion->client->surname }}</td>
                            <td style="vertical-align: middle;">
                            @if($userService->isAdmin())
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('bonLivrasion.edit', [$bon_livrasion->id]) }}">Modifier</a>
                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest('tr').querySelector('.preview-pdf').submit();">Aperçu PDF</a>
                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest('tr').querySelector('.download').submit();">Exporter PDF</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#fill-danger-modal" onclick="onDelete({{ $bon_livrasion->id }})">Supprimer</a>
                                </div>
                            </div>

                        <form target="_blank" class="preview-pdf" action="{{ route('bonLivrasion.preview') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $bon_livrasion->id }}" />
                            </form>
                            <form target="_blank" class="download" action="{{ route('bonLivrasion.download') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $bon_livrasion->id }}" />
                            </form>
                            @endif
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
</div>

<div id="fill-danger-modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Suppression d'un bon de livraison</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                    Êtes-vous sûr de vouloir supprimer ce bon de livraison ?
                </h5>
                <p class="text-muted">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('bonLivrasion.destroy') }}" method="POST">   
                    @csrf
                    <input type="hidden" name="delete_id" value="" id="delete_id" />
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
    let user_id = $('#delete_id');
    user_id.val(id);
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