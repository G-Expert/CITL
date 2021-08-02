<?php
$clients = ReadClient();
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
                          <h1 class="mb-0 h2 font-weight-bold">Nouvelle Importation</h1>
                      </div>

                      <div class="d-flex">
                          <a href="clients_liste" class="btn btn-warning">Liste</a><br>
                      </div>

                  </div>
              </div>
          </div>

          <div class="row">
              <div class=" col-md-12 col-12">

                @if (isset($error))
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Alert :</strong> {{$error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                @endif


                <form class="form-row" action="addImp" method="post">
                  @csrf

                 <div class="form-group col-lg col-md-3">
                    <label class="form-label">Clients</label>
                    <select class="selectpicker clients" id="basic-example" name="clients" data-width="100%">
                    @foreach ($clients as $key => $value)
                      <option value="{{$value->id}}">{{$value->nom_filtre}} - {{$value->entreprise}}</option>
                    @endforeach


                    </select>
                 </div>

                 <div class="form-group col-lg col-md-3">
                   <label class="form-label" for="fname-4">Description</label>
                   <input type="text" id="fname-4" name="descrp" class="form-control" required/>
                 </div>


                 <div class="col-12">
										<!-- Button open count -->
										<button class="btn btn-warning" type="submit">
											Ouvrir l'opérations
										</button>
                    <!-- Button close count -->
                    <a href="addExport"><button class="btn btn-danger" type="button">Annuler</button></a>
									</div>

               </form>


              </div>
          </div>

        </div>
        <!-- Container fluid -->

    </div>
    <!-- Page Content -->
</div>
