@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('links')
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('custom_css')
<style>
.selection{
    width: 250px;
    display: block;
    position: relative;
    height: 38px;
}
.select2-selection__rendered{
    height: 38px;
    line-height: 38px !important;
}
.select2-container .select2-selection--single{
    height: 38px;
}
.select2-selection__placeholder{
    line-height: 38px !important;
}
</style>
@endsection

@section('content')
 <!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'items' => [
                    ['label' => 'Tableau de bord', 'route' => 'dashboard', 'routeParams' => [request()->route('website') ?? 'gvagroupe'], 'active' => true]
                ]
            ])

            <div class="row">
                <div class="col-xl-12">
                    <div class="card crm-widget">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                                <div class="col">
                                    <div class="py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Utilisateurs <i class="ri-arrow-{{ $users_trend == 'up' ? 'up' : 'down' }}-circle-line text-{{ $users_trend == 'up' ? 'success' : 'danger' }} fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-user-line display-6 text-muted cfs-22"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0 cfs-22"><span class="counter-value" data-target="{{ $users_count }}"></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Clients <i class="ri-arrow-{{ $clients_trend == 'up' ? 'up' : 'down' }}-circle-line text-{{ $clients_trend == 'up' ? 'success' : 'danger' }} fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-team-line display-6 text-muted cfs-22"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0 cfs-22"><span class="counter-value" data-target="{{ $clients }}"></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Actualités <i class="ri-arrow-{{ $blogs_trend == 'up' ? 'up' : 'down' }}-circle-line text-{{ $blogs_trend == 'up' ? 'success' : 'danger' }} fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-newspaper-line display-6 text-muted cfs-22"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0 cfs-22"><span class="counter-value" data-target="{{ $blogs_count }}"></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Factures générées <i class="ri-arrow-{{ $factures_generated_trend == 'up' ? 'up' : 'down' }}-circle-line text-{{ $factures_generated_trend == 'up' ? 'success' : 'danger' }} fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-file-text-line display-6 text-muted cfs-22"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0 cfs-22"><span class="counter-value" data-target="{{ $factures_generated }}"></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-4 px-3">
                                        <h5 class="text-muted text-uppercase fs-13">Membres de l'équipe <i class="ri-arrow-{{ $team_members_trend == 'up' ? 'up' : 'down' }}-circle-line text-{{ $team_members_trend == 'up' ? 'success' : 'danger' }} fs-18 float-end align-middle"></i></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-team-line display-6 text-muted cfs-22"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0 cfs-22"><span class="counter-value" data-target="{{ $team_members_count }}"></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">

                <div class="col-xxl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Aperçu du Solde</h4>
                            {{-- <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Year<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Last Week</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                        <a class="dropdown-item" href="#">Current Year</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div><!-- end card header -->
                        <div class="card-body px-0">
                            <ul class="list-inline main-chart text-center mb-0">
                                <li class="list-inline-item chart-border-left me-0 border-0">
                                    <h4 class="text-primary"><span id="revenue_total_overview"></span> <span class="text-muted d-inline-block fs-13 align-middle ms-2">Factures</span></h4>
                                </li>
                                <li class="list-inline-item chart-border-left me-0">
                                    <h4><span id="expenses_total_overview"></span><span class="text-muted d-inline-block fs-13 align-middle ms-2">Depenses</span>
                                    </h4>
                                </li>
                                <li class="list-inline-item chart-border-left me-0">
                                    <h4><span data-plugin="counterup" id="profit_total_overview">3.6</span><span class="text-muted d-inline-block fs-13 align-middle ms-2">Solde</span></h4>
                                </li>
                            </ul>

                            <div id="revenue-expenses-charts" data-colors='["--vz-success", "--vz-danger"]' data-colors-minimal='["--vz-primary", "--vz-info"]' data-colors-interactive='["--vz-info", "--vz-primary"]' data-colors-galaxy='["--vz-primary", "--vz-secondary"]' data-colors-classic='["--vz-primary", "--vz-secondary"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xxl-6 col-md-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">STATISTIQUES FACTURES</h4>
                            <div class="flex-shrink-0">
                                {{--<div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Nov 2021<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Oct 2021</a>
                                        <a class="dropdown-item" href="#">Nov 2021</a>
                                        <a class="dropdown-item" href="#">Dec 2021</a>
                                        <a class="dropdown-item" href="#">Jan 2022</a>
                                    </div>
                                </div>--}}
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body pb-0">
                            <div id="factures_percentages_status" data-colors='["--vz-info"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card -->
                </div><!-- end col -->

                {{--<div class="col-xxl-3 col-md-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Deal Type</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Yearly</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body pb-0">
                            <div id="deal-type-charts" data-colors='["--vz-warning", "--vz-danger", "--vz-success"]' data-colors-minimal='["--vz-primary-rgb, 0.15", "--vz-primary-rgb, 0.35", "--vz-primary-rgb, 0.45"]' data-colors-modern='["--vz-warning", "--vz-secondary", "--vz-success"]' data-colors-interactive='["--vz-warning", "--vz-info", "--vz-primary"]' data-colors-corporate='["--vz-secondary", "--vz-info", "--vz-success"]' data-colors-classic='["--vz-secondary", "--vz-danger", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>--}}
                <!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Factures en suspens</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted">02 Nov 2021 to 31 Dec 2021<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    {{--<div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Last Week</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                        <a class="dropdown-item" href="#">Current Year</a>
                                    </div>--}}
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                    <thead class="table-light">
                                        <tr class="text-muted">
                                            <th scope="col">Référence</th>
                                            <th scope="col" style="width: 20%;">Date</th>
                                            <th scope="col">Client</th>
                                            <th scope="col" style="width: 16%;">Statut</th>
                                            <th scope="col" style="width: 12%;">Prix ​​total</th>
                                            <th scope="col" style="width: 90px;text-align: right;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(isset($factures_not_payed) && count($factures_not_payed) > 0)
                                        @foreach($factures_not_payed as $facture)
                                            <tr>
                                                <td>
                                                    {{ $facture->name }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($facture->factured_date)->format('d/m/Y') }}</td>
                                                <td>
                                                    <i class="ri-user-line"></i>
                                                    <a href="#javascript: void(0);" class="text-body fw-medium">{{ optional($facture->client)->name }} {{ optional($facture->client)->surname }}</a>
                                                </td>
                                                <td><span class="badge bg-danger-subtle text-danger p-2">Impayé</span></td>
                                                <td>
                                                    <div class="text-nowrap">CHF {{ $facture->total_ttc }}</div>
                                                </td>
                                                <td class="table-action" style="width: 90px;text-align: right;">
                                                    <a href="{{ route('factures.edit', [$facture->id, 'gvagroupe']) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                {{--<div class="dropdown float-right">
                        <button class="dropdown-toggle arrow-none card-drop cursor-pointer" style="border: 0px;background: transparent;font-size: 18px" data-toggle="dropdown" aria-expanded="false">
                            Année: <span id="year_selected_costs">2024</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right costs_year_dropdown">
                        @php
                            // Generate an array of years from 2016 to the current year
                            $years = range(date('Y'), 2016);
                        @endphp

                        @foreach($years as $year)
                            <a href="javascript:void(0);" class="dropdown-item" onclick="onChangeYearCosts('{{ $year }}')">{{ $year }}</a>
                        @endforeach
                        </div>
                    </div>--}}

                <div class="col-xl-5">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Statistiques Dépenses</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span id="year_selected_costs">2024</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end costs_year_dropdown">
                                        @php
                                            // Generate an array of years from 2016 to the current year
                                            $years = range(date('Y'), 2016);
                                        @endphp

                                        @foreach($years as $year)
                                            <a href="javascript:void(0);" class="dropdown-item" onclick="onChangeYearCosts('{{ $year }}')">{{ $year }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body p-0" id="depenses_list_container">

                            <div style="max-height: fit-content;">
                                <ul class="list-group list-group-flush border-dashed px-3" id="depenses_list">
                                </ul><!-- end ul -->
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">                  
                <div class="col-xxl-4 col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header border-bottom-dashed align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">REVENU</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span id="year_revenu"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end costs_year_dropdown">
                                        @php
                                            // Generate an array of years from 2016 to the current year
                                            $years = range(date('Y'), 2016);
                                        @endphp

                                        @foreach($years as $year)
                                            <a href="javascript:void(0);" class="dropdown-item" onclick="onChangeYearRevenue('{{ $year }}')">{{ $year }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div><!-- end cardheader -->
                        <div class="card-body">
                            {{-- <div id="portfolio_donut_charts" data-colors='["--vz-primary", "--vz-info", "--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div> --}}

                            <ul class="list-group list-group-flush border-dashed mb-0">
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Mois en cours</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">CHF <span id="this_month_revenue"></span></h6>
                                        </div>
                                    </div>
                                </li><!-- end -->
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Mois précédent</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">CHF <span id="previous_month_revenue"></span></h6>
                                        </div>
                                    </div>
                                </li><!-- end -->
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Impayé</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">CHF <span id="not_paid_revenue"></span></h6>
                                        </div>
                                    </div>
                                </li><!-- end -->
                                <li class="list-group-item px-0 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">Total</h6>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">CHF <span id="all_year_revenue"></span></h6>
                                        </div>
                                    </div>
                                </li><!-- end -->
                            </ul><!-- end -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

            </div><!-- end row -->

            <div class="row">                  
                <div class="col-xxl-12 col-xl-12">
                    @include('factures.raports.index')
                </div>
            </div><!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('layouts.footer')
</div>
<!-- end main content-->



<div class="container-fluid" style="display: none;">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">GVGROUPE</a></li>
                        <li class="breadcrumb-item active">Tableau de bord</li>
                    </ol>
                </div>
                <h4 class="page-title">Tableau de bord</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row no-gutters">

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $users_count }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total des utilisateurs</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $clients }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Clients</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $team_members_count }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Membres de l'équipe</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="mdi mdi-table-account text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $blogs_count }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Actualités</p>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>


    <div class="row">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                   {{-- <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('factures') }}" class="dropdown-item">Voir tout</a>
                        </div>
                    </div> --}}

                    <h4 class="header-title mb-4">Factures par mois pour l'année en cours</h4>

                    <div class="mt-3 chartjs-chart" style="height: 320px;">
                        <canvas id="bar-chart-example-2" data-colors="#fa5c7c,#727cf5"></canvas>
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                        </div>
                    </div> --}}
                    <h4 class="header-title mb-4">STATISTIQUES FACTURES</h4>

                    <div class="my-4 chartjs-chart" style="height: 202px;">
                        <canvas id="project-status-chart" data-colors="#0acf97,#727cf5,#fa5c7c"></canvas>
                    </div>

                    <div class="row text-center mt-2 py-2">
                        <div class="col-6">
                            <i class="mdi mdi-trending-up text-success mt-3 h3"></i>
                            <h3 class="font-weight-normal">
                                <span>{{ $factures_status['percentagePayed'] }}%</span>
                            </h3>
                            <p class="text-muted mb-0">Payé</p>
                        </div>
                        <div class="col-6">
                            <i class="mdi mdi-trending-down text-danger mt-3 h3"></i>
                            <h3 class="font-weight-normal">
                                <span>{{ $factures_status['percentageNotPayed'] }}%</span>
                            </h3>
                            <p class="text-muted mb-0">Impayé</p>
                        </div>
                    </div>
                    <!-- end row-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('factures', ['gvagroupe']) }}" class="dropdown-item">Voir tout</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Factures en suspens</h4>

                    <!-- <p><b>107</b> Tasks completed out of 195</p> -->

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                @if(isset($factures_not_payed) && count($factures_not_payed) > 0)
                                @foreach($factures_not_payed as $facture)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">{{ $facture->name }}</a></h5>
                                        <span class="text-muted font-13">{{ $facture->company_to_name }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Client</span>
                                        <h5 class="font-14 mt-1 font-weight-normal">{{ optional($facture->client)->name }} {{ optional($facture->client)->surname }}</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Date facture</span>
                                        <h5 class="font-14 mt-1 font-weight-normal">{{ $facture->factured_date }}</h5>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger-lighten">Impayé</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Prix ​​total</span>
                                        <h5 class="font-14 mt-1 font-weight-normal">{{ $facture->total_ttc }}</h5>
                                    </td>
                                    <td class="table-action" style="width: 90px;text-align: right;">
                                        <a href="{{ route('factures.edit', [$facture->id, 'gvagroupe']) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                       {{-- <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>--}}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <div class="col-lg-12 p-0">
        <div class="card">
            <div class="card-body">
            <div class="dropdown float-right">
                        <button class="dropdown-toggle arrow-none card-drop cursor-pointer" style="border: 0px;background: transparent;font-size: 18px" data-toggle="dropdown" aria-expanded="false">
                            Année: <span id="year_revenu"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right costs_year_dropdown">
                        @php
                            // Generate an array of years from 2016 to the current year
                            $years = range(date('Y'), 2016);
                        @endphp

                        @foreach($years as $year)
                            <a href="javascript:void(0);" class="dropdown-item" onclick="onChangeYearRevenue('{{ $year }}')">{{ $year }}</a>
                        @endforeach
                        </div>
                    </div>
                
                <h4 class="header-title mb-3">REVENU</h4>

                <div class="chart-content-bg">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <p class="text-muted mb-0 mt-3">Mois en cours</p>
                            <h2 class="font-weight-normal mb-3">
                                <span>CHF <span id="this_month_revenue"></span></span>
                            </h2>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted mb-0 mt-3">Le mois précédent</p>
                            <h2 class="font-weight-normal mb-3">
                                <span>CHF <span id="previous_month_revenue"></span></span>
                            </h2>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted mb-0 mt-3">Impayé</p>
                            <h2 class="font-weight-normal mb-3">
                                <span>CHF <span id="not_paid_revenue"></span></span>
                            </h2>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted mb-0 mt-3">Total</p>
                            <h2 class="font-weight-normal mb-3">
                                <span>CHF <span id="all_year_revenue"></span></span>
                            </h2>
                        </div>
                    </div>
                </div>

                <div id="dash-revenue-chart" class="apex-charts" data-colors="#0acf97,#fa5c7c"></div>

            </div>
            <!-- end card body-->
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <button class="dropdown-toggle arrow-none card-drop cursor-pointer" style="border: 0px;background: transparent;font-size: 18px" data-toggle="dropdown" aria-expanded="false">
                            Année: <span id="year_selected_costs">2024</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right costs_year_dropdown">
                        @php
                            // Generate an array of years from 2016 to the current year
                            $years = range(date('Y'), 2016);
                        @endphp

                        @foreach($years as $year)
                            <a href="javascript:void(0);" class="dropdown-item" onclick="onChangeYearCosts('{{ $year }}')">{{ $year }}</a>
                        @endforeach
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Dépenses</h4>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Mois</th>
                                            <th class="text-right">Prix Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_costs">
                                        @if(isset($monthlyCosts) && count($monthlyCosts) > 0)
                                            @foreach($monthlyCosts as $costMonth)
                                            <tr>
                                                <td class="text-capitalize">{{ $costMonth->month_name }}</td>
                                                <td class="text-right">CHF {{ number_format($costMonth->total_cost, 2, '.', "'") }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                    @if(isset($totalCostsByYear))
                                    <tfoot style="border-top: 2px solid black;">
                                        <tr>
                                            <th></th>
                                            <th class="text-right" style="font-size: 24px;">Total: CHF <span id="total_price_costs">{{ number_format($totalCostsByYear, 2, '.', "'") }}</span></th>
                                        </tr>
                                    </tfoot>
                                    @endif
                                </table>
                            </div> <!-- end table-responsive -->
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div><!-- end card body-->
            </div><!-- end card -->
        </div> <!-- end col-->
    </div>

    @include('factures.raports.index')

    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-4">Tasks Overview</h4>

                    <div class="mt-3 chartjs-chart" style="height: 320px;">
                        <canvas id="task-area-chart" data-bgColor="#727cf5" data-borderColor="#727cf5"></canvas>
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> --}}

    {{-- <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a href="{{ route('activities') }}" class="dropdown-item">Tout voir</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-2">Activité récente</h4>
                    <div data-simplebar="init" style="max-height: 330px;">
                        <div class="simplebar-wrapper" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">
                                    <div class="simplebar-content" style="padding: 0px;">
                                    <div class="timeline-alt pb-0">

                                    @if(count($activities) > 0)
                                        @foreach($activities as $activity)
                                        <div class="timeline-item">
                                            <i class="mdi 
                                            @if($activity->type == 'blog_create' || $activity->type == 'blog_update'
                                            || $activity->type == 'blog_category_create' || $activity->type == 'blog_category_update'
                                            || $activity->type == 'blog_category_delete'
                                            || $activity->type == 'blog_delete'
                                            )
                                            mdi-table-account
                                            @endif
                                            @if($activity->type == 'user_create' || $activity->type == 'user_update' || 
                                            $activity->type == 'team_member_create' || $activity->type == 'team_member_update' ||
                                            $activity->type ==  'team_member_delete' || $activity->type == 'user_delete'
                                            )
                                            dripicons-user-group
                                            @endif
                                            @if($activity->type == 'project_create' || $activity->type == 'project_update' || $activity->type == 'project_delete')
                                                mdi-desktop-mac
                                            @endif
                                            bg-info-lighten text-info timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-info font-weight-bold mb-1 d-block">{{ $activity->title }}</a>
                                                <small>{{ $activity->description }}</small>
                                                <p class="mb-0 pb-2">
                                                <small class="text-muted">{{ $activity->created_at->diffForHumans(); }}</small>
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif

                                        <!-- <div class="timeline-item">
                                            <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-info font-weight-bold mb-1 d-block">You sold an item</a>
                                                <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                                <p class="mb-0 pb-2">
                                                <small class="text-muted">5 minutes ago</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-primary font-weight-bold mb-1 d-block">Product on the Bootstrap Market</a>
                                                <small>Dave Gamache added
                                                <span class="font-weight-bold">Admin Dashboard</span>
                                                </small>
                                                <p class="mb-0 pb-2">
                                                <small class="text-muted">30 minutes ago</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-info font-weight-bold mb-1 d-block">Robert Delaney</a>
                                                <small>Send you message
                                                <span class="font-weight-bold">"Are you there?"</span>
                                                </small>
                                                <p class="mb-0 pb-2">
                                                <small class="text-muted">2 hours ago</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-primary font-weight-bold mb-1 d-block">Audrey Tobey</a>
                                                <small>Uploaded a photo
                                                <span class="font-weight-bold">"Error.jpg"</span>
                                                </small>
                                                <p class="mb-0 pb-2">
                                                <small class="text-muted">14 hours ago</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-primary font-weight-bold mb-1 d-block">Audrey Tobey</a>
                                                <small>Uploaded a photo
                                                <span class="font-weight-bold">"Error.jpg"</span>
                                                </small>
                                                <p class="mb-0 pb-2">
                                                <small class="text-muted">14 hours ago</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-primary font-weight-bold mb-1 d-block">Audrey Tobey</a>
                                                <small>Uploaded a photo
                                                <span class="font-weight-bold">"Error.jpg"</span>
                                                </small>
                                                <p class="mb-0 pb-2">
                                                <small class="text-muted">14 hours ago</small>
                                                </p>
                                            </div>
                                        </div> -->

                                    </div>
                                    <!-- end timeline -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 313px; height: 373px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar" style="height: 291px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                        </div>
                    </div>
                    <!-- end slimscroll -->
                </div>
                <!-- end card-body -->
            </div>
    <!-- end card-->
    </div>--}}

    {{-- <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                    </div>
                </div>
                <h4 class="header-title mb-3">Your Calendar</h4>

                <div class="row">
                    <div class="col-md-7">
                        <div data-provide="datepicker-inline" data-date-today-highlight="true" class="calendar-widget"></div>
                    </div> <!-- end col-->
                    <div class="col-md-5">
                        <ul class="list-unstyled">
                            <li class="mb-4">
                                <p class="text-muted mb-1 font-13">
                                    <i class="mdi mdi-calendar"></i> 7:30 AM - 10:00 AM
                                </p>
                                <h5>Meeting with BD Team</h5>
                            </li>
                            <li class="mb-4">
                                <p class="text-muted mb-1 font-13">
                                    <i class="mdi mdi-calendar"></i> 10:30 AM - 11:45 AM
                                </p>
                                <h5>Design Review - Hyper Admin</h5>
                            </li>
                            <li class="mb-4">
                                <p class="text-muted mb-1 font-13">
                                    <i class="mdi mdi-calendar"></i> 12:15 PM - 02:00 PM
                                </p>
                                <h5>Setup Github Repository</h5>
                            </li>
                            <li>
                                <p class="text-muted mb-1 font-13">
                                    <i class="mdi mdi-calendar"></i> 5:30 PM - 07:00 PM
                                </p>
                                <h5>Meeting with Design Studio</h5>
                            </li>
                        </ul>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col--> --}}

    </div>
    
