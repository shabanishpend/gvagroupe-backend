@extends('front.layouts.admin')
@section('title', __('messages.search_rental_text'))

@section('meta')
<meta name="description" content="Entrez dans un monde d'élégance et de commodité grâce à notre service de voitures de première classe." />
<meta property="og:image" content="https://gvagroupe.ch/front/images/background/2.webp">
<meta property="og:image:secure_url" content="https://gvagroupe.ch/front/images/background/2.webp" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="GVAGROUPE">
<meta property="og:description" content="Entrez dans un monde d'élégance et de commodité grâce à notre service de voitures de première classe.">
<meta property="og:url" content="https://gvagroupe.ch/auto-rental">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="GVAGROUPE" />
<meta property="twitter:title" content="GVAGROUPE" />
@endsection

@section('links')
@endsection

@section('custom_css')
<style>
     #section-cars{
        padding-top: 30px !important;
    }
    .back_button{
        border: 0;
        outline: 0;
        margin-top: 30px;
        padding: 5px 15px 5px 10px;
        color: black !important;
    }
</style>
@endsection

@section('content')
<!-- section begin -->
<section id="subheader" class="jarallax text-light">
    <img src="/front/images/background/2.webp" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{ __('messages.search_rental_text') }}</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</section>
<!-- section close -->

<div class="container">
    <button class="back_button" id="backButton">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            <path fill="none" d="M0 0h24v24H0z"/>
        </svg>
        {{ __('messages.back')}}
    </button>
</div>


