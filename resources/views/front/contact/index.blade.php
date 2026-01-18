@extends('front.layouts.admin')
@section('title', __('messages.contact'))

@section('meta')
<meta name="description" content="Nous sommes là pour répondre à toutes vos questions, suggestions et demandes, n’hésitez pas à nous écrire." />
<meta property="og:image" content="https://gvagroupe.ch/front/assets/img/contact.webp">
<meta property="og:image:secure_url" content="https://gvagroupe.ch/front/assets/img/contact.webp" />
<meta property="og:image:width" content="700" /> 
<meta property="og:image:height" content="400" />
<meta property="og:title" content="{{ __('messages.contact') }} | GVAGROUPE" />
<meta property="og:description" content="Nous sommes là pour répondre à toutes vos questions, suggestions et demandes, n’hésitez pas à nous écrire.">
<meta property="og:url" content="https://gvagroupe.ch/contact">
<meta property="og:type" content="website">
<meta name="robots" content="index, noarchive">
<meta name="author" content="GVAGROUPE" />
<meta property="twitter:title" content="{{ __('messages.contact') }} | GVAGROUPE" />
@endsection

@section('links')

@endsection

@section('content')
<!-- section begin -->
<section id="subheader" class="jarallax text-light">
    <img src="/front/assets/img/contact.webp" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{ __('messages.contact') }}</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</section>
<!-- section close -->

<section aria-label="section" class="pt-0">
<iframe title="google map contact" style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d318573.79917327047!2d5.824976410153096!3d46.21240647017463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c631e31334f23%3A0xfe51d27951056270!2sRue%20du%20Pr%C3%A9-Bouvier%208%2C%201217%20Meyrin%2C%20Switzerland!5e0!3m2!1sen!2s!4v1687371169830!5m2!1sen!2s" frameborder="0" allowfullscreen></iframe>
    <div class="container mt-5">
        <div class="row g-custom-x">
            
            <div class="col-lg-8 mb-sm-30">

                <h3 class="mb-0">{{ __('messages.contact') }}</h3>
                <p>{{ __('messages.contact_desc') }}</p>
            
                <form action="{{ route('new-contact') }}" method="POST" id="contact_form" class="form-border">
                    @csrf
                    @include('layouts.alerts')
                        <div class="row">
                            <div class="col-md-6 mb10">
                                <div class="field-set">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('messages.full_name') }}" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb10">
                                <div class="field-set">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required>
                                </div>
                            </div>
                        </div>
                            
                        <div class="field-set mb20">
                            <textarea name="message" id="message" class="form-control" placeholder="{{ __('messages.message') }}" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="my-3">
                            {!! NoCaptcha::display() !!}
                        </div>

                        <div style="display:none">
                            <input name="my_honeypot" type="text" value="" id="my_honeypot">
                        </div>

                        <div id='submit' class="mt20">
                            <input type='submit' id='send_message' value="{{ __('messages.submit') }}" class="btn-main">
                        </div>

                        <div id="success_message" class='success'>
                            Your message has been sent successfully. Refresh this page if you want to send more messages.
                        </div>
                        <div id="error_message" class='error'>
                            Sorry there was an error sending your form.
                        </div>
                    </form>
        </div>
        
        <div class="col-lg-4">
            <h3 class="mb-0">&nbsp;</h3>
            <p>&nbsp;</p>
            <div class="de-box mb30">
                <h4>Genève</h4>
                <address class="s1">
                    <span><i class="id-color fa fa-map-marker fa-lg"></i>Rue Pré-Bouvier 8, 1214 Satigny</span>
                    <span><i class="id-color fa fa-phone fa-lg"></i><a href="tel:+41762653397">+41762653397</a></span>
                    <span><i class="id-color fa fa-envelope-o fa-lg"></i><a href="mailto:contact@gvgroupe.ch">contact@gvgroupe.ch</a></span>
                </address>
            </div>

        </div>
            
        </div>
    </div>

</section>
@endsection

@section('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('custom_script')
<script>

</script>
@endsection