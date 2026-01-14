@extends('layouts.admin')
@section('title', 'Voir')

@section('links')
    <link href="/assets/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'contacts',
                'items' => [
                    ['label' => 'Gestion des contacts', 'route' => 'contacts'],
                    ['label' => 'Voir un contact', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')  

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Voir un contact</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                <div>
                <p>Nom: {{ $contact->name }}</p>
                <p>E-mail: {{ $contact->email }}</p>
                    <p>Message: </p>
                    <p>{{ $contact->message }}</p>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>

</script>
@endsection


@section('scripts')
<!-- Datatables js -->
<script src="/assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="/assets/js/vendor/dataTables.bootstrap4.js"></script>
<script src="/assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="/assets/js/vendor/responsive.bootstrap4.min.js"></script>

<!-- Datatable Init js -->
<script src="/assets/js/pages/demo.datatable-init.js"></script>
@endsection
