@inject('userService', 'App\Services\UserService')
@extends('layouts.admin')
@section('title', 'Profil')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="profile-foreground position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg">
                    <img src="/assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
                </div>
            </div>
            <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
                <div class="row g-4">
                    <div class="col-auto">
                        <div class="avatar-lg">
                        @if(Auth::user()->image)
                                <img alt="Image" src="/back/img/users/{{ Auth::user()->image }}"  class="img-thumbnail rounded-circle" alt="user-img">
                        @else
                            <img class="img-thumbnail rounded-circle" src="assets/images/users/avatar-1.jpg" alt="user-img">
                        @endif
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col">
                        <div class="p-2">
                            <h3 class="text-white mb-1">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h3>
                            <p class="text-white text-opacity-75">{{ Auth::user()->role->role->title }}</p>
                            @if(Auth::user()->state_province && Auth::user()->country)
                            <div class="hstack text-white-50 gap-1">
                                <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ Auth::user()->state_province }}, {{ Auth::user()->country }}</div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
                <!--fin de la ligne-->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="d-flex profile-wrapper">
                            <!-- Onglets de navigation -->
                            <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                        <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Aperçu</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="flex-shrink-0">
                                <a href="{{ route('profile-edit') }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Modifier le profil</a>
                            </div>
                        </div>
                        <!-- Contenu des onglets -->
                        <div class="tab-content pt-4 text-muted">
                            <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-5">Complétez votre profil</h5>
                                                @php
                                                    $user = Auth::user();
                                                    $fields = [
                                                        !empty($user->name),
                                                        !empty($user->surname),
                                                        !empty($user->email),
                                                        !empty($user->description),
                                                        !empty($user->image)
                                                    ];
                                                    $filled = array_sum($fields);
                                                    $total = count($fields);
                                                    $progress = intval(($filled / $total) * 100);
                                                    $progress = $progress > 100 ? 100 : $progress;
                                                    $progressColor = $progress == 100 ? 'bg-success' : ($progress >= 60 ? 'bg-warning' : 'bg-danger');
                                                @endphp
                                                <div class="progress animated-progress custom-progress progress-label">
                                                    <div class="progress-bar {{ $progressColor }}" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="label">{{ $progress }}%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Informations</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row">
                                                                    @if(Auth::user()->type !== 'company')
                                                                        Nom et prénom :
                                                                    @else
                                                                        Nom de la société :
                                                                    @endif
                                                                </th>
                                                                <td class="text-muted">{{ Auth::user()->name }} {{ Auth::user()->surname }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Mobile :</th>
                                                                <td class="text-muted">{{ Auth::user()->phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">E-mail :</th>
                                                                <td class="text-muted">{{ Auth::user()->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Localisation :</th>
                                                                <td class="text-muted">
                                                                    @php
                                                                        $state = Auth::user()->address;
                                                                        $city = Auth::user()->city;
                                                                        $postal_code = Auth::user()->postal_code;
                                                                    @endphp
                                                                    @if(!empty($state) && !empty($city))
                                                                        {{ $state }}, {{ $city }}
                                                                    @else
                                                                        --
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Date d'inscription</th>
                                                                <td class="text-muted">{{ Auth::user()->created_at->format('d M Y') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- fin du corps de la carte -->
                                        </div><!-- fin de la carte -->

                                        <div class="card" style="display:none;">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">Portfolio</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <div>
                                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16 bg-body text-body material-shadow">
                                                                <i class="ri-github-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16 bg-primary material-shadow">
                                                                <i class="ri-global-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16 bg-success material-shadow">
                                                                <i class="ri-dribbble-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16 bg-danger material-shadow">
                                                                <i class="ri-pinterest-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!-- fin du corps de la carte -->
                                        </div><!-- fin de la carte -->

                                    </div>
                                    <!--fin de la colonne-->
                                    <div class="col-xxl-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">À propos</h5>
                                                <p>{{ Auth::user()->description }}</p>
                                                <div class="row">
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-user-2-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Poste :</p>
                                                                <h6 class="text-truncate mb-0">{{ Auth::user()->role->role->title }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--fin de la colonne-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary material-shadow">
                                                                    <i class="ri-global-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Plateforme :</p>
                                                                <a href="{{ env('APP_URL') }}" class="fw-semibold">GVACARS</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--fin de la colonne-->
                                                </div>
                                                <!--fin de la ligne-->
                                            </div>
                                            <!--fin du corps de la carte-->
                                        </div><!-- fin de la carte -->

                                    </div>
                                    <!--fin de la colonne-->
                                </div>
                                <!--fin de la ligne-->
                            </div>
                        </div>
                        <!--fin du contenu des onglets-->
                    </div>
                </div>
                <!--fin de la colonne-->
            </div>
            <!--fin de la ligne-->

        </div><!-- container-fluid -->
    </div><!-- Fin du contenu de la page -->
    @include('layouts.footer')
</div><!-- fin du contenu principal-->
@endsection