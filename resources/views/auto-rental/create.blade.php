@extends('layouts.admin')
@section('title', 'Créer une nouvelle voiture de location')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                       
            @include('layouts.breadcrump', [
                'title' => 'GVACARS',
                'showBackButton' => true,
                'backRoute' => 'auto-rental.index',
                'items' => [
                    ['label' => 'Location d\'automobiles', 'route' => 'auto-rental.index'],
                    ['label' => 'Créer une nouvelle voiture de location', 'active' => true]
                ]
            ])    
            @include('layouts.alerts')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer une nouvelle voiture de location</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                <form method="POST" action="{{ route('auto-rental.update') }}" class="row w-100" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="create" />

                    <div class="w-100">
                        <!-- Nav pills -->
                        <ul class="nav nav-pills pl-2 pr-2">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="pill" href="#french">French</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#english">English</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#deutch">Deutch</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content mt-3">

                            <div class="tab-pane active p-0" id="french">
                                <div class="row">

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="image_1">Image 1</label>
                                        <input type="file" class="form-control" id="image_1" name="image_1" value="{{ old('image_1') }}" required />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="image_2">Image 2</label>
                                        <input type="file" class="form-control" id="image_2" name="image_2" value="{{ old('image_2') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="naimage_3me">Image 3</label>
                                        <input type="file" class="form-control" id="image_3" name="image_3" value="{{ old('image_3') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="{{ old('name') }}" required />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="price">Prix</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Prix" value="{{ old('price') }}" required />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="fuel">Carburant</label>
                                        <input type="text" class="form-control" id="fuel" name="fuel" placeholder="Carburant" value="{{ old('fuel') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="transmission">Transmission</label>
                                        <input type="text" class="form-control" id="transmission" name="transmission" placeholder="Transmission" value="{{ old('transmission') }}" />
                                    </div>


                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="seats">Sièges</label>
                                        <input type="text" class="form-control" id="seats" name="seats" placeholder="Sièges" value="{{ old('seats') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="doors">Portes</label>
                                        <input type="text" class="form-control" id="doors" name="doors" placeholder="Portes" value="{{ old('doors') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="performance">Performance</label>
                                        <input type="text" class="form-control" id="performance" name="performance" placeholder="Performance" value="{{ old('performance') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="year">Annee</label>
                                        <input type="text" class="form-control" id="year" name="year" placeholder="Annee" value="{{ old('year') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                        <label class="w-100" for="category">Localisation</label>
                                        <select class="form-control select2" id="location" data-toggle="select2" name="location" required>
                                            <option value="airoport-geneva" selected>Airoport geneve</option>
                                            <option value="my-location">Localisation du bureau</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-12 mb-3">
                                        <label for="description">Description</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="tab-pane fade p-0" id="english">

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nom" value="{{ old('name_en') }}"  />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="fuel">Carburant</label>
                                        <input type="text" class="form-control" id="fuel_en" name="fuel_en" placeholder="Carburant" value="{{ old('fuel_en') }}"  />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="transmission">Transmission</label>
                                        <input type="text" class="form-control" id="transmission_en" name="transmission_en" placeholder="Transmission" value="{{ old('transmission_en') }}"  />
                                    </div>

                                    <div class="form-group col-lg-12 mb-3">
                                        <label for="description">Description</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="description_en" name="description_en" rows="5">{{ old('description_en') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade p-0" id="deutch">

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name_de" name="name_de" placeholder="Nom" value="{{ old('name_de') }}"  />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="fuel">Carburant</label>
                                        <input type="text" class="form-control" id="fuel_de" name="fuel_de" placeholder="Carburant" value="{{ old('fuel_de') }}"  />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="transmission">Transmission</label>
                                        <input type="text" class="form-control" id="transmission_de" name="transmission_de" placeholder="Transmission" value="{{ old('transmission_de') }}"  />
                                    </div>

                                    <div class="form-group col-lg-12 mb-3">
                                        <label for="description">Description</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="description_de" name="description_de" rows="5">{{ old('description_de') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12 mb-3">
                        <button class="btn btn-primary" type="submit">Soumettre le formulaire</button>
                    </div>
        
                </form>   
            </div>
            </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<!-- <script>
    var model = $('#model').select2();
    $(document.body).on("change","#mark",function(){
        getModelsByMark(this.value);
    });
    function getModelsByMark(mark_id){
        $.ajax({
            url: `/api/buy/cars/models/${mark_id}`,
            type: 'GET',
            success: function(data) {
                console.log(data.models)
                var models = data.models;
                var html = [];
                for(var i = 0; i < models.length; i++){
                    console.log(models[i])
                    let name = models[i].name;
                    let id = models[i].id;
                    let option = `<option value="${id}">${name}</option>`
                    html.push(option)
                }
                $('#model').append(html);
                if(models.length === 0){
                    $('#model').html('');
                }
                $('#model').select2();
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }
</script> -->
@endsection
