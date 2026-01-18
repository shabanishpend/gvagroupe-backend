<!DOCTYPE html>
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
            padding-top: 1rem !important;
            margin: 0;
            font-family: "Roboto", sans-serif;
        }
        .box {
            background-color: #fff;
            width: 100%;
        }
        .logo_header {
            object-fit: contain;
            object-position: top;
            width: 200px;
            height: 33.79px;
        }
        .header {
            width: 100%;
            padding-top: 0rem;
        }
        .d_inline {
            display: inline-block;
        }
        .w_50 {
            width: 49.5%;
        }
        .text-right {
            text-align: right;
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
            border: 1px solid black;
            border-left: 0px;
            border-right: 0px;
            padding: 8px 5px 8px 0px !important;
            text-align: left;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="header">
            <div class="w_50 left d_inline" style="vertical-align: top;">
                <div>
                    <img class="logo_header" src="https://gvagroupe.ch/front/assets/img/logo.webp">
                </div>
            </div>
     
            <div class="w_50 right d_inline text-right" style="min-height: 100px;">
                <div>
                </div>
            </div>
        </div>

        <div>
            <h3>Rapport des factures @if(isset($dateFrom))du {{ date('d.m.Y', strtotime($dateFrom)) }} @endif @if(!isset($dateFrom)) jusqu'à  @else au @endif {{ date('d.m.Y', strtotime($dateTo)) }}</h3>

            <p style="margin-top: 1rem;font-size: 14px;">Ce rapport fournit un aperçu détaillé de toutes les factures générées entre le @if(isset($dateFrom))du {{ date('d.m.Y', strtotime($dateFrom)) }} @endif @if(!isset($dateFrom)) jusqu'à  @else au @endif {{ date('d.m.Y', strtotime($dateTo)) }}. Il inclut le nombre total de factures, le revenu total, les détails des clients et d'autres informations pertinentes. L'objectif de ce rapport est d'offrir des informations sur la performance financière et les tendances pour la période spécifiée.</p>
        </div>

        @if(isset($client))
            <p>Client: <span style="font-weight: bold;"> {{ $client->name }} {{ $client->surname }}</span></p>
        @endif

        <div>
            <table style="width: 100%;font-size: 12px;">
                <thead>
                    <tr>
                        <th style="width: 5%;font-size: 12px;">#</th>
                        <th style="width: 30%;font-size: 12px;">Entreprise / Nom et Prénom</th>
                        <th style="font-size: 12px;">Référence</th>
                        {{--<th>Prix ​​total</th> --}}
                        <th style="font-size: 12px;">Date de facturation</th>
                        <th style="font-size: 12px;">Crédit / Entrée</th>
                        <th style="font-size: 12px;">Débit / Sortie</th>
                        <th style="width: 8%;">Type</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($factures))
                    @foreach($factures as $facture)
                        <tr>
                            <td style="vertical-align: middle;">{{ $loop->index + 1 }}</td>
                            <td style="vertical-align: middle;">
                                @if($facture['type_of_facture'] == 'cost')
                                    @if(isset($facture->categoryAtached) && isset($facture->categoryAtached->subCategory))
                                        {{ $facture->categoryAtached->name }} / {{ $facture->categoryAtached->subCategory->name }}
                                    @else
                                        {{ $facture->categoryAtached->name }}
                                    @endif
                                @endif

                                @if($facture->type_of_facture == 'facture')
                                    {{ optional($facture->client)->name ?? '' }} {{ optional($facture->client)->surname ?? '' }}
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if($facture->type_of_facture == 'cost')
                                    DE-{{ $facture->id }}
                                @else
                                    {{ $facture->name }}
                                @endif
                            </td>
                           {{-- <td style="vertical-align: middle;">
                                @if($facture['type_of_facture'] == 'cost')
                                    {{ number_format($facture->total_price, 2, '.', "'") }} CHF
                                @endif

                                @if($facture->type_of_facture == 'facture')
                                    {{ number_format($facture->total_ttc, 2, '.', "'") }} CHF
                                @endif
                            </td> --}}
                            <td style="vertical-align: middle;">
                                @if($facture->type_of_facture == 'cost')
                                    {{ date('d.m.Y', strtotime($facture->payed_date)) }}
                                @else
                                    {{ date('d.m.Y', strtotime($facture->factured_date)) }}
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if($facture->type_of_facture == 'cost')
                                @else
                                    {{ number_format($facture->total_ttc, 2, '.', "'") }} CHF
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if($facture->type_of_facture == 'cost')
                                {{ number_format($facture->total_price, 2, '.', "'") }} CHF
                                @else
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                @if($facture->type_of_facture == 'cost')
                                    Dépenses
                                @else
                                    Facture
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <p style="margin-top: 2rem;margin-bottom: 0px !important;">Le total des prix des Crédit / Entrée est: <span style="font-weight: bold;">CHF {{ number_format($total_price, 2, '.', "'") }}</span></p>
            <p style="margin-top: 0rem;">Le total des prix des Débit / Sortie est: <span style="font-weight: bold;">CHF {{ number_format($total_price_depenses, 2, '.', "'") }}</span></p>
            <p style="margin-top: 2rem;font-size: 12px;">Ce rapport est généré à cette date : {{ \Carbon\Carbon::now()->format('d.m.Y H:i') }}</p>
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
