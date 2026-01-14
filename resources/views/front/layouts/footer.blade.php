<footer class="text-light">
    <div class="container">
        <div class="row g-custom-x">
            <div class="col-lg-3">
                <div class="widget pb-2">
                    <h5><img class="logo-1" src="/front/assets/img/logo.webp" alt=""></h5>
                    <div class="widget pb-0">
                        <address class="s1">
                            <span><i class="id-color fa fa-map-marker fa-lg"></i>Rue Pré-Bouvier 8 1214 Satigny</span>
                            <span><i class="id-color fa fa-phone fa-lg"></i><a href="tel:+41762653397">+41762653397</a></span>
                            <span><i class="id-color fa fa-envelope-o fa-lg"></i><a aria-label="mail" href="mailto: contact@gvacars.ch">contact@gvacars.ch</a></span>
                        </address>

                        <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=100066238585421" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                        <a href="https://www.instagram.com/gva.cars/" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-2">
                <div class="widget">
                    <h5>{{ __('messages.useful_links') }}</h5>
                    <ul>
                    <li><a aria-label="home" href="/">{{ __('messages.home') }}</a></li>
                    {{-- <li><a aria-label="about us" href="/#about">{{ __('messages.about_us') }}</a></li>
                    <li><a aria-label="portfolio" href="/#portfolio">{{ __('messages.portfolio') }}</a></li>
                    <li><a aria-label="team" href="/#team">{{ __('messages.team') }}</a></li> --}}
                    <li><a aria-label="contact" href="/#contact">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="widget">
                    <h5>{{ __('messages.services') }}</h5>
                    <ul>
                        <li><a aria-label="search rental cars" href="{{ route('auto-rental.search') }}">{{ __('messages.search_rental_text') }}</a></li>
                        <li><a aria-label="buy cars" href="{{ route('cars') }}">{{ __('messages.buy_cars') }}</a></li>
                        <li><a aria-label="service reservation" href="{{ route('auto-service.reservation') }}">{{ __('messages.service_reservation') }}</a></li>
                    </ul>
                </div>
            </div>
            
            @include('front.newsletter.index')

        </div>
    </div>
    <div class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="de-flex">
                        <div class="de-flex-col">
                            <a href="index.html">
                              &copy; {{ __('messages.copyright_text') }}
                            </a>
                        </div>
                        <ul class="menu-simple">
                            <li><a href="{{ route('privacy-policy') }}">{{ __('messages.privacy_policy') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>