@extends('front.layouts.admin')
@section('title', __('messages.details_car'))

@section('meta')
<meta name="description" content="{{ $car->description }}" />
<meta property="og:image" content="/back/img/cars/{{ $car->image_1 }}">
<meta property="og:image:secure_url" content="/back/img/cars/{{ $car->image_1 }}" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="{{ $car->name }} | GVAGROUPE">
<meta property="og:description" content="{{ $car->description }}">
<meta property="og:url" content="https://gvagroupe.ch/car/{{ $car->id }}">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="{{ $car->name }} | GVAGROUPE" />
<meta property="twitter:title" content="{{ $car->name }} | GVAGROUPE" />
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
                        <img alt="Image" src="/back/img/cars/{{ $car->image_1 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_2)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_2 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_3)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_3 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_4)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_4 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_5)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_5 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_6)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_6 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_7)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_7 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_8)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_8 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_9)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_9 }}" alt="{{ $car->name }}">
                      </div>
                    @endif
                    @if($car->image_10)
                      <div class="item">
                        <img alt="Image" src="/back/img/cars/{{ $car->image_10 }}" alt="{{ $car->name }}">
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
                    <h3>CHF  {{ number_format($car->price, 0, ',', '.') }}</h3>
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
                          <span class="d-title">{{ __('messages.category') }}: </span>
                          <spam class="d-value">
                          @if($car->category)
                              @if(app()->getLocale() == 'fr')
                                {{ $car->category->name }}
                              @elseif(app()->getLocale() == 'en')
                                {{ isset($car->category->translation->name_en) ? $car->category->translation->name_en : '' }}
                              @elseif(app()->getLocale() == 'de')
                                {{ isset($car->category->translation->name_de) ? $car->category->translation->name_de : '' }}
                              @endif
                          @else  
                          @endif
                          </spam>
                      </div>
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.model') }}: </span>
                          <spam class="d-value">
                          @if($car->translation && $car->model->translation)
                              @if(app()->getLocale() == 'fr')
                                  {{$car->model->name}}
                              @elseif(app()->getLocale() == 'en')
                                {{$car->model->translation->name_en}}
                              @elseif(app()->getLocale() == 'de')
                                {{$car->model->translation->name_de}}
                              @endif
                          @else  
                          @endif
                          </spam>
                      </div>
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.mark') }}: </span>
                          <spam class="d-value">
                          @if($car->translation && $car->mark->translation)
                              @if(app()->getLocale() == 'fr')
                                  {{$car->mark->name}}
                              @elseif(app()->getLocale() == 'en')
                                {{$car->mark->translation->name_en}}
                              @elseif(app()->getLocale() == 'de')
                                {{$car->mark->translation->name_de}}
                              @endif
                          @else  
                          @endif
                          </spam>
                      </div>
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.chasie_number') }}: </span>
                          <spam class="d-value">
                            {{$car->chasie_number}}
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.color') }}: </span>
                          <spam class="d-value">
                              {{ $car->color }}
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.registration_number') }}: </span>
                          <spam class="d-value">
                              {{ $car->registration_number }}
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.type_approval') }}: </span>
                          <spam class="d-value">
                              {{ $car->type_approval }}
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.cylindrée') }}: </span>
                          <spam class="d-value">
                              {{ $car->cilindre }}
                          </spam>
                      </div>
                                     
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.power') }}: </span>
                          <spam class="d-value">
                              {{ $car->power_kw }}
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.unloaded_weight') }}: </span>
                          <spam class="d-value">
                              {{ $car->weight_no_loaded }}
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.loaded_weight') }}: </span>
                          <spam class="d-value">
                              {{ $car->weight_loaded }}
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.full_weight') }}: </span>
                          <spam class="d-value">
                              {{ $car->weight_full_loaded }}
                          </spam>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="de-spec">

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.roof_load') }}: </span>
                          <spam class="d-value">
                              {{ $car->roof_weight }}
                          </spam>
                      </div>

                      <div class="d-row">
                          <span class="d-title">{{ __('messages.emission_code') }}: </span>
                          <spam class="d-value">
                              {{ $car->emission_code }}
                          </spam>
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
                          <span class="d-title">{{ __('messages.mileage') }}: </span>
                          <spam class="d-value">
                            @if($car->translation)
                              @if(app()->getLocale() == 'fr')
                                  {{$car->mileage}}
                              @elseif(app()->getLocale() == 'en')
                              {{$car->translation->mileage_en}}
                              @elseif(app()->getLocale() == 'de')
                              {{$car->translation->mileage_de}}
                              @endif
                          @else  
                          @endif
                          </spam>
                      </div>
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.transmission') }}: </span>
                          <spam class="d-value">
                          @if($car->translation)
                              @if(app()->getLocale() == 'fr')
                                  {{$car->transmission}}
                              @elseif(app()->getLocale() == 'en')
                              {{$car->translation->transmission_en}}
                              @elseif(app()->getLocale() == 'de')
                              {{$car->translation->transmission_de}}
                              @endif
                          @else  
                          @endif
                          </spam>
                      </div>
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.seats') }}: </span>
                          <spam class="d-value">{{ $car->seats }}</spam>
                      </div>
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.doors') }}: </span>
                          <spam class="d-value">{{ $car->doors }}</spam>
                      </div>
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.year') }}: </span>
                          <spam class="d-value">{{ $car->year }}</spam>
                      </div>
                      <div class="d-row">
                          <span class="d-title">{{ __('messages.expertise')}}: </span>
                          <spam class="d-value">
                            @if($car->expertise)
                              Oui
                            @else
                              Non
                            @endif
                          </spam>
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
			

