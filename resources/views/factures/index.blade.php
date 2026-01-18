@extends('layouts.admin')
@section('title', 'Factures')
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
                'title' => 'gvagroupe',
                'items' => [
                    ['label' => 'Gestion des factures', 'route' => 'factures', 'routeParams' => [$website ?? 'gvagroupe']],
                    ['label' => 'Factures', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')   

            @if($userService->isAdmin())
            <div class="w-100 mb-3">
                <a href="{{ route('factures.create', [$website]) }}" class="btn btn-info">Créer une facture</a>
            </div>
            @endif

            <div class="w-100 mb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Factures à revoir</h5>

                                <div class="row">

                                    <div class="col-12">
                                        @foreach($factures as $facture)
                                            @if(!$facture->is_archived)
                                                @if($facture->is_expired || $facture->warning)
                                                    <a data-bs-toggle="modal" data-bs-target="#fill-danger-modal-{{ $facture->id }}" class="alert {{ $facture->is_expired ? 'alert-danger' : 'alert-warning' }} d-flex align-items-center">
                                                        <h5 class="alert-heading">{{ $facture->name }} /</h5>
                                                        <p class="mb-0 ml-2">{{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }}</p>
                                                        <p class="mb-0 ml-2">- {{ $facture->is_expired ? 'Expirée' : 'Expire bientôt' }}</p>
                                                    </a>
                                                    <div id="fill-danger-modal-{{ $facture->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="myModalLabel">Archiver une facture</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="fs-15">
                                                                        Êtes-vous sûr de vouloir archiver cette facture et en créer une nouvelle ?
                                                                    </h5>
                                                                    <p class="text-muted">Cette action est irréversible et la nouvelle facture sera créée avec le même client et les mêmes détails.</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('factures.duplicate') }}" method="POST">   
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $facture->id }}" />
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit" class="btn btn-primary ">Archiver</button>
                                                                    </form>
                                                                </div>

                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                    {{--<form class="duplicate" action="{{ route('factures.duplicate') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $facture->id }}" />
                                                    </form>--}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Factures</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    {{-- <th style="width: 10%">#</th> --}}
                                    <th style="width: 10%">Entreprise / Nom et Prénom</th>
                                    <th style="width: 10%">Référence</th>
                                    <th style="width: 10%">Prix ​​total</th>
                                    <th style="width: 10%">Date de facturation</th>
                                    <th style="width: 10%">Mode de paiment</th>
                                    <th style="width: 10%"> Date de paiement</th>
                                    @if($website == 'maflotte')
                                        <th style="width: 10%">Mode d'envoi / Date</th>
                                    @endif
                                    <th style="width: 10%">Envoyer la facture</th>
                                    @if($website == 'maflotte')
                                        <th style="width: 10%">Abonoment</th>
                                    @endif
                                    <th style="width: 10%">Status</th>
                                    <th style="text-align: right">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($factures) > 0)
                                    @foreach($factures as $facture)
                                    <!-- @php 
                                        $subscription_type = $facture->subscription_type;
                                        $payable_end_time = $facture->subscription_start_date;
                                        $subscription_end_date = $facture->subscription_end_date;
                                        
                                        $todayDate = \Carbon\Carbon::now();
                                        $options = ["monthly", "3_months", "6_months", "yearly"];
                                        $is_expired = false;
                                        $warning = false;

                                        if(in_array($subscription_type, $options)){
                                            $end_date = strtotime($payable_end_time);
                                            
                                            switch($subscription_type) {
                                                case 'monthly':
                                                    $end_date = strtotime("+1 month", $end_date);
                                                    $warning_date = strtotime("-15 days", $end_date);
                                                    break;
                                                case '3_months':
                                                    $end_date = strtotime("+3 months", $end_date);
                                                    $warning_date = strtotime("-1 month", $end_date);
                                                    break;
                                                case '6_months':
                                                    $end_date = strtotime("+6 months", $end_date);
                                                    $warning_date = strtotime("-1 month", $end_date);
                                                    break;
                                                case 'yearly':
                                                    $end_date = strtotime("+1 year", $end_date);
                                                    $warning_date = strtotime("-1 month", $end_date);
                                                    break;
                                            }

                                            if($todayDate->greaterThan(\Carbon\Carbon::createFromTimestamp($end_date))){
                                                $is_expired = true;
                                            } elseif($todayDate->greaterThan(\Carbon\Carbon::createFromTimestamp($warning_date))) {
                                                $warning = true;
                                            }

                                        } else if(isset($subscription_end_date)) {
                                            if($todayDate->greaterThan(\Carbon\Carbon::parse($subscription_end_date))){
                                                $is_expired = true;
                                            }
                                        }

                                        $row_color = '';
                                        if($is_expired) {
                                            $row_color = 'red';
                                        } elseif($warning) {
                                            $row_color = 'orange';
                                        }
                                    @endphp -->
                                    <tr 
                                        id="facture-{{ $facture->id }}" 
                                    >
                                        {{-- <td style="vertical-align: middle;">{{ $loop->index + 1 }}</td> --}}
                                        <td style="vertical-align: middle;">{{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }}</td>
                                        <td style="vertical-align: middle;">{{ $facture->name }}</td>
                                        <td style="vertical-align: middle;">{{ $facture->total_ttc }} CHF</td>
                                        <td style="vertical-align: middle;">{{ date('d/m/Y', strtotime($facture->factured_date)) }}</td>
                                        {{-- <td style="vertical-align: middle;">
                                            @if(isset($facture->user->name))
                                                {{$facture->user->name}} {{$facture->user->surname}}
                                            @endif
                                        </td> --}}

                                        <td style="vertical-align: middle;">
                                            <select @if($facture->status == 2) disabled @endif class="form-control select2 select" data-toggle="select2" id="payment_method_mode" name="payment_method_mode" onchange="updatePaymentMethodMode({{ $facture->id }}, this.value)">
                                                <option @if($facture->payment_method_mode == "Virement bancaire") selected @endif value="Virement bancaire">Virement bancaire</option>
                                                <option @if($facture->payment_method_mode == "Carte de crédit") selected @endif  value="Carte de crédit">Carte de crédit</option>
                                                <option @if($facture->payment_method_mode == "Espèces") selected @endif value="Espèces">Espèces</option>
                                                <option @if($facture->payment_method_mode == "TWINT") selected @endif value="TWINT">TWINT</option>
                                            </select>
                                        </td>

                                        <td style="vertical-align: middle;">
                                            @if($facture->status == 1 || $facture->status == 0)
                                                @if($facture->payable_date)
                                                    <input @if($facture->status == 2) disabled @endif type="date" @if(!$userService->isAdmin()) disabled @endif class="payableDate form-control" data-facture-id="{{ $facture->id }}" value="{{ date('Y-m-d', strtotime($facture->payable_date)) }}" />
                                                @else
                                                    <input @if($facture->status == 2) disabled @endif type="date" @if(!$userService->isAdmin()) disabled @endif class="payableDate form-control" data-facture-id="{{ $facture->id }}" value="" />
                                                @endif
                                            @endif
                                        </td>
                                        @if($website == 'maflotte')
                                        <td style="vertical-align: middle;">
                                            <select @if($facture->status == 2) disabled @endif class="form-control select2 select" data-toggle="select2" id="shipping_method" name="shipping_method" onchange="updateShippingMethod({{ $facture->id }}, this.value)">
                                                <option value="" @if(empty($facture->shipping_method)) selected @endif>Sélectionner une méthode</option>
                                                <option @if($facture->shipping_method == "Whatsup") selected @endif value="Whatsup">Whatsup</option>
                                                <option @if($facture->shipping_method == "Poste") selected @endif  value="Poste">Poste</option>
                                                <option @if($facture->shipping_method == "Email") selected @endif value="Email">Email</option>
                                                <option @if($facture->shipping_method == "A la main") selected @endif value="A la main">A la main</option>
                                            </select>

                                            @if($facture->shipping_date)
                                                <input type="date" class="shipping_date w-100 form-control mt-2" data-facture-id="{{ $facture->id }}" oninput="updateShippingDate({{ $facture->id }}, this.value)" value="{{ date('Y-m-d', strtotime($facture->shipping_date)) }}" />
                                            @else
                                                <input type="date" class="shipping_date w-100 form-control mt-2" data-facture-id="{{ $facture->id }}" oninput="updateShippingDate({{ $facture->id }}, this.value)" value="" />
                                            @endif
                                        </td>
                                        @endif
                                        <td style="vertical-align: middle;">
                                            @if(isset($facture->client->email))
                                                @if($facture->email_sended == 'sended')
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#email-modal-sended-{{ $facture->id }}">L'e-mail est envoyé</button>
                                                <div id="email-modal-sended-{{ $facture->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Envoyer un e-mail</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="fs-15">
                                                                    Êtes-vous sûr de vouloir envoyer un e-mail à {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }} ?
                                                                </h5>
                                                                <p class="text-muted">Cette action est irréversible et l'e-mail sera envoyé à {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }}.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('factures.email.send') }}" method="POST" style="margin: 0px;">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $facture->id }}" />
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary ">Envoyer</button>
                                                                </form>
                                                            </div>

                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                                @else
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#email-modal-{{ $facture->id }}">Envoyer un e-mail</button>
                                                <div id="email-modal-{{ $facture->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Envoyer un e-mail</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="fs-15">
                                                                    Êtes-vous sûr de vouloir envoyer un e-mail à {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }} ?
                                                                </h5>
                                                                <p class="text-muted">Cette action est irréversible et l'e-mail sera envoyé à {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }}.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form @if($facture->status == 2) disabled @endif action="{{ route('factures.email.send') }}" method="POST" style="margin: 0px;">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $facture->id }}" />
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary ">Envoyer</button>
                                                                </form>
                                                            </div>

                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                                @endif
                                            @endif

                                        </td>
                                        @if($website == 'maflotte')
                                        <td style="vertical-align: middle;">
                                            @if($facture->is_expired)
                                                <button class="btn btn btn-danger">Expirée</button>
                                            @elseif($facture->warning)
                                                <button class="btn btn btn-warning">Expire bientôt</button>
                                            @endif
                                        </td>
                                        @endif
                                        <td style="vertical-align: middle;">
                                            @if($facture->status == 0 && $userService->isAccountant())
                                                <button class="btn btn-danger">Impayé</button>
                                            @elseif($facture->status == 1 && $userService->isAccountant())
                                                <button class="btn btn-success">Payé</button>
                                            @endif
                                            @if($facture->status == 0 && $userService->isAdmin())
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#email-modal-impayee-{{ $facture->id }}">Impayé</button>
                                                <div id="email-modal-impayee-{{ $facture->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Marquer comme payée</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="fs-15">
                                                                    Êtes-vous sûr de vouloir marquer cette facture comme payée ?
                                                                </h5>
                                                                <p class="text-muted">Cette action est irréversible et la facture sera marquée comme payée.</p>
                                                         
                                                            </div>
                                                            <div class="modal-footer">
                                                            <form action="{{ route('factures.update', [$website]) }}" method="POST" style="margin: 0px;">
                                                                    @csrf
                                                                    <input type="hidden" name="type_form" value="edit" />
                                                                    <input type="hidden" name="id" value="{{ $facture->id }}" />
                                                                    <input type="hidden" name="status" value="1" />
                                                                    <input type="hidden" name="status_change_only" value="true" />
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary ">Payé</button>
                                                                </form>
                                                            </div>

                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            @elseif($facture->status == 1 && $userService->isAdmin())
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#email-modal-impayee-{{ $facture->id }}">Payé</button>
                                                <div id="email-modal-impayee-{{ $facture->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Marquer comme impayée</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="fs-15">
                                                                Êtes-vous sûr de vouloir marquer cette facture comme impayée ?
                                                                </h5>
                                                                <p class="text-muted">Cette action est irréversible et la facture sera marquée comme impayée.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <form action="{{ route('factures.update', [$website]) }}" method="POST" style="margin: 0px;">
                                                                    @csrf
                                                                    <input type="hidden" name="type_form" value="edit" />
                                                                    <input type="hidden" name="id" value="{{ $facture->id }}" />
                                                                    <input type="hidden" name="status" value="0" />
                                                                    <input type="hidden" name="status_change_only" value="true" />
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary ">Impayé</button>
                                                                </form>
                                                            </div>

                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            @endif
                                            @if($facture->is_archived)
                                                <button class="btn btn-success">Archivée</button>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;text-align: right">

                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @if($userService->isAdmin())
                                                        <a class="dropdown-item" href="{{ route('factures.edit', [$facture->id, $website]) }}">Modifier</a>
                                                    @endif
                                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest('tr').querySelector('.preview-pdf').submit();">Aperçu PDF</a>
                                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest('tr').querySelector('.print').submit();">Imprimer</a>
                                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest('tr').querySelector('.download').submit();">Exporter PDF</a>
                                                    @if($userService->isAdmin())
                                                        <a href="{{ route('factures.email-history.show', [$facture->id, $website]) }}" class="dropdown-item">Historique des e-mails</a>
                                                    @endif
                                                    @if($userService->isAdmin() && $facture->status != 2)
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#fill-danger-modal" onclick="onDelete({{ $facture->id }})">Supprimer</a>
                                                    @endif
                                                    @if($userService->isAdmin() && $facture->status != 2)
                                                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest('tr').querySelector('.duplicate').submit();">Dupliquer</a>
                                                    @endif
                                                </div>
                                            </div>
                    
                                        <form @if($facture->status == 2) disabled @endif target="_blank" class="preview-pdf" action="{{ route('factures.preview') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $facture->id }}" />
                                            </form>
                                            <form @if($facture->status == 2) disabled @endif target="_blank" class="print" action="{{ route('factures.print') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $facture->id }}" />
                                            </form>
                                            <form @if($facture->status == 2) disabled @endif target="_blank" class="download" action="{{ route('factures.download') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $facture->id }}" />
                                            </form>
                                            <form @if($facture->status == 2) disabled @endif class="duplicate" action="{{ route('factures.duplicate') }}" method="POST" style="display: none;">
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
                <h5 class="modal-title" id="myModalLabel">Suppression d'une facture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                    Êtes-vous sûr de vouloir supprimer cette facture ?
                </h5>
                <p class="text-muted">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('factures.delete') }}" method="POST">   
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
    // Retrieve the saved page number from sessionStorage (or localStorage)
    const savedPage = sessionStorage.getItem('dataTablePageNumber') || 0;

    const table = $('.table').DataTable({
        ordering: false,
        displayStart: savedPage * 10,
    })

     // Listen for page change events to save the current page number
     table.on('page.dt', function () {
        const info = table.page.info();
        sessionStorage.setItem('dataTablePageNumber', info.page);
    });
    
    function onDelete(id) {
        let facture_id = $('#id');
        facture_id.val(id);
    }
