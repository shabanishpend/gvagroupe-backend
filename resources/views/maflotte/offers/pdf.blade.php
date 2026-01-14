<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @page {
            margin-bottom: 0; /* Removes any margin from the bottom of the page */
            padding-bottom: 0;
        }
        body {
            padding: 2.5rem;
            padding-top: 0rem;
            margin: 0;
            counter-reset: page;
            font-family: "Roboto", sans-serif;
        }
        .page:after { content: counter(page); }
        .page-break {
            page-break-before: always;
        }
        .box{
            background-color: #fff;
            width: 100%;
        }
        .logo_header{
            object-fit: contain;
            width: 200px;
            height: 33.79px;
        }
        p{
            color: #000;
            padding: 0px !important;
            margin-bottom: 0px !important;
            margin-top: 0px !important;
        }
        .box .header{
            width: 100%;
            padding-top: 2rem;
        }
        .price_discount{
            border-bottom: 1px solid black;
            position: relative;
            height: 50px;
        }
        .price_discount .discount{
            position: relative;
            bottom: 0;
            left: 0;
        }
        textarea{
            font-family: "Roboto", sans-serif;
            border: 0px !important;
            background: transparent !important;
            resize: none; /* Disable manual resizing */
            overflow: hidden; /* Hide the scrollbars */
            height: auto; /* Let the height adjust automatically */
            min-height: 50px; /* Set a minimum height if needed */
            font-size: 13px;
            line-height: 13px;
        }
        .d_inline{display: inline-block;}
        .text-right {text-align: right;}
        .text-center{text-align: center;}
        .text-left{text-align: left;}
        .fs_10{font-size: 10px;}
        .fs_11{font-size: 11px;}
        .fs_12{font-size: 12px;}
        .fs_13{font-size: 13px;}
        .fs_14{font-size: 14px;}
        .fs_16{font-size: 16px !important;}
        .fs_18{font-size: 18px;}
        .fs_20{font-size: 20px;}
        .fs_22{font-size: 22px;}
        .fs_24{font-size: 24px;}
        .pt_2{padding-top: 2rem;}
        .position-relative{position: relative;}
        .w_50{width: 49.5%;}
        .w_100{width: 100%;}
        .w_40{width: 48%;}
        .w_30{width: 30%;}
    </style>
</head>
<body>
    <div class="box">
        <div class="header">

            <div class="w_50 left d_inline" style="vertical-align: top;">
                <div style="padding-top: 10px;">
                  <p style="line-height: 18px;font-size: 18px;">Volet financier (offre annuelle)</p>
                  <p style="line-height: 13px;font-size: 13px;margin-top: 0.5rem !important;">{{ $user['name'] }} {{ $user['surname'] }}</p>
                </div>
            </div>
            <div class="w_50 right d_inline text-right" style="min-height: 100px;vertical-align: top;">
                <div>
                    <img 
                        class="logo_header" 
                        src="https://gvacars.ch/front/assets/images/logo-no-bg.png" 
                    >
                </div>
            </div>

        </div>

        <div>
            <p class="text-center" style="line-height: 18px;font-size:18px;margin-top:1rem !important;">Services proposés par MAFLOTTE (par mois et par véhicule) <br/> Accord de 12 mois</p>
        </div>

        <div style="margin-top:3rem !important;">
            <p style="line-height: 16px;font-size:16px;">Nombre de véhicule : <span style="font-weight: bold;">{{ $cars_number }}</span></p>
            <div style="line-height: 16px;font-size:16px;position: relative;">Prix mensuel de chaque appareil : 
                <span class="price_discount" style="font-weight: bold;text-decoration: line-through;text-decoration-color: red;">{{ $price }}.-</span>/véhicule
            </div>
            <div style="line-height: 16px;font-size:16px;position: relative;"><span style="opacity: 0;">Prix mensuel de chaque appareil :</span>
                <span class="" style="font-weight: bold;">{{ $discount_price }}.-</span>
            </div>
        </div>

        <div style="margin-top:0.5rem !important;">
            <textarea>{!! $services !!}</textarea>
        </div>

        <div style="margin-top:2rem !important;width: 100%;border: 1px solid black;background-color: #f1f1f1;padding: 10px 5px 10px 5px;">
            <p style="font-size: 16px;line-height: 16px;">Total annuel (TTC) : <span style="font-weight: bold;">CHF {{ str_replace(',', '’', number_format($total_price)) }}</span></p>
        </div>

        <div style="margin-top:2rem !important;">
            <textarea>{!! $conditions !!}</textarea>
        </div>

        <div style="margin-top:2rem !important;">
            <textarea>{!! $signature_footer !!}</textarea>
        </div>

        <div style="margin-top:2.5rem !important;">
            <textarea style="font-size: 12px;text-align:center;">{!! $footer_text !!}</textarea>
        </div>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font("helvetica", "bold");
            $totalPages = $pdf->get_page_count();  // Get total pages
        
            // Use {PAGE_NUM} to dynamically get the current page number during rendering
            $pdf->page_text(270, 810, "Page {PAGE_NUM} of {$totalPages}", $font, 10, array(0,0,0));

        }
    </script>
</body>
</html>
