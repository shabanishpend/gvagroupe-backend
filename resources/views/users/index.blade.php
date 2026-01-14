@extends('layouts.admin')
@section('title', 'Utilisateurs')
@inject('userService', 'App\Services\UserService')


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
                'title' => 'GVACARS',
                'items' => [
                    ['label' => 'Gestion des utilisateurs', 'route' => 'users'],
                    ['label' => 'Utilisateurs', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="w-100 mb-3">
                <a href="{{ route('users-create') }}" class="btn btn-info">Créer un utilisateur</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Utilisateurs</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Nom et Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users) > 0)
                                    @foreach($users as $user)
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            @if($user->image)
                                                <img 
                                                    src="/back//img/users/{{ $user->image }}"
                                                    width="40"
                                                    height="40"
                                                    style="border-radius: 100%;"
                                                    class="object-cover"
                                                />
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">{{ $user->name }} {{ $user->surname }}</td>
                                        <td style="vertical-align: middle;">{{ $user->phone }}</td>
                                        <td style="vertical-align: middle;">{{ $user->email }}</td>
                                        <td style="vertical-align: middle;">
                                            @if($user->role && $user->role->role)
                                                @if($user->role->role->id == 1)
                                                    <span class="badge bg-warning-subtle text-warning">{{ $user->role->role->title }}</span>
                                                @elseif($user->role->role->id == 2)
                                                    <span class="badge bg-success-subtle text-success">{{ $user->role->role->title }}</span>
                                                @elseif($user->role->role->id == 3)
                                                    <span class="badge bg-info-subtle text-info">{{ $user->role->role->title }}</span>
                                                @elseif($user->role->role->id == 4)
                                                    <span class="badge bg-danger-subtle text-danger">{{ $user->role->role->title }}</span>  
                                                @elseif($user->role->role->id == 5)
                                                    <span class="badge bg-primary-subtle text-primary">{{ $user->role->role->title }}</span>
                                                @elseif($user->role->role->id == 6)
                                                    <span class="badge bg-secondary-subtle text-secondary">{{ $user->role->role->title }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div>
                                                <a href="{{ route('users-view',[$user->id]) }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                @if($user->id == auth()->user()->id)
                                                <a href="{{ route('users-edit',[$user->id]) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                @endif
                                                @if($user->id == auth()->user()->id)
                                                <a href="javascript: void(0);" class="action-icon"  data-bs-toggle="modal" data-bs-target="#fill-danger-modal" onclick="onDelete({{ $user->id }})"> <i class="mdi mdi-delete"></i></a>
                                                @endif
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
        </div>
    </div>
    @include('layouts.footer')
</div>

<div id="fill-danger-modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Suppression d'un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                    Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                </h5>
                <p class="text-muted">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('users-delete') }}" method="POST">   
                    @csrf
                    <input type="hidden" name="user_id" value="" id="user_id" />
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
    let user_id = $('#user_id');
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