</script>
<script>
    document.querySelectorAll('.payableDate').forEach(function(dateInput) {
        dateInput.addEventListener('change', function() {
            const selectedDate = this.value;
            const factureId = this.getAttribute('data-facture-id');

            // Prepare the data to send
            const data = {
                facture_id: factureId,
                payable_date: selectedDate,
                _token: '{{ csrf_token() }}' // Assuming you're using Laravel and need CSRF protection
            };

            // Send the AJAX request
            fetch(`/api/pay_date/update/${factureId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': data._token // Include CSRF token in headers
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Date updated successfully!');
                    // Optionally, show a success message to the user
                } else {
                    console.error('Error updating date:', data.error);
                    // Optionally, show an error message to the user
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle any errors that occurred during the fetch
            });
        });
    });
</script>
<script>
    function updatePaymentMethodMode(factureId, paymentMethodMode) {
        fetch(`/api/payment_method_mode/update/${factureId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ payment_method_mode: paymentMethodMode })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function updateShippingMethod(factureId, shippingMethod) {
        fetch(`/api/shipping_method/update/${factureId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'    
            },
            body: JSON.stringify({ shipping_method: shippingMethod })
        })
        .then(response => response.json())
        .then(data => {
        console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function updateShippingDate(factureId, shippingDate) {
        fetch(`/api/shipping_date/update/${factureId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'    
            },
            body: JSON.stringify({ shipping_date: shippingDate })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
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