</div>
 <!-- container -->
@endsection

@section('custom_script')
<script>
    //  Column with Rotated Labels
    var chartColumnRotateLabelsColors = ['#0acf97', '#fa5c7c']; // Payé: Green, Impayé: Red
    var options = {
        series: [{
            name: 'Payé',
            data: ["{{ $factures_status['percentagePayed'] }}"]
        },
        {
            name: 'Impayé',
            data: ["{{ $factures_status['percentageNotPayed'] }}"]
        }],
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                columnWidth: '30%',
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 2
        },
        colors: chartColumnRotateLabelsColors,
        xaxis: {
            labels: {
                rotate: -45
            },
            categories: ['Payé', 'Impayé'],
            tickPlacement: 'on'
        },
        yaxis: {
            title: {
                text: '%',
            },
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
        },
        legend: {
            onItemClick: {
                toggleDataSeries: false
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#factures_percentages_status"), options);
    chart.render();
</script>

<script>
    var revenueExpensesCharts = "";
    function loadCharts() {
        var e, t;
        var facturesByMonths = @json($factures_by_months);
        var costsByMonths = @json($costs_by_months);

        let revenue = [];
        let expenses = [];
        let profit = [];
        let revenue_total = 0;
        let expenses_total = 0;
        let profit_total = 0;
        
        for(let i = 0; i < facturesByMonths.length; i++){
            let total = Number(facturesByMonths[i].total);
            let formattedTotal = total;
            revenue.push(Number(formattedTotal));
            revenue_total += total;
        }

        for(let i = 0; i < costsByMonths.length; i++){
            let total = Number(costsByMonths[i].total);
            let formattedTotal = total;
            expenses.push(Number(formattedTotal));
            expenses_total += total;
        }

        // Calculate profit for each month
        for(let i = 0; i < 12; i++){
            let monthlyProfit = (revenue[i] || 0) - (expenses[i] || 0);
            profit.push(monthlyProfit);
            profit_total += monthlyProfit;
        }

        console.log("revenue",revenue);
        console.log("expenses",expenses);
        document.getElementById('revenue_total_overview').innerHTML = 'CHF ' + revenue_total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('expenses_total_overview').innerHTML = 'CHF ' + expenses_total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('profit_total_overview').innerHTML = 'CHF ' + profit_total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        (t = getChartColorsArray("revenue-expenses-charts")) && (e = {
            series: [{
                name: "Factures",
                data: revenue
            }, {
                name: "Dépenses",
                data: expenses
            }, {
                name: "Solde",
                data: profit
            }],
            chart: {
                height: 290,
                type: "area",
                toolbar: "false"
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 2
            },
            xaxis: {
                categories: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil", "Août", "Sep", "Oct", "Nov", "Déc"]
            },
            yaxis: {
                labels: {
                    formatter: function(e) {
                        return "CHF " + e;
                    }
                },
                tickAmount: 5,
                min: 0,
                max: 20000
            },
            colors: t,
            fill: {
                opacity: .06,
                colors: t,
                type: "solid"
            }
        }, "" != revenueExpensesCharts && revenueExpensesCharts.destroy(), (revenueExpensesCharts = new ApexCharts(document.querySelector("#revenue-expenses-charts"), e)).render())
    }
    loadCharts()
</script>

<script>
    function onChangeYearCosts(year){
        const total_price_costs = document.getElementById('total_price_costs');
        const year_selected_costs = document.getElementById('year_selected_costs');
        const table_costs = document.getElementById('depenses_list');

        year_selected_costs.innerHTML = "";
        year_selected_costs.innerHTML = year;
        
        fetch(`/admin/costs/api/${year}/gvgroupe`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log("data ====>", data);

                if (data.costsByMonths !== undefined) {
                    table_costs.innerHTML = "";
                    if (data.costsByMonths.length > 0) {
                        for (let i = 0; i < data.costsByMonths.length; i++) {
                            let tr = `
                                <li class="list-group-item ps-0">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0 text-capitalize" for="task_one">${data.costsByMonths[i].month_name}</label>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <p class="text-muted fs-12 mb-0">CHF ${Number(data.costsByMonths[i].total_cost).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p>
                                        </div>
                                    </div>
                                </li>
                            `;
                            table_costs.innerHTML += tr;
                        }
                    } else {
                        let tr = `
                            <li class="list-group-item ps-0">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-check-label mb-0" for="task_one">Aucune donnée</label>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                           
                                        </div>
                                    </div>
                                </li>
                            `;
                        table_costs.innerHTML += tr;
                    }

                    if (data.allCostByYear !== undefined) {
                        let tr = `
                         <li class="list-group-item ps-0 depenses-total">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <label class="form-check-label mb-0" for="task_one">Total des dépenses</label>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <p class="font-bold fs-12 mb-0">CHF ${Number(data.allCostByYear).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p>
                                </div>
                            </div>
                        </li>
                        `;
                        table_costs.innerHTML += tr;
                    }
                }
            })
            .catch(error => {
                console.log("error ====>", error);
            });
    }

    const currentYear = new Date().getFullYear();
    onChangeYearCosts(currentYear)
</script>

<script>
    // Total Portfolio Donut Charts
    // var donutchartportfolioColors = getChartColorsArray("portfolio_donut_charts");
    // function loadRevenue(a, b, c, d, year_revenu){
    //     // convert a, b, c, d to number without , and .
    //     a = Number(a.replace(/,/g, ''));
    //     b = Number(b.replace(/,/g, ''));
    //     c = Number(c.replace(/,/g, ''));
    //     d = Number(d.replace(/,/g, ''));

    //     console.log("a ===>", a);
    //     console.log("b ===>", b);
    //     console.log("c ===>", c);
    //     console.log("d ===>", d);

    //     if (donutchartportfolioColors) {
    //         var options = {
    //             series: [a, b, c],
    //             labels: ["Mois en cours", "Le mois précédent", "Impayé"],
    //             chart: {
    //                 type: "donut",
    //                 height: 210,
    //             },

    //             plotOptions: {
    //                 pie: {
    //                     size: 100,
    //                     offsetX: 0,
    //                     offsetY: 0,
    //                     donut: {
    //                         size: "70%",
    //                         labels: {
    //                             show: true,
    //                             name: {
    //                                 show: true,
    //                                 fontSize: '18px',
    //                                 offsetY: -5,
    //                             },
    //                             value: {
    //                                 show: true,
    //                                 fontSize: '20px',
    //                                 color: '#343a40',
    //                                 fontWeight: 500,
    //                                 offsetY: 5,
    //                                 formatter: function (val) {
    //                                     return "$" + val
    //                                 }
    //                             },
    //                             total: {
    //                                 show: true,
    //                                 fontSize: '13px',
    //                                 label: 'Total value',
    //                                 color: '#9599ad',
    //                                 fontWeight: 500,
    //                                 formatter: function (w) {
    //                                     return "CHF " + w.globals.seriesTotals.reduce(function (a, b) {
    //                                         return d
    //                                     }, 0)
    //                                 }
    //                             }
    //                         }
    //                     },
    //                 },
    //             },
    //             dataLabels: {
    //                 enabled: false,
    //             },
    //             legend: {
    //                 show: false,
    //             },
    //             yaxis: {
    //                 labels: {
    //                     formatter: function (value) {
    //                         return "CHF " + Number(value)
    //                     }
    //                 }
    //             },
    //             stroke: {
    //                 lineCap: "round",
    //                 width: 2
    //             },
    //             colors: donutchartportfolioColors,
    //         };

    //         var chart = new ApexCharts(document.querySelector("#portfolio_donut_charts"), options);
    //         chart.render();
    //     }
    // }

    function onChangeYearRevenue(year){
        const this_month_revenue = document.getElementById('this_month_revenue');
        const previous_month_revenue = document.getElementById('previous_month_revenue');
        const not_paid_revenue = document.getElementById('not_paid_revenue');
        const all_year_revenue = document.getElementById('all_year_revenue');
        const year_revenu = document.getElementById('year_revenu');
        
        fetch(`/admin/revenue/api/${year}/gvgroupe`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const { this_month, previous_month, totalNotPaid, all_time } = data.revenue;
            let a = this_month.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            let b = previous_month.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            let c = totalNotPaid.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            let d = all_time.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            this_month_revenue.innerHTML = a;
            previous_month_revenue.innerHTML = b;
            not_paid_revenue.innerHTML = c;
            all_year_revenue.innerHTML = d;
            year_revenu.innerHTML = year;
            // loadRevenue(a, b, c, d, year);
        })
        .catch(error => {
            console.error("Error fetching revenue data:", error);
        });
    }
    onChangeYearRevenue(new Date().getFullYear())
</script>

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