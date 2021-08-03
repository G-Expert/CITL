<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\clients;


class CitlController extends Controller
{

#Gestion de profil client

//Mise à jour du compte
public function upcount(Request $request)
{
  $nom = $request->nom;
  $prenom = $request->prenom;
  $tel = $request->tel;
  $mail = $request->email;
  $entrep = $request->entrep;
  $pass = $request->pass;
  $id = $_SESSION['i'];
  $res = updateClient($nom,$prenom,$mail,$entrep,$tel,$pass,$id);
  return redirect('count');
}

//Compte user
public function count()
{
  return view('count');
}
//Connection au compte client
  public function login(Request $request)
  {
     $tel  = $request->tel;
     $pass = $request->pass;
     $data = [$tel,$pass];
     $client   = loginCli($tel,$pass);
     if ($client==null) {
       return view('error');
    }else{
      $_SESSION['i'] = $client->id;
      return redirect('profile');
    }
  }

//Lecture des exportation du client
public function expPCl(Request $request)
{
  return view('expPcl');
}
//Lecture des exportations livrées
public function expPClv(Request $request)
{
  return view('expPClv');
}
//Lecture des importations en cours
public function impClP(Request $request)
{
  return view('impClP');
}
//Lecture des importations validées
public function impClPv(Request $request)
{
  return view('impClPv');
}




#Gestion des devis
  public function devisF(Request $request)
  {
     $type = $request->operation;
     $nature = $request->nature;
     $conteneur = $request->conteneur;
     $pays = $request->pays;
     $poids = $request->poids;
     $voie = $request->voie;
     $arrive = $request->port;
     $tel = $request->tel;
     $mail = $request->mail;
     $nom = $request->nom;
     $code = date("YmdHis").'dev';
     $data = ['type'=>$type,'nature'=>$nature,'conteneur'=>$conteneur,'pays'=>$pays,'poids'=>$poids,'voie'=>$voie,'arrive'=>$arrive,'tel'=>$tel,'mail'=>$mail,'nom'=>$nom,'code'=>$code];
     // dd($data);
     $res = addDevis($type,$nature,$conteneur,$pays,$poids,$voie,$arrive,$tel,$mail,$nom,$code);
     ini_set( 'display_errors', 1);
     //errot_reporting( E_ALL );
     $from = "info@citl.ci";
     $to ="citlogistics2000@gmail.com";
     $subject = "Demande devis";
     $message = "Une demande de devis vient d'être effectuer sur votre site www.citl.ci/devis_demande";
     $headers = "From:" . $from;
     mail($to,$subject,$message, $headers);
     $alert = $nom;
     return view('devis')->with('alert',$alert);
  }

  //Login administrateur
  public function kmtAd()
  {
    return view('kmtAd');
  }

  //Nouveau client Form
  public function clients_new()
  {
    return view("new_client");
  }

  // Ajouter un nouveau client
  public function FNew(Request $request)
  {
    $entreprise    = $request->entreprise;
    $client_nom    = $request->client_nom;
    $prenom_client = $request->prenom_client;
    $pays          = $request->pays;
    $tel_client    = $pays.$request->tel_client;
    $mail_client   = $request->mail_client;
    $pass_client   = rand(1, 30).'citl';
    $nomF          = $client_nom.' '.$prenom_client;
    $data = ['nom'=>$client_nom,'prenom'=>$prenom_client,'tel'=>$tel_client,'mail'=>$mail_client,'pass'=>$pass_client,'entreprise'=>$entreprise,'nom_filtre'=>$nomF];
    // Verification
    $client = DB::table('clients')
           ->where('tel', '=', $tel_client)
           ->get();
    $nb = count($client);

    if ($nb==0) {
      clients::create($data);
      $msg="Votre compte CITL est actif pour le suivi de vos operations logistique chez CITL. Tel : ".$tel_client.",Password : ".$pass_client." Cliquez ici www.citl.ci";
      //Notification aux clients
      dd($msg);
      $res = SMS($msg,$tel_client,'CITL');
      return redirect('clients_liste');
    }else{
      $error = "Ce numéro de Téléphone ".$tel_client." existe déjà | Veuillez changer le numéro tél";
      return view('new_client')->with('error',$error);
    }

  }

  //Suppression de compte client
  public function delClient(Request $request)
  {
    $res = delClient($request->idClient);
    return response()->json(['code' => '2'],200);
  }

  //Lecture du client en fonction de l"id
  public function readClID(Request $request)
  {
    $clients = ReadClientID($request->idClient);
    $data   = response()->json(['nom'=>$clients->nom,
                                  'prenom'=>$clients->prenom,
                                  'tel'=>$clients->tel,
                                  'mail'=>$clients->mail,
                                  'pass'=>$clients->pass,
                                  'id'=>$clients->id,
                                  'entreprise'=>$clients->entreprise]);
    return $data;
  }

  //Modification des clients en fonction de l'id
  public function modif(Request $request)
  {
    $res = updateClient($request->nom,$request->prenom,$request->mail,$request->entrep,$request->tel,$request->pass,$request->id);
    return response()->json(['code' => '2'],200);
  }

  //Filtre automatique
  public function filtreCl(Request $request)
  {
    $clients = filtreClient($request->attribut,$request->valeur);
    $nbCl = count($clients);
    $output = '';
    if ($nbCl!=0) {
      foreach ($clients as $key => $value) {
        $output.='<div class="col-xl-3 col-lg-6 col-md-6 col-12">
                          <!-- Card -->
                          <div class="card mb-4">
                              <!-- Card body -->
                              <div class="card-body">
                                  <div class="text-center">

                                      <h4 class="mb-0">'.$value->nom_filtre.'</h4>
                                      <p class="mb-0">
                                          '.$value->tel.'<br>
                                          <span class="text-dark">
                                            <a href="#" id="'.$value->id.'" nom="'.$value->nom_filtre.'" class="edit"><i class="fe fe-edit font-size-lg text-warning"></i></a>

                                            <a href="#" id="'.$value->id.'" nom="'.$value->nom_filtre.'" class="del"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                                          </span>
                                      </p>

                                  </div>
                                  <div class="d-flex justify-content-between border-bottom py-2 mt-6">
                                      <span><b>Entreprise</b></span>
                                      <span class="text-dark">'.$value->entreprise.'</span>
                                  </div>
                                  <div class="d-flex justify-content-between border-bottom py-2">
                                      <span><b>E-mail</b></span>
                                      <span> '.$value->mail.' </span>
                                  </div>
                                  <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                      <span><b>Password</b></span>
                                      <span class="text-dark"> '.$value->pass.' </span>
                                  </div>
                                  <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                      <span><b>Import</b></span>
                                      <span class="text-dark"> '.ImportClientNb($value->id).' </span>
                                  </div>
                                  <div class="d-flex justify-content-between pt-2 py-2">
                                      <span><b>Export</b></span>
                                      <span class="text-dark">
                                        <span class="badge badge-success">
                                         <a href="expCl?idcl='.$value->id.'" class="text-white">
                                         '.ExportClientNb($value->id).'
                                         </a>
                                        </span>
                                      </span>
                                  </div>
                              </div>
                          </div>
        </div>';
        $output.='                      <!-- Modal de Modification -->
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
                              </div>';
      }
    }else{
      $output.='<div class="alert alert-danger col-lg-12" role="alert">Aucun clients</div>';
    }

    //Scripte JS
    $output.="
    <script type='text/javascript'>

    //Suppression de compte client
    $('.del').click(function(){
       var idCl = $(this).attr('id');
       var nom  = $(this).attr('nom');
       var data = {idClient:idCl};
       Swal.fire({
            title: 'GESTION DE COMPTE',
            text: 'Voulez-vous supprimer '+nom+' ?',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'non',
            confirmButtonText: 'oui , supprimer!',
            backdrop: `rgba(240,15,83,0.4)`
          }).then((result)=>{
            if (result.value) {
              $.ajax({
                 url:'delClient',
                 method:'GET',
                 data:data,
                 dataType:'json',
                 success:function(data){
                   if (data.code==2) {
                     Swal.fire({
                       position: 'top-end',
                       icon: 'success',
                       title: nom+' a été Supprimée avec succès',
                       showConfirmButton: false,
                       timer: 1500
                     });
                     window.location='clients_liste';
                   }
                 },
                 error:function(data){
                   console.log('error');
                 }
              });
            }
          });
    });

    //Modification de compte client
     $('.edit').click(function(){
        var idCl = $(this).attr('id');
        var data = {idClient:idCl};
        $.ajax({
          url:'readClID',
          method:'GET',
          data:data,
          dataType:'json',
          success:function(data){
              $('.nom').val(data.nom);
              $('.prenom').val(data.prenom);
              $('.mail').val(data.mail);
              $('.entrep').val(data.entreprise);
              $('.tel').val(data.tel);
              $('.pass').val(data.pass);
              $('.id').val(data.id);
              $('#exampleModalLong').modal('show');
          },
          error:function(data){
            console.log('error');
          }
        });


     });

   //Validation des mises à jour
     $('.reservBtn').click(function(){
       var id = $('.id').val();
       var nom = $('.nom').val();
       var prenom = $('.prenom').val();
       var mail = $('.mail').val();
       var entrep = $('.entrep').val();
       var tel = $('.tel').val();
       var pass = $('.pass').val();
       var nf = nom+' '+prenom;
       var data = {nom:nom,prenom:prenom,mail:mail,entrep:entrep,tel:tel,pass:pass,id:id};
       $.ajax({
         url:'modif',
         method:'GET',
         data:data,
         dataType:'json',
         success:function(data){
           Swal.fire({
             position: 'top-end',
             icon: 'success',
             title: nf+' a été modifié avec succès',
             showConfirmButton: false,
             timer: 1500
           });
           window.location='clients_liste';
         },
         error:function(data){console.log(data);}
       });
     });
     </script>";


    return $output;
  }

