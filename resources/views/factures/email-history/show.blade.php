@extends('layouts.admin')
@section('title', 'Historique des e-mails - ' . $facture->name)
@inject('userService', 'App\Services\UserService')

@section('links')
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'items' => [
                    ['label' => 'Gestion des factures', 'route' => 'factures', 'routeParams' => [$website]],
                    ['label' => 'Factures', 'route' => 'factures', 'routeParams' => [$website]],
                    ['label' => 'Historique des e-mails', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <!-- Facture Information Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informations de la facture</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Référence:</strong> {{ $facture->name ?? 'N/A' }}</p>
                                    <p><strong>Client:</strong> {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }}</p>
                                    <p><strong>Email du client:</strong> {{ optional($facture->client)->email ?? 'N/A' }}</p>
                                    <p><strong>Prix total:</strong> {{ $facture->total_ttc ?? 0 }} CHF</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date de facturation:</strong> {{ $facture->factured_date ? date('d/m/Y', strtotime($facture->factured_date)) : 'N/A' }}</p>
                                    <p><strong>Date de paiement:</strong> {{ $facture->payable_date ? date('d/m/Y', strtotime($facture->payable_date)) : 'N/A' }}</p>
                                    <p><strong>Statut:</strong> 
                                        @if($facture->status == 1)
                                            <span class="badge bg-success-subtle text-success">Payé</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Impayé</span>
                                        @endif
                                    </p>
                                    <p><strong>Mode de paiement:</strong> {{ $facture->payment_method_mode ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0">{{ $emailStatistics['total'] }}</h4>
                                    <p class="text-muted mb-0">Total des e-mails</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-primary rounded fs-3">
                                            <i class="mdi mdi-email-multiple"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0">{{ $emailStatistics['successful'] }}</h4>
                                    <p class="text-muted mb-0">Envoyés avec succès</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-success rounded fs-3">
                                            <i class="mdi mdi-check-circle"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0">{{ $emailStatistics['failed'] }}</h4>
                                    <p class="text-muted mb-0">Échecs</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-danger rounded fs-3">
                                            <i class="mdi mdi-close-circle"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0">{{ $emailStatistics['success_rate'] }}%</h4>
                                    <p class="text-muted mb-0">Taux de réussite</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-info rounded fs-3">
                                            <i class="mdi mdi-chart-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send Email Button -->
            @if(isset($facture->client->email) && $userService->isAdmin())
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Envoyer un e-mail</h5>
                        </div>
                        <div class="card-body">
                            @if($facture->email_sended == 'sended')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#email-modal-sended">
                                    <i class="mdi mdi-email-send"></i> L'e-mail est envoyé - Envoyer à nouveau
                                </button>
                            @else
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#email-modal">
                                    <i class="mdi mdi-email-send"></i> Envoyer un e-mail à {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }}
                                </button>
                            @endif
                            <p class="text-muted mt-2">Cette action enverra la facture par e-mail au client et l'enregistrera dans l'historique.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send Email Modal -->
            <div id="email-modal" class="modal fade" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emailModalLabel">Envoyer un e-mail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="fs-15">
                                Êtes-vous sûr de vouloir envoyer un e-mail à {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }} ?
                            </h5>
                            <p class="text-muted">Cette action est irréversible et l'e-mail sera envoyé à {{ optional($facture->client)->email ?? 'N/A' }}.</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('factures.email.send') }}" method="POST" style="margin: 0px;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $facture->id }}" />
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send Email Modal (Already Sent) -->
            <div id="email-modal-sended" class="modal fade" tabindex="-1" aria-labelledby="emailModalSendedLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emailModalSendedLabel">Envoyer un e-mail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="fs-15">
                                Êtes-vous sûr de vouloir envoyer un e-mail à {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }} ?
                            </h5>
                            <p class="text-muted">Cette action est irréversible et l'e-mail sera envoyé à {{ optional($facture->client)->email ?? 'N/A' }}.</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('factures.email.send') }}" method="POST" style="margin: 0px;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $facture->id }}" />
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Email History Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Historique des e-mails pour {{ $facture->name }}</h4>
                            <p class="card-title-desc">Tous les e-mails envoyés pour cette facture</p>
                        </div>
                        <div class="card-body">
                            <table id="facture-email-history-datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Date & Heure</th>
                                        <th>Destinataire</th>
                                        <th>Sujet</th>
                                        <th>Statut</th>
                                        <th>Envoyé par</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
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
@endsection

@section('custom_script')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#facture-email-history-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('factures.email-history.api') }}",
            type: "POST",
            data: function(d) {
                d.facture_id = {{ $facture->id }};
                d._token = '{{ csrf_token() }}';
                return d;
            },
            error: function(xhr, error, thrown) {
                console.error('DataTables Ajax Error:', error);
                console.error('Response:', xhr.responseText);
            }
        },
        columns: [
            {data: 0, name: 'created_at'},
            {data: 1, name: 'recipient_email'},
            {data: 2, name: 'subject'},
            {data: 3, name: 'status'},
            {data: 4, name: 'user'},
            {data: 5, name: 'actions', orderable: false, searchable: false}
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        responsive: true
    });

    // Reload table after successful email send
    @if(session('success'))
        table.ajax.reload(null, false);
    @endif
});
</script>
@endsection

