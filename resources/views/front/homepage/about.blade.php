<section class="text-light about-homepage">
    <div class="overlay"></div>
    <img src="/front/assets/img/rental-service-1.webp" class="jarallax-img" alt="">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInRight">
                <h2>{{ __('messages.about_us_welcome_text') }}</h2>
                <p>{{ __('messages.about_us_welcome_desc') }}</p>
            </div>
            <div class="col-lg-6 wow fadeInLeft">
              {{ __('messages.about_us_welcome_content') }}
            </div>
        </div>
        <div class="spacer-double"></div>
        <div class="row text-center">
            <div class="col-md-3 col-sm-6 mb-sm-30">
                <div class="de_count transparent text-light wow fadeInUp">
                    <h3 class="timer" data-to="92" data-speed="3000">0</h3>
                    {{ __('messages.clients') }}
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
                <div class="de_count transparent text-light wow fadeInUp">
                    <h3 class="timer" data-to="350" data-speed="3000">0</h3>
                    {{ __('messages.rented_cars') }}
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
                <div class="de_count transparent text-light wow fadeInUp">
                    <h3 class="timer" data-to="220" data-speed="3000">0</h3>
                    {{ __('messages.cars_selled') }}
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
                <div class="de_count transparent text-light wow fadeInUp">
                    <h3 class="timer" data-to="984" data-speed="3000">0</h3>
                    {{ __('messages.services_finished') }}
                </div>
            </div>
        </div>
    </div>
</section>