  //Liste des clients
  public function liste_client()
  {
     return view('liste_client');
  }

#Gestion des devis
  //Liste des nouvelles demandes de devis
  public function devis_demande()
  {
    return view('devis_demande');
  }

  //Operation de validation de devis
  public function valideDevis(Request $request)
  {
    $res = UpDevis(1,$request->id);
    return response()->json(['code' => '2'],200);
  }

  //Opération de rejet de devis
  public function rejeteDevis(Request $request)
  {
    $res = UpDevis(2,$request->id);
    return response()->json(['code' => '2'],200);
  }

  //Operation de suppression de devis
  //Opération de rejet de devis
  public function supDevis(Request $request)
  {
    $res = UpDevis(3,$request->id);
    return response()->json(['code' => '2'],200);
  }

  //Liste des demandes validées
  public function devis_valide()
  {
    return view('devis_valide');
  }

  //Liste des demandes rejetées
  public function devis_lock()
  {
    return view('devis_lock');
  }

  //Filtre de recherche de devis
  public function filtreNewDv(Request $request)
  {
    $devis = filtreDevis($request->attribut,$request->valeur,0);
    $nbCl = count($devis);
    $output = '';
    if ($nbCl!=0) {
      foreach ($devis as $key => $value){
       $output.='<div class="col-xl-3 col-lg-6 col-md-6 col-12">
                            <!-- Card -->
                            <div class="card mb-4">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="text-center">

                                        <h4 class="mb-0">'.$value->Nom.'</h4>
                                        <p class="mb-0"><b>'.$value->codeDevis.'</b><br>'.$value->tel.'<br>'.$value->mail.'<br>Le '.$value->created_at.'<br>
                                            <span class="text-dark">
                                              <a href="#" id="'.$value->idcotation.'" nom="'.$value->codeDevis.'" title="Validé" class="valide"><i class="fe fe-user-check font-size-lg text-success"></i></a>
                                              <a href="#" id="'.$value->idcotation.'" nom="'.$value->codeDevis.'" title="rejetée" class="rejete text-link"><i class="fe fe-clipboard nav-icon font-size-lg"></i></a>
                                              <a href="#" id="'.$value->idcotation.'" nom="'.$value->codeDevis.'" title="supprimer"class="del"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                                            </span>
                                        </p>

                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2 mt-6">
                                        <span><b>Type</b></span>
                                        <span class="text-dark">'.$value->type.'</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                        <span><b>Nature</b></span>
                                        <span> '.$value->nature.'</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                        <span><b>Voie</b></span>
                                        <span class="text-dark">'.$value->voie.'</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                        <span><b>Pays</b></span>
                                        <span class="text-dark">'.$value->pays_destination.'</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                        <span><b>Port</b></span>
                                        <span class="text-dark">'.$value->arrive.'</span>
                                    </div>

                                    <div class="d-flex justify-content-between pt-2 py-2">
                                        <span><b>Poids</b></span>
                                        <span class="text-dark">'.$value->poids.'</span>
                                    </div>
                                </div>
                            </div>
          </div>';
      }
    }else{
      $output.='<div class="alert alert-danger col-lg-12" role="alert">Aucun devis</div>';
    }
    $output.="
      <script type='text/javascript'>
      //Suppression de devis
      $('.del').click(function(){
         var id = $(this).attr('id');
         var nom = $(this).attr('nom');
         var data = {id:id,nom:nom};
         console.log('nom: '+nom+'id: '+id);
         Swal.fire({
              title: 'GESTION DE DEVIS',
              text: 'Voulez-vous supprimer le devis '+nom+' ?',
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'non',
              confirmButtonText: 'oui , supprimer!',
              backdrop: `rgba(240,15,83,0.4)`
            }).then((result)=>{
              if (result.value) {
                $.ajax({
                   url:'rejeteDevis',
                   method:'GET',
                   data:data,
                   dataType:'json',
                   success:function(data){
                     if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: 'Le devis '+nom+' a été supprimé avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='devis_demande';
                     }
                   },
                   error:function(data){
                     console.log('error');
                   }
                });
              }
            });
      });

