@extends('front.layouts.admin')
@section('title', __('messages.reservation_service'))

@section('meta')
<meta name="description" content="Service d'Entretien Automobile de Qualité: Confiez-nous votre voiture pour un entretien de qualité supérieure. De l'entretien courant aux réparations complexes, nos techniciens qualifiés garantissent une performance optimale. Prenez rendez-vous dès maintenant !" />
<meta property="og:image" content="https://gvacars.ch/front/assets/img/car-service.webp">
<meta property="og:image:secure_url" content="https://gvacars.ch/front/assets/img/car-service.webp" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="{{ __('messages.reservation_service') }} | GVACARS" />
<meta property="og:description" content="Service d'Entretien Automobile de Qualité: Confiez-nous votre voiture pour un entretien de qualité supérieure. De l'entretien courant aux réparations complexes, nos techniciens qualifiés garantissent une performance optimale. Prenez rendez-vous dès maintenant !">
<meta property="og:url" content="https://gvacars.ch/auto-service-reservation">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="GVACARS" />
<meta property="twitter:title" content="{{ __('messages.reservation_service') }} | GVACARS" />
@endsection

@section('links')
@endsection

@section('custom_css')
<style>
    .auto-service-form{
        padding-top: 30px;
    }
</style>
@endsection

@section('content')
<!-- section begin -->
<section id="subheader" class="jarallax text-light">
    <img src="/front/assets/img/car-service.webp" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{ __('messages.reservation_service') }}</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</section>
<!-- section close -->
<section class="auto-service-page pt-4 mt-0 pb-0 mb-0">
    <div class=""> 
        <div class="row">
            @include('front.auto-service.form')
        </div>
    </div>      
</section>
@endsection

@section('scripts')
@include('front.auto-service.form-js')
@endsection

@section('custom_script')
<script>

</script>
@endsection