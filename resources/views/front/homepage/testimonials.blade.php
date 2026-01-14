@if(count($testimonials) > 0)
<section id="testimonials" class="testimonials section-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="section-title" data-aos="fade-right">
              <h2>TESTIMONIALES</h2>
              <p>Les témoignages sont un moyen efficace pour les clients potentiels de se faire une idée de la qualité de nos services./p>
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">
              @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      {{ $testimonial->description }}
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                    <img alt="Image" src="/front/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                    <h3>{{ $testimonial->user_full_name }}</h3>
                    <h4>{{ $testimonial->user_position }}</h4>
                  </div>
                </div><!-- End testimonial item -->
                @endforeach
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
</section>
@endif