      //Rejet du devis
      $('.rejete').click(function(){
         var id = $(this).attr('id');
         var nom = $(this).attr('nom');
         var data = {id:id,nom:nom};
         console.log('nom: '+nom+'id: '+id);
         Swal.fire({
              title: 'GESTION DE DEVIS',
              text: 'Voulez-vous rejeter le devis '+nom+' ?',
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'non',
              confirmButtonText: 'oui , rejeter!',
              backdrop: `rgba(240,15,83,0.4)`
            }).then((result)=>{
              if (result.value) {
                $.ajax({
                   url:'rejeteDevis',
                   method:'GET',
                   data:data,
                   dataType:'json',
                   success:function(data){
                     if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: 'Le devis '+nom+' a été rejeté avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='devis_demande';
                     }
                   },
                   error:function(data){
                     console.log('error');
                   }
                });
              }
            });
      });

      //Suppression de devis
      $('.del').click(function(){
         var id = $(this).attr('id');
         var nom = $(this).attr('nom');
         var data = {id:id,nom:nom};
         console.log('nom: '+nom+'id: '+id);
         Swal.fire({
              title: 'GESTION DE DEVIS',
              text: 'Voulez-vous supprimer le devis '+nom+' ?',
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'non',
              confirmButtonText: 'oui , supprimer!',
              backdrop: `rgba(240,15,83,0.4)`
            }).then((result)=>{
              if (result.value) {
                $.ajax({
                   url:'rejeteDevis',
                   method:'GET',
                   data:data,
                   dataType:'json',
                   success:function(data){
                     if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: 'Le devis '+nom+' a été supprimé avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='devis_demande';
                     }
                   },
                   error:function(data){
                     console.log('error');
                   }
                });
              }
            });
      });


      </script>
    ";
    return $output;
  }

  //Filtre de devis rejeté
  public function filtreRjtDv(Request $request)
  {
    $devis = filtreDevis($request->attribut,$request->valeur,2);
    $nbCl = count($devis);
    $output = '';
    if ($nbCl!=0) {
      foreach ($devis as $key => $value){
       $output.='<div class="col-xl-3 col-lg-6 col-md-6 col-12">
                            <!-- Card -->
                            <div class="card mb-4">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="text-center">

                                        <h4 class="mb-0">'.$value->Nom.'</h4>
                                        <p class="mb-0"><b>'.$value->codeDevis.'</b><br>'.$value->tel.'<br>'.$value->mail.'<br>Le '.$value->created_at.'<br>
                                            <span class="text-dark">
                                            <span class="badge badge-info">Rejeté</span>
                                              <a href="#" id="'.$value->idcotation.'" nom="'.$value->codeDevis.'" title="supprimer"class="del"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                                            </span>
                                        </p>

                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2 mt-6">
                                        <span><b>Type</b></span>
                                        <span class="text-dark">'.$value->type.'</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                        <span><b>Nature</b></span>
                                        <span> '.$value->nature.'</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                        <span><b>Voie</b></span>
                                        <span class="text-dark">'.$value->voie.'</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                        <span><b>Pays</b></span>
                                        <span class="text-dark">'.$value->pays_destination.'</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                        <span><b>Port</b></span>
                                        <span class="text-dark">'.$value->arrive.'</span>
                                    </div>

                                    <div class="d-flex justify-content-between pt-2 py-2">
                                        <span><b>Poids</b></span>
                                        <span class="text-dark">'.$value->poids.'</span>
                                    </div>
                                </div>
                            </div>
          </div>';
      }
    }else{
      $output.='<div class="alert alert-danger col-lg-12" role="alert">Aucun devis</div>';
    }
    $output.="
      <script type='text/javascript'>
      //Suppression de devis
      $('.del').click(function(){
         var id = $(this).attr('id');
         var nom = $(this).attr('nom');
         var data = {id:id,nom:nom};
         console.log('nom: '+nom+'id: '+id);
         Swal.fire({
              title: 'GESTION DE DEVIS',
              text: 'Voulez-vous supprimer le devis '+nom+' ?',
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'non',
              confirmButtonText: 'oui , supprimer!',
              backdrop: `rgba(240,15,83,0.4)`
            }).then((result)=>{
              if (result.value) {
                $.ajax({
                   url:'supDevis',
                   method:'GET',
                   data:data,
                   dataType:'json',
                   success:function(data){
                     if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: 'Le devis '+nom+' a été supprimé avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='devis_lock';
                     }
                   },
                   error:function(data){
                     console.log('error');
                   }
                });
              }
            });
      });

      //Rejet du devis
      $('.rejete').click(function(){
         var id = $(this).attr('id');
         var nom = $(this).attr('nom');
         var data = {id:id,nom:nom};
         console.log('nom: '+nom+'id: '+id);
         Swal.fire({
              title: 'GESTION DE DEVIS',
              text: 'Voulez-vous rejeter le devis '+nom+' ?',
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'non',
              confirmButtonText: 'oui , rejeter!',
              backdrop: `rgba(240,15,83,0.4)`
            }).then((result)=>{
              if (result.value) {
                $.ajax({
                   url:'rejeteDevis',
                   method:'GET',
                   data:data,
                   dataType:'json',
                   success:function(data){
                     if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: 'Le devis '+nom+' a été rejeté avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='devis_lock';
                     }
                   },
                   error:function(data){
                     console.log('error');
                   }
                });
              }
            });
      });

      //Suppression de devis
      $('.del').click(function(){
         var id = $(this).attr('id');
         var nom = $(this).attr('nom');
         var data = {id:id,nom:nom};
         console.log('nom: '+nom+'id: '+id);
         Swal.fire({
              title: 'GESTION DE DEVIS',
              text: 'Voulez-vous supprimer le devis '+nom+' ?',
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'non',
              confirmButtonText: 'oui , supprimer!',
              backdrop: `rgba(240,15,83,0.4)`
            }).then((result)=>{
              if (result.value) {
                $.ajax({
                   url:'rejeteDevis',
                   method:'GET',
                   data:data,
                   dataType:'json',
                   success:function(data){
                     if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: 'Le devis '+nom+' a été supprimé avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       //window.location='devis_lock';
                     }
                   },
                   error:function(data){
                     console.log('error');
                   }
                });
              }
            });
      });


      </script>
    ";
    return $output;
  }

   //Filtre de recherche de devis validé
   public function filtreValDv(Request $request)
   {
     $devis = filtreDevis($request->attribut,$request->valeur,1);
     $nbCl = count($devis);
     $output = '';
     if ($nbCl!=0) {
       foreach ($devis as $key => $value){
        $output.='<div class="col-xl-3 col-lg-6 col-md-6 col-12">
                             <!-- Card -->
                             <div class="card mb-4">
                                 <!-- Card body -->
                                 <div class="card-body">
                                     <div class="text-center">

                                         <h4 class="mb-0">'.$value->Nom.'</h4>
                                         <p class="mb-0"><b>'.$value->codeDevis.'</b><br>'.$value->tel.'<br>'.$value->mail.'<br>Le '.$value->created_at.'<br>
                                             <span class="text-dark">
                                             <span class="badge badge-success">Validé</span>
                                               <a href="#" id="'.$value->idcotation.'" nom="'.$value->codeDevis.'" title="supprimer"class="del"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                                             </span>
                                         </p>

                                     </div>
                                     <div class="d-flex justify-content-between border-bottom py-2 mt-6">
                                         <span><b>Type</b></span>
                                         <span class="text-dark">'.$value->type.'</span>
                                     </div>
                                     <div class="d-flex justify-content-between border-bottom py-2">
                                         <span><b>Nature</b></span>
                                         <span> '.$value->nature.'</span>
                                     </div>
                                     <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                         <span><b>Voie</b></span>
                                         <span class="text-dark">'.$value->voie.'</span>
                                     </div>
                                     <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                         <span><b>Pays</b></span>
                                         <span class="text-dark">'.$value->pays_destination.'</span>
                                     </div>
                                     <div class="d-flex justify-content-between pt-2 border-bottom py-2">
                                         <span><b>Port</b></span>
                                         <span class="text-dark">'.$value->arrive.'</span>
                                     </div>

                                     <div class="d-flex justify-content-between pt-2 py-2">
                                         <span><b>Poids</b></span>
                                         <span class="text-dark">'.$value->poids.'</span>
                                     </div>
                                 </div>
                             </div>
           </div>';
       }
     }else{
       $output.='<div class="alert alert-danger col-lg-12" role="alert">Aucun devis</div>';
     }
     $output.="
       <script type='text/javascript'>
       //Suppression de devis
       $('.del').click(function(){
          var id = $(this).attr('id');
          var nom = $(this).attr('nom');
          var data = {id:id,nom:nom};
          console.log('nom: '+nom+'id: '+id);
          Swal.fire({
               title: 'GESTION DE DEVIS',
               text: 'Voulez-vous supprimer le devis '+nom+' ?',
               icon: 'error',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               cancelButtonText: 'non',
               confirmButtonText: 'oui , supprimer!',
               backdrop: `rgba(240,15,83,0.4)`
             }).then((result)=>{
               if (result.value) {
                 $.ajax({
                    url:'supDevis',
                    method:'GET',
                    data:data,
                    dataType:'json',
                    success:function(data){
                      if (data.code==2) {
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Le devis '+nom+' a été supprimé avec succès',
                          showConfirmButton: false,
                          timer: 1500
                        });
                        window.location='devis_valide';
                      }
                    },
                    error:function(data){
                      console.log('error');
                    }
                 });
               }
             });
       });

       //Rejet du devis
       $('.rejete').click(function(){
          var id = $(this).attr('id');
          var nom = $(this).attr('nom');
          var data = {id:id,nom:nom};
          console.log('nom: '+nom+'id: '+id);
          Swal.fire({
               title: 'GESTION DE DEVIS',
               text: 'Voulez-vous rejeter le devis '+nom+' ?',
               icon: 'error',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               cancelButtonText: 'non',
               confirmButtonText: 'oui , rejeter!',
               backdrop: `rgba(240,15,83,0.4)`
             }).then((result)=>{
               if (result.value) {
                 $.ajax({
                    url:'rejeteDevis',
                    method:'GET',
                    data:data,
                    dataType:'json',
                    success:function(data){
                      if (data.code==2) {
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Le devis '+nom+' a été rejeté avec succès',
                          showConfirmButton: false,
                          timer: 1500
                        });
                        window.location='devis_valide';
                      }
                    },
                    error:function(data){
                      console.log('error');
                    }
                 });
               }
             });
       });

       //Suppression de devis
       $('.del').click(function(){
          var id = $(this).attr('id');
          var nom = $(this).attr('nom');
          var data = {id:id,nom:nom};
          console.log('nom: '+nom+'id: '+id);
          Swal.fire({
               title: 'GESTION DE DEVIS',
               text: 'Voulez-vous supprimer le devis '+nom+' ?',
               icon: 'error',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               cancelButtonText: 'non',
               confirmButtonText: 'oui , supprimer!',
               backdrop: `rgba(240,15,83,0.4)`
             }).then((result)=>{
               if (result.value) {
                 $.ajax({
                    url:'supDevis',
                    method:'GET',
                    data:data,
                    dataType:'json',
                    success:function(data){
                      if (data.code==2) {
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Le devis '+nom+' a été supprimé avec succès',
                          showConfirmButton: false,
                          timer: 1500
                        });
                        window.location='devis_valide';
                      }
                    },
                    error:function(data){
                      console.log('error');
                    }
                 });
               }
             });
       });


       </script>
     ";
     return $output;
   }




#Gestion des Imports

//Lecture des importations spécifique du client
public function impCl(Request $request)
{
  $client = $request->idcl;
  return view('singleImpClient')->with('idcl',$client);
}

