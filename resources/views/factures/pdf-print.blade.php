<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
        body {
            padding: 2.5rem;
            padding-top: 0rem;
            margin: 0;
            counter-reset: page;
            font-family: "Nunito", sans-serif;
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
            font-weight: 700;
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
            @if($data['website'] == 'maflotte')
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
            font-weight: 400;
            font-family: "Nunito", sans-serif;
            line-height: 16px !important;
        }
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
            border-bottom: 1px dashed black;
            margin-top: 1rem;
            margin-left: -2.9rem;
            margin-right: -2rem;
            left: 0;
            bottom: 0px;
            position: relative;
            bottom: 0;
            left: 0px;
            height: 290px;
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
        @media print{
            @page{
                /* margin : 0; */
            }
            .page-break{
                page-break-before: always;
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="header">

            <div class="w_50 left d_inline">
                <div>
                    @if($data['type_of_facture'] != 'facture')
                    @else
                    <img 
                        class="logo_header" 
                        src="https://gvagroupe.ch/front/assets/img/logo.webp" 
                    >
                    @endif
                </div>
                <div style="margin-top: 0px;">
                    @if($data['type_of_facture'] != 'facture' || $data['website'] == 'maflotte')
                    <p class="fs_14">&nbsp;</p>
                    <p class="fs_14">&nbsp;</p>
                    <p class="fs_14">&nbsp;</p>
                    @else
                    <!-- <p class="fs_14">Succursale Genève</p> -->
                    <p class="fs_14">Tél: 076/265.33.97</p>
                    <p class="fs_14">CHE-430.201.315</p>
                    @endif
                </div>
            </div>
            @if($data['website'] == 'maflotte')
            <div class="w_50 right d_inline text-right" style="min-height: 100px; vertical-align: top;">
                <div>
                    <img 
                        class="logo_header" 
                        style="width: 150px; object-position: right;"
                        src="https://gvagroupe.ch/front/assets/images/logo-no-bg.png" 
                    >
                </div>
            </div>
            @endif

        </div>

        <div class="w_100 position-relative">
            <div style="margin-top:30px;width: 40%; float: right;">
                @if($data['website'] == 'maflotte' || $data['website'] == 'gvagroupe')
                <p class="fs_11 text-left"><span style="border-bottom: 1px solid black;">GVAGROUPE, Impasse du Tilleul 12, 1510 Moudon</span></p>
                @endif
                @if(isset($data['client']['name']) || isset($data['client']['surname']))
                    <p class="">{{ $data['client']['name'] ?? '' }} {{ $data['client']['surname'] ?? '' }}</p>
                @endif
                
                @if(isset($data['client']['address']))
                    <p class="">{{ $data['client']['address'] }}</p>
                @endif

                @if(isset($data['client']['postal_code']) || isset($data['client']['city']))
                    <p class="">{{ $data['client']['postal_code'] ?? '' }} {{ $data['client']['city'] ?? '' }}</p>
                @endif
                
                @if($data['website'] == 'gvagroupe')
                    @if(isset($data['factured_city']) || isset($data['factured_date']))
                        <p class="" style="margin-top: 4rem !important;">
                            {{ $data['factured_city'] ?? 'City not specified' }}, le {{ date('d.m.Y', strtotime($data['factured_date'] ?? now())) }}
                        </p>
                    @endif
                @endif
            </div>
        </div>

        <div style="height: 240px;width: 100%;"></div>

        <div class="w_100" @if($data['website'] == 'maflotte') style="border-bottom: 1px solid #39afd1;" @else style="border-bottom: 1px solid black;" @endif>
        <div class="w_100 d_inline" @if($data['website'] == 'maflotte') style="border-bottom: 1px solid #39afd1;" @else style="border-bottom: 1px solid black;" @endif>
            <h3 class="title color-black">
                @if(isset($data['name']))
                    @if($data['type_of_facture'] != 'facture')
                        Offre {{ $data['name'] }} 
                    @else
                        Facture {{ $data['name'] }} 
                    @endif
                @else
                    @if($data['type_of_facture'] != 'facture')
                        Offre
                    @else
                        Facture
                    @endif
                @endif
            </h3>

            </div>
            <div class="w_100" style="padding-top: 10px;padding-bottom: 10px;">

                @if($data['website'] == 'gvagroupe')
                <div class="w_100 d_inline" style="border-bottom: 1px solid black;margin-bottom: 8px !important;padding-bottom: 8px;">
                    <div class="w_50 d_inline">
                        <p class="fs_14">Date d’intervention:</p>
                    </div>
                    <div class="w_50 d_inline">
                        <p class="fs_14">{{ date('d/m/Y', strtotime($data['intervenation_date'])) }}</p>
                    </div>
                </div>
                @endif

                @if($data['website'] == 'maflotte')
                <div class="w_50 d_inline" style="margin-top: 3px;">
                    <div class="w_40 d_inline">
                        <p class="fs_14">Date:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14">{{ date('d.m.Y', strtotime($data['factured_date'])) }}</p>
                    </div>
                </div>
                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">Payable jusqu'au:</p>
                    </div>
                    <div class="w_40 d_inline">
                        <p class="fs_14">{{ date('d.m.Y', strtotime($data['payable_end_time'])) }}</p>
                    </div>
                </div>
                <div class="w_50 d_inline">
                    <div class="w_40 d_inline">
                        <p class="fs_14">No de client:</p>
                    </div>
                    <div class="w_40 d_inline">
                        @if(isset($data['client']['id']))
                        <p class="fs_14">{{ $data['client']['id'] }}</p>
                        @endif
                    </div>
                </div>
                @endif

                @if($data['hide_car_details'] == 1 && $data['website'] == 'gvagroupe')
                <div>
                    <div class="w_50 d_inline">
                        <div class="w_40 d_inline">
                            <p class="fs_14">N° plaques:</p>
                        </div>
                        <div class="w_40 d_inline">
                            <p class="fs_14"> {{ $data['plaque'] }}</p>
                        </div>
                    </div>

                    <div class="w_50 d_inline">
                        <div class="w_40 d_inline">
                            <p class="fs_14">Marque:</p>
                        </div>
                        <div class="w_40 d_inline">
                            <p class="fs_14">{{ $data['marque'] }}</p>
                        </div>
                    </div>

                    <div class="w_50 d_inline">
                        <div class="w_40 d_inline">
                            <p class="fs_14">KM Voiture:</p>
                        </div>
                        <div class="w_40 d_inline">
                            <p class="fs_14">{{ $data['km_voiture'] }}</p>
                        </div>
                    </div>

                    <div class="w_50 d_inline">
                        <div class="w_40 d_inline">
                            <p class="fs_14">Type:</p>
                        </div>
                        <div class="w_40 d_inline">
                            <p class="fs_14">{{ $data['type'] }}</p>
                        </div>
                    </div>
                    
                    <div class="w_50 d_inline">
                        <div class="w_40 d_inline">
                            <p class="fs_14">PU. KW:</p>
                        </div>
                        <div class="w_40 d_inline">
                            <p class="fs_14">{{ $data['pu_km'] }}</p>
                        </div>
                    </div>

                    <div class="w_50 d_inline">
                        <div class="w_40 d_inline">
                            <p class="fs_14">Châssis:</p>
                        </div>
                        <div class="w_40 d_inline">
                            <p class="" style="font-size: 13px!important; line-height: 12px !important;"> {{ $data['chassis'] }}</p>
                        </div>
                    </div>

                    <div class="w_50 d_inline">
                        <div class="w_40 d_inline">
                            <p class="fs_14">Année:</p>
                        </div>
                        <div class="w_40 d_inline">
                            <p class="fs_14">{{ $data['year'] }}</p>
                        </div>
                    </div>

                    <div class="w_50 d_inline">
                        <div class="w_40 d_inline">
                            <p class="fs_14">HML:</p>
                        </div>
                        <div class="w_40 d_inline">
                            <p class="fs_14">{{ $data['hml'] }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($data['type_of_facture'] != 'offers')
        <p style="margin-top: 2rem !important;margin-bottom:7px !important;" class="fs_14">
            @if(isset($data['client']['name']) || isset($data['client']['surname']))
                Bonjour {{ $data['client']['name'] ?? '' }} {{ $data['client']['surname'] ?? '' }},
            @endif
        </p>
        @endif

        @if($data['type_of_facture'] != 'offers')
        <p style="margin-top: 0px !important;margin-bottom:0px !important;" class="fs_14">Merci pour votre confiance. Veuillez trouver votre facture ci-dessous:</p>
        @endif

        <table class="w_100" style="margin-top: 2rem;">
            <tr>
                @if($data['website'] !== 'maflotte')
                <th class="fs_14">Position</th>
                @endif
                <th class="fs_14" style="width: 50%;">Description</th>
                <th class="text-right fs_14">Quantité</th>
                <th class="text-right fs_14">Prix unitaire</th>
                <th class="text-right fs_14">Prix total</th>
            </tr>
            @if(isset($data['items']) && count($data['items']) > 0)
            @foreach($data['items'] as $item)
            <tr>
                @if($data['website'] !== 'maflotte')
                <td class="fs_14">{{ $loop->index + 1 }}</td>
                @endif
                <td class="fs_14" style="width: 50%;word-wrap: break-word;white-space: normal;">
                    <textarea>{!! html_entity_decode($item['title']) !!}</textarea>
                    @if($data['website'] == 'maflotte' && $data['subscription_start_date'])<span style="font-size: 14px; line-height: 12px !important;">Pour la période du <span id="subscription_start_date_text">{{ date('d.m.Y', strtotime($data['subscription_start_date'])) }}</span> au <span id="subscription_end_date_text">{{ date('d.m.Y', strtotime($data['subscription_end_date'])) }}</span></span> @endif
                </td>
                <td class="text-right fs_14">{{ $item['quantity'] }}</td>
                <td class="text-right fs_14">{{ $item['prix_unitaire'] }}</td>
                <td class="text-right fs_14">{{ $item['total_chf'] }}</td>
            </tr>
            @endforeach
            @endif
            @if(isset($data['tvsh']) && $data['tvsh'] > 0 ?? null)
            <tr class="total-row">
                <td></td>
                <td colspan="@if($data['website'] !== 'maflotte') 3 @else 3 @endif"  class="fs_14"><span class="font_bold">Total</span> <br/> TVA en sus {{ $data['tvsh'] }}%</td>
                <td class="text-right fs_14"><span class="font_bold">{{ $data['total_hors_price'] }}</span> <br/> {{ $data['total_tva'] }}</td>
            </tr>
            @endif
            <!-- <tr>
                <td colspan="4">TVA en sus 0.00%</td>
                <td class="text-right">0.00</td>
            </tr> -->
            <tr class="total-row">
                @if($data['website'] !== 'maflotte')
                <td></td>
                @endif
                @if(isset($data['tvsh']) && $data['tvsh'] > 0)
                <td colspan="@if($data['website'] !== 'maflotte') 3 @else 3 @endif" class="font_bold fs_14">Montant de la facture (taxe comprise) CHF</td>
                @else
                <td colspan="@if($data['website'] !== 'maflotte') 3 @else 3 @endif" class="font_bold fs_14">Montant de la facture (exonéré de la TVA)</td>
                @endif
                <td class="font_bold text-right fs_14">{{ $data['total_ttc'] }}</td>
            </tr>
        </table>

        <p style="margin-top: 2rem !important;margin-bottom:7px !important;" class="fs_14">Vous avez des questions? N’hésitez pas à nous contacter!</p>
        <p class="mt_2 fs_14">Cordialement
            <br/> 
            @if(isset($data['cordialement']))
                {{ $data['cordialement'] }}
            @else
                Alban Shabani
            @endif
        .</p>
    </div>

    <div style="position: relative;">
        @include('factures.payment')
    </div>
    <script>
        window.print()
    </script>
</body>
</html>
