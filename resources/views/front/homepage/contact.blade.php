<section id="contact" class="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <div class="section-title">
              <h2>{{ __('messages.contact') }}</h2>
              <p>{{ __('messages.contact_desc') }}</p>
            </div>
          </div>

          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <iframe title="google map contact" style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d318573.79917327047!2d5.824976410153096!3d46.21240647017463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c631e31334f23%3A0xfe51d27951056270!2sRue%20du%20Pr%C3%A9-Bouvier%208%2C%201217%20Meyrin%2C%20Switzerland!5e0!3m2!1sen!2s!4v1687371169830!5m2!1sen!2s" frameborder="0" allowfullscreen></iframe>
            <div class="info mt-4">
              <i class="bi bi-geo-alt"></i>
              <p class="h4">{{ __('messages.location') }}</p>
              <p>Rue Pré-Bouvier 8, 1214 Satigny</p>
            </div>
            <div class="row">
              <div class="col-lg-6 mt-4">
                <div class="info">
                  <i class="bi bi-envelope"></i>
                  <p class="h4">E-mail:</p>
                  <p>contact@gvacars.ch</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="info w-100 mt-4">
                  <i class="bi bi-phone"></i>
                  <p class="h4">{{ __('messages.phone') }}</p>
                  <p>+41762653397</p>
                </div>
              </div>
            </div>

            <form action="{{ route('new-contact') }}" method="POST" class="php-email-form mt-4">
              @csrf
              @include('layouts.alerts')
              <div class="row">
                <div class="col-md-12 form-group">
                  <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="{{ __('messages.full_name') }}">
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="email" class="form-control" name="email" id="email-contact" value="{{ old('email') }}" placeholder="E-mail">
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="{{ __('messages.message') }}">{{ old('message') }}</textarea>
              </div>
              <div class="my-3">
                    {!! NoCaptcha::display() !!}
                </div>
              <div class="my-3">
                <div class="loading">{{ __('messages.loading') }}</div>
                <div class="error-message"></div>
                <div class="sent-message">{{ __('messages.contact_message_send') }}</div>
              </div>
              <div class="text-center">
                <button type="submit">{{ __('messages.submit') }}</button></div>
            </form>
          </div>
        </div>

      </div>
</section>