//Filtre des importations
public function filtreImpv(Request $request)
{
  $attribut = $request->attribut;
  $valeur   = $request->valeur;
  $imp =  filtreImp($attribut,$valeur,1);
  $nbImp = count($imp);
  $output='';
  if ($nbImp!=0) {
    foreach ($imp as $key => $value) {
      $output.='
         <!-- Card -->
         <div class="card mb-4">

         <!-- Card body -->
         <div class="card-body">
             <div class="text-center">
                 <h4 class="mb-0">'.nomCl($value->client_id).'</h4>
                 <p class="mb-0">
                   '.entreprise($value->client_id).'<br>
                     '.mailClient($value->client_id).'<br>
                       '.TelClient($value->client_id).'<br>
                         <b>'.$value->codeImp.'</b><br>
                         <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           <strong>Descrption: </strong> <span class="descrp">'.$value->description.'</span>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                   <span class="badge badge-info">En cours</span><br>

                     <span class="text-dark">
                       <br><a href="#" class="details" id="'.$value->idimport.'"><i class="fe fe-eye font-size-lg text-warning"></i></a>
                       <a href="#" id="'.$value->idimport.'" nom="'.$value->codeImp.'" title="Validé" class="valide"><i class="fe fe-user-check font-size-lg text-success"></i></a>
                       <a href="#" id="'.$value->idimport.'" nom="'.$value->codeImp.'" class="sup" title="Supprimer"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                     </span>
                 </p>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>Doss</span>
                 <span class="text-dark">';

                 if ($value->doss=="") {
                   $output.='<b><input type="date" name="dosse" class="dosse"></b>';
                 }else{
                   $output.='<b>'.$value->d1.'</b>';
                   $output.='<b><input type="hidden" name="dosse" class="dosse" value="'.$value->d1.'"></b>';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>FDI</span>
                 <span class="text-dark">';

                 if ($value->fdi=="") {
                   $output.='<b><input type="date" name="fdie" class="fdie"></b>';
                 }else{
                   $output.='<b>'.$value->d2.'</b>';
                   $output.='<b><input type="hidden" name="fdie" class="fdie" value="'.$value->d2.'"></b>';
                 }

                $output.='</span>
             </div>


             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>BSC</span>
                 <span class="text-dark">';

                 if ($value->bsc=="") {
                   $output.='<b><input type="date" name="bsce" class="bsce"></b>';
                 }else{
                   $output.='<b>'.$value->d3.'</b>';
                   $output.='<b><input type="hidden" name="bsce" class="bsce" value="'.$value->d3.'"></b>';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>RFCV</span>
                 <span class="text-dark">';

                 if ($value->rfcv=="") {
                   $output.='<input type="date" class="rfcvee" name="rfcvee">';
                 }else{
                   $output.='<b>'.$value->d4.'</b>';
                   $output.='<input type="hidden" class="rfcvee" name="rfcvee" value="'.$value->d4.'">';
                 }

                $output.='</span>
              </div>

              <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                  <span>TD</span>
                  <span class="text-dark">';

                  if ($value->td=="") {
                    $output.='<input type="date" class="tdee" name="tdee">';
                  }else{
                    $output.='<b>'.$value->d5.'</b>';
                    $output.='<input type="hidden" class="tdee" name="tdee" value="'.$value->d5.'">';
                  }

                 $output.='</span>
               </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>DD</span>
                 <span class="text-dark">';

                 if ($value->dd=="") {
                   $output.='<input type="date" name="dde" class="dde">';
                 }else{
                   $output.='<b>'.$value->d6.'</b>';
                   $output.='<input type="hidden" class="dde" name="dde" value="'.$value->d6.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>PFP</span>
                 <span class="text-dark">';

                 if ($value->pfp=="") {
                   $output.='<input type="date" name="pfp" class="pfp">';
                 }else{
                   $output.='<b>'.$value->d7.'</b>';
                   $output.='<input type="hidden" name="pfp" class="pfp" value="'.$value->d7.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>LIV</span>
                 <span class="text-dark">';

                 if ($value->liv=="") {
                   $output.='<input type="date" name="live" class="live">';
                 }else{
                   $output.='<b>'.$value->d8.'</b>';
                   $output.='<input type="hidden" name="live" class="live" value="'.$value->d8.'">';
                 }
                $output.='</span>
             </div>

            <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>VSD</span>
                 <span class="text-dark">';

                 if ($value->vsd=="") {
                   $output.='<input type="date" name="vsde" class="vsde">';
                 }else{
                   $output.='<b>'.$value->d9.'</b>';
                   $output.='<input type="hidden" name="vsde" class="vsde" value="'.$value->d9.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                  <span>BED</span>
                  <span class="text-dark">';

                  if ($value->bed=="") {
                    $output.='<input type="date" name="bede" class="bede">';
                  }else{
                    $output.='<b>'.$value->d10.'</b>';
                    $output.='<input type="hidden" name="bede" class="bede" value="'.$value->d10.'">';
                  }

                 $output.='</span>
              </div>

              <span class="badge badge-success btn valExport">Modifier</span>

          </div>
          <input type="hidden" class="idimp" value="'.$value->idimport.'">

         </div>
        ';
    }
  }else{
    $output.='<div class="alert alert-danger col-lg-12" role="alert">Aucune Importations</div>';
  }
$output.="<script type='text/javascript'>";

  //Supprimer
     $output.="
        $('.sup').click(function(){
        var code = $(this).attr('nom');
        var id   = $(this).attr('id');
        var data = {id:id};
        Swal.fire({
             title: 'SUPPRESSION DES IMPORTS',
             text: 'Voulez-vous supprimer '+code+' ?',
             icon: 'error',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: 'non',
             confirmButtonText: 'oui , valider!',
             backdrop: `rgba(240,15,83,0.4)`
           }).then((result)=>{
               if (result.value) {
                  $.ajax({
                    url:'DelImp',
                    method:'GET',
                    data:data,
                    dataType:'json',
                     success:function(data){
                       if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: code+' a été supprimée avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='new_importLV';
                     }

                     },
                     error:function(data){
                        console.log(data);
                     }
                  });
               }
           });
     });";

 //Valider
   $output.="
      $('.valide').click(function(){
      var code = $(this).attr('nom');
      var id   = $(this).attr('id');
      var data = {id:id};
      Swal.fire({
           title: 'VALIDATION DES IMPORTS',
           text: 'Voulez-vous valider '+code+' ?',
           icon: 'error',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           cancelButtonText: 'non',
           confirmButtonText: 'oui , valider!',
           backdrop: `rgba(240,15,83,0.4)`
         }).then((result)=>{
             if (result.value) {
                $.ajax({
                  url:'valideImp',
                  method:'GET',
                  data:data,
                  dataType:'json',
                   success:function(data){
                     if (data.code==2) {
                     Swal.fire({
                       position: 'top-end',
                       icon: 'success',
                       title: code+' a été validée avec succès',
                       showConfirmButton: false,
                       timer: 1500
                     });
                     window.location='new_importLV';
                   }

                   },
                   error:function(data){
                      console.log(data);
                   }
                });
             }
         });
   });";

 //Mise en etat
 $output.="$('.valExport').click(function(){
   var doss     = $('.dosse').val();
   var fdi      = $('.fdie').val();
   var bsc      = $('.bsce').val();
   var rfcv     = $('.rfcvee').val();
   var td       = $('.tdee').val();
   var dd       = $('.dde').val();
   var pfp      = $('.pfpe').val();
   var liv      = $('.live').val();
   var vsd      = $('.vsde').val();
   var bed      = $('.bede').val();
   var idimp    = $('.idimp').val();
   //var data    = {fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,td:td,ded:ded,bd:bd,pfp:pfp,dn:dn,rc:rc,idexp:id};
   var datL    = {doss:doss,fdi:fdi,bsc:bsc,rfcv:rfcv,td:td};
   var datM    = {dd:dd,pfp:pfp,liv:liv,vsd:vsd,bed:bed,idimp:idimp};
   var data    = {doss:doss,fdi:fdi,bsc:bsc,rfcv:rfcv,td:td,dd:dd,pfp:pfp,liv:liv,vsd:vsd,bed:bed,idimp:idimp};
   //console.log(idimp);
   //console.log(datM);
   //console.log(datL);
   console.log(data);
   $.ajax({
     url:'import',
     method:'GET',
     data:data,
     dataType:'json',
     success:function(data){
       if (data.code==2) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Mise en etat effectué avec succès',
          showConfirmButton: false,
          timer: 1500
        });
        window.location='new_importLV';
      }
     },
     error:function(data){
        console.log(data);
     }

  });

 });";


$output.="</script>";

  return $output;
}