{{-- <section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>{{ __('messages.details_car') }}</h2>
      <ol>
        <li><a aria-label="home" href="index.html">{{ __('messages.home') }}</a></li>
        <li>{{ __('messages.details_car') }}</li>
      </ol>
    </div>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details car">
  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-7">
        <div class="portfolio-details-slider swiper">
          <div class="swiper-wrapper">

            @if($car->image_1)
              <div class="swiper-slide">
                <img alt="Image" src="/back/img/cars/{{ $car->image_1 }}" alt="{{ $car->name }}" height="500">
              </div>
            @endif

            @if($car->image_2)
              <div class="swiper-slide">
                <img alt="Image" src="/back/img/cars/{{ $car->image_2 }}" alt="{{ $car->name }}" height="500">
              </div>
            @endif

            @if($car->image_3)
              <div class="swiper-slide">
                <img alt="Image" src="/back/img/cars/{{ $car->image_3 }}" alt="{{ $car->name }}" height="500">
              </div>
            @endif

          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="portfolio-info">
          <h3>Car information</h3>
          <ul>

       
            <li><strong>{{ __('messages.contact') }}</strong>: <a aria-label="contact" href="#">045 219 437</a></li>
          </ul>
        </div>
        <div class="portfolio-info mt-3">
          <h3>{{ __('messages.details_car') }}</h3>
          <ul>
 
            <li><strong>{{ __('messages.seats') }}</strong>: 
            @if($car->translation)
                @if(app()->getLocale() == 'fr')
                    {{$car->seats}}
                @elseif(app()->getLocale() == 'en')
                {{$car->translation->seats_en}}
                @elseif(app()->getLocale() == 'de')
                {{$car->translation->seats_de}}
                @endif
            @else  
            @endif
          </li>
            <li><strong>{{ __('messages.doors') }}</strong>: 
          
            @if($car->translation)
                @if(app()->getLocale() == 'fr')
                    {{$car->doors}}
                @elseif(app()->getLocale() == 'en')
                {{$car->translation->doors_en}}
                @elseif(app()->getLocale() == 'de')
                {{$car->translation->doors_de}}
                @endif
            @else  
            @endif</li>
          </ul>
        </div>
      </div>

      <div class="col-lg-12">
      <div class="portfolio-description">
          <p>
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
        </div>
      </div>
    </div>

  </div>
</section><!-- End Portfolio Details Section -->
--}}
@endsection