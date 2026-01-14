@extends('emails.layouts.default-layout')

@section('content')
<div>
    <p>
    Bonjour {{ $data['client']['name'] }} {{ $data['client']['surname'] }}, <br/><br/>

    J'espère que vous allez bien. Veuillez trouver ci-joint la facture numéro {{ $data['name'] }} concernant les services fournis en @if($data['intervenation_date']) {{ date('d.m.Y', strtotime($data['intervenation_date'])) }} @else {{ date('d.m.Y', strtotime($data['factured_date'])) }} @endif. Nous vous prions de bien vouloir procéder au règlement dans les délais spécifiés selon les termes de paiement.
    <br/><br/>
    N'hésitez pas à nous contacter si vous avez des questions ou si vous avez besoin de renseignements supplémentaires.
    <br/><br/>
    Nous vous remercions de votre confiance et restons à votre disposition pour toute information complémentaire.
    <br/><br/>
    Cordialement,<br/>
    @if($data['website'] == 'gvacars')
    GVACARS<br/>
    @else
    MAFLOTTE<br/>
    @endif
    @if($data['website'] == 'gvacars')
    contact@gvacars.ch <br/>
    076/265.33.97 <br/>
    @endif
    </p>
</div>
@endsection