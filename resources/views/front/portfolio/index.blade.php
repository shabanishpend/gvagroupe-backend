@extends('front.layouts.admin')
@section('title', __('messages.portfolio'))
@section('content')
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>
         @if($project->translation)
            @if(app()->getLocale() == 'fr')
                {{ $project->title }}
                @elseif(app()->getLocale() == 'en')
                {{$project->translation->title_en}}
                @elseif(app()->getLocale() == 'de')
                {{$project->translation->title_de}}
                @endif
            @else
            {{ $project->title }}  
          @endif
      </h2>
      <ol>
        <li><a aria-label="home" href="index.html">{{ __('messages.home') }}</a></li>
        <li>{{ __('messages.portfolio') }}</li>
        <li>
           @if($project->translation)
            @if(app()->getLocale() == 'fr')
                {{ $project->title }}
                @elseif(app()->getLocale() == 'en')
                {{$project->translation->title_en}}
                @elseif(app()->getLocale() == 'de')
                {{$project->translation->title_de}}
                @endif
            @else
            {{ $project->title }}  
          @endif
        </li>
      </ol>
    </div>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-8">
        <div class="portfolio-details-slider swiper">
          <div class="swiper-wrapper align-items-center">

            <div class="swiper-slide">
              <img alt="Image" src="/back/img/projects/{{ $project->image }}" alt="">
            </div>

            <!-- <div class="swiper-slide">
              <img alt="Image" src="/front/assets/img/portfolio/portfolio-details-2.jpg" alt="">
            </div>

            <div class="swiper-slide">
              <img alt="Image" src="/front/assets/img/portfolio/portfolio-details-3.jpg" alt="">
            </div> -->

          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="portfolio-info">
          <h3>{{ __('messages.project_information') }}</h3>
          <ul>
            <li><strong>{{ __('messages.service') }}</strong>: 
            @if($project->translation)
            @if(app()->getLocale() == 'fr')
                {{ $project->service }}
                @elseif(app()->getLocale() == 'en')
                {{$project->translation->service_en}}
                @elseif(app()->getLocale() == 'de')
                {{$project->translation->service_de}}
                @endif
            @else
            {{ $project->service }}  
            @endif
            </li>
            <li><strong>{{ __('messages.client') }}</strong>: {{ $project->client }}</li>
            <li><strong>{{ __('messages.year') }}</strong>: {{ $project->year }}</li>
            <li><strong>{{ __('messages.site') }}</strong>: <a aria-label="project visit" href="{{ $project->visit }}">{{ $project->visit }}</a></li>
          </ul>
        </div>
        <div class="portfolio-description">
          <h2>
          @if($project->translation)
            @if(app()->getLocale() == 'fr')
                {{ $project->title }}
                @elseif(app()->getLocale() == 'en')
                {{$project->translation->title_en}}
                @elseif(app()->getLocale() == 'de')
                {{$project->translation->title_de}}
                @endif
            @else
            {{ $project->title }}  
            @endif
          </h2>
          <p>
          @if($project->translation)
            @if(app()->getLocale() == 'fr')
                 {!! $project->content !!}
                @elseif(app()->getLocale() == 'en')
                {!! $project->translation->content_en !!}
                @elseif(app()->getLocale() == 'de')
                {!! $project->translation->content_de !!}
                @endif
            @else
             {!! $project->content !!}  
            @endif
          </p>
        </div>
      </div>

    </div>

  </div>
</section><!-- End Portfolio Details Section -->

@endsection