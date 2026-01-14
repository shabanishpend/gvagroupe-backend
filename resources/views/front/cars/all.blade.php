@extends('front.layouts.admin')
@section('title', __('messages.buy_cars'))

@section('meta')
<meta name="description" content="Découvrez votre prochaine voiture de rêve chez nous. Large sélection de véhicules neufs et d'occasion, des modèles fiables et abordables. Trouvez la voiture parfaite pour votre style de vie et votre budget. Faites un essai routier dès aujourd'hui !" />
<meta property="og:image" content="https://gvacars.ch/front/images/background/2.webp">
<meta property="og:image:secure_url" content="https://gvacars.ch/front/images/background/2.webp" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="{{ __('messages.buy_cars') }} | GVACARS" />
<meta property="og:description" content="Découvrez votre prochaine voiture de rêve chez nous. Large sélection de véhicules neufs et d'occasion, des modèles fiables et abordables. Trouvez la voiture parfaite pour votre style de vie et votre budget. Faites un essai routier dès aujourd'hui !">
<meta property="og:url" content="https://gvacars.ch/cars">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="GVACARS" />
<meta property="twitter:title" content="{{ __('messages.buy_cars') }} | GVACARS" />
@endsection

@section('links')

@endsection

@section('custom_css')
    <style>
        @media (min-width: 992px){
            #filter_cars{
                display:none;
            }
        }
        @media (max-width: 992px){
            #filter_groups{
                display: none;
            }
        }
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
                        <h1>{{ __('messages.buy_cars') }}</h1>
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
            <div class="col-lg-3">
                <button class="green-button w-100 mb-3" onclick="$('#filter_groups').toggle()" id="filter_cars">{{ __('messages.filter') }}</button>
                <div id="filter_groups">
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
                        <h4>{{ __('messages.number_seats') }}</h4>
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
                </div>

            </div>

            <div class="col-lg-9">
                <p> <span id="count_results">{{ count($cars) }}</span> {{ __('messages.results')}} </p>
                <div class="row" id="filter_results">
                @if(count($cars) > 0)
                    @foreach($cars as $car)
                    <div class="col-xl-4 col-lg-6">
                        <div class="de-item mb30">
                            <div class="d-img">
                                <a href="{{ route('car', $car->id) }}">
                                    <img src="/back/img/cars/{{ $car->image_1 }}" class="img-fluid" alt="">
                                </a>
                            </div>
                            <div class="d-info">
                                <div class="d-text">
                                    <h4><a href="{{ route('car', $car->id) }}" class="color-black">{{ $car->name }}</a></h4>
                                <div class="d-item_like">
                                    <!-- <i class="fa fa-heart"></i><span>25</span> -->
                                </div>
                            <div class="d-atr-group">
                                        <span class="d-atr"><img src="/front/images/icons/1-green.svg"" alt="">{{ $car->seats }}</span>
                                        <span class="d-atr"><img src="/front/images/icons/3-green.svg" alt="">{{ $car->doors }}</span>
                                        <span class="d-atr"><img src="/front/images/icons/4-green.svg" alt="">
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
                                        </span>
                                        @if($car->expertise)
                                        <span class="d-atr">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#1ecb15" height="16px" width="16px" viewBox="0 0 448 512"><path d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                                            {{ __('messages.expertise')}}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="d-price">
                                       <span>CHF {{ number_format($car->price, 0, ',', '.') }}</span>
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
@endsection

@section('scripts')

@endsection

