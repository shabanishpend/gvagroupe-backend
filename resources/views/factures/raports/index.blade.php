
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Rapports</h5>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-start mb-3 raport_filter">
            <div style="margin-right: 10px !important;">
                <label for="from_date_reports" class="form-label">Du:</label>
                <input type="date" name="from_date_reports" id="from_date_reports" class="form-control" onchange="onChangeFromDate(this)" /> 
            </div>
            
            <div style="margin-right: 20px !important;">
                <label for="to_date_reports" class="form-label">Au:</label>
                <input type="date" name="to_date_reports" id="to_date_reports" class="form-control" onchange="onChangeFromDate(this)" />
            </div>

            <div>
                <label for="raportsClients" class="form-label">Client:</label>
                <select class="form-control"  onchange="onChangeFromDate(this)" id="raportsClients">
                    @foreach($clientsAll as $client)
                    <option 
                        value="{{ $client->id }}" 
                    >
                        {{ $client->name }} {{ $client->surname }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div style="text-align:left; width: 100%;margin-bottom: 1rem;">
            <button 
                style="padding:5px; background-color: transparent;border: 0px;color: blue;"
                onclick="event.preventDefault(); this.closest('div').querySelector('.download-excel').submit();"
            >
                @include('svg.excel')
                Exporter Excel
            </button>
            <button 
                style="padding:5px; background-color: transparent;border: 0px;color: blue;"
                onclick="event.preventDefault(); this.closest('div').querySelector('.download-pdf').submit();"
            >
                @include('svg.pdf')
                Exporter PDF
            </button>
            <button 
                style="padding:5px; background-color: transparent;border: 0px;color: blue;"
                onclick="event.preventDefault(); this.closest('div').querySelector('.preview-pdf').submit();"
            >
                @include('svg.pdf')
                Aperçu PDF
            </button>
            <form target="_blank" class="preview-pdf" action="{{ route('rapports.factures.preview') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                <input type="hidden" name="dateFrom" value="" id="previewDateFrom" />
                <input type="hidden" name="dateTo" value="" id="previewDateTo" />
                <input type="hidden" name="client" value="" id="clientPreview" />
            </form>
            <form target="_blank" class="download-pdf" action="{{ route('rapports.factures.download') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                <input type="hidden" name="dateFrom" value="" id="downloadDateFrom" />
                <input type="hidden" name="dateTo" value="" id="downloadDateTo" />
                <input type="hidden" name="client" value="" id="clientDownload" />
            </form>
            <form target="_blank" class="download-excel" action="{{ route('rapports.factures.excel') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                <input type="hidden" name="dateFrom" value="" id="excelDateFrom" />
                <input type="hidden" name="dateTo" value="" id="excelDateTo" />
                <input type="hidden" name="client" value="" id="excelClient" />
            </form>
        </div>
        <table class="table rapports table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
            <thead>
                <tr>
                    <th data-ordering="false">#</th>
                    <th data-ordering="false">Entreprise / Nom et Prénom</th>
                    <th data-ordering="false">Référence</th>
                    <th data-ordering="false">Date de facturation</th>
                    <th data-ordering="false">Crédit / Entrée</th>
                    <th data-ordering="false">Débit / Sortie</th>
                    <th data-ordering="false">Type</th>
                </tr>
            </thead>
            <tbody id="rapports_body_table">
                {{--<tr>
                    <td>01</td>
                    <td>VLZ-452</td>
                    <td>VLZ1400087402</td>
                    <td><a href="#!">Post launch reminder/ post list</a></td>
                    <td>Joseph Parker</td>
                    <td>Alexis Clarke</td>
                    <td>Joseph Parker</td>
                    <td>03 Oct, 2021</td>
                    <td><span class="badge bg-info-subtle text-info">Re-open</span></td>
                    <td><span class="badge bg-danger">High</span></td>
                    <td>
                        <div class="dropdown d-inline-block">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-fill align-middle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                <li>
                                    <a class="dropdown-item remove-item-btn">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>--}}
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3">
            <div>
                <p style="margin-top: 1rem; margin-bottom: 0px;font-weight: bold;font-size: 14px;">Le total des prix des Crédit / Entrée est: CHF <span id="totalPriceElement"></span></p>
                <p style="margin-top: 0rem; font-weight: bold;font-size: 14px; margin-bottom: 0px;">Le total des prix des Débit / Sortie est: CHF <span id="totalPriceElementDepenses"></span></p>
                <p style="margin-top: 0rem; font-weight: bold;font-size: 14px;">Gains totaux: CHF <span id="totalPriceElementGains"></span></p>
            </div>
        </div>
    </div>
</div>

<div class="card" style="display: none;">
    <div class="card-body">
        <div class="dropdown float-right raport_filter">
            <div>
                Du: 
                <input type="date" name="from_date_reports" id="from_date_reports" onchange="onChangeFromDate(this)" /> 
            </div>
            
            <div>
                au: 
                <input type="date" name="to_date_reports" id="to_date_reports" onchange="onChangeFromDate(this)" />
            </div>

            <div>
                Client:
                <select class="form-control select2 select" data-toggle="select2"  onchange="onChangeFromDate(this)" id="raportsClients">
                    @foreach($clientsAll as $client)
                    <option 
                        value="{{ $client->id }}" 
                    >
                        {{ $client->name }} {{ $client->surname }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <h4 class="header-title mb-3">Rapports</h4>
        <div class="row mt-5 ">
            <div style="text-align:right; width: 100%;">
                <button 
                    style="padding:5px; background-color: transparent;border: 0px;color: blue;"
                    onclick="event.preventDefault(); this.closest('div').querySelector('.download-excel').submit();"
                >
                    @include('svg.excel')
                    Exporter Excel
                </button>
                <button 
                    style="padding:5px; background-color: transparent;border: 0px;color: blue;"
                    onclick="event.preventDefault(); this.closest('div').querySelector('.download-pdf').submit();"
                >
                    @include('svg.pdf')
                    Exporter PDF
                </button>
                <button 
                    style="padding:5px; background-color: transparent;border: 0px;color: blue;"
                    onclick="event.preventDefault(); this.closest('div').querySelector('.preview-pdf').submit();"
                >
                    @include('svg.pdf')
                    Aperçu PDF
                </button>
                <form target="_blank" class="preview-pdf" action="{{ route('rapports.factures.preview') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="hidden" name="dateFrom" value="" id="previewDateFrom" />
                    <input type="hidden" name="dateTo" value="" id="previewDateTo" />
                    <input type="hidden" name="client" value="" id="clientPreview" />
                </form>
                <form target="_blank" class="download-pdf" action="{{ route('rapports.factures.download') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="hidden" name="dateFrom" value="" id="downloadDateFrom" />
                    <input type="hidden" name="dateTo" value="" id="downloadDateTo" />
                    <input type="hidden" name="client" value="" id="clientDownload" />
                </form>
                <form target="_blank" class="download-excel" action="{{ route('rapports.factures.excel') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="hidden" name="dateFrom" value="" id="excelDateFrom" />
                    <input type="hidden" name="dateTo" value="" id="excelDateTo" />
                    <input type="hidden" name="client" value="" id="excelClient" />
                </form>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table rapports dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>Entreprise / Nom et Prénom</th>
                                <th>Référence</th>
                                {{--<th>Prix ​​total</th>--}}
                                <th>Date de facturation</th>
                                <th>Crédit / Entrée</th>
                                <th>Débit / Sortie</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody id="rapports_body_table">
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-4">
                        <div>
                            <p style="margin-top: 1rem; margin-bottom: 0px;font-weight: bold;font-size: 18px;">Le total des prix des Crédit / Entrée est: CHF <span id="totalPriceElement"></span></p>
                            <p style="margin-top: 0rem; font-weight: bold;font-size: 18px; margin-bottom: 0px;">Le total des prix des Débit / Sortie est: CHF <span id="totalPriceElementDepenses"></span></p>
                            <p style="margin-top: 0rem; font-weight: bold;font-size: 18px;">Gains totaux: CHF <span id="totalPriceElementGains"></span></p>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row-->
    </div><!-- end card body-->
</div><!-- end card -->

