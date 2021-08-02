<?php
//Nombre d'export en cours
$exp =  ReadExport(0);
$expNb = count($exp);
//Nombre d'imports en cours
$imp =  ReadImport(0);
$impnb = count($imp);
//Nombre de devis en cours
$devis = ReadDevis(0);
$nbdev = count($devis);
//Nombre de client
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
                            <h1 class="mb-0 h2 font-weight-bold">Tableau de bord</h1>
                        </div>
                        <div class="d-flex">

                            <a href="/" class="btn btn-warning">Commencer</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                <div>
                                    <span class="font-size-xs text-uppercase font-weight-semi-bold">Export en cours</span>
                                </div>
                                <div>
                                    <span class="fe fe-shopping-bag font-size-lg text-primary"></span>
                                </div>
                            </div>
                            <h2 class="font-weight-bold mb-1">
                                {{$expNb}}
                            </h2>
                            {{-- <span class="text-success font-weight-semi-bold">
                                <i class="fe fe-trending-up mr-1"></i>100</span>
                            <span class="ml-1 font-weight-medium">commandes soldées</span> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                <div>
                                    <span class="font-size-xs text-uppercase font-weight-semi-bold">Import en cours</span>
                                </div>
                                <div>
                                    <span class=" fe fe-book-open font-size-lg text-primary"></span>
                                </div>
                            </div>
                            <h2 class="font-weight-bold mb-1">
                                {{$impnb}}
                            </h2>
                            {{-- <span class="text-danger font-weight-semi-bold">120+</span>
                            <span class="ml-1 font-weight-medium">courses disponibles</span> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                <div>
                                    <span class="font-size-xs text-uppercase font-weight-semi-bold">Devis</span>
                                </div>
                                <div>
                                    <span class=" fe fe-users font-size-lg text-primary"></span>
                                </div>
                            </div>
                            <h2 class="font-weight-bold mb-1">
                                {{$nbdev}}
                            </h2>
                            {{-- <span class="text-success font-weight-semi-bold"><i class="fe fe-trending-up mr-1"></i>+1200</span>
                            <span class="ml-1 font-weight-medium">clients</span> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                <div>
                                    <span class="font-size-xs text-uppercase font-weight-semi-bold">Clients</span>
                                </div>
                                <div>
                                    <span class=" fe fe-user-check font-size-lg text-primary"></span>
                                </div>
                            </div>
                            <h2 class="font-weight-bold mb-1">
                              {{$nbCl}}
                            </h2>
                            {{-- <span class="text-success font-weight-semi-bold"><i class="fe fe-trending-up mr-1"></i>+200</span>
                            <span class="ml-1 font-weight-medium">transporteurs</span> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-4">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Card header -->
                        <div class="card-header d-flex align-items-center
                          justify-content-between card-header-height">
                            <h4 class="mb-0">Import récents</h4>
                            <a href="#!" class="btn btn-outline-white btn-sm">Voir Plus</a>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- List group -->
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 pt-0 ">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-md avatar-indicators avatar-offline">
                                                <img alt="avatar" src="../../assets/images/avatar/avatar-1.jpg" class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="col ml-n3">
                                            <h4 class="mb-0 h5">Rob Percival</h4>
                                            <span class="mr-2 font-size-xs">
                        <span class="text-dark  mr-1 font-weight-semi-bold">42</span>Courses</span>
                                            <span class="mr-2 font-size-xs">
                        <span class="text-dark  mr-1 font-weight-semi-bold">1,10,124</span>Students</span>
                                            <span class="font-size-xs">
                        <span class="text-dark  mr-1 font-weight-semi-bold">32,000</span> Reviews
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="dropdown dropleft">
                        <a class="text-muted text-decoration-none" href="#!" role="button" id="courseDropdown7"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fe fe-more-vertical"></i>
                        </a>
                        <span class="dropdown-menu" aria-labelledby="courseDropdown7">
                          <span class="dropdown-header">Settings</span>
                                            <a class="dropdown-item" href="#!"><i class="fe fe-edit dropdown-item-icon "></i>Edit</a>
                                            <a class="dropdown-item" href="#!"><i class="fe fe-trash dropdown-item-icon "></i>Remove</a>
                                            </span>
                                            </span>
                                        </div>
                                    </div>

                                </li>

                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-4">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Card header -->
                        <div class="card-header d-flex align-items-center
                          justify-content-between card-header-height">
                            <h4 class="mb-0">Export Récent</h4>
                            <a href="#!" class="btn btn-outline-white btn-sm">Voir plus</a>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- List group flush -->
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 pt-0">
                                    <div class="row">
                                        <!-- Col -->
                                        <div class="col-auto">
                                            <a href="#!">
                                                <img src="../../assets/images/course/course-laravel.jpg" alt="" class="img-fluid rounded img-4by3-lg" /></a>
                                        </div>
                                        <!-- Col -->
                                        <div class="col pl-0">
                                            <a href="#!">
                                                <h5 class="text-primary-hover">
                                                    Revolutionize how you build the web...
                                                </h5>
                                            </a>
                                            <div class="d-flex align-items-center">
                                                <img src="../../assets/images/avatar/avatar-7.jpg" alt="" class="rounded-circle avatar-xs mr-2" />
                                                <span class="font-size-xs">Brooklyn Simmons</span>
                                            </div>
                                        </div>
                                        <!-- Col auto -->
                                        <div class="col-auto">
                                            <span class="dropdown dropleft">
                        <a class="text-muted text-decoration-none" href="#!" role="button" id="courseDropdown3"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fe fe-more-vertical"></i>
                        </a>
                        <span class="dropdown-menu" aria-labelledby="courseDropdown3">
                          <span class="dropdown-header">Settings</span>
                                            <a class="dropdown-item" href="#!"><i class="fe fe-edit dropdown-item-icon "></i>Edit</a>
                                            <a class="dropdown-item" href="#!"><i
                              class="fe fe-trash dropdown-item-icon "></i>Remove</a>
                                            </span>
                                            </span>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-4">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Card header -->
                        <div class="card-header card-header-height d-flex align-items-center">
                            <h4 class="mb-0">Devis récents
                            </h4>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- List group -->
                            <ul class="list-group list-group-flush list-timeline-activity">
                                <li class="list-group-item px-0 pt-0 border-0 mb-2">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                                <img alt="avatar" src="../../assets/images/avatar/avatar-6.jpg" class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="col ml-n3">
                                            <h4 class="mb-0 h5">Dianna Smiley</h4>
                                            <p class="mb-1">Just buy the courses”Build React Application Tutorial”</p>
                                            <span class="font-size-xs">2m ago</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Container fluid -->

    </div>
    <!-- Page Content -->
</div>
