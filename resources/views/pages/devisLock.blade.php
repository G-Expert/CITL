<?php
//Liste des nouveaux devis
$devis = ReadDevis(2);
$nbDevis = count($devis);

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
                          <h1 class="mb-0 h2 font-weight-bold">Devis rejetés [ {{$nbDevis}}  devis ]</h1>
                      </div>
                      {{-- <div class="d-flex">
                          <a href="nouveaux devis_new" class="btn btn-warning">Nouveau</a><br>
                      </div> --}}

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
                           <option value="type">Type</option>
                           <option value="nature">Nature</option>
                           <option value="conteneur">Conteneur</option>
                           <option value="pays_destination">Pays</option>
                           <option value="poids">Poids</option>
                           <option value="arrive">Arrive</option>
                           <option value="tel">Tel</option>
                           <option value="mail">E-mail</option>
                           <option value="Nom">Nom</option>
                           <option value="codeDevis">Code</option>
                         </select>
                       </div>
                       <div class="mb-4 col-lg-6">
                         <label>Valeur de la recherche</label>
                         <input type="search" class="form-control search" placeholder=""/>
                       </div>
                    </div>

                    <div class="row searchClient">
                      @if ($nbDevis!=0)
                        @foreach ($devis as $key => $value)
                          <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                                            <!-- Card -->
                                            <div class="card mb-4">
                                                <!-- Card body -->
                                                <div class="card-body">
                                                    <div class="text-center">

                                                        <h4 class="mb-0">{{$value->Nom}}</h4>
                                                        <p class="mb-0"><b>{{$value->codeDevis}}</b><br>{{$value->tel}}<br>{{$value->mail}}<br>Le {{$value->created_at}}<br>
                                                            <span class="text-dark">
                                                              <span class="badge badge-info">rejeté</span>
                                                              <a href="#" id="{{$value->idcotation}}" nom="{{$value->codeDevis}}" title="supprimer"class="del"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                                                            </span>
                                                        </p>

                                                    </div>
                                                    <div class="d-flex justify-content-between border-bottom py-2 mt-6">
                                                        <span><b>Type</b></span>
                                                        <span class="text-dark">{{$value->type}}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between border-bottom py-2">
                                                        <span><b>Nature</b></span>
                                                        <span> {{$value->nature}} </span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                                        <span><b>Voie</b></span>
                                                        <span class="text-dark"> {{$value->voie}} </span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                                        <span><b>Pays</b></span>
                                                        <span class="text-dark"> {{$value->pays_destination}} </span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                                        <span><b>Port</b></span>
                                                        <span class="text-dark"> {{$value->arrive}} </span>
                                                    </div>

                                                    <div class="d-flex justify-content-between pt-2 py-2">
                                                        <span><b>Poids</b></span>
                                                        <span class="text-dark"> {{$value->poids}} </span>
                                                    </div>
                                                </div>
                                            </div>
                          </div>
                        @endforeach
                      @else
                        <div class="alert alert-danger col-lg-12" role="alert">
                           Aucun devis
                        </div>
                      @endif



                      <!-- Modal de Modification -->
                      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Modifier</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                                  <div class="form-group">
                                    <label class="input-label" for="textInput">Nom</label>
                                    <input type="text" id="textInput" class="form-control nom">
                                  </div>

                                  <div class="form-group">
                                    <label class="input-label" for="textInput">Prénom</label>
                                    <input type="text" id="textInput" class="form-control prenom">
                                  </div>

                                  <div class="form-group">
                                    <label class="input-label" for="textInput">E-mail</label>
                                    <input type="text" id="textInput" class="form-control mail">
                                  </div>

                                  <div class="form-group">
                                    <label class="input-label" for="textInput">Entreprise</label>
                                    <input type="text" id="textInput" class="form-control entrep">
                                  </div>

                                  <div class="form-group">
                                    <label class="input-label" for="textInput">Téléphone</label>
                                    <input type="text" id="textInput" class="form-control tel">
                                  </div>

                                  <div class="form-group">
                                    <label class="input-label" for="textInput">Mot de passe</label>
                                    <input type="text" id="textInput" class="form-control pass">
                                  </div>

                                  <input type="hidden" class="id">


                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary annulBtn" data-dismiss="modal">Annuler</button>
                              <button type="button" class="btn btn-warning reservBtn">Modifier</button>
                            </div>
                          </div>
                        </div>
                      </div>

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
