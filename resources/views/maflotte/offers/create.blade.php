@extends('layouts.admin')
@section('title', "Créer Offre")

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'gvagroupe',
                'showBackButton' => true,
                'backRoute' => 'offres',
                'backRouteParams' => [$website ?? 'maflotte'],
                'items' => [
                    ['label' => 'Gestion des offres', 'route' => 'offres', 'routeParams' => [$website ?? 'maflotte']],
                    ['label' => 'Offres', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer une offre</h5>
                </div>
                <div class="card-body">
    <div class="row">
        <form method="POST" action="{{ route('offres.update', ['maflotte']) }}" class="row w-100" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"  />
            <input type="hidden" name="type_action" value="create"  />

            <div class="w-100">
                <!-- Tab panes -->
                <div class="tab-content mt-3">
                    <div class="tab-pane active p-0" id="french">
                        <div class="row">

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="type">Type</label>
                                <select class="form-control select2" id="type" data-toggle="select2" name="type">
                                    <option value="year">Annuel</option>
                                    <option value="2-year">2 Annuels</option>
                                    <option value="3-year">3 Annuels</option>
                                    <option value="4-year">4 Annuels</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="cars_number">Nombre de voiture</label>
                                <input type="number" class="form-control" name="cars_number" id="cars_number" placeholder="Nombre de voiture" value="{{ old('cars_number') }}" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="price">Prix ​​Général</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Prix ​​général" value="{{ old('price') }}" required>
                                </div>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="price_discount">Prix ​​réduit</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price_discount" id="price_discount" placeholder="Prix ​​réduit" value="{{ old('price_discount') }}" required>
                                </div>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="client_id">Client</label>
                                <select class="form-control select2" id="client_id" data-toggle="select2" name="client_id" required>
                                    <option value=""></option>
                                    @if(isset($clients) && count($clients) > 0)
                                        @foreach($clients as $client)
                                            <option 
                                                value="{{ $client->id }}" 
                                                data-id="{{ $client->id }}"
                                                data-surname="{{ $client->surname }}"
                                                data-address="{{ $client->address }}"
                                                data-city="{{ $client->city }}"
                                                data-name="{{ $client->name }}"
                                                data-postal-code="{{ $client->postal_code }}"
                                            >
                                                {{ $client->name }} {{ $client->surname }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="services">Services</label>
                                <div class="input-group w-100">
                                    <textarea rows="7" class="form-control" name="services">Services compris dans l’offre :
&nbsp;&nbsp;&nbsp;• Installation de l’appareil
&nbsp;&nbsp;&nbsp;• Ouverture du compte + paramétrages
&nbsp;&nbsp;&nbsp;• Formation d’utilisation de la plateforme
&nbsp;&nbsp;&nbsp;• Service après vente, dépannages
&nbsp;&nbsp;&nbsp;• Localisation temps réel + historique d’un an
&nbsp;&nbsp;&nbsp;• Rapport d’activité personnalisé
&nbsp;&nbsp;&nbsp;• Décompte kilométrique des véhicules
&nbsp;&nbsp;&nbsp;• Application mobile
&nbsp;&nbsp;&nbsp;• Accessibilité et données dans 100 payes</textarea>
                                </div>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="conditions">Conditions</label>
                                <div class="input-group w-100">
                                    <textarea rows="7" class="form-control" name="conditions">Conditions de livraison et de paiement : Selon nos conditions générales de vente et notre tarification des services. Validité de l’offre : 1 mois. Les marchandises commandées ne sont pas remboursées.
- Les appareils de géolocalisation appartiennent à MAFLOTTE et sont récupérés à la fin du contrat
- Le délai de livraison est de 2 à 4 semaines à la réception de la commande.
- La proposition signée par les deux partis est un engagement contractuel et irrévocable.
- En cas d’annulation de ce contrat avant la livraison par l’acheteur, MAFLOTTE est en droit d’exiger 50 % sur le montant total du contrat payable à 15 jours. Cette close fait partie intégrante de nos conditions de ventes.
La durée du contrat est de 12 mois. Le contrat est reconduit tacitement d’année en année. La résiliation du présent contrat se fait par lettre recommandée en respectant un préavis de 3 mois avant l’expiration de la période en cours.</textarea>
                                </div>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="signature_footer">Signature</label>
                                <div class="input-group w-100">
                                    <textarea rows="7" class="form-control" name="signature_footer">Lu et approuvé
Nom et Prénom / 
Entreprise (tampon)
Date et Signature autorisée
</textarea>
                                </div>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="footer_text">Footer Text</label>
                                <div class="input-group w-100">
                                    <textarea rows="7" class="form-control" name="footer_text">Lu et approuvé GVAGROUPE (MAFLOTTE), Impasse du Tilleul 12, 1510 Moudon, contact@maflotte.ch</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-12 mb-3">
                <button class="btn btn-primary" type="submit">Soumettre le formulaire</button>
            </div>
            </div>
        </form>   
    </div>

    </div>
    </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>

</script>
@endsection