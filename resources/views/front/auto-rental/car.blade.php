@extends('front.layouts.admin')
@section('title', __('messages.details_car'))

@section('meta')
<meta name="description" content="{{ $car->name }}" />
<meta property="og:image" content="/back/img/cars/{{ $car->image_1 }}">
<meta property="og:image:secure_url" content="/back/img/cars/{{ $car->image_1 }}" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="{{ $car->name }} | GVACARS">
<meta property="og:description" content="{{ $car->name }}">
<meta property="og:url" content="https://gvacars.ch/auto-rental/{{ $car->id }}">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="{{ $car->name }} | GVACARS" />
<meta property="twitter:title" content="{{ $car->name }} | GVACARS" />
@endsection

@section('content')
 <!-- section begin -->
 <section id="subheader" class="jarallax text-light">
    <img src="/front/images/background/2.webp" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                      <h1>{{ __('messages.car_details') }}</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</section>
<!-- section close -->

<section id="section-car-details">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div id="slider-carousel" class="owl-carousel">
                    @if($car->image_1)
                      <div class="item">
                        <img alt="Image" src="/back/img/auto-rental/{{ $car->image_1 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_2)
                      <div class="item">
                        <img alt="Image" src="/back/img/auto-rental/{{ $car->image_2 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_3)
                      <div class="item">
                        <img alt="Image" src="/back/img/auto-rental/{{ $car->image_3 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <h3>{{ $car->name }}</h3>
                <p class="mb-0">
                  @if($car->translation)
                      @if(app()->getLocale() == 'fr')
                          {{$car->description}}
                      @elseif(app()->getLocale() == 'en')
                      {{$car->translation->description_en}}
                      @elseif(app()->getLocale() == 'de')
                      {{$car->translation->description_de}}
                      @endif
                  @else  
                  @endif
                </p>

                <div class="spacer-10"></div>

                <div class="de-price text-left">
                    {{__('messages.price')}}
                    <h3>CHF  {{ number_format($car->price, 0, ',', '.') }} / {{ __('messages.day') }}</h3>
                </div>

                <div class="spacer-10"></div>
                <div class="pb-5">
                  <a class="btn-main" href="tel:+41762653397">{{ __('messages.phone') }}</a>
                </div>

                <h4>{{ __('messages.specifications') }}</h4>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="de-spec">

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.seats') }}: </span>
                          <spam class="d-value">{{ $car->seats }}</spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.doors') }}: </span>
                          <spam class="d-value">{{ $car->doors }}</spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.fuel') }}: </span>
                          <spam class="d-value">
                          @if($car->translation)
                              @if(app()->getLocale() == 'fr')
                                  {{$car->fuel}}
                              @elseif(app()->getLocale() == 'en')
                              {{$car->translation->fuel_en}}
                              @elseif(app()->getLocale() == 'de')
                              {{$car->translation->fuel_en}}
                              @endif
                          @else  
                          @endif
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.year') }}: </span>
                          <spam class="d-value">{{ $car->year }}</spam>
                      </div>

                    </div>
                  </div>
                  </div>
              </div>
      
                <div class="spacer-single"></div>

                <!-- <h4>Features</h4>
                <ul class="ul-style-2">
                    <li>Bluetooth</li>
                    <li>Multimedia Player</li>
                    <li>Central Lock</li>
                    <li>Sunroof</li>
                </ul> -->
            </div>            
        </div>
    </div>
</section>
@endsection