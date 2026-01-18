@extends('front.layouts.admin')
@section('title', __('messages.home'))

@section('links')
<link rel="stylesheet" type="text/css" href="/front/assets/vendor/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="/front/assets/css/cars.css" />
<link rel="stylesheet" type="text/css" href="/front/assets/css/auto-service.css" />
@endsection

@section('meta')
<meta name="description" content="Bienvenue sur notre plateforme automobile de premier ordre, votre destination ultime pour tout ce qui concerne les voitures ! Des conseils d'entretien automobile d'experts et des services aux options de vente de voitures sans tracas et de location de voitures haut de gamme, nous avons tout ce qu'il vous faut." />
<meta property="og:image" content="https://gvagroupe.ch/front/assets/img/page-thumbnail.webp">
<meta property="og:image:secure_url" content="https://gvagroupe.ch/front/assets/img/page-thumbnail.webp" />
<meta property="og:image:alt" content="Page Preview" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="GVAGROUPE">
<meta property="og:description" content="Bienvenue sur notre plateforme automobile de premier ordre, votre destination ultime pour tout ce qui concerne les voitures ! Des conseils d'entretien automobile d'experts et des services aux options de vente de voitures sans tracas et de location de voitures haut de gamme, nous avons tout ce qu'il vous faut.">
<meta property="og:url" content="https://gvgroupe.ch">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="GVAGROUPE" />
<meta property="twitter:title" content="GVAGROUPE" />
@endsection

@section('content')
  @include('front.homepage.hero')
  @include('front.cars.index')
  @include('front.homepage.about')
  @include('front.auto-service.form')
  @include('front.homepage.why-us')
  @include('front.homepage.clients')
@endsection

@section('scripts')
    @include('front.auto-service.form-js')
@endsection

@section('custom_script')
  <script>

  </script>
@endsection