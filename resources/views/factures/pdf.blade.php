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
            /* font-family: "Times Roman", serif; */
            padding: 2.5rem;
            padding-top: 0rem;
            /* padding-bottom: 0rem !important; */
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
        .box .header .right{
            /* min-height: 150px; */
        }
        .box .header .left{
            /* min-height: 150px; */
        }
        .box .header .right input{
            font-size: 16px;
        }
        .box input{
            margin-top: 5px;
            min-width: 250px;
            border: 0px;
            outline: 0;
            color: #000;
            font-size: 14px;
        }
        .title{margin-top: 0rem;margin-bottom: 0.2rem;}
        .color-black{color: #000;}
        .d_inline{display: inline-block;}
        .auto_detail_title{
            max-width: 100px;
            width: 100px;
        }
        .auto_detail_grid input{
            min-width: 200px;
        }
        .intervenation{
            margin-top: 2rem;
            margin-bottom: 2rem !important;
        }
        .attention{
            margin-top: 1.5rem;
            margin-bottom: 0px !important;
            color: red;
        }
        .mt_2{margin-top: 2rem !important;}
        .font_bold{
            font-family: "Roboto", sans-serif;
            font-weight: 700;
            font-style: normal;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th {
            /* border: 1px solid black; */
            padding: 8px 0px 8px 0px !important;
            text-align: left;
            color: #000;
            font-size: 14px;
        }

        td {
            @if($website == 'maflotte')
            border: 1px solid #39afd1;
            @else
            border: 1px solid black;
            @endif
            border-left: 0px;
            border-right: 0px;
            padding: 8px 0px 8px 0px !important;
            text-align: left;
            color: #000;
        }
        textarea{
            margin-top: 0px !important;
            width: 100%;
            border: 0px;
            outline: 0;
            color: #000;
            font-size: 14px;
            height: auto;
            font-family: "Roboto", sans-serif;
            line-height: 14px !important;
            margin-bottom: -3px !important;
        }
        /* .table_car_details p{
            line-height: 0px !important;
        } */
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
        .payment{
            width: 800px;
            border-top: 1px dashed black;
            margin-top: 5rem;
            margin-left: -2.9rem;
            margin-right: -2rem;
            left: 0;
            bottom: 0;
            position: absolute;
            bottom: 0;
            left: 0px;
            height: 364px;
        }
        .arrow::before {
            content: " ";
            border-left: 1px solid #000;
            border-bottom: 1px solid #000;
            width: 10px;
            height: 10px;
            transform: rotate(90deg);
            cursor: pointer;
            display: block;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="header">

            <div class="w_50 left d_inline">
                <div>
                @if($type_of_facture != 'facture')
                @else
                    <img 
                        class="logo_header" 
                        src="https://gvacars.ch/front/assets/img/logo.webp" 
                    >
                @endif
                </div>
                <div style="margin-top: 0px;">
                @if($type_of_facture != 'facture' || $website == 'maflotte')
                    <p class="fs_14">&nbsp;</p>
                    <p class="fs_14">&nbsp;</p>
                    <p class="fs_14">&nbsp;</p>
                @else
                    {{-- <p class="fs_14">Succursale Genève</p> --}}
                    <p class="fs_14">Tél: 076/265.33.97</p>
                    <p class="fs_14">CHE-430.201.315</p>
                @endif
                </div>
            </div>
            @if($website == 'maflotte')
            <div class="w_50 right d_inline text-right" style="min-height: 100px;">
                <div>
                    <img 
                        class="logo_header" 
                        src="https://gvacars.ch/front/assets/images/logo-no-bg.png" 
                    >
                </div>
            </div>
            @endif

        </div>

        <div class="w_100 position-relative text-right">
            <div style="margin-top:30px;width: 40%; float: right;">
                @if($website == 'maflotte' || $website == 'gvacars')
                <p class="fs_11 text-left"><span style="border-bottom: 1px solid black;">GVACARS, Impasse du Tilleul 12, 1510 Moudon</span></p>
                @endif
                @if(isset($client['name']) || isset($client['surname']))
                    <p class="fs_12 text-left">{{ $client['name'] ?? '' }} {{ $client['surname'] ?? '' }}</p>
                @endif

                @if(isset($client['address']))
                    <p class="fs_12 text-left">{{ $client['address'] }}</p>
                @endif

                @if(isset($client['postal_code']) || isset($client['city']))
                    <p class="fs_12 text-left">{{ $client['postal_code'] ?? '' }} {{ $client['city'] ?? '' }}</p>
                @endif
                @if($website == 'gvacars')
                    @if(isset($factured_city) || isset($factured_date))
                        <p class="fs_16 text-left" style="margin-top: 4rem !important;">
                            {{ $factured_city ?? 'City not specified' }}, le {{ date('d.m.Y', strtotime($factured_date ?? now())) }}
                        </p>  
                    @endif
                @endif
            </div>
        </div>

        <div style="height: 240px;width: 100%;"></div>

        <div class="w_100"  @if($website == 'maflotte') style="border-bottom: 1px solid #39afd1;" @else style="border-bottom: 1px solid black;" @endif>
            <div class="w_100 d_inline" @if($website == 'maflotte') style="border-bottom: 1px solid #39afd1;" @else style="border-bottom: 1px solid black;" @endif>
                <h3 class="title color-black">
                    @if($type_of_facture != 'facture')
                        Offre
                    @else
                        Facture 
                    @endif
                    @if(isset($name))
                        {{$name}}
                    @endif
                </h3>
            </div>
            <div class="w_100 table_car_details" style="padding-top: 5px;padding-bottom: 0px;">

                @if($website == 'gvacars' && $type_of_facture != 'offers')
                <div class="w_100 d_inline" style="border-bottom: 1px solid black;margin-bottom: 10px !important;padding-bottom: 0px;">
                    <div class="w_50 d_inline">
                        <p class="fs_14">Date d’intervention:</p>
                    </div>
                    <div class="w_50 d_inline">
                        <p class="fs_14">{{ date('d/m/Y', strtotime($intervenation_date)) }}</p>
                    </div>
                </div>
                @endif

                @if($website == 'maflotte')
                <div class="w_50 d_inline" style="margin-top: 3px;">
                    <div class="w_40 d_inline">
                        <p class="fs_14">Date:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14">{{ date('d.m.Y', strtotime($factured_date)) }}</p>
                    </div>
                </div>
                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">Payable jusqu'au:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14">{{ date('d.m.Y', strtotime($payable_end_time)) }}</p>
                    </div>
                </div>
                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">No de client:</p>
                    </div>
                    <div class="w_40 d_inline">
                        @if(isset($client['id']))
                        <p class="fs_14">{{ $client['id'] }}</p>
                        @endif
                    </div>
                </div>
                @endif
                
                @if($hide_car_details == 1 && $website !== 'maflotte')
                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">N° plaques:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14"> {{ $plaque }}</p>
                    </div>
                </div>

                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">Marque:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14"> {{ $marque }}</p>
                    </div>
                </div>

                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">KM Voiture:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14"> {{ $km_voiture }}</p>
                    </div>
                </div>

                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">Type:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14"> {{ $type }}</p>
                    </div>
                </div>

                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">PU. KW:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14"> {{ $pu_km }}</p>
                    </div>
                </div>

                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">Châssis:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="" style="font-size: 13px!important; line-height: 12px !important;"> {{ $chassis }}</p>
                    </div>
                </div>

                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">Année:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14"> {{ $year }}</p>
                    </div>
                </div>

                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">HML:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14"> {{ $hml }}</p>
                    </div>
                </div>
                @endif

            </div>
        </div>

        @if($type_of_facture != 'offers')
        <p style="margin-top: 2rem !important;margin-bottom:7px !important;" class="fs_14">
            @if(isset($client['name']) || isset($client['surname']))
                Bonjour {{ $client['name'] ?? '' }} {{ $client['surname'] ?? '' }}
            @endif
        </p>
        @endif

        @if($type_of_facture != 'offers')
        <p style="margin-top: 0px !important;margin-bottom:0px !important;" class="fs_14">Merci pour votre confiance. Veuillez trouver votre facture ci-dessous:</p>
        @endif

        <table class="w_100" style="margin-top: 2.5rem;">
            <tr>
                @if($website !== 'maflotte')
                <th class="fs_14" style="width: 50px;">Position</th>
                @endif
                <th class="fs_14" style="width: 50%;">Description</th>
                <th class="text-right fs_14">Quantité</th>
                <th class="text-right fs_14">Prix unitaire</th>
                <th class="text-right fs_14">Prix total</th>
            </tr>
            @if(isset($items) && count($items) > 0)
            @foreach($items as $item)
            <tr>
                @if($website !== 'maflotte')
                <td class="fs_14" style="width: 30px;">{{ $loop->index + 1 }}</td>
                @endif
                <td class="fs_14" style="width: 50%;word-wrap: break-word;white-space: normal;">
                    <textarea>{!! html_entity_decode($item['title']) !!}</textarea>
                    @if($website == 'maflotte' && $subscription_start_date)<span style="font-size: 14px; line-height: 0px !important;margin-left:4px;">Pour la période du <span id="subscription_start_date_text">{{ date('d.m.Y', strtotime($subscription_start_date)) }}</span> au <span id="subscription_end_date_text">{{ date('d.m.Y', strtotime($subscription_end_date)) }}</span></span> @endif
                </td>
                <td class="text-right fs_14">{{ $item['quantity'] }}</td>
                <td class="text-right fs_14">{{ $item['prix_unitaire'] }}</td>
                <td class="text-right fs_14">@if($item['total_chf'] > 0) {{ $item['total_chf']}} @endif</td>
            </tr>
            @endforeach
            @endif
            @if(isset($tvsh) && $tvsh > 0)
            <tr class="total-row">
                <td></td>
                <td colspan="3" class="fs_14"><span class="font_bold">Total</span> <br/> TVA en sus {{ $tvsh }}%</td>
                <td class="text-right fs_14"><span class="font_bold">{{ $total_hors_price }}</span> <br/> {{ $total_tva }}</td>
            </tr> 
            @endif
            <tr class="total-row">
                @if($website !== 'maflotte')
                <td></td>
                @endif
                @if(isset($tvsh) && $tvsh > 0)
                <td colspan="@if($website !== 'maflotte') 3 @else 3 @endif" class="font_bold fs_14">Montant de la facture (taxe comprise) CHF</td>
                @else
                <td colspan="@if($website !== 'maflotte') 3 @else 3 @endif" class="font_bold fs_14">Montant de la facture (exonéré de la TVA)</td>
                @endif
                <td class="font_bold text-right fs_14">{{ $total_ttc }}</td>
            </tr>
        </table>

        {{--<div class="auto_detail_grid d_inline">

            <div class="auto_detail">
                <div class="auto_detail_title d_inline">
                    <p class="fs_16">N° plaques</p>
                </div>
                <p class="d_inline fs_16">{{ $plaque }}</p>
            </div>

            <div class="auto_detail">
                <div class="auto_detail_title d_inline">
                    <p class="fs_16">KM Voiture</p>
                </div>
                <p class="d_inline fs_16">{{ $km_voiture }}</p>
            </div>

            <div class="auto_detail">
                <div class="auto_detail_title d_inline">
                    <p class="fs_16">PU. KW</p>
                </div>
                <p class="d_inline fs_16">{{ $pu_km }}</p>
            </div>
            
            <div class="auto_detail">
                <div class="auto_detail_title d_inline">
                    <p class="fs_16">Année</p>
                </div>
                <p class="d_inline fs_16">{{ $year }}</p>
            </div>

        </div>--}}

        {{--<div class="auto_detail_grid d_inline" style="margin-left: 2rem;">

            <div class="auto_detail">
                <div class="auto_detail_title d_inline">
                    <p class="fs_16">Marque</p>
                </div>
                <p class="d_inline fs_16">{{ $marque }}</p>
            </div>

            <div class="auto_detail">
                <div class="auto_detail_title d_inline">
                    <p class="fs_16">Type</p>
                </div>
                <p class="d_inline fs_16">{{ $type }}</p>
            </div>

            <div class="auto_detail">
                <div class="auto_detail_title d_inline">
                    <p class="fs_16">Châssis</p>
                </div>
                <p class="d_inline fs_16">{{ $chassis }}</p>
            </div>
            
            <div class="auto_detail">
                <div class="auto_detail_title d_inline">
                    <p class="fs_16">HML</p>
                </div>
                <p class="d_inline fs_16">{{ $hml }}</p>
            </div>

        </div> --}}

        {{-- <p class="intervenation font_bold">Intervention le {{ $intervenation_date }}</p>--}}

        {{-- <table class="w_100">
            <tr>
                <td class="fs_16 font_bold">Désignation</td>
                <td class="fs_16 font_bold">Prix unitaire</td>
                <td class="fs_16 font_bold">Quantité</td>
                <td class="fs_16 font_bold">Total CHF</td>
            </tr>
            @if(isset($items) && count($items) > 0)
            @foreach($items as $item)
            <tr class="item">
                <td style="width: 45%;">
                    <p class="fs_16">{{ $item['title'] }} </p>
                </td>
                <td>
                    <p class="text-right fs_16">{{ $item['prix_unitaire'] }} CHF</p>
                </td>
                <td>
                    <p class="text-right fs_16">{{ $item['quantity'] }}</p>
                </td>
                <td>
                    <p class="text-right fs_16">{{ $item['total_chf'] }} CHF</p>
                </td>
            </tr>
            @endforeach
            @endif
            <tr>
                <td class="fs_16">&nbsp;</td>
                <td class="fs_16">&nbsp;</td>
                <td class="fs_16">&nbsp;</td>
                <td class="fs_16">&nbsp;</td>
            </tr>
            <tr>
                <td class="fs_16 font_bold">Total hors TVA</td>
                <td class="text-right fs_16 font_bold">{{ $total_hors_tva }} CHF</td>
                <td class="text-right fs_16 font_bold">{{ $total_hors_quantity }}</td>
                <td class="text-right fs_16 font_bold">{{ $total_hors_price }} CHF</td>
            </tr>
            <tr>
                <td class="fs_18">
                    <span class="d_inline font_bold">TVA</span>
                    <span class="d_inline font_bold" style="float:right;">{{ $tvsh }}%</span>
                </td>
                <td class="fs_18 text-center font_bold" colspan="3">{{ $total_tva }} CHF</td>
            </tr>
            <tr>
                <td class="fs_18 font_bold">Total TTC</td>
                <td class="fs_18 text-center font_bold" colspan="3">{{ $total_ttc }} CHF</td>
            </tr>
        </table>--}}

       {{--<h3 class="attention">ATTENTION</h3>
        <p class="fs_16">Vous convenez que le réparateur ne sera responsable envers vous ni envers aucun tiers <br/> d'aucune modification des services effectués.</p>
       --}}

       {{--
       <div style="margin-top: 2rem;" class="page-break">
            <h3>Détails de paiement</h3>
            <p class="fs_14"><span class="font_bold">Banque:</span> PostFinance AG</p>
            <p class="fs_14"><span class="font_bold">Titulaire du compte:</span> GVACARS</p>
            <p class="fs_14"><span class="font_bold">BIC:</span> POFICHBEXXX</p>
            <p class="fs_14"><span class="font_bold">IBAN:</span> CH10 0900 0000 1631 6822 5</p>
            <p class="fs_14"><span class="font_bold">E-mail:</span> contact@gvacars.ch</p>
       </div>--}}

       <p style="margin-top: 2rem !important;margin-bottom:7px !important;" class="fs_14">Vous avez des questions? N’hésitez pas à nous contacter!</p>
        <p class="mt_2 fs_14">Cordialement
            <br/> 
            @if(isset($cordialement))
                {{ $cordialement }}
            @else
                Alban Shabani
            @endif 
        </p>

    </div>

    @include('factures.payment')
    
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
