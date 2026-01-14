<section id="de-carousel" aria-label="section" class="no-top no-bottom carousel hero-hompage slide">
  <ol class="carousel-indicators z1000">
    <li data-mdb-target="#de-carousel" data-mdb-slide-to="0" class="active"></li>
    <li data-mdb-target="#de-carousel" data-mdb-slide-to="1"></li>
  </ol>
  <div class="carousel-inner position-relative">

    <div class="carousel-item active">
      <div class="overlay"></div>
      <img src="/front/assets/img/geneva.webp" class="jarallax-img" alt="">
      <div class="container position-relative h-100 v-center">
          <div class="row align-items-center">
              <div class="col-lg-12 text-light">
                  <h1 class="mb-2 position-relative wow fadeInUp text-center" data-wow-delay=".3s">{{ __('messages.welcome_title_1') }}</h1>
                  <p class="lead wow fadeInUp color-white text-center" data-wow-delay=".3s">{{ __('messages.welcome_text_2') }}</p>
              </div>

              <div class="col-lg-12 wow fadeInUp" data-wow-delay=".5s">
                  <div class="spacer-single sm-hide"></div>
                  {{-- <div class="p-4 rounded-3 shadow-soft" data-bgcolor="#ffffff">
                      

                     <form class="w-100" action="{{ route('auto-rental.search') }}" method="GET">
                        @csrf
                          <div id="step-1" class="row">

                          <div class="col-lg-3 mb20">
                              <h5><label for="PickupLocation">{{ __('messages.location') }}</label></h5>
                              <input type="text" name="PickupLocation" onfocus="geolocate()" placeholder="{{ __('messages.enter_pickup_location') }}" id="autocomplete" autocomplete="off" class="form-control">

                              <div class="jls-address-preview jls-address-preview--hidden">
                                  <div class="jls-address-preview__header">
                                  </div>
                              </div>
                          </div>

                          <div class="col-lg-3 mb20">
                            <h5><label for="rental_from">{{ __('messages.rental_date_from') }}</label></h5>
                            <div class="date-time-field">
                                <input type="text" id="rental_from" name="rental_from" value="">
                                <select name="rental_time_from">
                                    <option selected disabled value="Select time">{{ __('messages.time') }}</option>
                                    <option value="00:00">00:00</option>
                                    <option value="00:30">00:30</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:30">01:30</option>
                                    <option value="02:00">02:00</option>
                                    <option value="02:30">02:30</option>
                                    <option value="03:00">03:00</option>
                                    <option value="03:30">03:30</option>
                                    <option value="04:00">04:00</option>
                                    <option value="04:30">04:30</option>
                                    <option value="05:00">05:00</option>
                                    <option value="05:30">05:30</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:30">06:30</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:30">07:30</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:30">23:30</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-lg-3">
                            <h5><label for="rental_to">{{ __('messages.rental_date_to') }}</label></h5>
                            <div class="date-time-field">
                                <input type="text" id="rental_to" name="rental_to" value="">
                                <select name="rental_time_to">
                                    <option selected disabled value="Select time">{{ __('messages.time') }}</option>
                                    <option value="00:00">00:00</option>
                                    <option value="00:30">00:30</option>
                                    <option value="01:00">01:00</option>
                                    <option value="01:30">01:30</option>
                                    <option value="02:00">02:00</option>
                                    <option value="02:30">02:30</option>
                                    <option value="03:00">03:00</option>
                                    <option value="03:30">03:30</option>
                                    <option value="04:00">04:00</option>
                                    <option value="04:30">04:30</option>
                                    <option value="05:00">05:00</option>
                                    <option value="05:30">05:30</option>
                                    <option value="06:00">06:00</option>
                                    <option value="06:30">06:30</option>
                                    <option value="07:00">07:00</option>
                                    <option value="07:30">07:30</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                    <option value="23:30">23:30</option>
                                </select>
                            </div>
                          </div>
   
                          <div class="col-lg-3 mb20">
                              <h5>&nbsp;</h5>
                              <input type='submit' id='send_message' value="{{ __('messages.search') }}" class="btn-main pull-left">
                          </div>

                          </div>
                          
                      </form>
                  </div> --}}
              </div>

          </div>
      </div>
    </div>

        <!-- Single item -->
    <div class="carousel-item">
        <img src="/front/assets/img/open-door.webp" class="jarallax-img" alt="">

        <div class="mask">
            <div class="no-top no-bottom">
                <div class="h-100 v-center">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 text-center mb-sm-30">
                                <h1 class=" mb-3 wow fadeInUp color-white">{{ __('messages.welcome_title_2') }}</h1>
                                <p class="lead wow fadeInUp color-white" data-wow-delay=".3s">{{ __('messages.welcome_text_2') }}</p>
                                <div class="spacer-10"></div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>

  <a class="carousel-control-prev" href="#de-carousel" role="button" data-mdb-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#de-carousel" role="button" data-mdb-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</section>

@section('custom_script')
<script>
  var rental_from = $('#rental_from');
  rental_from.daterangepicker({
        singleDatePicker: true,
        autoApply: true,
        showDropdowns: true,
        timePicker: false,
        minDate: new Date()
      }, function(start, end, label) {
      }
  );

  var rental_to = $('#rental_to');
  rental_to.daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        timePicker: false,
        minDate: new Date()
      }, function(start, end, label) {
      }
  );

  rental_from.on('apply.daterangepicker', function(ev, picker) {
      var dateSelected = picker.startDate.format('YYYY-MM-DD');
      rental_to.daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        timePicker: false,
        minDate: new Date(dateSelected)
      }, function(start, end, label) {
      }
  );
    });

  var rental_time_from = $('#rental_time_from');
  rental_time_from.daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      timePicker24Hour: true,
      singleDatePicker: true,
      autoApply: true,
      startDate: moment().startOf('day'),
      endDate: moment().startOf('day'),
      locale: {
        format: 'HH:mm'
      }
    },function(start, end, label) {

    });
    rental_time_from.on('show.daterangepicker', function(ev, picker) {
      picker.container.find('.calendar-table').hide();
    });
    rental_time_from.on('apply.daterangepicker', function(ev, picker) {
      var selectedTime = picker.startDate.format('HH:mm');
      console.log(selectedTime);
      // Do something with the selected time
    });

    var rental_time_to = $('#rental_time_to');
    rental_time_to.daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        timePicker24Hour: true,
        singleDatePicker: true,
        autoApply: true,
        startDate: moment().startOf('day'),
        endDate: moment().startOf('day'),
        locale: {
          format: 'HH:mm'
        }
      },function(start, end, label) {

    });
    rental_time_to.on('show.daterangepicker', function(ev, picker) {
      picker.container.find('.calendar-table').hide();
    });
    rental_time_to.on('apply.daterangepicker', function(ev, picker) {
      var selectedTime = picker.startDate.format('HH:mm');
      console.log(selectedTime);
      // Do something with the selected time
    });
</script>
@endsection