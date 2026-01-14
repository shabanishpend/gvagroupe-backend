<!-- Free to use, HTML email template designed & built by FullSphere. Learn more about us at www.fullsphere.co.uk -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="x-apple-disable-message-reformatting">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Emails</title>
      <style type="text/css">
        a,a[href],a:hover, a:link, a:visited {
          /* This is the link colour */
          text-decoration: none!important;
          color: #0000EE;
        }
        .link {
          text-decoration: underline!important;
        }
        p, p:visited {
          /* Fallback paragraph style */
          font-size:15px;
          line-height:24px;
          font-family: 'Helvetica', Arial, sans-serif;
          font-weight:300;
          text-decoration:none;
          color: #000000;
        }
        h1 {
          /* Fallback heading style */
          font-size:22px;
          line-height:24px;
          font-family:'Helvetica', Arial, sans-serif;
          font-weight:normal;
          text-decoration:none;
          color: #000000;
        }
        .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {line-height: 100%;}
        .ExternalClass {width: 100%;}
      </style>
      @yield('styles')
  </head>
  <body style="text-align: left; margin: 0; padding-top: 10px; padding-bottom: 10px; padding-left: 0; padding-right: 0; -webkit-text-size-adjust: 100%; color: #000000">
      @include('emails.layouts.header')
      @yield('content')
      @include('emails.layouts.footer')
    @yield('scripts')
  </body>
</html>