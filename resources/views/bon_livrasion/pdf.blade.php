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
            <p class="text-center" style="line-height: 30px;font-size:30px;margin-top:1rem !important;">Bon de livraison</p>
        </div>

        <div class="header" style="margin-top: 3rem !important;">

            <div class="w_50 left d_inline" style="vertical-align: top;">
                <p style="line-height: 16px;font-size: 16px;">Date : {{ date('d.m.Y', strtotime($date)) }}</p>
            </div>
            <div class="w_50 right d_inline" style="vertical-align: top;">
                <p style="line-height: 16px;font-size: 16px;">Entreprise : {{ $client['name']}} {{ $client['surname']}}</p>
                <p style="line-height: 16px;font-size: 16px;">Adresse : {{ $client['address']}}
                1180 Rolle </p>
            </div>

        </div>

        <p style="line-height: 18px;font-size: 18px;margin-top: 3rem !important;">Numéro de bon : {{ $id }}</p>

        <table style="border-collapse: collapse; width: 100%; text-align: center;margin-top: 1rem !important;">
            <tr>
                <!-- Article Column -->
                <th colspan="1" style="border: 0.5px solid #000000; background-color: #7d3fb3; color: white; padding: 0px 5px 5px 5px; width: 40%;">Article</th>
                
                <!-- Description Column -->
                <th colspan="2" style="border: 0.5px solid #000000; background-color: #7d3fb3; color: white; padding: 0px 5px 5px 5px; width: 60%;">Description</th>
            </tr>

            <tr>
                <!-- Article Content -->
                <td colspan="1" style="border: 0.5px solid #000000; padding: 0px 5px 5px 5px; vertical-align: top; background-color: #f9f9f9;text-align: left;">{{ $article }}</td>
                
                <!-- Description Content -->
                <td colspan="2" style="border: 0.5px solid #000000; padding: 0px 5px 5px 5px; vertical-align: top; text-align: left;">{{ $article_description }}</td>
            </tr>

            <tr>
                <!-- Sub-header for Désignation, IMEI, and SIM columns -->
                <th style="border: 0.5px solid #000; background-color: #7d3fb3; color: white;padding-bottom: 3px;">Désignation</th>
                <th style="border: 0.5px solid #000; background-color: #7d3fb3; color: white;padding-bottom: 3px;">IMEI du traceur</th>
                <th style="border: 0.5px solid #000; background-color: #7d3fb3; color: white;padding-bottom: 3px;">Numéro de la carte SIM</th>
            </tr>

            <!-- Rows for Traceurs -->
            @if(isset($items))
                @if(count($items) > 0)
                    @foreach($items as $item)
                    <tr>
                        <td style="border: 0.5px solid #000000; text-align: left; padding: 0px 5px 5px 5px; background-color: #ececf6;">{{ $item['title'] }}</td>
                        <td style="border: 0.5px solid #000000; text-align: left; padding: 0px 5px 5px 5px;">{{ $item['imei'] }}</td>
                        <td style="border: 0.5px solid #000000; text-align: left; padding: 0px 5px 5px 5px;">{{ $item['nr_cart_sim'] }}</td>
                    </tr>
                    @endforeach
                @endif
            @endif

            <!-- Footer Row for Notes -->
            <tr>
                <td style="border: 0.5px solid #000000; padding: 5px 5px 5px 5px; text-align: left; background-color: #f1f1f1;"></td>
                <td colspan="2" style="border: 0.5px solid #000000; padding: 5px 5px 5px 5px; text-align: left; background-color: #fff; font-size: 14px;">
                    <em>Selon nos conditions générales de vente et notre tarification des services. Les marchandises commandées ne sont pas remboursées. Les appareils sont la propriété de GVACARS et doivent être retournés une fois le contrat terminé.</em>
                </td>
            </tr>
        </table>


        <div style="border: 0.5px solid #000000;width: 100%;margin-top: 4rem;padding: 1rem 5px 1rem 5px;">
            <p style="line-height: 18px;font-size: 18px;">DATE :</p>
            <p style="line-height: 18px;font-size: 18px;margin-top: 1.5rem !important;">SIGNATURE :</p>
        </div>

        <p style="text-align: center;color: #646464; font-size: 14px; margin-top: 4rem !important;">GVACARS (MAFLOTTE), Impasse du Tilleul 12, 1510 Moudon, contact@maflotte.ch, www.maflotte.ch</p>

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
