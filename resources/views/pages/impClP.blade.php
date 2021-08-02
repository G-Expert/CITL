<?php
  $exp =  ImportClientEtat($_SESSION['i'],0);
  $expNb = count($exp);
  //dd($exp);
?>
<!-- Wrapper -->
<div id="db-wrapper">
    <!-- Sidebar -->
    @include('pages.profil_nav')
    <!-- sidebar -->

    <!-- Page Content -->
    <div id="page-content">

        <!-- Page Header -->
        @include('pages.profil_header')
        <!-- Page Header -->

        <!-- Container fluid::Tableau de bord -->
        <div class="container-fluid p-4">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-12">
                  <div class="border-bottom pb-4 mb-4 d-lg-flex justify-content-between align-items-center">
                      <div>
                          <h1 class="mb-0 h2 font-weight-bold">Importations en cours [ {{$expNb}} Imports]</h1>
                      </div>
                      {{-- <div class="d-flex">
                          <a href="clients_liste" class="btn btn-warning">Liste</a><br>
                      </div> --}}

                  </div>
              </div>
          </div>

          <div class="row">
              <div class=" col-md-12 col-12">
                <!-- Tab -->
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">


                    <div class="row searchClient">


                      @if ($expNb!=0)

                        @foreach ($exp as $key => $value)
                          <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                          <!-- Card -->
                          <div class="card mb-4">
                              <!-- Card body -->
                              <div class="card-body">
                                  <div class="text-center">
                                      <h4 class="mb-0">{{$value->nom_filtre}}</h4>
                                      <p class="mb-0">
                                        {{$value->entreprise}}<br>
                                          {{$value->tel}}<br>
                                            {{$value->mail}}<br>
                                              <b>{{$value->codeImp}}</b><br>
                                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Descrption: </strong> <span class="descrp">{{$value->description}}</span>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                        {{-- <span class="badge badge-info">En cours</span><br> --}}

                                          <span class="text-dark">
                                            <br><a href="#" class="details" id="{{$value->idimport}}"><i class="fe fe-eye font-size-lg text-warning"></i><br> Voir plus</a>
                                            {{-- <a href="#" id="{{$value->idimport}}" nom="{{$value->codeImp}}" title="Validé" class="valide"><i class="fe fe-user-check font-size-lg text-success"></i></a>
                                            <a href="#" id="{{$value->idimport}}" nom="{{$value->codeImp}}" class="sup" title="Supprimer"><i class="fe fe-trash font-size-lg text-danger"></i></a> --}}
                                          </span>
                                      </p>
                                  </div>


                                  <div class="d-flex justify-content-between border-bottom py-2 mt-2">
                                      <span>Doss</span>
                                      <span class="text-dark">
                                        @if ($value->doss=='')
                                          <b class="">Aucun</b>
                                        @else
                                          <b>{{$value->d1}}</b>
                                        @endif
                                      </span>
                                  </div>

                                  <div class="d-flex justify-content-between border-bottom py-2">
                                      <span>FDI</span>
                                      <span class="text-dark">
                                        @if ($value->fdi=='')
                                          <b class="">Aucun</b>
                                        @else
                                          <b>{{$value->d2}}</b>
                                        @endif
                                      </span>
                                  </div>

                                  <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                      <span>BSC</span>
                                      <span class="text-dark">
                                        @if ($value->bsc=='')
                                          <b class="">Aucun</b>
                                        @else
                                          <b>{{$value->d3}}</b>
                                        @endif
                                      </span>
                                  </div>

                                  <div class="d-flex justify-content-between pt-2 py-2">
                                      <span>RCFV</span>
                                      <span class="text-dark">
                                        @if ($value->rfcv=='')
                                          <b class="">Aucun</b>
                                        @else
                                          <b>{{$value->d4}}</b>
                                        @endif
                                      </span>
                                  </div>

                              </div>
                          </div>
                          </div>
                        @endforeach

                      @else
                        <div class="alert alert-danger col-lg-12" role="alert">
                          Aucune importations
                        </div>
                      @endif


                    </dv>
                  </div>
                </div>
              </div>
          </div>

        </div>
        <!-- Container fluid -->

    </div>
    <!-- Page Content -->
</div>



<!-- Modal de détail -->
<div class="modal fade" id="DetailsModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Détails</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="mt-0">

                    <p class="mb-0 ">
                        <span class="entreprise"></span><br>
                        <span class="nom"></span><br>
                        <span class="tel"></span><br>
                        <span class="mail"></span><br>
                        Code: <span class="code"></span><br>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Descrption: </strong> <span class="descrp"></span>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                       </div>
                      {{-- <span class="badge badge-info">En cours</span><br> --}}
                    </p><hr>

                  <!-- Card -->
                  <div class="card">
                    <!-- Table -->
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th style="width:30%;" class="bg-transparent border-bottom-0"><b>Etapes</b></th>
                            <th class="bg-transparent border-bottom-0"><b>Valeur</b></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-dark font-weight-semi-bold">Doss</td>
                            <td class="doss"></td>
                            <input type="hidden" class="dosse"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">FDI</td>
                            <td class="fdi"></td>
                            <input type="hidden" class="fdie"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">BSC</td>
                            <td class="bsc"></td>
                            <input type="hidden" class="bsce"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              RCFV
                            </td>
                            <td class="rfcve"></td>
                            <input type="hidden" class="rfcvee"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              TD
                            </td>
                            <td class="tde"></td>
                            <input type="hidden" class="tdee"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                             DD
                            </td>
                            <td class="dd"></td>
                            <input type="hidden" class="dde"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              PFP
                            </td>
                            <td class="pfp"></td>
                            <input type="hidden" class="pfpse"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              LIV
                            </td>
                            <td class="liv"></td>
                            <input type="hidden" class="live"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              VSD
                            </td>
                            <td class="vsd"></td>
                            <input type="hidden" class="vsde"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              BED
                            </td>
                            <td class="bed"></td>
                            <input type="hidden" class="bede"/>
                          </tr>

                          <input type="hidden" class="idimp">

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary annulBtn" data-dismiss="modal">Annuler</button>
        {{-- <button type="button" class="btn btn-warning valExport">Valider</button> --}}
      </div>
    </div>
  </div>
</div>


<!-- Modal de mise en etat -->
