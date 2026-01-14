@extends('layouts.admin')
@section('title', 'Editer Auto Rental Car')

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
                    ['label' => 'Modifier une voiture de location ' . $rental->name, 'active' => true]
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
                    <input type="hidden" name="type" value="edit" />
                    <input type="hidden" name="id" value="{{ $rental->id }}" />


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
                                        <label class="w-100" for="image_1">Image 1</label>
                                        @if($rental->image_1)
                                            <img alt="Image" src="/back/img/auto-rental/{{ $rental->image_1 }}" width="200" height="100" class="object-contain object-position-left mb-2"  />
                                        @endif
                                        <input type="file" class="form-control" id="image_1" name="image_1" value="{{ old('image_1') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label class="w-100" for="image_2">Image 2</label>
                                        @if($rental->image_2)
                                            <img alt="Image" src="/back/img/auto-rental/{{ $rental->image_2 }}" width="200" height="100" class="object-contain object-position-left mb-2"  />
                                        @endif
                                        <input type="file" class="form-control" id="image_2" name="image_2" value="{{ old('image_2') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label class="w-100" for="naimage_3me">Image 3</label>
                                        @if($rental->image_3)
                                            <img alt="Image" src="/back/img/auto-rental/{{ $rental->image_3 }}" width="200" height="100" class="object-contain object-position-left mb-2"  />
                                        @endif
                                        <input type="file" class="form-control" id="image_3" name="image_3" value="{{ old('image_3') }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="{{ $rental->name }}" required />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="price">Prix</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Prix" value="{{ $rental->price }}" required />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="fuel">Carburant</label>
                                        <input type="text" class="form-control" id="fuel" name="fuel" placeholder="Carburant" value="{{ $rental->fuel }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="transmission">Transmission</label>
                                        <input type="text" class="form-control" id="transmission" name="transmission" placeholder="Transmission" value="{{ $rental->transmission }}" />
                                    </div>


                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="seats">Sièges</label>
                                        <input type="text" class="form-control" id="seats" name="seats" placeholder="Sièges" value="{{ $rental->seats }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="doors">Portes</label>
                                        <input type="text" class="form-control" id="doors" name="doors" placeholder="Portes" value="{{ $rental->doors }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="date_from">Date de début</label>
                                        <input type="text" class="form-control" id="date_from" name="date_from" placeholder="" value="{{ $rental->date_from }}"/>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="performance">Performance</label>
                                        <input type="text" class="form-control" id="performance" name="performance" placeholder="Performance" value="{{ $rental->performance }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="time_from">Durée à partir de</label>
                                        <input type="text" class="form-control" id="time_from" name="time_from" placeholder="" value="{{ $rental->time_from }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="date_to">Date à</label>
                                        <input type="text" class="form-control" id="date_to" name="date_to" placeholder="" value="{{ $rental->date_to }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="time_to">Le temps de</label>
                                        <input type="text" class="form-control" id="time_to" name="time_to" placeholder="" value="{{ $rental->time_to }}" />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                        <label class="w-100" for="category">Localisation</label>
                                        <select class="form-control select2 w-100" id="location" data-bs-toggle="select2" name="location" required>
                                            <option value="airoport-geneva" @if($rental->location == 'airoport-geneva') selected @endif>Airoport geneve</option>
                                            <option value="my-location"  @if($rental->location == 'my-location') selected @endif>Localisation du bureau</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                        <label class="w-100" for="status">Statut</label>
                                        <select class="form-control select2 w-100" id="" data-bs-toggle="select2" name="status" required>
                                            <option value="0" @if($rental->status == 0) selected @endif>Avaiabile</option>
                                            <option value="1"  @if($rental->status == 1) selected @endif>Busy</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="year">Annee</label>
                                        <input type="text" class="form-control" id="year" name="year" placeholder="Annee" value="{{ $rental->year }}" />
                                    </div>

                                    <div class="form-group col-lg-12 mb-3">
                                        <label for="description">Description</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="description" name="description" rows="5">{{ $rental->description }}</textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade p-0" id="english">

                                <div class="row">

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nom" value="@if($rental->translation && $rental->translation->name_en){{$rental->translation->name_en}}@endif"  />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="fuel">Carburant</label>
                                        <input type="text" class="form-control" id="fuel_en" name="fuel_en" placeholder="Carburant" value="@if($rental->translation && $rental->translation->fuel_en){{$rental->translation->fuel_en}}@endif"  />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="transmission">Transmission</label>
                                        <input type="text" class="form-control" id="transmission_en" name="transmission_en" placeholder="Transmission" value="@if($rental->translation && $rental->translation->transmission_en){{$rental->translation->transmission_en}}@endif"  />
                                    </div>

                                    <div class="form-group col-lg-12 mb-3">
                                        <label for="description">Description</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="description_en" name="description_en" rows="5">@if($rental->translation && $rental->translation->description_en){{$rental->translation->description_en}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade p-0" id="deutch">

                                <div class="row">

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name_de" name="name_de" placeholder="Nom" value="@if($rental->translation && $rental->translation->name_de){{$rental->translation->name_de}}@endif"  />
                                    </div>

                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="fuel">Carburant</label>
                                        <input type="text" class="form-control" id="fuel_de" name="fuel_de" placeholder="Carburant" value="@if($rental->translation && $rental->translation->fuel_de){{$rental->translation->fuel_de}}@endif"  />
                                    </div>
                                    
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                        <label for="transmission">Transmission</label>
                                        <input type="text" class="form-control" id="transmission_de" name="transmission_de" placeholder="Transmission" value="@if($rental->translation && $rental->translation->transmission_de){{$rental->translation->transmission_de}}@endif"  />
                                    </div>

                                    <div class="form-group col-lg-12 mb-3">
                                        <label for="description">Description</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="description_de" name="description_de" rows="5">@if($rental->translation && $rental->translation->description_de){{$rental->translation->description_de}}@endif</textarea>
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
    @include('layouts.footer')
</div>
@endsection

@section('custom_script')
<script>
    $('#date_from').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('#date_to').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('#time_from').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      timePicker24Hour: true,
      singleDatePicker: true,
      startDate: moment().startOf('day'),
      endDate: moment().startOf('day'),
      locale: {
        format: 'HH:mm'
      }
    },function(start, end, label) {

    });

    $('#time_from').on('show.daterangepicker', function(ev, picker) {
      picker.container.find('.calendar-table').hide();
    });

    $('.time_to').on('apply.daterangepicker', function(ev, picker) {
      var selectedTime = picker.startDate.format('HH:mm');
      console.log(selectedTime);
      // Do something with the selected time
    });

    $('#time_to').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      timePicker24Hour: true,
      singleDatePicker: true,
      startDate: moment().startOf('day'),
      endDate: moment().startOf('day'),
      locale: {
        format: 'HH:mm'
      }
    },function(start, end, label) {

    });

    $('#time_to').on('show.daterangepicker', function(ev, picker) {
      picker.container.find('.calendar-table').hide();
    });

    $('.time_to').on('apply.daterangepicker', function(ev, picker) {
      var selectedTime = picker.startDate.format('HH:mm');
      console.log(selectedTime);
      // Do something with the selected time
    });

    var date_from = "{{ old('date_from') }}"
    var time_from = "{{ old('time_from') }}"
    var date_to = "{{ old('date_to') }}"
    var time_to = "{{ old('time_to') }}"

    if(date_from != "" && date_from != undefined){
        $('#date_from').data('daterangepicker').setStartDate(date_from);
    }

    if(time_from != "" && time_from != undefined){
        $('.time_from').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        timePicker24Hour: true,
        singleDatePicker: true,
        startDate: moment().startOf('day'),
        endDate: moment().startOf('day'),
        startDate: moment().startOf('day').set({ hour: time_from.split(':')[0], minute: time_from.split(':')[1], second: 0 }),
        locale: {
          format: 'HH:mm'
        }
      },function(start, end, label) {

      });
      $('.time_from').on('show.daterangepicker', function(ev, picker) {
        picker.container.find('.calendar-table').hide();
      });
    }

    if(date_to != "" && date_to != undefined){
        $('#date_to').data('daterangepicker').setStartDate(date_to);
    }

    if(time_to != "" && time_to != undefined){
        $('.time_to').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        timePicker24Hour: true,
        singleDatePicker: true,
        startDate: moment().startOf('day'),
        endDate: moment().startOf('day'),
        startDate: moment().startOf('day').set({ hour: time_to.split(':')[0], minute: time_to.split(':')[1], second: 0 }),
        locale: {
          format: 'HH:mm'
        }
      },function(start, end, label) {

      });
      $('.time_to').on('show.daterangepicker', function(ev, picker) {
        picker.container.find('.calendar-table').hide();
      });
    }
</script>
@endsection
