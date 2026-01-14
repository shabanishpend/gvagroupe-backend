
<header class="transparent">            
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="{{ route('home') }}">
                                    <img class="logo-1" src="/front/assets/img/logo.webp" alt="">
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                    </div>
                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            <li class="{{ request()->routeIs('home') ? 'active' : null }}"><a class="menu-item" href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                            <li class="{{ request()->routeIs('cars') ? 'active' : null }}"><a class="menu-item" href="{{ route('auto-rental.search') }}">{{ __('messages.search_rental_text') }}</a></li>
                            <li class="{{ request()->routeIs('auto-service.reservation') ? 'active' : null }}"><a class="menu-item" href="{{ route('auto-service.reservation') }}">{{ __('messages.service_reservation') }}</a></li>
                            <li class="{{ request()->routeIs('cars') ? 'active' : null }}"><a class="menu-item" href="{{ route('cars') }}">{{ __('messages.buy_cars') }}</a></li>
                            <li class="{{ request()->routeIs('service-limusine') ? 'active' : null }}"><a class="menu-item" href="{{ route('service-limusine') }}">{{ __('messages.service_limusine') }}</a></li>
                            <li class="{{ request()->routeIs('contact') ? 'active' : null }}"><a class="menu-item" href="{{ route('contact') }}">{{ __('messages.contact') }}</a></li>
                            {{--<li class="{{ (request()->is('#about')) ? 'active' : '' }}"><a class="menu-item" href="{{ route('cars') }}">{{ __('messages.about_us') }}</a></li>
                            <li class="{{ (request()->is('#services')) ? 'active' : '' }}"><a class="menu-item" href="{{ route('cars') }}">{{ __('messages.services') }}</a></li>
                            <li class="{{ (request()->is('#portfolio')) ? 'active' : '' }}"><a class="menu-item" href="{{ route('cars') }}">{{ __('messages.portfolio') }}</a></li> --}}
                           
                            <li>
                              <a class="menu-item" href="#">
                                @if(app()->getLocale() == 'en')
                                  <img alt="Image" style="margin-right: 5px !important; " width="25" height="15" src="/front/assets/img/en.webp" />
                                  @elseif(app()->getLocale() == 'fr')
                                  <img alt="Image" style="margin-right: 5px !important; " width="25" height="15" src="/front/assets/img/fr.webp" />
                                  @elseif(app()->getLocale() == 'de')
                                  <img alt="Image" style="margin-right: 5px !important; " width="25" height="15" src="/front/assets/img/de.webp" />
                                @endif
                              </a>
                                <ul>
                                    <li>
                                      <div class="menu-item cursor-pointer">
                                        <form action="{{ route('locale.set') }}" method="POST" class="mb-0" id="form_1">
                                          @csrf
                                          <input type="hidden" value="en" name="language" />
                                          <div class="lang-item" aria-label="en" onclick="document.getElementById('form_1').submit()">
                                            <img alt="Image" width="25" height="15" src="/front/assets/img/en.webp" /> EN
                                          </div>
                                        </form>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="menu-item cursor-pointer">
                                        <form action="{{ route('locale.set') }}" method="POST" class="mb-0" id="form_2">
                                          @csrf
                                          <input type="hidden" value="fr" name="language" />
                                            <div class="lang-item" aria-label="fr" onclick="document.getElementById('form_2').submit()">
                                              <img alt="Image" width="25" height="15" src="/front/assets/img/fr.webp" /> FR
                                            </div>
                                        </form>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="menu-item cursor-pointer">
                                        <form action="{{ route('locale.set') }}" method="POST" class="mb-0" id="form_3">
                                          @csrf
                                          <input type="hidden" value="de" name="language" />
                                            <div class="lang-item" aria-label="deutch" onclick="document.getElementById('form_3').submit()">
                                              <img alt="Image" width="25" height="15" src="/front/assets/img/de.webp" /> DE
                                            </div>
                                          </form>
                                      </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="de-flex-col show_mobile">
                        <div class="menu_side_area">
                            {{--<a href="login.html" class="btn-main">Sign In</a>--}}
                            <span id="menu-btn"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>