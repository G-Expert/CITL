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
                          <h1 class="mb-0 h2 font-weight-bold">Paramètres Administrateur</h1>
                      </div>

                  </div>
              </div>
          </div>

          <!-- Row -->
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
                                <form>
                                    <div class="form-group mb-4">
                                        <label for="siteName" class="form-label">Username</label>
                                        <input class="form-control" id="siteName" placeholder="" type="text" required />
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="siteName" class="form-label">Mot de Passe</label>
                                        <input class="form-control" id="siteName" placeholder="" type="text" required />
                                    </div>
                                    <button type="submit" class="btn btn-warning">Sauvegarder</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
        <!-- Container fluid -->

    </div>
    <!-- Page Content -->
</div>