@section('custom_script')
<script>
    function checkCategory(element){
        $(element).parent().find('button').click();
    }
    function formatPriceWithPoints(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    function scrollToElement() {
      var targetElement = $("#filter_results");
      if (targetElement.length) {
        $("html, body").animate({
          scrollTop: targetElement.offset().top - 150
        }, 300); // Adjust the duration as needed
      }
    }
    function filter(element){
        var categories = [];
        var marks = [];
        var seats = [];
        var loader = $('#de-preloader');
        var count_results = $('#count_results');

        var results = $('#filter_results');
        var categoriesElements = $('.filter_category');
        var marksElements = $('.filter_marks');
        var seatsElements = $('.filter_seats');

        var minPrice = $('.range-min').val();
        var maxPrice = $('.range-max').val();

        if(categoriesElements.length > 0){
            categoriesElements.each(function(){
                let val = $(this).attr('value');
                let id = $(this).attr('data-id');
                let checked = this.checked;

                if(checked){
                    categories.push(id);
                }else{
                    categories.splice(id, 1);
                }
            });
        }

        if(marksElements.length > 0){
            marksElements.each(function(){
                let val = $(this).attr('value');
                let id = $(this).attr('data-id');
                let checked = this.checked;

                if(checked){
                    marks.push(id);
                }else{
                    marks.splice(id, 1);
                }
            });
        }

        if(seatsElements.length > 0){
            seatsElements.each(function(){
                let val = $(this).attr('data-value');
                let checked = this.checked;
                console.log("Val", val, checked)
                if(checked){
                    console.log("test")
                    seats.push(val);
                }else{
                    seats.splice(val, 1);
                }
            });
        }

        loader.show();
        
        var formattedMinPrice = Number(minPrice).toFixed(3); // "0.000"
        var formattedMaxPrice = Number(maxPrice).toFixed(3);
        $.ajax({
            url: '/api/buy/cars/filter',
            type: 'POST',
            data: JSON.stringify({
                "categories": categories,
                "marks": marks,
                "seats": seats,
                "minPrice": formattedMinPrice,
                "maxPrice": formattedMaxPrice,
            }),
            processData: true,
            contentType: 'application/json',
            success: function(data) {
                results.html('');
                let cars = data.cars;
                let locale = "{{ app()->getLocale() }}"
                let category = '';

                if(cars.length > 0){
                    for(let i = 0; i < cars.length; i++){
                        let car = cars[i];
                        let category = '';
                        if(locale == 'fr'){
                            category = car.category.name
                        }else if(locale == 'en'){
                            category = car.category.translation.name_en
                        }else if(locale == 'de'){
                            category = car.category.translation.name_de
                        }else{
                            category = car.category.name
                        }
                        let html = ` 
                        <div class="col-xl-4 col-lg-6">
                            <div class="de-item mb30">
                                <div class="d-img">
                                    <a href="/car/${car.id}">
                                        <img src="/back/img/cars/${car.image_1}" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="d-info">
                                    <div class="d-text">
                                        <h4><a href="/car/${car.id}" class="color-white">${car.name}</a></h4>
                                    <div class="d-item_like">
                                        <!-- <i class="fa fa-heart"></i><span>25</span> -->
                                    </div>
                                <div class="d-atr-group">
                                            <span class="d-atr"><img src="/front/images/icons/1-green.svg"" alt="">${car.seats}</span>
                                            <span class="d-atr"><img src="/front/images/icons/3-green.svg" alt="">${car.doors}</span>
                                            <span class="d-atr"><img src="/front/images/icons/4-green.svg" alt="">
                                            ${category}
                                            </span>
                                           ${car.expertise ? `<span class="d-atr">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="#1ecb15" height="16px" width="16px" viewBox="0 0 448 512"><path d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                                                {{ __('messages.expertise')}}
                                            </span>` : ''}
                                        </div>
                                        <div class="d-price">
                                        <span>CHF ${formatPriceWithPoints(car.price)}</span>
                                            <a class="btn-main" href="tel:+41762653397">{{ __('messages.phone') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        results.append(html);
                    }
                }

                count_results.html(cars.length)
                loader.hide();
                scrollToElement()
            },  
            error: function(jqXHR, textStatus, errorThrown) {
                loader.hide();
            }
        });
    }
</script>
<script>
    document.getElementById('backButton').addEventListener('click', function() {
        window.history.back();
    });
</script>
{{-- <script>
    var categorySelect = $('#category');
    var messages = @json(__('messages'));

    categorySelect.select2({
        placeholder: messages.select_category,
    }).val(null).trigger("change");

    let categoryParam = "{{ request()->query('category') }}";
    if(categoryParam != '' && categoryParam != null){
        categorySelect.select2().val(categoryParam).trigger("change");
    }

    var marks = $('#marks');
    marks.select2({
        placeholder: messages.select_mark,
    }).val(null).trigger("change");

    let markParam = "{{ request()->query('mark') }}";
    if(markParam != '' && markParam != null){
        marks.select2().val(markParam).trigger("change");
        getModelsByMark(markParam);
    }

    var model = $('#model');
    model.select2({
        placeholder: messages.select_model,
    });

    let modelParam = "{{ request()->query('model') }}";
    if(model != '' && model != null){
        model.select2().val(modelParam).trigger("change");
    }

    $(document.body).on("change","#marks",function(){
        getModelsByMark(this.value);
    });
    function getModelsByMark(mark_id){
        $.ajax({
            url: `/api/buy/cars/models/${mark_id}`,
            type: 'GET',
            success: function(data) {
                var models = data.models;
                var html = [];
                for(var i = 0; i < models.length; i++){
                    let name = models[i].name;
                    let id = models[i].id;
                    let selected = null;
                    if(id == modelParam){
                        selected = 'selected'
                    }
                    if(models[i].translation != undefined && models[i].translation){
                        @if(app()->getLocale() == 'fr')
                            name = name;
                        @elseif(app()->getLocale() == 'en')
                            name = models[i].translation.name_en
                        @elseif(app()->getLocale() == 'de')
                            name = models[i].translation.name_de
                        @endif
                    }
                    let option = `<option value="${id}" ${selected}>${name}</option>`
                    html.push(option)
                }
                $('#model').append(html);
                if(models.length === 0){
                    $('#model').html('');
                }
                $('#model').select2();
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }

</script> --}}
@endsection