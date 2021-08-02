<?php
use Illuminate\Support\Facades\DB;
use App\Models\Cotation;
use App\Models\clients;
use App\Models\Exports;
use App\Models\Imports;
session_start();


function addDevis($type,$nature,$conteneur,$pays_destination,$poids,$voie,$arrive,$tel,$mail,$Nom,$code)
{
  $datacota = ['type'=>$type,'nature'=>$nature,'conteneur'=>$conteneur,'pays_destination'=>$pays_destination,'poids'=>$poids,'voie'=>$voie,'arrive'=>$arrive,'tel'=>$tel,'mail'=>$mail,'Nom'=>$Nom,'codeDevis'=>$code];
  $res = Cotation::create($datacota);
  return $res;
}

#Gestion des clients

function loginCli($tel,$pass)
{
  $clients = DB::table('clients')->where('clients.tel','=',$tel)->where('clients.pass','=',$pass)->first();
  return $clients;
}

function ReadClient()
{
  $clients = DB::table('clients')->orderBy('id', 'desc')->get();
  return $clients;
}

function ReadClientID($id)
{
  $clients = DB::table('clients')->where('clients.id','=',$id)->first();
  return $clients;
}

function TelClient($id)
{
  $clients = DB::table('clients')->where('clients.id','=',$id)->first();
  $tel = $clients->tel;
  return $tel;
}

function mailClient($id)
{
  $clients = DB::table('clients')->where('clients.id','=',$id)->first();
  $mail = $clients->mail;
  return $mail;
}

function entreprise($id)
{
  $clients = DB::table('clients')->where('clients.id','=',$id)->first();
  $entrep = $clients->entreprise;
  return $entrep;
}

function nomCl($id)
{
  $clients = DB::table('clients')->where('clients.id','=',$id)->first();
  $entrep = $clients->nom_filtre;
  return $entrep;
}

function nomClp($id)
{
  $clients = DB::table('clients')->where('clients.id','=',$id)->first();
  $entrep = $clients->prenom;
  return $entrep;
}

function nomCli($id)
{
  $clients = DB::table('clients')->where('clients.id','=',$id)->first();
  $entrep = $clients->nom;
  return $entrep;
}

function nomClpass($id)
{
  $clients = DB::table('clients')->where('clients.id','=',$id)->first();
  $entrep = $clients->pass;
  return $entrep;
}

function delClient($id)
{
  $res = DB::table('clients')->where('clients.id','=',$id)->delete();
  return $res;
}

function updateClient($nom,$prenom,$mail,$entrep,$tel,$pass,$id)
{
  $nomF = $nom.' '.$prenom;
  $dataUpd = ['nom'=>$nom,'prenom'=>$prenom,'entreprise'=>$entrep,'nom_filtre'=>$nomF,'mail'=>$mail,'tel'=>$tel,'pass'=>$pass];
  $res = DB::table('clients')
                 ->where('clients.id', '=', $id)
                 ->update($dataUpd);
  return $res;
}

function filtreClient($attribut,$valeur)
{
  //$res = DB::table('clients')->where($attribut,'=',$valeur)->orderBy('id', 'desc')->get();
  $res = Clients::query()->where($attribut, 'LIKE', "%{$valeur}%")
                  ->orderBy('id', 'desc')->get();
  return $res;
}

#Gestion des notifications
 //SMS
 function SMS($msg,$tel,$sender)
 {
    // Filtrer le messages
         $nvMsg = str_replace('à','a', $msg);
         $nvMsg = str_replace('á','a', $nvMsg);
         $nvMsg = str_replace('â','a', $nvMsg);
         $nvMsg = str_replace('ç','c', $nvMsg);
         $nvMsg = str_replace('è','e', $nvMsg);
         $nvMsg = str_replace('é','e', $nvMsg);
         $nvMsg = str_replace('ê','e', $nvMsg);
         $nvMsg = str_replace('ë','e', $nvMsg);
         $nvMsg = str_replace('ù','u', $nvMsg);
         $nvMsg = str_replace('ù','u', $nvMsg);
         $nvMsg = str_replace('ü','u', $nvMsg);
         $nvMsg = str_replace('û','u', $nvMsg);
         $nvMsg = str_replace('ô','o', $nvMsg);
         $nvMsg = str_replace('î','i', $nvMsg);
         $key = "3763339782bc5b94840f995a652718";
         $api = 'Authorization: Bearer '.$key."";
         // Step 1: Créer la campagne
         $curl = curl_init();
         $datas= [
           'step' => NULL,
           'sender' => $sender,
           'name' => 'SMS GRENIER',
           'campaignType' => 'SIMPLE',
           'recipientSource' => 'CUSTOM',
           'groupId' => NULL,
           'filename' => NULL,
           'saveAsModel' => false,
           'destination' => 'NAT_INTER',
           'message' => $msg,
           'emailText' => NULL,
           'recipients' =>
           [
             [
               'phone' => $tel,
             ],
           ],
           'sendAt' => [],
           'dlrUrl' => NULL,
           'responseUrl' => NULL,
         ];
         curl_setopt_array($curl, array(
           CURLOPT_URL => 'https://api.letexto.com/v1/campaigns',
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => '',
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 0,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => 'POST',
           CURLOPT_POSTFIELDS =>json_encode($datas),
           CURLOPT_HTTPHEADER => array(
             $api,
             'Content-Type: application/json'
           ),
         ));
         $response = curl_exec($curl);
         curl_close($curl);
         $res = json_decode($response);
         $camp_id = $res->id;

         // Step2: Programmer la campagne
         $curl_send = curl_init();
         curl_setopt_array($curl_send, array(
           CURLOPT_URL => 'https://api.letexto.com/v1/campaigns/'.$camp_id.'/schedules',
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => '',
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 0,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => 'POST',
           CURLOPT_HTTPHEADER => array(
             $api
           ),
         ));
         $response_send = curl_exec($curl_send);
         curl_close($curl_send);
         return $response_send;
 }


