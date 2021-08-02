<?php
//Liste des clients
$clients = ReadClient();
$nbCl = count($clients);

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
                          <h1 class="mb-0 h2 font-weight-bold">Liste des clients [ {{$nbCl}} clients ]</h1>
                      </div>
                      <div class="d-flex">
                          <a href="clients_new" class="btn btn-warning">Nouveau</a><br>
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
                         <select class="selectpicker pays" id="basic-example" name="pays" data-width="100%">
                           <option value="nom">Nom</option>
                           <option value="entreprise">Entreprise</option>
                           <option value="tel">Télephone</option>
                           <option value="mail">E-mail</option>
                         </select>
                       </div>
                       <div class="mb-4 col-lg-6">
                         <label>Valeur de la recherche</label>
                         <input type="search" class="form-control search" placeholder=""/>
                       </div>
                    </div>

                    <div class="row searchClient">

                    @if ($nbCl!=0)
                      @foreach ($clients as $key => $value)
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                                          <!-- Card -->
                                          <div class="card mb-4">
                                              <!-- Card body -->
                                              <div class="card-body">
                                                  <div class="text-center">

                                                      <h4 class="mb-0">{{$value->nom_filtre}}</h4>
                                                      <p class="mb-0">
                                                          {{$value->tel}}<br>
                                                          <span class="text-dark">
                                                            <a href="#" id="{{$value->id}}" nom="{{$value->nom_filtre}}" class="edit"><i class="fe fe-edit font-size-lg text-warning"></i></a>

                                                            <a href="#" id="{{$value->id}}" nom="{{$value->nom_filtre}}" class="del"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                                                          </span>
                                                      </p>

                                                  </div>
                                                  <div class="d-flex justify-content-between border-bottom py-2 mt-6">
                                                      <span><b>Entreprise</b></span>
                                                      <span class="text-dark">{{$value->entreprise}}</span>
                                                  </div>
                                                  <div class="d-flex justify-content-between border-bottom py-2">
                                                      <span><b>E-mail</b></span>
                                                      <span> {{$value->mail}} </span>
                                                  </div>
                                                  <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                                      <span><b>Password</b></span>
                                                      <span class="text-dark"> {{$value->pass}} </span>
                                                  </div>
                                                  <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                                      <span><b>Import</b></span>
                                                      <span class="text-dark">
                                                        <a href="impCl?idcl={{$value->id}}" class="text-white">
                                                        <span class="badge badge-success">
                                                         {{ImportClientNb($value->id)}}
                                                        </span>
                                                       </a>
                                                      </span>
                                                  </div>
                                                  <div class="d-flex justify-content-between pt-2 py-2">

                                                      <span><b>Export</b></span>
                                                      <span class="text-dark">
                                                         <a href="expCl?idcl={{$value->id}}" class="text-white">
                                                         <span class="badge badge-success">
                                                           {{ExportClientNb($value->id)}}
                                                         </span>
                                                          </a>
                                                        </span>

                                                  </div>
                                              </div>
                                          </div>
                        </div>
                      @endforeach
                    @else
                      <div class="alert alert-danger col-lg-12" role="alert">
                         Aucun clients
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
