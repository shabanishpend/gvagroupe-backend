
@extends('front.layouts.admin')
@section('title', __('messages.service_limusine'))

@section('meta')
<meta name="description" content="Entrez dans un monde d'élégance et de commodité grâce à notre service de voitures de première classe. Nous veillons à ce que tous vos besoins soient satisfaits pendant votre voyage vers votre destination. Installez-vous confortablement, détendez-vous et laissez-vous tenter par un voyage où le luxe côtoie la fluidité. Votre expérience exceptionnelle commence dès que vous entrez dans le véhicule." />
<meta property="og:image" content="https://gvacars.ch/front/assets/img/open-door.webp">
<meta property="og:image:secure_url" content="https://gvacars.ch/front/assets/img/open-door.webp" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="{{ __('messages.service_limusine') }} | GVACARS" />
<meta property="og:description" content="Entrez dans un monde d'élégance et de commodité grâce à notre service de voitures de première classe. Nous veillons à ce que tous vos besoins soient satisfaits pendant votre voyage vers votre destination. Installez-vous confortablement, détendez-vous et laissez-vous tenter par un voyage où le luxe côtoie la fluidité. Votre expérience exceptionnelle commence dès que vous entrez dans le véhicule.">
<meta property="og:url" content="https://gvacars.ch/service-limusine">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="GVACARS" />
<meta property="twitter:title" content="{{ __('messages.service_limusine') }} | GVACARS" />
@endsection

@section('links')
@endsection

@section('content')
<section id="de-carousel" aria-label="section" class="no-top no-bottom carousel hero-hompage slide jarallax" data-mdb-interval="false">
  <ol class="carousel-indicators z1000">
    <li data-mdb-target="#de-carousel" data-mdb-slide-to="0" class="active"></li>
  </ol>
  <div class="carousel-inner position-relative">
        <!-- Single item -->
    <div class="carousel-item active">
        <img src="/front/assets/img/open-door.webp" class="jarallax-img" alt="">

        <div class="mask">
            <div class="no-top no-bottom">
                <div class="h-100 v-center">
                    <div class="container">
                        <div class="row  align-items-center">
                            <div class="col-lg-12 text-center mb-sm-30">
                                <h1 class=" mb-3 wow fadeInUp color-white">{{ __('messages.welcome_title_2') }}</h1>
                                <p class="lead wow fadeInUp color-white" data-wow-delay=".3s">{{ __('messages.welcome_text_2') }}</p>
                                <div class="spacer-10"></div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>

  {{--<a class="carousel-control-prev" href="#de-carousel" role="button" data-mdb-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#de-carousel" role="button" data-mdb-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>--}}

</section>
@endsection