#Gestion des importations

function ImportClientNb($idClient)
{
  $import = DB::table('imports')->where('imports.client_id','=',$idClient)->get();
  $nb = count($import);
  return $nb;
}

function ImportClient($idClient)
{
   $imports = DB::table('imports')
                ->join('clients', 'imports.client_id', '=', 'clients.id')
                ->select('clients.*', 'imports.*')
                ->where('imports.client_id','=',$idClient)
                ->get();
   return $imports;
}

function ImportClientEtat($idClient,$etat)
{
   $imports = DB::table('imports')
                ->join('clients', 'imports.client_id', '=', 'clients.id')
                ->select('clients.*', 'imports.*')
                ->where('imports.client_id','=',$idClient)
                ->where('imports.statut','=',$etat)
                ->get();
   return $imports;
}
//Ajout d'importation
function addImport($code,$clientID,$descrp,$statut)
{
  $val = "";
  $res = DB::table('imports')->insert(['codeImp'=>$code,
                                      'client_id'=>$clientID,'description'=>$descrp,
                                      'statut'=>$statut,'doss'=>$val,'fdi'=>$val,
                                      'bsc'=>$val,'rfcv'=>$val,'td'=>$val,'dd'=>$val,'pfp'=>$val,
                                      'liv'=>$val,'vsd'=>$val,'bed'=>$val
                                    ]);
}

# Gestion des exportations

//Ajout des exportations
function addExport($code,$clientID,$descrp,$statut)
{
  $val = "";
  $res = DB::table('exports')->insert(['codeexport'=>$code,
                                      'client_id'=>$clientID,'description'=>$descrp,
                                      'statut'=>$statut,'fret'=>$val,'booking'=>$val,
                                      'emb'=>$val,'ae'=>$val,'chg'=>$val,'td'=>$val,'td'=>$val,
                                      'bd'=>$val,'pfp'=>$val,'rc'=>$val,'dn'=>$val
                                    ]);
  return $res;
}

function ExportClientNb($idClient)
{
  $export = DB::table('exports')->where('exports.client_id','=',$idClient)->get();
  $nb = count($export);
  return $nb;
}

function ExportClient($idClient)
{
   $export = DB::table('exports')
                ->join('clients', 'exports.client_id', '=', 'clients.id')
                ->select('clients.*', 'exports.*')
                ->where('exports.client_id','=',$idClient)
                ->get();
   return $export;
}

function ExportClientEtat($idClient,$etat)
{
   $export = DB::table('exports')
                ->join('clients','exports.client_id','=','clients.id')
                ->select('clients.*', 'exports.*')
                ->where('exports.client_id','=',$idClient)
                ->where('exports.statut','=',$etat)
                ->get();
   return $export;
}





#Gestion des devis
//Lecture des devis
 function ReadDevis($etat)
 {
   $devis = DB::table('cotations')->where('cotations.etat','=',$etat)->orderBy('idcotation', 'desc')->get();
   return $devis;
 }

 //Changement de l'etat
 function UpDevis($etat,$id)
 {
   $devis = DB::table('cotations')
              ->where('cotations.idcotation',$id)
              ->update(['etat' => $etat]);
   return $devis;
 }

 //Filtre de devis
 function filtreDevis($attribut,$valeur,$etat)
 {
   $res = Cotation::query()->where($attribut, 'LIKE', "%{$valeur}%")
                            ->where('cotations.etat','=',$etat)
                            ->orderBy('idcotation','desc')->get();
   return $res;
 }

