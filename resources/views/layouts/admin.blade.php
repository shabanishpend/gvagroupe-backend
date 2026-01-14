<html lang="fr" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable" data-theme="default" data-theme-colors="default" data-sidebar-visibility="show" data-layout-style="default" data-bs-theme="light" data-layout-width="fluid" data-layout-position="fixed" data-body-image="none">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="title" content="@yield('title')">
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') | GVACARS</title>

        <!-- Layout config Js -->
        <script src="/assets/js/layout.js"></script>
        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="/front/assets/img/favicon.webp">
        <!-- Global CSS -->
        <link href="/assets/css/global.css" rel="stylesheet" type="text/css" />

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        @yield('links')
        @yield('custom_css')
        <style>
            .selection{
                width: 100%;
                display: block;
                position: relative;
                height: 38px !important;
            }
            .select2-selection__rendered{
                height: 38px !important;
                line-height: 38px !important;
            }
            .select2-container .select2-selection--multiple{
                height: 38px !important;
            }
            .select2-container .select2-selection--single{
                height: 38px !important;
                border: 1px solid #ced4da;
            }
            .select2-selection__placeholder{
                line-height: 38px !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__clear{
                height: 38px !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow{
                top:6;
            }
            .ck-editor{
                width: 100% !important;
            }
            .select2-selection__choice{
                line-height: 25px !important;
            }
        </style>
    </head>
    <body>
        <div id="layout-wrapper">
            @include('layouts.navbar')
            <!-- removeNotificationModal -->
            <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                    <h4>Are you sure ?</h4>
                                    <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                            </div>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            @include('layouts.sidebar')
            @yield('content')
        </div>

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

        <!--preloader-->
        <div id="preloader">
            <div id="status">
                <div class="spinner-border text-primary avatar-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        {{--<div class="customizer-setting d-none d-md-block">
            <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
                <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
            </div>
        </div>--}}

        {{-- @include('layouts.customize') --}}

         <!-- JAVASCRIPT -->
         <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>
        <script src="/assets/libs/feather-icons/feather.min.js"></script>
        <script src="/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
        <script src="/assets/js/plugins.js"></script>

        <!-- apexcharts -->
        <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Dashboard init -->
        <script src="/assets/js/pages/dashboard-crm.init.js"></script>
        <!-- ckeditor -->
        <script src="/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

        <!-- quill js -->
        <script src="/assets/libs/quill/quill.min.js"></script>
        
        <!-- init js -->
        <script src="/assets/js/pages/form-editor.init.js"></script>

        <!-- Modern colorpicker bundle -->
        <script src="/assets/libs/@simonwep/pickr/pickr.min.js"></script>

        <!-- init js -->
        <script src="/assets/js/pages/form-pickers.init.js"></script>

        <!-- App js -->
        <script src="/assets/js/app.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        @yield('scripts')
        @yield('custom_script')
    </body>
</html>