// filtre de recherche filtreImp($attribut,$valeur,$etat)
public function filtreImp(Request $request)
{
  $attribut = $request->attribut;
  $valeur   = $request->valeur;
  $imp =  filtreImp($attribut,$valeur,0);
  $nbImp = count($imp);
  $output='';
  if ($nbImp!=0) {
    foreach ($imp as $key => $value) {
      $output.='
         <!-- Card -->
         <div class="card mb-4">

         <!-- Card body -->
         <div class="card-body">
             <div class="text-center">
                 <h4 class="mb-0">'.nomCl($value->client_id).'</h4>
                 <p class="mb-0">
                   '.entreprise($value->client_id).'<br>
                     '.mailClient($value->client_id).'<br>
                       '.TelClient($value->client_id).'<br>
                         <b>'.$value->codeImp.'</b><br>
                         <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           <strong>Descrption: </strong> <span class="descrp">'.$value->description.'</span>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                   <span class="badge badge-info">En cours</span><br>

                     <span class="text-dark">
                       <br><a href="#" class="details" id="'.$value->idimport.'"><i class="fe fe-eye font-size-lg text-warning"></i></a>
                       <a href="#" id="'.$value->idimport.'" nom="'.$value->codeImp.'" title="Validé" class="valide"><i class="fe fe-user-check font-size-lg text-success"></i></a>
                       <a href="#" id="'.$value->idimport.'" nom="'.$value->codeImp.'" class="sup" title="Supprimer"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                     </span>
                 </p>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>Doss</span>
                 <span class="text-dark">';

                 if ($value->doss=="") {
                   $output.='<b><input type="date" name="dosse" class="dosse"></b>';
                 }else{
                   $output.='<b>'.$value->d1.'</b>';
                   $output.='<b><input type="hidden" name="dosse" class="dosse" value="'.$value->d1.'"></b>';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>FDI</span>
                 <span class="text-dark">';

                 if ($value->fdi=="") {
                   $output.='<b><input type="date" name="fdie" class="fdie"></b>';
                 }else{
                   $output.='<b>'.$value->d2.'</b>';
                   $output.='<b><input type="hidden" name="fdie" class="fdie" value="'.$value->d2.'"></b>';
                 }

                $output.='</span>
             </div>


             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>BSC</span>
                 <span class="text-dark">';

                 if ($value->bsc=="") {
                   $output.='<b><input type="date" name="bsce" class="bsce"></b>';
                 }else{
                   $output.='<b>'.$value->d3.'</b>';
                   $output.='<b><input type="hidden" name="bsce" class="bsce" value="'.$value->d3.'"></b>';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>RFCV</span>
                 <span class="text-dark">';

                 if ($value->rfcv=="") {
                   $output.='<input type="date" class="rfcvee" name="rfcvee">';
                 }else{
                   $output.='<b>'.$value->d4.'</b>';
                   $output.='<input type="hidden" class="rfcvee" name="rfcvee" value="'.$value->d4.'">';
                 }

                $output.='</span>
              </div>

              <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                  <span>TD</span>
                  <span class="text-dark">';

                  if ($value->td=="") {
                    $output.='<input type="date" class="tdee" name="tdee">';
                  }else{
                    $output.='<b>'.$value->d5.'</b>';
                    $output.='<input type="hidden" class="tdee" name="tdee" value="'.$value->d5.'">';
                  }

                 $output.='</span>
               </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>DD</span>
                 <span class="text-dark">';

                 if ($value->dd=="") {
                   $output.='<input type="date" name="dde" class="dde">';
                 }else{
                   $output.='<b>'.$value->d6.'</b>';
                   $output.='<input type="hidden" class="dde" name="dde" value="'.$value->d6.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>PFP</span>
                 <span class="text-dark">';

                 if ($value->pfp=="") {
                   $output.='<input type="date" name="pfp" class="pfp">';
                 }else{
                   $output.='<b>'.$value->d7.'</b>';
                   $output.='<input type="hidden" name="pfp" class="pfp" value="'.$value->d7.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>LIV</span>
                 <span class="text-dark">';

                 if ($value->liv=="") {
                   $output.='<input type="date" name="live" class="live">';
                 }else{
                   $output.='<b>'.$value->d8.'</b>';
                   $output.='<input type="hidden" name="live" class="live" value="'.$value->d8.'">';
                 }
                $output.='</span>
             </div>

            <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>VSD</span>
                 <span class="text-dark">';

                 if ($value->vsd=="") {
                   $output.='<input type="date" name="vsde" class="vsde">';
                 }else{
                   $output.='<b>'.$value->d9.'</b>';
                   $output.='<input type="hidden" name="vsde" class="vsde" value="'.$value->d9.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                  <span>BED</span>
                  <span class="text-dark">';

                  if ($value->bed=="") {
                    $output.='<input type="date" name="bede" class="bede">';
                  }else{
                    $output.='<b>'.$value->d10.'</b>';
                    $output.='<input type="hidden" name="bede" class="bede" value="'.$value->d10.'">';
                  }

                 $output.='</span>
              </div>

              <span class="badge badge-success btn valExport">Modifier</span>

          </div>
          <input type="hidden" class="idimp" value="'.$value->idimport.'">

         </div>
        ';
    }
  }else{
    $output.='<div class="alert alert-danger col-lg-12" role="alert">Aucune Importations</div>';
  }
$output.="<script type='text/javascript'>";

  //Supprimer
     $output.="
        $('.sup').click(function(){
        var code = $(this).attr('nom');
        var id   = $(this).attr('id');
        var data = {id:id};
        Swal.fire({
             title: 'SUPPRESSION DES IMPORTS',
             text: 'Voulez-vous supprimer '+code+' ?',
             icon: 'error',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: 'non',
             confirmButtonText: 'oui , valider!',
             backdrop: `rgba(240,15,83,0.4)`
           }).then((result)=>{
               if (result.value) {
                  $.ajax({
                    url:'DelImp',
                    method:'GET',
                    data:data,
                    dataType:'json',
                     success:function(data){
                       if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: code+' a été supprimée avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='new_import';
                     }

                     },
                     error:function(data){
                        console.log(data);
                     }
                  });
               }
           });
     });";

 //Valider
   $output.="
      $('.valide').click(function(){
      var code = $(this).attr('nom');
      var id   = $(this).attr('id');
      var data = {id:id};
      Swal.fire({
           title: 'VALIDATION DES IMPORTS',
           text: 'Voulez-vous valider '+code+' ?',
           icon: 'error',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           cancelButtonText: 'non',
           confirmButtonText: 'oui , valider!',
           backdrop: `rgba(240,15,83,0.4)`
         }).then((result)=>{
             if (result.value) {
                $.ajax({
                  url:'valideImp',
                  method:'GET',
                  data:data,
                  dataType:'json',
                   success:function(data){
                     if (data.code==2) {
                     Swal.fire({
                       position: 'top-end',
                       icon: 'success',
                       title: code+' a été validée avec succès',
                       showConfirmButton: false,
                       timer: 1500
                     });
                     window.location='new_import';
                   }

                   },
                   error:function(data){
                      console.log(data);
                   }
                });
             }
         });
   });";

 //Mise en etat
 $output.="$('.valExport').click(function(){
   var doss     = $('.dosse').val();
   var fdi      = $('.fdie').val();
   var bsc      = $('.bsce').val();
   var rfcv     = $('.rfcvee').val();
   var td       = $('.tdee').val();
   var dd       = $('.dde').val();
   var pfp      = $('.pfpe').val();
   var liv      = $('.live').val();
   var vsd      = $('.vsde').val();
   var bed      = $('.bede').val();
   var idimp    = $('.idimp').val();
   //var data    = {fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,td:td,ded:ded,bd:bd,pfp:pfp,dn:dn,rc:rc,idexp:id};
   var datL    = {doss:doss,fdi:fdi,bsc:bsc,rfcv:rfcv,td:td};
   var datM    = {dd:dd,pfp:pfp,liv:liv,vsd:vsd,bed:bed,idimp:idimp};
   var data    = {doss:doss,fdi:fdi,bsc:bsc,rfcv:rfcv,td:td,dd:dd,pfp:pfp,liv:liv,vsd:vsd,bed:bed,idimp:idimp};
   //console.log(idimp);
   //console.log(datM);
   //console.log(datL);
   console.log(data);
   $.ajax({
     url:'import',
     method:'GET',
     data:data,
     dataType:'json',
     success:function(data){
       if (data.code==2) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Mise en etat effectué avec succès',
          showConfirmButton: false,
          timer: 1500
        });
        window.location='new_import';
      }
     },
     error:function(data){
        console.log(data);
     }

  });

 });";


$output.="</script>";

  return $output;
}

//Mise en etat
public function import(Request $request)
{
    if ($request->doss=="") {
      $doss = "";
      $d1   = "";
    }else{
      $doss = 1;
      $d1   = $request->doss;
    }
    if ($request->fdi=="") {
      $fdi = "";
      $d2   = "";
    }else{
      $fdi = 1;
      $d2   = $request->fdi;
    }

    if ($request->bsc=="") {
      $bsc = "";
      $d3   = "";
    }else{
      $bsc = 1;
      $d3   = $request->bsc;
    }
    if ($request->rfcv=="") {
      $rfcv = "";
      $d4   = "";
    }else{
      $rfcv = 1;
      $d4   = $request->rfcv;
    }

    if ($request->td=="") {
      $td = "";
      $d5   = "";
    }else{
      $td = 1;
      $d5   = $request->td;
    }

    if ($request->dd=="") {
      $dd = "";
      $d6   = "";
    }else{
      $dd = 1;
      $d6   = $request->dd;
    }
    if ($request->pfp=="") {
      $pfp = "";
      $d7   = "";
    }else{
      $pfp = 1;
      $d7  = $request->pfp;
    }

    if ($request->liv=="") {
      $liv = "";
      $d8   = "";
    }else{
      $liv = 1;
      $d8   = $request->liv;
    }
    if ($request->vsd=="") {
      $vsd = "";
      $d9   = "";
    }else{
      $vsd = 1;
      $d9  = $request->vsd;
    }

    if ($request->bed=="") {
      $bed = "";
      $d10  = "";
    }else{
      $bed = 1;
      $d10   = $request->bed;
    }

    $id = $request->idimp;
    $data = [$doss,$d1,$fdi,$d2,$bsc,$d3,$rfcv,$d4,$td,$d5,$dd,$d6,$pfp,$d7,$liv,$d8,$vsd,$d9,$bed,$d10,$id];
    $res = Upimport($doss,$d1,$fdi,$d2,$bsc,$d3,$rfcv,$d4,$td,$d5,$dd,$d6,$pfp,$d7,$liv,$d8,$vsd,$d9,$bed,$d10,$id);
    return response()->json(['code' => '2'],200);
}

