<?php
// //Nombre d'export en cours
// $exp =  ExportClientEtat($_SESSION['i'],0);
// $expNb = count($exp);
// //Nombre d'imports en cours
// $imp =  ImportClientEtat($_SESSION['i'],0);
// $impnb = count($imp);
// //Nombre d'export livré
// $devis = ExportClientEtat($_SESSION['i'],1);
// $nbdev = count($devis);
// //Nombre d'import livré
// $clients = ImportClientEtat($_SESSION['i'],1);
// $nbCl = count($clients);
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
                            <h1 class="mb-0 h2 font-weight-bold">{{nomCl($_SESSION['i'])}}</h1>
                        </div>
                        <div class="d-flex">

                            <a href="/logout" class="btn btn-warning">Se Déconnecter</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-12">
                  <!-- Card -->
                  <div class="card mb-4">
                      <!-- Card header -->
                      <div class="card-header">
                          <h4 class="mb-0">Paramètres Général</h4>
                      </div>
                      <!-- Card body -->
                      <div class="card-body">
                          <!-- Form -->
                          <form action="upcount" method="GET">
                              <div class="form-group mb-4">
                                  <label for="Nom" class="form-label">Nom</label>
                                  <input class="form-control" id="Nom" value="{{nomCli($_SESSION['i'])}}"
                                   type="text" name="nom"/>
                              </div>
                              <div class="form-group mb-4">
                                  <label for="prenom" class="form-label">Prénom</label>
                                  <input class="form-control" id="prenom" name="prenom"
                                         value="{{nomClp($_SESSION['i'])}}" type="text"/>
                              </div>

                              <div class="form-group mb-4">
                                  <label for="tel" class="form-label">Téléphone</label>
                                  <input class="form-control" id="tel" name="tel"
                                  value="{{TelClient($_SESSION['i'])}}" type="text" disabled/>
                              </div>
                              <div class="form-group mb-4">
                                  <label for="email" class="form-label">E-mail</label>
                                  <input class="form-control" id="email" name="email"
                                         value="{{mailClient($_SESSION['i'])}}" type="text"/>
                              </div>

                              <div class="form-group mb-4">
                                  <label for="siteName" class="form-label">Entreprise</label>
                                  <input class="form-control" id="entrep" name="entrep"
                                         value="{{entreprise($_SESSION['i'])}}" type="text"/>
                              </div>
                              <div class="form-group mb-4">
                                  <label for="pass" class="form-label">Mot de Passe</label>
                                  <input class="form-control" id="pass" name="pass"
                                         value="{{nomClpass($_SESSION['i'])}}" type="text"/>
                              </div>



                              <button type="submit" class="btn btn-warning">Sauvegarder</button>
                          </form>
                      </div>
                  </div>


              </div>
            </div>

        </div>
        <!-- Container fluid -->

    </div>
    <!-- Page Content -->
</div>
