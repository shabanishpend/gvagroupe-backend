<section id="section-cars">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 offset-lg-3 text-center">
                <h2>{{ __('messages.buy_cars') }}</h2>
                <!-- <p>Driving your dreams to reality with an exquisite fleet of versatile vehicles for unforgettable journeys.</p> -->
                <div class="spacer-20"></div>
            </div>

            <div id="items-carousel" class="owl-carousel wow fadeIn cars">
                @if(count($cars) > 0)
                    @foreach($cars as $car)
                    <div class="col-lg-12">
                        <div class="de-item mb30">
                            <div class="d-img img">
                                <a href="{{ route('car', $car->id) }}">
                                    @if($car->image_1)
                                        <img 
                                            alt="Image" 
                                            src="/back/img/cars/{{ $car->image_1 }}"
                                            class="img-fluid"
                                        />
                                    @else
                                        <div style="min-height: 280px;background-color: #f5f5f5;"></div>
                                    @endif
                                </a>
                            </div>
                            <div class="d-info">
                                <div class="d-text">
                                    <h4> <a href="{{ route('car', $car->id) }}" class="">
                                    @if(app()->getLocale() == 'en')
                                        {{ $car->translation->name_en }}
                                    @elseif(app()->getLocale() == 'fr')
                                        {{ $car->name }}
                                    @elseif(app()->getLocale() == 'de')
                                        {{ $car->translation->name_de }}
                                    @else
                                        {{ $car->name }}
                                    @endif
                                    </a>
                                    </h4>
                                    <!-- <div class="d-item_like">
                                        <i class="fa fa-heart"></i><span>74</span>
                                    </div> -->
                                    <div class="d-atr-group">
                                        <span class="d-atr"><img src="/front/images/icons/1-green.svg" alt="">{{ $car->seats }}</span>
                                        <!-- <span class="d-atr"><img src="/front/images/icons/2-green.svg" alt="">2</span> -->
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
                                    <div class="d-price pt-2">
                                        <span>CHF {{ number_format($car->price, 0, ',', '.') }}</span>
                                        <a class="btn-main" href="tel:+41762653397">{{ __('messages.phone') }}</a>
                                    </div>
                                    <!-- <div class="w-100 text-right mt-4">
                                        <form action="{{ route('car', $car->id) }}" method="GET">
                                            <button type="submit" class="btn btn-light w-100">{{ __('messages.details') }}</button>
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</section>

{{-- <div class="cars">
    <div class="container">
        <div class="row">
            <h2 class="text-center mb-5">{{ __('messages.buy_cars') }}</h2>
            @if(count($cars) > 0)
                @foreach($cars as $car)
                <div class="col-lg-4">
                    <div class="car">
                        <div class="image">
                            <img alt="Image" 
                                src="/back/img/cars/{{ $car->image_1 }}"
                            />
                        </div>
                        <div class="content">
                            <p class="mb-0 date color-black">{{ $car->created_at->diffForHumans() }}</p>
                            <p class="mb-2 title fs-20 color-black fw-700">
                                @if(app()->getLocale() == 'en')
                                {{ $car->translation->name_en }}
                                @elseif(app()->getLocale() == 'fr')
                                {{ $car->name }}
                                @elseif(app()->getLocale() == 'fr')
                                {{ $car->translation->name_de }}
                                @else
                                {{ $car->name }}
                                @endif
                            </p>
                            <p class="mb-0 desc fs-14 color-black">
                            @if(app()->getLocale() == 'en')
                                {{ Str::limit($car->translation->description_en, 200) }}
                                @elseif(app()->getLocale() == 'fr')
                                {{ Str::limit($car->description, 200) }}
                                @elseif(app()->getLocale() == 'de')
                                {{ Str::limit($car->translation->description_de, 200) }}
                                @else
                                {{ Str::limit($car->description, 200) }}
                            @endif
                                
                            </p>
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
            <div class="col-lg-12 text-center mt-3">
                <form action="{{ route('cars') }}" method="GET">
                    <button 
                        class="green-button"
                        onclick=""
                    >
                    {{ __('messages.see_all') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> --}}