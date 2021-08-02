<?php
  $exp =  ReadExport(0);
  $expNb = count($exp);
  //dd($exp);
?>
<!-- Wrapper -->
<div id="db-wrapper">
    <!-- Sidebar -->
    @include('pages.admin_nav')
    <!-- sidebar -->

    <!-- Page Content -->
    <div id="page-content">

        <!-- Page Header -->
        @include('pages.admin_header')
        <!-- Page Header -->

        <!-- Container fluid::Tableau de bord -->
        <div class="container-fluid p-4">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-12">
                  <div class="border-bottom pb-4 mb-4 d-lg-flex justify-content-between align-items-center">
                      <div>
                          <h1 class="mb-0 h2 font-weight-bold">Exportations en cours [ {{$expNb}} Exports]</h1>
                      </div>
                      <div class="d-flex">
                          <a href="addExport" class="btn btn-warning">Nouvelle</a><br>
                      </div>

                  </div>
              </div>
          </div>

          <div class="row">
              <div class=" col-md-12 col-12">
                <!-- Tab -->
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
                    <div class="row">
                       <div class="mb-4 col-lg-6">
                         <label>Filtre de recherhce</label>
                         <select class="selectpicker attribut" id="basic-example" name="attribut" data-width="100%">
                           <option value="codeexport">Code</option>
                           <option value="d1">Fret</option>
                           <option value="d2">Booking</option>
                           <option value="d3">Emb</option>
                           <option value="d3">AE</option>
                           <option value="d4">Emb</option>
                           <option value="d5">Chg</option>
                           <option value="d6">TD</option>
                           <option value="d7">DED</option>
                           <option value="d8">BD</option>
                           <option value="d9">PFP</option>
                           <option value="d10">RC</option>
                           <option value="d11">DN</option>
                         </select>
                       </div>
                       <div class="mb-4 col-lg-6">
                         <label>Valeur de la recherche</label>
                         <input type="search" class="form-control filtExp" placeholder=""/>
                       </div>
                    </div>

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
                                              <b>{{$value->codeexport}}</b><br>
                                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Descrption: </strong> <span class="descrp">{{$value->description}}</span>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                        <span class="badge badge-info">En cours</span><br>

                                          <span class="text-dark">
                                            <br><a href="#" class="details" id="{{$value->idExport}}"><i class="fe fe-eye font-size-lg text-warning"></i></a>
                                            <a href="#" id="{{$value->idExport}}" nom="{{$value->codeexport}}" title="Validé" class="valide"><i class="fe fe-user-check font-size-lg text-success"></i></a>
                                            <a href="#" id="{{$value->idExport}}" nom="{{$value->codeexport}}" class="sup" title="Supprimer"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                                          </span>
                                      </p>
                                  </div>


                                  <div class="d-flex justify-content-between border-bottom py-2 mt-2">
                                      <span>Fret</span>
                                      <span class="text-dark">
                                        @if ($value->fret=='')
                                          <b class="">Aucun</b>
                                        @else
                                          <b>{{$value->d1}}</b>
                                        @endif
                                      </span>
                                  </div>

                                  <div class="d-flex justify-content-between border-bottom py-2">
                                      <span>Booking</span>
                                      <span class="text-dark">
                                        @if ($value->booking=='')
                                          <b class="">Aucun</b>
                                        @else
                                          <b>{{$value->d2}}</b>
                                        @endif
                                      </span>
                                  </div>

                                  <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                      <span>Emb</span>
                                      <span class="text-dark">
                                        @if ($value->emb=='')
                                          <b class="">Aucun</b>
                                        @else
                                          <b>{{$value->d3}}</b>
                                        @endif
                                      </span>
                                  </div>

                                  <div class="d-flex justify-content-between pt-2 py-2">
                                      <span>AE</span>
                                      <span class="text-dark">
                                        @if ($value->ae=='')
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
                          Aucune exportation
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
                            <td class="text-dark font-weight-semi-bold">Fret</td>
                            <td class="fret"></td>
                            <input type="hidden" class="frt"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">Booking</td>
                            <td class="booking"></td>
                            <input type="hidden" class="book"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">Embotage</td>
                            <td class="embtg"></td>
                            <input type="hidden" class="emb"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              A. Exportations
                            </td>
                            <td class="export"></td>
                            <input type="hidden" class="ae"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              Eng. Change
                            </td>
                            <td class="change"></td>
                            <input type="hidden" class="chg"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              Tirage de Déclarat.
                            </td>
                            <td class="td"></td>
                            <input type="hidden" class="ted"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              Déclarat. Douane
                            </td>
                            <td class="deD"></td>
                            <input type="hidden" class="ded"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              Enlev. Douane
                            </td>
                            <td class="enlD"></td>
                            <input type="hidden" class="bd"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              Paie Fret Port.
                            </td>
                            <td class="port"></td>
                            <input type="hidden" class="pfp"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                              Ret. Connaisst.
                            </td>
                            <td class="rtc"></td>
                            <input type="hidden" class="rc"/>
                          </tr>

                          <tr>
                            <td class="text-dark font-weight-semi-bold">
                             Départ Navire
                            </td>
                            <td class="depNv"></td>
                            <input type="hidden" class="dn"/>
                          </tr>

                          <input type="hidden" class="idex">

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary annulBtn" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-warning valExport">Valider</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal de mise en etat -->