#Gestion des exportations

   //Filtre de recherche
   function filtreExp($attribut,$valeur,$etat)
   {
     $res = Exports::query()->where($attribut, 'LIKE', "%{$valeur}%")
                             ->where('exports.statut','=',$etat)
                             ->orderBy('idExport','desc')->get();
     return $res;

   }

  //Statut de l'operation
  function upStat($id,$etat)
  {
    $exp = DB::table('exports')
              ->where('exports.idExport',$id)
              ->update(['exports.statut'=>$etat]);
  }

  //Mise en etat
  function upExp($fret,$d1,$booking,$d2,$emb,$d3,$ae,$d4,$chg,$d5,$td,$d6,$ded,$d7,$bd,$d8,$pfp,$d9,$rc,$d10,$dn,$d11,$id)
  {
     $exp = DB::table('exports')
               ->where('exports.idExport',$id)
               ->update(['fret'=>$fret,'d1'=>$d1,'booking'=>$booking,'d2'=>$d2,'emb'=>$emb,'d3'=>$d3,'ae'=>$ae,'d4'=>$d4,'chg'=>$chg,'d5'=>$d5,'td'=>$td,'d6'=>$d6,'ded'=>$ded,
                         'd7'=>$d7,'bd'=>$bd,'d8'=>$d8,'pfp'=>$pfp,'d9'=>$d9,'rc'=>$rc,'d10'=>$d10,'dn'=>$dn,'d11'=>$d11]);
     return $exp;
  }

  //Lecture des exportss en fonction de l'id
  function ReadExpID($id)
  {
    $exp = DB::table('exports')
             ->join('clients','exports.client_id','=','clients.id')
             ->select('exports.*','clients.*','exports.idExport as IdExp')
             ->where('exports.idExport','=',$id)
             ->first();
    return $exp;
  }

  //Lecture des imports en fonction de l'id
  function ReadImpID($id)
  {
    $exp = DB::table('imports')
             ->join('clients','imports.client_id','=','clients.id')
             ->select('imports.*','clients.*','clients.id as IdCl')
             ->where('imports.idimport','=',$id)
             ->first();
    return $exp;
  }

 // Lecture des exportations
  function ReadExport($etat)
  {
     $exp = DB::table('exports')
              ->join('clients','exports.client_id','=','clients.id')
              ->select('exports.*','clients.*','exports.idExport as IdExp')
              ->where('exports.statut','=',$etat)
              ->orderBy('exports.idExport','desc')
              ->get();
     return $exp;
  }

#Gestion des importations

//Filtre de recherhce
function filtreImp($attribut,$valeur,$etat)
{
  $res = Imports::query()->where($attribut, 'LIKE', "%{$valeur}%")
                          ->where('imports.statut','=',$etat)
                          ->orderBy('idimport','desc')->get();
  return $res;

}

//Modification des imports
function Upimport($doss,$d1,$fdi,$d2,$bsc,$d3,$rfcv,$d4,$td,$d5,$dd,$d6,$pfp,$d7,$liv,$d8,$vsd,$d9,$bed,$d10,$id)
{
  $imp = DB::table('imports')
              ->where('idimport', $id)
              ->update(['doss'=>$doss,'d1'=>$d1,'fdi'=>$fdi,'d2'=>$d2,'bsc'=>$bsc,'d3'=>$d3,'rfcv'=>$rfcv,'d4'=>$d4,'td'=>$td,
                        'd5'=>$d5,'dd'=>$dd,'d6'=>$d6,'pfp'=>$pfp,'d7'=>$d7,'liv'=>$liv,
                        'd8'=>$d8,'vsd'=>$vsd,'d9'=>$d9,'bed'=>$bed,'d10'=>$d10]);
  return $imp;
}

//Mise en etat des importations
function upStatImp($id,$etat)
{
  $imp = DB::table('imports')
            ->where('imports.idimport',$id)
            ->update(['imports.statut'=>$etat]);
  return $imp;
}

//Lecture des importations
function ReadImport($etat)
{
   $exp = DB::table('imports')
            ->join('clients','imports.client_id','=','clients.id')
            ->select('imports.*','clients.*','imports.idimport as IdImp')
            ->where('imports.statut','=',$etat)
            ->orderBy('imports.idimport','desc')
            ->get();
   return $exp;
}

  // Definition des steps en cours
  function ExpStepEncours($id,$attribut)
  {
    $exp = DB::table('exports')->where('exports.statut','=',0)
                                ->where('exports.idExport','=',$id)
                                ->first();
    dd($attribut);
    $res = $exp->$attribut;
    return $res;
  }
