@inject('userService', 'App\Services\UserService')

<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('dashboard', ['website' => 'gvacars']) }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/front/assets/img/logo.webp" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/front/assets/img/logo.webp" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('dashboard', ['website' => 'gvacars']) }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="/front/assets/img/logo.webp" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/front/assets/img/logo.webp" alt="" height="25" style="filter: invert(1) brightness(1);">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome Anna!</h6>
            <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
            <a class="dropdown-item" href="apps-tasks-kanban.html"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
            <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$5971.67</b></span></a>
            <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-success-subtle text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
            <a class="dropdown-item" href="auth-lockscreen-basic.html"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                @if($userService->isAdmin() || $userService->isAccountant())
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Tableau de bord</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('dashboard', ['website' => 'gvacars']) }}" class="nav-link {{ request()->is('admin/dashboard/gvacars*') ? 'active' : '' }}" data-key="t-analytics"> GVACARS </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard', ['website' => 'maflotte']) }}" class="nav-link {{ request()->is('admin/dashboard/maflotte*') ? 'active' : '' }}" data-key="t-crm"> MAFLOTTE </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if($userService->isAdmin())
                <li class="nav-item">
                    <a class="nav-link menu-link  {{ request()->is('admin/team-members*') ||
                request()->is('admin/projects*') || 
                request()->is('admin/contacts*') || 
                request()->is('admin/testimonials*') ||
                request()->is('admin/auto-rental*') ||
                request()->is('admin/reservations*') ||
                request()->is('admin/wlb*') ? 'active' : '' }}" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Page d'accueil</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('team-members') }}" class="nav-link {{ request()->is('admin/team-members*') ? 'active' : '' }}" data-key="t-chat"> Membres de l'équipe  </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('projects') }}" class="nav-link {{ request()->is('admin/projects*') ? 'active' : '' }}" data-key="t-api-key">Projets</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contacts') }}" class="nav-link {{ request()->is('admin/contacts*') ? 'active' : '' }}" data-key="t-api-key">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('testimonials') }}" class="nav-link {{ request()->is('admin/testimonials*') ? 'active' : '' }}" data-key="t-api-key">Témoignages</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('wlb') }}" class="nav-link {{ request()->is('admin/wlb*') ? 'active' : '' }}" data-key="t-api-key">Marques mondiales</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('auto-rental.index') }}" class="nav-link {{ request()->is('admin/auto-rental*', 'admin/auto-rental/*') ? 'active' : '' }}" data-key="t-api-key">Véhicules de location</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reservations.index') }}" class="nav-link {{ request()->is('admin/reservations*', 'admin/reservations/*') ? 'active' : '' }}" data-key="t-api-key">Réservations</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if($userService->isAdmin())
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('users*', 'roles*') ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-user-line"></i> <span data-key="t-layouts">Gestion utilisateurs</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('users') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" data-key="t-horizontal">Utilisateurs</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles') }}" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}" data-key="t-detached">Rôles</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if($userService->isAdmin() || $userService->isAccountant())
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/factures/gvacars', 'admin/raports*', 'admin/factures/clients/create/gvacars', 'admin/factures/clients/edit/*/gvacars') ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-file-text-line"></i> <span data-key="t-layouts">GVACARS</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('factures.clients', ['gvacars']) }}" class="nav-link {{ request()->is('admin/factures/clients/gvacars*', 'admin/factures/clients/gvarcars/*') ? 'active' : '' }}" data-key="t-horizontal">Clients</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('clients.cars') }}" class="nav-link {{ request()->is('admin/factures/clients/cars*', 'admin/factures/clients/cars/*') ? 'active' : '' }}" data-key="t-detached">Voitures Clients</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('factures', ['gvacars']) }}" class="nav-link {{ request()->is('admin/factures/gvacars', 'admin/factures/create/gvacars', 'admin/factures/edit/*/gvacars', 'admin/factures/edit*/gvacars') ? 'active' : '' }}" data-key="t-detached">Factures</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('offers') }}" class="nav-link {{ request()->is('admin/offers', 'admin/offers/create', 'admin/offers/edit/*', 'admin/offers/edit*') ? 'active' : '' }}" data-key="t-detached">Offres</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rapports.factures.website', ['gvacars']) }}" class="nav-link {{ request()->is('admin/raports') ? 'active' : '' }}" data-key="t-detached">Rapports</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if($userService->isAdmin() || $userService->isAccountant())
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/blogs*', 'admin/blogs/categories*') ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-file-text-line"></i> <span data-key="t-layouts">MAFLOTTE</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            @if($userService->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('factures.clients', ['maflotte']) }}" class="nav-link {{ request()->is('admin/factures/clients/maflotte*', 'admin/factures/clients/maflotte/*') ? 'active' : '' }}" data-key="t-horizontal">Clients</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('factures',['maflotte']) }}" class="nav-link {{ request()->is('admin/factures/maflotte', 'admin/factures/create/maflotte', 'admin/factures/edit/*/maflotte') ? 'active' : '' }}" data-key="t-detached">Factures</a>
                            </li>
                            @if($userService->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('offres',['maflotte']) }}" class="nav-link {{ request()->is('admin/offres/maflotte', 'admin/offres/maflotte/create', 'admin/offres/edit/*') ? 'active' : '' }}" data-key="t-detached">Offres</a>
                            </li>
                            @endif
                            @if($userService->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('bonLivrasion',['maflotte']) }}" class="nav-link {{ request()->is('admin/bon/livraison/*') ? 'active' : '' }}" data-key="t-detached">Bon de livraison</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if($userService->isAdmin() || $userService->isAccountant() || $userService->isDepensesManagment())
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/costs*') ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-car-line"></i> <span data-key="t-layouts">Gestion de Dépenses</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('costs') }}" class="nav-link {{ request()->is('admin/costs', 'admin/costs/create', 'admin/costs/edit') ? 'active' : '' }}" data-key="t-horizontal">Dépenses</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('costs.categories') }}" class="nav-link {{ request()->is('admin/costs/categories', 'admin/costs/categories/*') ? 'active' : '' }}" data-key="t-horizontal">Catégories</a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{ route('costs.sub.categories') }}" class="nav-link {{ request()->is('admin/costs/sub/categories', 'admin/costs/sub/categories/*') ? 'active' : '' }}" data-key="t-horizontal">Sub Catégories</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if($userService->isAdmin())
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('users*', 'roles*') ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-newspaper-line"></i> <span data-key="t-layouts">Actualités</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('blogs') }}" class="nav-link {{ request()->is('admin/blogs', 'admin/blogs/create','admin/blogs/edit') ? 'active' : '' }}" data-key="t-horizontal">Actualités</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('blogs-categories') }}" class="nav-link {{ request()->is('admin/blogs/categories', 'admin/blogs/categories/create','admin/blogs/categories/edit') ? 'active' : '' }}" data-key="t-detached">Catégories</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if($userService->isAdmin())
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/jobs*') ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-briefcase-line"></i> <span data-key="t-layouts">Emploi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('jobs') }}" class="nav-link {{ request()->is('admin/jobs', 'admin/jobs/create','admin/jobs/edit') ? 'active' : '' }}" data-key="t-horizontal">Emplois</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jobs.categories') }}" class="nav-link {{ request()->is('admin/jobs/categories*', 'admin/jobs/categories/create*','admin/jobs/categories/edit*') ? 'active' : '' }}" data-key="t-detached">Catégories</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if($userService->isAdmin())
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/buy/cars*','admin/buy/cars/*') ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-car-line"></i> <span data-key="t-layouts">Véhicules à vendre</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('buy-cars.categories') }}" class="nav-link {{ request()->is('admin/buy/cars/categories', 'admin/buy/cars/categories/*') ? 'active' : '' }}" data-key="t-horizontal">Catégories</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('buy-cars.models') }}" class="nav-link {{ request()->is('admin/buy/cars/models*', 'admin/buy/cars/models/*') ? 'active' : '' }}" data-key="t-horizontal">Modèles</a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{ route('buy-cars.marks') }}" class="nav-link {{ request()->is('admin/buy/cars/marks*', 'admin/buy/cars/marks/*') ? 'active' : '' }}" data-key="t-horizontal">Marques</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('buy-cars.cars') }}" class="nav-link {{ request()->is('admin/buy/cars', 'admin/buy/cars/create', 'admin/buy/cars/edit') ? 'active' : '' }}" data-key="t-horizontal">Voitures</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
