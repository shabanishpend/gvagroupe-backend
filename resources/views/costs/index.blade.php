@extends('layouts.admin')
@section('title', 'Dépenses')
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
                    ['label' => 'Gestion des dépenses', 'route' => 'costs'],
                    ['label' => 'Dépenses', 'active' => true]
                ]
            ])    
            @include('layouts.alerts') 
    
            @if($userService->isAdmin() || $userService->isDepensesManagment() || $userService->isAccountant())
            <div class="w-100 mb-3">
                <a href="{{ route('costs.create') }}" class="btn btn-info">Ajouter dépense</a>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dépenses</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Catégorie</th>
                            <th>Sub Catégorie</th>
                            <th>Prix Total</th>
                            <th>Date</th>
                            <th>Mode de paiement</th>
                            <th>Observations</th>
                            <th>Déposer</th>
                            <th>Actes</th>
                        </tr>
                    </thead>

                    <tbody>
                    @if(count($costs) > 0)
                        @foreach($costs as $cost)
                        <tr>
                            <td style="vertical-align: middle;">DE-{{ $cost->id }}</td>
                            <td style="vertical-align: middle;">
                                @if(isset($cost->categoryAtached))
                                    {{ $cost->categoryAtached->name }}
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if(isset($cost->categoryAtached->subCategory))
                                    {{ $cost->categoryAtached->subCategory->name }}
                                @endif
                            </td>
                            <td style="vertical-align: middle;">{{ $cost->total_price }}</td>
                            <td style="vertical-align: middle;">{{ date('d.m.Y', strtotime($cost->payed_date)) }}</td>
                            <td style="vertical-align: middle;">
                                @if($cost->mode_payment)
                                    {{ $cost->mode_payment }}
                                @else
                                    <span class="badge badge-danger">Aucun mode de paiement</span>
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if($cost->observations)
                                    {{ $cost->observations }}
                                @else
                                    <span class="badge badge-danger">Aucune observation</span>
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if($cost->file)
                                    <a target="_blank" href="/back/files/dépenses/{{ $cost->file }}">Ouvrir le fichier</a>
                                @else
                                    <span class="badge badge-danger">Aucun fichier</span>
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                <a href="javascript: void(0);" class="action-icon"  data-bs-toggle="modal" data-bs-target="#fill-danger-modal" onclick="onDelete({{ $cost->id }})"> <i class="mdi mdi-delete"></i></a>
                                <a href="{{ route('costs.edit', [$cost->id]) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
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
</div>

<div id="fill-danger-modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Suppression d'une dépense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                    Êtes-vous sûr de vouloir supprimer cette dépense ?
                </h5>
                <p class="text-muted">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('costs.destroy') }}" method="POST">   
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
        const savedPage = sessionStorage.getItem('dataTablePageNumberCosts') || 0;
        var table = $('#basic-datatable').DataTable({
            ordering: false,
            searching: false,
            displayStart: savedPage * 10,
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
           // Listen for page change events to save the current page number
        table.on('page.dt', function () {
            const info = table.page.info();
            sessionStorage.setItem('dataTablePageNumberCosts', info.page);
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