//Validation des importations
public function valideImp(Request $request)
{
  $res = upStatImp($request->id,1);
  return response()->json(['code' => '2'],200);
}

//Suppression des importations
public function DelImp(Request $request)
{
  $res = upStatImp($request->id,3);
  return response()->json(['code' => '2'],200);
}

//Lecture des details
public function readImpDet(Request $request)
{
    $res        = ReadImpID($request->idExp);
    $nom        = $res->nom_filtre;
    $entreprise = $res->entreprise;
    $tel        = $res->tel;
    $mail       = $res->mail;
    $descrp     = $res->description;
    $code       = $res->codeImp;
    $id         = $request->idExp;
    //Doss
     if ($res->doss=='') {
      $doss = 'aucun';
     }else{
      $doss = $res->d1;
     }
     //FDI
      if ($res->fdi=='') {
       $fdi = 'aucun';
      }else{
       $fdi = $res->d2;
      }
      //BSC
       if ($res->bsc=='') {
        $bsc = 'aucun';
       }else{
        $bsc = $res->d3;
       }
       //rcfv
        if ($res->rfcv=='') {
         $rfcv = 'aucun';
        }else{
         $rfcv = $res->d4;
        }
        //TD
         if ($res->td=='') {
          $td = 'aucun';
         }else{
          $td = $res->d5;
         }
         //DD
          if ($res->dd=='') {
           $dd = 'aucun';
          }else{
           $dd = $res->d6;
          }
          //PFP
           if ($res->pfp=='') {
            $pfp = 'aucun';
           }else{
            $pfp = $res->d7;
           }
           //LIV
            if ($res->liv=='') {
             $liv = 'aucun';
            }else{
             $liv = $res->d8;
            }
            //vsd
             if ($res->vsd=='') {
              $vsd = 'aucun';
             }else{
              $vsd = $res->d9;
             }
             //bed
              if ($res->bed=='') {
               $bed = 'aucun';
              }else{
               $bed = $res->d10;
              }
            $data = ['descrp'=>$descrp,'doss'=>$doss,'fdi'=>$fdi,'bsc'=>$bsc,'rfcv'=>$rfcv,
                     'td'=>$td,'dd'=>$dd,'pfp'=>$pfp,'liv'=>$liv,'vsd'=>$vsd,
                     'bed'=>$bed,'code'=>$code,'id'=>$id,'nom'=>$nom,'entreprise'=>$entreprise,
                     'tel'=>$tel,'mail'=>$mail];
            $dataR = response()->json($data,200);
            return $dataR;
}

//Nouvelle importations
 public function addImport(Request $request)
 {
   return view('addImport');
 }

//Ajouter une nouvelle importation
public function addImp(Request $request)
{
    $code     = date("YmdHis").'exp';
    $descrp   = $request->descrp;
    $client   = $request->clients;
    $statut   = 0;
    $data     = ['code'=>$code,'descrp'=>$descrp,'client'=>$client,'statut'=>$statut];
    $res      = addImport($code,$client,$descrp,$statut);
    return redirect('new_import');
}

