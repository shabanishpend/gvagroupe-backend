<section class="auto-service-form">
    <div class="{{ request()->routeIs('auto-service-reservation') ? '' : '' }}">
        <div class="row">
            @if(Request::is('auto-service-reservation'))
            @else
                <h2 class="text-center mb-5">{{ __('messages.reservation_service') }}</h2>
            @endif
            @if (session()->has('service_success'))
                <div class="row mt-4 ml-0 mr-0">
                    <div class="col-12">
                        <div class="alert alert-success mb-0" role="alert">
                            <i class="dripicons-checkmark mr-2"></i> {{ session()->get('service_success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if (session()->has('service_errors'))
                <div class="row mt-4 ml-0 mr-0">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show mb-0">
                            <ul class="m-0 p-0">
                                @foreach (session()->get('service_errors') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="w-100 auto-service-bg">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row  service-reservation-form pb-5">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12 input-view mb-3">
                                    {{--<label class="fs-18 fw-700 color-white">{{ __('messages.details_service') }}</label>--}}
                                </div>

                                <div class="col-lg-12 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.service_type') }} *</label>
                                    <select class="default-select" name="type" id="type" required>
                                        <option value="maintance - repair">{{ __('messages.maintance_repair') }}</option>
                                        <option value="tyres">{{ __('messages.tyres') }}</option>
                                        <option value="brakes">{{ __('messages.brakes') }}</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.date_preferred') }} *</label>
                                    <input type="text" class="default-input" name="prefered_date" id="service_prefered_date"  />
                                </div>

                                <div class="col-lg-6 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.time_preferred') }} *</label>
                                    <input type="text" class="default-input timerangepicker" name="time" id="time" />
                                </div>

                                <div class="col-lg-12 input-view mb-2 mt-3">
                                    <label class="fs-18 fw-700 color-white">{{ __('messages.details_car') }}</label>
                                </div>

                                <div class="col-lg-6 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.car_mark') }} *</label>
                                    <input type="text" class="default-input" id="car_brand" name="car_brand"  value="{{ old('car_brand') }}" onkeyup="validate()" />
                                    <p class="mb-0 color-red error-form"></p>
                                </div>

                                <div class="col-lg-6 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.car_model') }} *</label>
                                    <input type="text" class="default-input" id="car_model" name="car_model" value="{{ old('car_model') }}" onkeyup="validate()" />
                                    <p class="mb-0 color-red error-form"></p>
                                </div>

                                <div class="col-lg-12 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.car_number_register') }} *</label>
                                    <input type="text" class="default-input" id="registration_number" name="registration_number" value="{{ old('registration_number') }}" onkeyup="validate()" />
                                    <p class="mb-0 color-red error-form"></p>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12 input-view mb-2 mt-3">
                                    <label class="fs-18 fw-700 color-white">{{ __('messages.personal_data') }}</label>
                                </div>

                                <div class="col-lg-6 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.name') }} *</label>
                                    <input type="text" class="default-input" id="first_name" name="first_name" value="{{ old('first_name') }}" onkeyup="validate()" />
                                    <p class="mb-0 color-red error-form"></p>
                                </div>

                                <div class="col-lg-6 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.surname') }} *</label>
                                    <input type="text" class="default-input" id="last_name" name="last_name"  value="{{ old('last_name') }}"  onkeyup="validate()" />
                                    <p class="mb-0 color-red error-form"></p>
                                </div>

                                <div class="col-lg-6 input-view mb-3">
                                    <label class="fs-18 color-white">E-mail *</label>
                                    <input type="email" class="default-input" id="email" name="email" value="{{ old('email') }}" onkeyup="validate()" />
                                    <p class="mb-0 color-red error-form"></p>
                                </div>

                                <div class="col-lg-6 input-view mb-3">
                                    <label class="fs-18 color-white">{{ __('messages.phone') }} *</label>
                                    <input type="text" class="default-input" id="phone" name="phone" value="{{ old('phone') }}"  onkeyup="validate()" />
                                    <p class="mb-0 color-red error-form"></p>
                                </div>

                                <div class="col-lg-12 input-view mb-3">
                                    <label class="fs-18 w-100 color-white">{{ __('messages.comment') }}</label>
                                    <textarea rows="5" class="default-textarea" id="comment" name="comment">{{ old('comment') }}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center mt-3">
                        <button onclick="submitReservation()" class="green-button">{{ __('messages.submit') }}</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->

<div class="modal fade default-modal service-reservation" id="serviceReservation" aria-hidden="true" aria-labelledby="serviceReservation" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5> -->
        <button type="button" class="btn-close" onclick="closeModalReservation()"></button>
      </div>
      <div class="modal-body text-center pt-5 pb-5">
        <svg id="error-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="100" height="100" viewBox="0 0 256 256" xml:space="preserve">
        <defs>
        </defs>
        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
            <path d="M 85.429 85.078 H 4.571 c -1.832 0 -3.471 -0.947 -4.387 -2.533 c -0.916 -1.586 -0.916 -3.479 0 -5.065 L 40.613 7.455 C 41.529 5.869 43.169 4.922 45 4.922 c 0 0 0 0 0 0 c 1.832 0 3.471 0.947 4.386 2.533 l 40.429 70.025 c 0.916 1.586 0.916 3.479 0.001 5.065 C 88.901 84.131 87.261 85.078 85.429 85.078 z M 45 7.922 c -0.747 0 -1.416 0.386 -1.79 1.033 L 2.782 78.979 c -0.373 0.646 -0.373 1.419 0 2.065 c 0.374 0.647 1.042 1.033 1.789 1.033 h 80.858 c 0.747 0 1.416 -0.387 1.789 -1.033 s 0.373 -1.419 0 -2.065 L 46.789 8.955 C 46.416 8.308 45.747 7.922 45 7.922 L 45 7.922 z M 45 75.325 c -4.105 0 -7.446 -3.34 -7.446 -7.445 s 3.34 -7.445 7.446 -7.445 s 7.445 3.34 7.445 7.445 S 49.106 75.325 45 75.325 z M 45 63.435 c -2.451 0 -4.446 1.994 -4.446 4.445 s 1.995 4.445 4.446 4.445 s 4.445 -1.994 4.445 -4.445 S 47.451 63.435 45 63.435 z M 45 57.146 c -3.794 0 -6.882 -3.087 -6.882 -6.882 V 34.121 c 0 -3.794 3.087 -6.882 6.882 -6.882 c 3.794 0 6.881 3.087 6.881 6.882 v 16.144 C 51.881 54.06 48.794 57.146 45 57.146 z M 45 30.239 c -2.141 0 -3.882 1.741 -3.882 3.882 v 16.144 c 0 2.141 1.741 3.882 3.882 3.882 c 2.14 0 3.881 -1.741 3.881 -3.882 V 34.121 C 48.881 31.98 47.14 30.239 45 30.239 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: red; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
        </g>
        </svg>
        <svg id="success-icon" fill="#009970" height="100px" width="100px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 52 52" xml:space="preserve">
            <g>
                <path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26
                    S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"/>
                <path d="M38.252,15.336l-15.369,17.29l-9.259-7.407c-0.43-0.345-1.061-0.274-1.405,0.156c-0.345,0.432-0.275,1.061,0.156,1.406
                    l10,8C22.559,34.928,22.78,35,23,35c0.276,0,0.551-0.114,0.748-0.336l16-18c0.367-0.412,0.33-1.045-0.083-1.411
                    C39.251,14.885,38.62,14.922,38.252,15.336z"/>
            </g>
        </svg>
        <p class="text mb-0 mt-3"></p>
        <div class="spinner-border" role="status"></div>
      </div>

    </div>
  </div>
</div>
