
@extends('front.layouts.admin')
@section('title', __('messages.privacy_policy'))

@section('meta')
<meta name="description" content="Entrez dans un monde d'élégance et de commodité grâce à notre service de voitures de première classe. Nous veillons à ce que tous vos besoins soient satisfaits pendant votre voyage vers votre destination. Installez-vous confortablement, détendez-vous et laissez-vous tenter par un voyage où le luxe côtoie la fluidité. Votre expérience exceptionnelle commence dès que vous entrez dans le véhicule." />
<meta property="og:image" content="https://gvacars.ch/front/assets/img/open-door.webp">
<meta property="og:image:secure_url" content="https://gvacars.ch/front/assets/img/open-door.webp" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="{{ __('messages.privacy_policy') }} | GVACARS" />
<meta property="og:description" content="Entrez dans un monde d'élégance et de commodité grâce à notre service de voitures de première classe. Nous veillons à ce que tous vos besoins soient satisfaits pendant votre voyage vers votre destination. Installez-vous confortablement, détendez-vous et laissez-vous tenter par un voyage où le luxe côtoie la fluidité. Votre expérience exceptionnelle commence dès que vous entrez dans le véhicule.">
<meta property="og:url" content="https://gvacars.ch/privacy-policy">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="GVACARS" />
<meta property="twitter:title" content="{{ __('messages.privacy_policy') }} | GVACARS" />
@endsection

@section('custom_css')
<style>
    p{
        font-size: 14px !important;
        color: #000;
        margin-bottom: 5px;
    }
    h3,h4{
        color: #000;
    }

    ul li{
        color: #000;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<!-- section begin -->
<section id="subheader" class="jarallax text-light">
    <img src="/front/assets/img/privacy.webp" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{ __('messages.privacy_policy') }}</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</section>
<!-- section close -->

<section aria-label="section" class="pt-0">
    <div class="container mt-5">
        <h3 class="mb-0">{{ __('messages.privacy_policy') }}</h3>
        @if(app()->getLocale() == 'en')
            @include('front.privacy-policy.english')
        @elseif(app()->getLocale() == 'fr')
            @include('front.privacy-policy.french')
        @elseif(app()->getLocale() == 'de')
            @include('front.privacy-policy.deutch')
        @endif
    </div>
</section>
@endsection