#Gestion des Exports

  // Nouveau exports
  public function addExport(Request $request)
  {
    return view('addExport');
  }

  // AJouter une nouvelle exportation
  public function addExp(Request $request)
  {
    $code     = date("YmdHis").'exp';
    $descrp   = $request->descrp;
    $client   = $request->clients;
    $statut   = 0;
    $data     = ['code'=>$code,'descrp'=>$descrp,'client'=>$client,'statut'=>$statut];
    $res = addExport($code,$client,$descrp,$statut);
    return redirect('new_export');
  }

  //Exporation spécifique d'un client
  public function filtreExpv(Request $request)
  {
     $res = filtreExp($request->attribut,$request->valeur,1);
     $nbExp = count($res);
     $output = '';
     if($nbExp!=0){
       foreach ($res as $key => $value){
        $output.='
         <!-- Card -->
         <div class="card mb-4">

         <!-- Card body -->
         <div class="card-body">
             <div class="text-center">
                 <h4 class="mb-0">'.nomCl($value->client_id).'</h4>
                 <p class="mb-0">
                   '.entreprise($value->client_id).'<br>
                     '.mailClient($value->client_id).'<br>
                       '.TelClient($value->client_id).'<br>
                         <b>'.$value->codeexport.'</b><br>
                         <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           <strong>Descrption: </strong> <span class="descrp">'.$value->description.'</span>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                   <span class="badge badge-success">validé</span><br>

                     <span class="text-dark">
                       <br><a href="#" class="details" id="'.$value->idExport.'"><i class="fe fe-eye font-size-lg text-warning"></i></a>
                       <a href="#" id="'.$value->idExport.'" nom="'.$value->codeexport.'" title="Validé" class="valide"><i class="fe fe-user-check font-size-lg text-success"></i></a>
                       <a href="#" id="'.$value->idExport.'" nom="'.$value->codeexport.'" class="sup" title="Supprimer"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                     </span>
                 </p>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>Fret</span>
                 <span class="text-dark">';

                 if ($value->fret=="") {
                   $output.='<b><input type="date" name="frt" class="frt"></b>';
                 }else{
                   $output.='<b>'.$value->d1.'</b>';
                   $output.='<b><input type="hidden" name="frt" class="frt" value="'.$value->d1.'"></b>';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>Booking</span>
                 <span class="text-dark">';

                 if ($value->booking=="") {
                   $output.='<b><input type="date" name="book" class="book"></b>';
                 }else{
                   $output.='<b>'.$value->d2.'</b>';
                   $output.='<b><input type="hidden" name="book" class="book" value="'.$value->d2.'"></b>';
                 }

                $output.='</span>
             </div>


             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>Emb</span>
                 <span class="text-dark">';

                 if ($value->emb=="") {
                   $output.='<b><input type="date" name="emb" class="emb"></b>';
                 }else{
                   $output.='<b>'.$value->d3.'</b>';
                   $output.='<b><input type="hidden" name="emb" class="emb" value="'.$value->d3.'"></b>';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>AE</span>
                 <span class="text-dark">';

                 if ($value->ae=="") {
                   $output.='<input type="date" class="ae" name="ae">';
                 }else{
                   $output.='<b>'.$value->d4.'</b>';
                   $output.='<input type="hidden" class="ae" name="ae" value="'.$value->d4.'">';
                 }

                $output.='</span>
              </div>

              <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                  <span>Chg</span>
                  <span class="text-dark">';

                  if ($value->chg=="") {
                    $output.='<input type="date" class="chg" name="chg">';
                  }else{
                    $output.='<b>'.$value->d5.'</b>';
                    $output.='<input type="hidden" class="chg" name="chg" value="'.$value->d5.'">';
                  }

                 $output.='</span>
               </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>TD</span>
                 <span class="text-dark">';

                 if ($value->td=="") {
                   $output.='<input type="date" name="td" class="ted">';
                 }else{
                   $output.='<b>'.$value->d6.'</b>';
                   $output.='<input type="hidden" class="ted" name="td" value="'.$value->d6.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>DED</span>
                 <span class="text-dark">';

                 if ($value->ded=="") {
                   $output.='<input type="date" name="ded" class="ded">';
                 }else{
                   $output.='<b>'.$value->d7.'</b>';
                   $output.='<input type="hidden" name="ded" class="ded" value="'.$value->d7.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>BD</span>
                 <span class="text-dark">';

                 if ($value->bd=="") {
                   $output.='<input type="date" name="bd" class="bd">';
                 }else{
                   $output.='<b>'.$value->d8.'</b>';
                   $output.='<input type="hidden" name="bd" class="bd" value="'.$value->d8.'">';
                 }

                $output.='</span>
             </div>

            <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>PFP</span>
                 <span class="text-dark">';

                 if ($value->pfp=="") {
                   $output.='<input type="date" name="pfp" class="pfp">';
                 }else{
                   $output.='<b>'.$value->d9.'</b>';
                   $output.='<input type="hidden" name="pfp" class="pfp" value="'.$value->d9.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                  <span>RC</span>
                  <span class="text-dark">';

                  if ($value->rc=="") {
                    $output.='<input type="date" name="rc" class="rc">';
                  }else{
                    $output.='<b>'.$value->d10.'</b>';
                    $output.='<input type="hidden" name="rc" class="rc" value="'.$value->d10.'">';
                  }

                 $output.='</span>
              </div>

              <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                   <span>DN</span>
                   <span class="text-dark">';

                   if ($value->dn=="") {
                     $output.='<input type="date" name="dn" class="dn">';
                   }else{
                     $output.='<b>'.$value->d11.'</b>';
                     $output.='<input type="hidden" name="dn" class="dn" value="'.$value->d11.'">';
                   }

                  $output.='</span>
               </div>
               <span class="badge badge-success btn valExport">Modifier</span>

          </div>
          <input type="hidden" class="idex" value="'.$value->idExport.'">

         </div>
        ';
       }
     }else{
       $output.='<div class="alert alert-danger col-lg-12" role="alert">Aucune exportations</div>';
     }

     //Modal de details

     $output.="<script type='text/javascript'>";
     //Valider
     $output.="
        $('.valide').click(function(){
        var code = $(this).attr('nom');
        var id   = $(this).attr('id');
        var data = {id:id};
        Swal.fire({
             title: 'VALIDATION DES EXPORTS',
             text: 'Voulez-vous valider '+code+' ?',
             icon: 'error',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: 'non',
             confirmButtonText: 'oui , valider!',
             backdrop: `rgba(240,15,83,0.4)`
           }).then((result)=>{
               if (result.value) {
                  $.ajax({
                    url:'valideExp',
                    method:'GET',
                    data:data,
                    dataType:'json',
                     success:function(data){
                       if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: code+' a été validée avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='new_export';
                     }

                     },
                     error:function(data){
                        console.log(data);
                     }
                  });
               }
           });
     });";

     //Supprimer
     $output.="
        $('.sup').click(function(){
        var code = $(this).attr('nom');
        var id   = $(this).attr('id');
        var data = {id:id};
        Swal.fire({
             title: 'SUPPRESSION DES EXPORTS',
             text: 'Voulez-vous supprimer '+code+' ?',
             icon: 'error',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: 'non',
             confirmButtonText: 'oui , valider!',
             backdrop: `rgba(240,15,83,0.4)`
           }).then((result)=>{
               if (result.value) {
                  $.ajax({
                    url:'DelExp',
                    method:'GET',
                    data:data,
                    dataType:'json',
                     success:function(data){
                       if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: code+' a été supprimée avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='new_export';
                     }

                     },
                     error:function(data){
                        console.log(data);
                     }
                  });
               }
           });
     });";

     // Mise en etat
     $output.="
     $('.valExport').click(function(){
       var fret    = $('.frt').val();
       var booking = $('.book').val();
       var emb     = $('.emb').val();
       var ae      = $('.ae').val();
       var chg     = $('.chg').val();
       var td      = $('.ted').val();
       var ded     = $('.ded').val();
       var bd      = $('.bd').val();
       var pfp     = $('.pfp').val();
       var rc      = $('.rc').val();
       var dn      = $('.dn').val();
       var id      = $('.idex').val();
       var datL    = {td:td,ded:ded,bd:bd,pfp:pfp,rc:rc,dn:dn};
       var datM    = {fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,idexp:id};
       var data    = {td:td,ded:ded,bd:bd,pfp:pfp,rc:rc,dn:dn,fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,idexp:id};
       console.log(id);
       //console.log(datM);
       //console.log(datL);
       console.log(data);
       $.ajax({
          url:'export',
          method:'GET',
          data:data,
          dataType:'json',
          success:function(data){
            if (data.code==2) {
             Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Mise en etat effectué avec succès',
               showConfirmButton: false,
               timer: 1500
             });
             window.location='new_export';
           }
          },
          error:function(data){
             console.log(data);
          }

       });

     });";



     $output.="</script>";
     return $output;
  }

  //Filre importation d'un client particulier
  public function expCl(Request $request)
  {
    $client = $request->idcl;
    return view('singleClient')->with('idcl',$client);
  }

  //Filtre de recherche exportation en cours
  public function filtreExp(Request $request)
  {
     $res = filtreExp($request->attribut,$request->valeur,0);
     $nbExp = count($res);
     $output = '';
     if($nbExp!=0){
       foreach ($res as $key => $value){
        $output.='
         <!-- Card -->
         <div class="card mb-4">

         <!-- Card body -->
         <div class="card-body">
             <div class="text-center">
                 <h4 class="mb-0">'.nomCl($value->client_id).'</h4>
                 <p class="mb-0">
                   '.entreprise($value->client_id).'<br>
                     '.mailClient($value->client_id).'<br>
                       '.TelClient($value->client_id).'<br>
                         <b>'.$value->codeexport.'</b><br>
                         <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           <strong>Descrption: </strong> <span class="descrp">'.$value->description.'</span>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                   <span class="badge badge-info">En cours</span><br>

                     <span class="text-dark">
                       <br><a href="#" class="details" id="'.$value->idExport.'"><i class="fe fe-eye font-size-lg text-warning"></i></a>
                       <a href="#" id="'.$value->idExport.'" nom="'.$value->codeexport.'" title="Validé" class="valide"><i class="fe fe-user-check font-size-lg text-success"></i></a>
                       <a href="#" id="'.$value->idExport.'" nom="'.$value->codeexport.'" class="sup" title="Supprimer"><i class="fe fe-trash font-size-lg text-danger"></i></a>
                     </span>
                 </p>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>Fret</span>
                 <span class="text-dark">';

                 if ($value->fret=="") {
                   $output.='<b><input type="date" name="frt" class="frt"></b>';
                 }else{
                   $output.='<b>'.$value->d1.'</b>';
                   $output.='<b><input type="hidden" name="frt" class="frt" value="'.$value->d1.'"></b>';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>Booking</span>
                 <span class="text-dark">';

                 if ($value->booking=="") {
                   $output.='<b><input type="date" name="book" class="book"></b>';
                 }else{
                   $output.='<b>'.$value->d2.'</b>';
                   $output.='<b><input type="hidden" name="book" class="book" value="'.$value->d2.'"></b>';
                 }

                $output.='</span>
             </div>


             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>Emb</span>
                 <span class="text-dark">';

                 if ($value->emb=="") {
                   $output.='<b><input type="date" name="emb" class="emb"></b>';
                 }else{
                   $output.='<b>'.$value->d3.'</b>';
                   $output.='<b><input type="hidden" name="emb" class="emb" value="'.$value->d3.'"></b>';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>AE</span>
                 <span class="text-dark">';

                 if ($value->ae=="") {
                   $output.='<input type="date" class="ae" name="ae">';
                 }else{
                   $output.='<b>'.$value->d4.'</b>';
                   $output.='<input type="hidden" class="ae" name="ae" value="'.$value->d4.'">';
                 }

                $output.='</span>
              </div>

              <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                  <span>Chg</span>
                  <span class="text-dark">';

                  if ($value->chg=="") {
                    $output.='<input type="date" class="chg" name="chg">';
                  }else{
                    $output.='<b>'.$value->d5.'</b>';
                    $output.='<input type="hidden" class="chg" name="chg" value="'.$value->d5.'">';
                  }

                 $output.='</span>
               </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>TD</span>
                 <span class="text-dark">';

                 if ($value->td=="") {
                   $output.='<input type="date" name="td" class="ted">';
                 }else{
                   $output.='<b>'.$value->d6.'</b>';
                   $output.='<input type="hidden" class="ted" name="td" value="'.$value->d6.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>DED</span>
                 <span class="text-dark">';

                 if ($value->ded=="") {
                   $output.='<input type="date" name="ded" class="ded">';
                 }else{
                   $output.='<b>'.$value->d7.'</b>';
                   $output.='<input type="hidden" name="ded" class="ded" value="'.$value->d7.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>BD</span>
                 <span class="text-dark">';

                 if ($value->bd=="") {
                   $output.='<input type="date" name="bd" class="bd">';
                 }else{
                   $output.='<b>'.$value->d8.'</b>';
                   $output.='<input type="hidden" name="bd" class="bd" value="'.$value->d8.'">';
                 }

                $output.='</span>
             </div>

            <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                 <span>PFP</span>
                 <span class="text-dark">';

                 if ($value->pfp=="") {
                   $output.='<input type="date" name="pfp" class="pfp">';
                 }else{
                   $output.='<b>'.$value->d9.'</b>';
                   $output.='<input type="hidden" name="pfp" class="pfp" value="'.$value->d9.'">';
                 }

                $output.='</span>
             </div>

             <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                  <span>RC</span>
                  <span class="text-dark">';

                  if ($value->rc=="") {
                    $output.='<input type="date" name="rc" class="rc">';
                  }else{
                    $output.='<b>'.$value->d10.'</b>';
                    $output.='<input type="hidden" name="rc" class="rc" value="'.$value->d10.'">';
                  }

                 $output.='</span>
              </div>

              <div class="d-flex justify-content-between border-bottom py-3 mt-2">
                   <span>DN</span>
                   <span class="text-dark">';

                   if ($value->dn=="") {
                     $output.='<input type="date" name="dn" class="dn">';
                   }else{
                     $output.='<b>'.$value->d11.'</b>';
                     $output.='<input type="hidden" name="dn" class="dn" value="'.$value->d11.'">';
                   }

                  $output.='</span>
               </div>
               <span class="badge badge-success btn valExport">Modifier</span>

          </div>
          <input type="hidden" class="idex" value="'.$value->idExport.'">

         </div>
        ';
       }
     }else{
       $output.='<div class="alert alert-danger col-lg-12" role="alert">Aucune exportations</div>';
     }

     //Modal de details

     $output.="<script type='text/javascript'>";
     //Valider
     $output.="
        $('.valide').click(function(){
        var code = $(this).attr('nom');
        var id   = $(this).attr('id');
        var data = {id:id};
        Swal.fire({
             title: 'VALIDATION DES EXPORTS',
             text: 'Voulez-vous valider '+code+' ?',
             icon: 'error',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: 'non',
             confirmButtonText: 'oui , valider!',
             backdrop: `rgba(240,15,83,0.4)`
           }).then((result)=>{
               if (result.value) {
                  $.ajax({
                    url:'valideExp',
                    method:'GET',
                    data:data,
                    dataType:'json',
                     success:function(data){
                       if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: code+' a été validée avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='new_export';
                     }

                     },
                     error:function(data){
                        console.log(data);
                     }
                  });
               }
           });
     });";

     //Supprimer
     $output.="
        $('.sup').click(function(){
        var code = $(this).attr('nom');
        var id   = $(this).attr('id');
        var data = {id:id};
        Swal.fire({
             title: 'SUPPRESSION DES EXPORTS',
             text: 'Voulez-vous supprimer '+code+' ?',
             icon: 'error',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: 'non',
             confirmButtonText: 'oui , valider!',
             backdrop: `rgba(240,15,83,0.4)`
           }).then((result)=>{
               if (result.value) {
                  $.ajax({
                    url:'DelExp',
                    method:'GET',
                    data:data,
                    dataType:'json',
                     success:function(data){
                       if (data.code==2) {
                       Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: code+' a été supprimée avec succès',
                         showConfirmButton: false,
                         timer: 1500
                       });
                       window.location='new_export';
                     }

                     },
                     error:function(data){
                        console.log(data);
                     }
                  });
               }
           });
     });";

     // Mise en etat
     $output.="
     $('.valExport').click(function(){
       var fret    = $('.frt').val();
       var booking = $('.book').val();
       var emb     = $('.emb').val();
       var ae      = $('.ae').val();
       var chg     = $('.chg').val();
       var td      = $('.ted').val();
       var ded     = $('.ded').val();
       var bd      = $('.bd').val();
       var pfp     = $('.pfp').val();
       var rc      = $('.rc').val();
       var dn      = $('.dn').val();
       var id      = $('.idex').val();
       var datL    = {td:td,ded:ded,bd:bd,pfp:pfp,rc:rc,dn:dn};
       var datM    = {fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,idexp:id};
       var data    = {td:td,ded:ded,bd:bd,pfp:pfp,rc:rc,dn:dn,fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,idexp:id};
       console.log(id);
       //console.log(datM);
       //console.log(datL);
       console.log(data);
       $.ajax({
          url:'export',
          method:'GET',
          data:data,
          dataType:'json',
          success:function(data){
            if (data.code==2) {
             Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Mise en etat effectué avec succès',
               showConfirmButton: false,
               timer: 1500
             });
             window.location='new_export';
           }
          },
          error:function(data){
             console.log(data);
          }

       });

     });";



     $output.="</script>";
     return $output;
  }

  // Validé une exportation
  public function valideExp(Request $request)
  {
    $res = upStat($request->id,1);
    return response()->json(['code' => '2'],200);
  }

  // Supprimer une exportation
  public function DelExp(Request $request)
  {
    $res = upStat($request->id,3);
    return response()->json(['code' => '2'],200);

  }


  //Mise en etat d'une operations d'exportation
  public function export(Request $request)
  {
    //dd($request);
    if ($request->fret=="") {
      $fret = "";
      $d1   = "";
    }else{
      $fret = 1;
      $d1   = $request->fret;
    }

    if ($request->booking=="") {
      $booking = "";
      $d2   = "";
    }else{
      $booking = 1;
      $d2   = $request->booking;
    }
    if ($request->emb=="") {
      $emb = "";
      $d3   = "";
    }else{
      $emb = 1;
      $d3   = $request->emb;
    }

    if ($request->ae=="") {
      $ae = "";
      $d4   = "";
    }else{
      $ae = 1;
      $d4   = $request->ae;
    }

    if ($request->chg=="") {
      $chg = "";
      $d5   = "";
    }else{
      $chg = 1;
      $d5   = $request->chg;
    }

    if ($request->td=="") {
          $td = "";
          $d6 = "";
        }else{
          $td = 1;
          $d6 = $request->td;
    }

    if ($request->ded=="") {
      $ded = "";
      $d7 = "";
    }else{
      $ded = 1;
      $d7 = $request->ded;
    }

    if ($request->bd=="") {
      $bd = "";
      $d8  = "";
    }else{
      $bd = 1;
      $d8  = $request->bd;
    }
    if ($request->pfp=="") {
      $pfp = "";
      $d9   = "";
    }else{
      $pfp = 1;
      $d9   = $request->pfp;
    }

    if ($request->rc=="") {
      $rc = "";
      $d10 = "";
    }else{
      $rc = 1;
      $d10 = $request->rc;
    }

    if ($request->dn=="") {
      $dn = "";
      $d11 = "";
    }else{
      $dn = 1;
      $d11 = $request->dn;
    }
    //dd($request);
    $id = $request->idexp;
    //dd($fret,$d1,$booking,$d2,$emb,$d3,$ae,$d4,$chg,$d5,$td,$d6,$ded,$d7,$bd,$d8,$pfp,$d9,$rc,$d10,$dn,$d11,$id);
    $res = upExp($fret,$d1,$booking,$d2,$emb,$d3,$ae,$d4,$chg,$d5,$td,$d6,$ded,$d7,$bd,$d8,$pfp,$d9,$rc,$d10,$dn,$d11,$id);
    return response()->json(['code' => '2'],200);
  }

  //Lecture des details
  public function readDet(Request $request)
  {
    $res        = ReadExpID($request->idExp);
    $nom        = $res->nom_filtre;
    $entreprise = $res->entreprise;
    $tel        = $res->tel;
    $mail       = $res->mail;
    $descrp     = $res->description;
    $code       = $res->code;
    //dd($res->ded);
    //Fret
     if ($res->fret=='') {
      $fret = 'aucun';
     }else{
      $fret = $res->d1;
     }
    //booking
    if ($res->booking=='') {
      $booking = 'aucun';
    }else{
      $booking = $res->d2;
    }
    //Embottage
    if ($res->emb=='') {
      $emb = 'aucun';
    }else{
      $emb = $res->d3;
    }
    //AE
    if ($res->ae=='') {
      $ae = 'aucun';
    }else{
      $ae = $res->d4;
    }
    //chg
    if ($res->chg=='') {
      $chg = 'aucun';
    }else{
      $chg = $res->d5;
    }
    //td
    if ($res->td=='') {
      $td = 'aucun';
    }else{
      $td = $res->d6;
    }
    //ded
    if ($res->ded=='') {
      $ded = 'aucun';
    }else{
      $ded = $res->d7;
    }
    //bd
    if ($res->bd=='') {
      $bd = 'aucun';
    }else{
      $bd = $res->d8;
    }
    //pfp
    if ($res->pfp=='') {
      $pfp = 'aucun';
    }else{
      $pfp = $res->d9;
    }
    //pfp
    if ($res->rc=='') {
      $rc = 'aucun';
    }else{
      $rc = $res->d10;
    }
    //dn
    if ($res->dn=='') {
      $dn = 'aucun';
    }else{
      $dn = $res->d11;
    }
    //id
    $id = $request->idExp;
    //dd($td);
    $data = ['ded'=>$ded,'bd'=>$bd,'pfp'=>$pfp,'nom'=>$nom,'entreprise'=>$entreprise,'tel'=>$tel,'mail'=>$mail,'descrp'=>$descrp,'dn'=>$dn,'rc'=>$rc,'fret'=>$fret,'booking'=>$booking,'emb'=>$emb,
             'ae'=>$ae,'chg'=>$chg,'td'=>$td,'code'=>$code,'id'=>$id];
    $dataR = response()->json($data,200);
    return $dataR;
  }

  //Nouvelle Opération d'export
  public function new_export()
  {
    return view('new_export');
  }
  //Opération d'export livrée
  public function new_exportLv()
  {
    return view('new_exportLv');
  }
  //Nouvelle operation d'importation
  public function new_import()
  {
    return view('new_import');
  }
  //Opération d'importation livrées
   public function new_importLV()
   {
     return view('new_importLV');
   }

  //Opérations d'unité SMS
  public function unite_sms()
  {
    return view('unite_sms');
  }

  //Gestion  des coordonnées administrateur
  public function coordonnes()
  {
    return view('coordonnes');
  }








}