<section id="section-cars">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-3">
                <div class="item_filter_group">
                    <h4>{{ __('messages.select_category') }}</h4>
                    <div class="de_form">
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                            <div class="de_checkbox">
                                <input 
                                    id="category_{{ $category->id }}" 
                                    type="checkbox" 
                                    value="{{ $category->name }}" 
                                    data-id="{{ $category->id }}"
                                    onclick="filter(this)"
                                    class="filter_category"
                                >
                                <label for="category_{{ $category->id }}">
                                    @if(app()->getLocale() == 'fr')
                                        {{ $category->name }}
                                    @elseif(app()->getLocale() == 'en')
                                        {{ isset($category->translation->name_en) ? $category->translation->name_en : '' }}
                                    @elseif(app()->getLocale() == 'de')
                                        {{ isset($category->translation->name_de) ? $category->translation->name_de : '' }}
                                    @else
                                        {{ $category->name }}
                                    @endif
                                </label>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="item_filter_group">
                    <h4>{{ __('messages.mark') }}</h4>
                    <div class="de_form">
                    @if(count($marks) > 0)
                            @foreach($marks as $mark)
                            <div class="de_checkbox">
                                <input 
                                    id="mark_{{ $mark->id }}" 
                                    type="checkbox" 
                                    value="{{ $mark->name }}" 
                                    onclick="filter(this)"
                                    data-id="{{ $mark->id }}"
                                    class="filter_marks"
                                >
                                <label for="mark_{{ $mark->id }}">
                                    @if(app()->getLocale() == 'fr')
                                        {{ $mark->name }}
                                    @elseif(app()->getLocale() == 'en')
                                        {{ isset($mark->translation->name_en) ? $mark->translation->name_en : '' }}
                                    @elseif(app()->getLocale() == 'de')
                                        {{ isset($mark->translation->name_de) ? $mark->translation->name_de : '' }}
                                    @else
                                        {{ $mark->name }}
                                    @endif
                                </label>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="item_filter_group">
                    <h4>{{ __('messages.car') }} {{ __('messages.seats') }}</h4>
                    <div class="de_form">
                        <div class="de_checkbox">
                            <input id="car_seat_1" name="car_seat_1" type="checkbox" class="filter_seats" onclick="filter(this)" data-value="2">
                            <label for="car_seat_1">2 {{ __('messages.seats') }}</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_seat_2" name="car_seat_2" type="checkbox" class="filter_seats" onclick="filter(this)" data-value="4">
                            <label for="car_seat_2">4 {{ __('messages.seats') }}</label>
                        </div>

                        <div class="de_checkbox">
                            <input id="car_seat_3" name="car_seat_3" type="checkbox" class="filter_seats" onclick="filter(this)" data-value="6">
                            <label for="car_seat_3">6 {{ __('messages.seats') }}</label>
                        </div>

                    </div>
                </div>

                <div class="item_filter_group">
                    <h4>{{ __('messages.price') }} (CHF)</h4>
                        <div class="price-input">
                        <div class="field">
                            <span>{{ __('messages.min') }}</span>
                            <input type="number" onchange="filter(this)" class="input-min" value="0">
                        </div>
                        <div class="field">
                            <span>{{ __('messages.max') }}</span>
                            <input type="number" onchange="filter(this)" class="input-max" value="200000">
                        </div>
                        </div>
                        <div class="slider">
                        <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input type="range" class="range-min" min="0" max="200000" onchange="filter(this)" value="0" step="1">
                            <input type="range" class="range-max" min="0" max="200000" onchange="filter(this)" value="200000" step="1">
                        </div>
                </div>
            </div> --}}

            <div class="col-lg-12">
                <p> <span id="count_results">{{ count($cars) }}</span> {{ __('messages.results')}} </p>
                <div class="row" id="filter_results">
                    @if(count($cars) > 0)
                        @foreach($cars as $car)
                        <div class="col-xl-3 col-lg-6">
                            <div class="de-item mb30">
                                <div class="d-img auto-rental-image">
                                    <a href="{{ route('auto-rental.car', $car->id) }}">
                                        <img src="/back/img/auto-rental/{{ $car->image_1 }}" height="100px" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="d-info">
                                    <div class="d-text">
                                        <h4><a href="{{ route('auto-rental.car', $car->id) }}" class="color-black">{{ $car->name }}</a></h4>
                                    <div class="d-item_like">
                                        <!-- <i class="fa fa-heart"></i><span>25</span> -->
                                    </div>
                                        <div class="d-atr-group">
                                            <span class="d-atr"><img src="/front/images/icons/1-green.svg"" alt="">{{ $car->seats }}</span>
                                            <span class="d-atr"><img src="/front/images/icons/3-green.svg" alt="">{{ $car->doors }}</span>
                                            {{--<span class="d-atr"><img src="/front/images/icons/4-green.svg" alt="">
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
                                            </span>--}}
                                        </div>
                                        <div class="d-price">
                                        <span>CHF {{ number_format($car->price, 0, ',', '.') }} / jour</span>
                                            <a class="btn-main" href="tel:+41762653397">{{ __('messages.phone') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
{{-- 
<section class="cars">
    <div class="container mb-5">
        <form method="GET" action="{{ route('auto-rental.search') }}" class="row">
            <h3>Filter</h3>
           <div class="form-group col-lg-4 mb-3">
                <label class="w-100" for="category">{{ __('messages.category') }}</label>
                <select class="form-control select2" id="category" data-toggle="select2" name="category">
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-4 mb-3">
                <label class="w-100" for="marks">{{ __('messages.select_mark') }}</label>
                <select class="form-control select2" id="marks" data-toggle="select2" name="mark">
                    @foreach($marks as $mark)
                        <option value="{{ $mark->id }}">{{ $mark->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-4 mb-3">
                <label class="w-100" for="model">{{ __('messages.select_model') }}</label>
                <select class="form-control select2" id="model" data-toggle="select2" name="model">
                </select>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="w-100" for="price">{{ __('messages.prix') }}</label>
                <input 
                    class="form-control default-input"
                    name="price"
                    id="price"
                    value="{{ request()->query('price') }}"
                />
            </div>
            <div class="col-lg-12 mb-3">
                <button class="green-button">
                {{ __('messages.submit') }}
                </button>
            </div>
        </from>
    </div>

    <div class="container"> 
        <div class="row">
            @if(count($rentals) > 0)
                @foreach($rentals as $rental)
                <div class="col-lg-4">
                    <div class="car">
                        <div class="image">
                            <img alt="Image" 
                                src="/back/img/auto-rental/{{ $rental->image_1 }}"
                            />
                        </div>
                        <div class="content">
                            <p class="mb-0 date color-black">{{ $rental->created_at->diffForHumans() }}</p>
                            <p class="mb-2 desc fs-14 color-black fw-400 badge"> {{ __('messages.avaiabile') }}</p>
                            <p class="mb-2 title fs-20 color-black fw-700">
                                @if($rental->translation)
                                    @if(app()->getLocale() == 'fr')
                                        {{$rental->name}}
                                    @elseif(app()->getLocale() == 'en')
                                        {{$rental->translation->name_en}}
                                    @elseif(app()->getLocale() == 'de')
                                        {{$rental->translation->name_de}}
                                    @endif
                                @else  
                                {{ $rental->name }}
                                @endif
                            </p>
                            <p class="mb-2 title fs-16 color-black fw-400">{{ $rental->price }} CHF / day</p>
                            <p class="mb-2 desc fs-14 color-black">
                                @if($rental->translation)
                                    @if(app()->getLocale() == 'fr')
                                        {{ Str::limit($rental->description, 200) }}
                                    @elseif(app()->getLocale() == 'en')
                                        {{ Str::limit($rental->translation->description_en, 200) }}
                                    @elseif(app()->getLocale() == 'de')
                                        {{ Str::limit($rental->translation->description_de, 200) }}
                                    @endif
                                @else  
                                {{ Str::limit($rental->description, 200) }}
                                @endif
                            </p>
                            <p class="mb-0 desc fs-14 color-black">{{ __('messages.contact') }}</p>
                            <a aria-label="phone" href="tel: +41762653397">{{ __('messages.phone') }}: +41762653397</a>
                            <div class="w-100 text-right mt-4">
                                <form action="{{ route('car', $car->id) }}" method="GET">
                                    <button class="green-button w-100">{{ __('messages.details') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>      
</section>
--}}
@endsection

@section('scripts')
<script>
    document.getElementById('backButton').addEventListener('click', function() {
        window.history.back();
    });
</script>
@endsection