@php
    if(isset($data['name'])){
        $name = $data['name'];
    }

    if(isset($data['total_ttc'])){
        $total_ttc = $data['total_ttc'];
    }

    if(isset($data['client'])){
        $client = $data['client'];
    }

    // Example name from the database
    $nameNumber = $name;

    // Step 1: Extract the numeric part from the string using preg_replace
    $numericPart = preg_replace('/[^0-9]/', '', $nameNumber);

    // Step 2: Pad the number to make it 26 digits long (with leading zeros)
    $paddedNumber = str_pad($numericPart, 26, '0', STR_PAD_LEFT);

    // Step 3: Format the number to match the desired pattern
    // 00 0000 00000 00000 00000 00123
    $formattedNumber = substr($paddedNumber, 0, 2) . ' ' . 
                       substr($paddedNumber, 2, 4) . ' ' . 
                       substr($paddedNumber, 6, 5) . ' ' . 
                       substr($paddedNumber, 11, 5) . ' ' . 
                       substr($paddedNumber, 16, 5) . ' ' . 
                       substr($paddedNumber, 21);


@endphp
<section class="payment page-break" style="break-after:page">
    @if(isset($data))
    <div class="w_30 left d_inline" style="border-right: 1px dashed black;vertical-align: top;padding-bottom: 2rem;position: relative;">
    @else
    <div class="w_30 left d_inline" style="border-right: 1px dashed black;vertical-align: top;padding-bottom: 6rem;position: relative;">
    @endif
    <div style="background-color: white; width: 11px; height: 11px;position: absolute; right: -6.5px;top:10px;">
            <img 
                src="https://gvacars.ch/front/images/scissors.png"
                style="width: 10px; height: 10px;"
            />
        </div>
        <div style="background-color: white; width: 11px; height: 11px;position: absolute; left: 1rem;top:-6.5px;transform: rotate(-90deg)">
            <img 
                src="https://gvacars.ch/front/images/scissors.png"
                style="width: 10px; height: 10px;"
            />
        </div>
        <!-- <div style="width: 1px; height: 100%;background-color: black;position: absolute; right: 0; top: 0;"></div> -->
        <p class="fs_16 font_bold" style="margin-top: 0.6rem !important;margin-bottom: 0.2rem !important;margin-left: 1rem !important;">Récépissé</p>
        <p class="fs_10 font_bold" style="margin-left: 1rem !important;">Compte / Payable à</p>
        <p class="fs_11" style="line-height: 11px;margin-left: 1rem !important;">CH10 0900 0000 1631 6822 5</p>
        <p class="fs_11" style="line-height: 11px;margin-left: 1rem !important;">GVACARS</p>
        <p class="fs_11" style="line-height: 11px;margin-left: 1rem !important;">Impasse du Tilleul 12</p>
        <p class="fs_11" style="line-height: 11px;margin-left: 1rem !important;">1510 Moudon</p>

        <p class="fs_10 font_bold" style="margin-left: 1rem !important;margin-top: 0.5rem !important;">Référence</p>
        <p class="fs_11" style="line-height: 11px;margin-left: 1rem !important;">{{ $formattedNumber }}</p>

        <p class="fs_10 font_bold" style="margin-top: 0.5rem !important;margin-left: 1rem !important;">Payable par</p>
        @if(isset($client['name']) || isset($client['surname']))
            <p class="fs_11" style="line-height: 11px;margin-left: 1rem !important;">{{ $client['name'] ?? '' }} {{ $client['surname'] ?? '' }}</p>
        @endif
        @if(isset($client['address']))
            <p class="fs_11" style="line-height: 11px;margin-left: 1rem !important;">{{ $client['address'] }}</p>
        @endif

        @if(isset($client['postal_code']) || isset($client['city']))
            <p class="fs_11" style="line-height: 11px;margin-left: 1rem !important;">{{ $client['postal_code'] ?? '' }} {{ $client['city'] ?? '' }}</p>
        @endif

        <div class="d_inline" style="vertical-align:top;margin-left: 1rem !important;">
            <p class="fs_11 font_bold" style="margin-top: 1.5rem !important;line-height: 11px;">Monnaie</p>
            <p class="fs_13" style="line-height: 13px;">CHF</p>
        </div>
        <div class="d_inline" style="vertical-align:top;margin-left: 1rem !important;">
            <p class="fs_11 font_bold" style="margin-top: 1.5rem !important; line-height: 11px;">Montant</p>
            <p class="fs_12" style="line-height: 12px;">{{ $total_ttc }}</p>
        </div>
        <p class="fs_11 font_bold" style="text-align: right;margin-top: 15px !important;margin-right: 0.6rem;">Point de dépôt</p>
        
    </div>
    <div class="right d_inline" style="padding-left: 0.6rem;vertical-align: top; width: 67.5%;">
        <div class="d_inline" style="width: 35%;vertical-align: top">
            <p class="fs_16 font_bold" style="margin-top: 0.6rem !important;">Section paiement</p>
            <img 
                src="https://gvacars.ch/front/images/QR.png"
                style="width: 170px; height: 170px;margin-top:1rem;"
            />
        </div>
        
        <div class="d_inline"  style="width: 52%;vertical-align: top;">
            <p class="fs_13 font_bold" style="margin-top: 0.6rem !important;">Compte / Payable à</p>
            <p class="fs_12" style="line-height: 12px;">CH10 0900 0000 1631 6822 5</p>
            <p class="fs_12" style="line-height: 12px;">GVACARS</p>
            <p class="fs_12" style="line-height: 12px;">Impasse du Tilleul 12</p>
            <p class="fs_12" style="line-height: 12px;">1510 Moudon</p>

            <p class="fs_10 font_bold" style="margin-top: 0.5rem !important;">Référence</p>
            <p class="fs_11" style="line-height: 11px;">{{ $formattedNumber }}</p>

            <p class="fs_13 font_bold" style="margin-top: 0.6rem !important;">Payable par</p>
            @if(isset($client['name']) || isset($client['surname']))
                <p class="fs_12" style="line-height: 12px;">{{ $client['name'] ?? '' }} {{ $client['surname'] ?? '' }}</p>
            @endif
            @if(isset($client['address']))
                <p class="fs_12" style="line-height: 12px;">{{ $client['address'] }}</p>
            @endif

            @if(isset($client['postal_code']) || isset($client['city']))
                <p class="fs_12" style="line-height: 12px;">{{ $client['postal_code'] ?? '' }} {{ $client['city'] ?? '' }}</p>
            @endif
        </div>

        <div class="w_100">
            <div class="d_inline" style="vertical-align:top;">
                <p class="fs_11 font_bold" style="margin-top: 1rem !important;line-height: 11px;">Monnaie</p>
                <p class="fs_13" style="line-height: 13px;">CHF</p>
            </div>
            <div class="d_inline" style="vertical-align:top;margin-left: 10px;">
                <p class="fs_11 font_bold" style="margin-top: 1rem !important;line-height: 11px;">Montant</p>
                <p class="fs_12" style="line-height: 12px;">{{ $total_ttc }}</p>
            </div>
        </div>
    </div>
    @if(!isset($data))
    <div style="position:relative;bottom: 75px;left: 350px; width: 100px; height: 20px;background-color: white;"></div>
    @endif
</section>