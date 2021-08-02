<!-- Sidebar -->
<nav class="navbar-vertical navbar">
           <div class="nav-scroller">
               <!-- Brand logo -->
               <a class="navbar-brand" href="dashboard">
                <!--<img src="../../assets/images/favicon/logo.png" alt="" /></a>-->
                <h1 class="text-white">CITL</h1>
               </a>
               <!-- Navbar nav -->
               <ul class="navbar-nav flex-column" id="sideNavbar">
                 <!-- Gestion des clients -->
                 <li class="nav-item">
                     <a class="nav-link " href="#!" data-toggle="collapse" data-target="#navCourses" aria-expanded="false" aria-controls="navCourses">
                         <i class="nav-icon fe fe-user mr-2"></i>Clients
                     </a>
                     <div id="navCourses" class="collapse" data-parent="#sideNavbar">
                         <ul class="nav flex-column">
                             <li class="nav-item">
                                 <a class="nav-link" href="clients_liste">Liste</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" href="clients_new">Nouveau</a>
                             </li>
                         </ul>
                     </div>
                 </li>

                   <!-- Gestion de  operations -->
                   <li class="nav-item">
                       <a class="nav-link " href="#!" data-toggle="collapse" data-target="#navDashboard" aria-expanded="false" aria-controls="navDashboard">
                           <i class="fe fe-refresh-cw nav-icon mr-2"></i>Opérations
                       </a>
                       <div id="navDashboard" class="collapse" data-parent="#sideNavbar">
                           <ul class="nav flex-column">
                               <!-- Commande Nouvelle -->
                               <li class="nav-item">
                                   <a class="nav-link" href="new_export">Export</a>
                               </li>

                               <li class="nav-item">
                                   <a class="nav-link" href="new_exportLv">Export livrés</a>
                               </li>

                               <!-- Commande rejete -->
                               <li class="nav-item ">
                                   <a class="nav-link " href="new_import">Imports</a>
                               </li>
                               <!-- Commande livrées -->
                               <li class="nav-item ">
                                   <a class="nav-link " href="new_importLV">Import livrées</a>
                               </li>
                               {{-- <!-- Commande soldées -->
                               <li class="nav-item ">
                                   <a class="nav-link " href="solde_commande">soldées</a>
                               </li> --}}
                           </ul>
                       </div>
                   </li>

                   <!-- Gestion des devis -->
                   <li class="nav-item">
                       <a class="nav-link " href="#!" data-toggle="collapse" data-target="#navtransport" aria-expanded="false" aria-controls="navProfile">
                           <i class="nav-icon fe fe-book mr-2"></i>Devis
                       </a>
                       <div id="navtransport" class="collapse " data-parent="#sideNavbar">
                           <ul class="nav flex-column">
                               <li class="nav-item">
                                   <a class="nav-link " href="devis_demande">Demandes</a>
                               </li>
                               <li class="nav-item ">
                                   <a class="nav-link" href="devis_valide">Demandes validées</a>
                               </li>
                               <li class="nav-item ">
                                   <a class="nav-link" href="devis_lock">Demandes rejetées</a>
                               </li>
                           </ul>
                       </div>
                   </li>


                   <!-- Nav item -->
                   <li class="nav-item ">
                       <div class="nav-divider">
                       </div>
                   </li>
                   <!-- Nav item -->
                   <li class="nav-item ">
                       <div class="navbar-heading">Paramètres</div>
                   </li>
                   <!-- Nav item -->
                   <li class="nav-item">
                       <a class="nav-link " href="https://dashboard.tawk.to/?lang=fr#/dashboard/6106f848649e0a0a5ccefc2a">
                           <i class="nav-icon fe fe-clipboard mr-2"></i>Tchat
                       </a>
                   </li>
                   <!-- Nav item -->
                   <li class="nav-item ">
                       <a class="nav-link " href="unite_sms">
                           <i class="nav-icon fe fe-git-pull-request mr-2"></i>Unité SMS
                       </a>
                   </li>

               </ul>

           </div>
       </nav>
