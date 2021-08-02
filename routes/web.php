<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitlController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('citl');
});

Route::get('fret', function () {
    return view('fret');
});

Route::get('mantrans', function () {
    return view('mantrans');
});

Route::get('transport', function () {
    return view('transport');
});

Route::get('logistique', function () {
    return view('logistique');
});

Route::get('about', function () {
    return view('about');
});

Route::get('devis', function () {
    return view('devis');
});

Route::post('devisF',[CitlController::class, 'devisF']);

#Back-office - Login
Route::get('kmtAd',[CitlController::class, 'kmtAd']);

#Dashboard
// Route du dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
});

#Gestion des users
//Route de connection au profil client
Route::get('login',[CitlController::class, 'login']);
//Route du profile client
Route::get('/profile', function () {
  if (isset($_SESSION['i'])) {
    return view('profil');
  }else{
    return view('citl');
  }
});
//Route de déconnection
Route::get('/logout',function(){
  session_destroy();
  return view('citl');
});
//Route de lecture des exportations users
Route::get('expPCl',[CitlController::class, 'expPCl']);
//Route des exportation livré users
Route::get('expPClv',[CitlController::class, 'expPClv']);
//Route des importations en cours users
Route::get('impClP',[CitlController::class, 'impClP']);
//Route des importations validées
Route::get('impClPv',[CitlController::class, 'impClPv']);
//Route du compte client
Route::get('count',[CitlController::class, 'count']);
//Route de mise à jour du compte
Route::get('upcount',[CitlController::class, 'upcount']);





#Gestion des clients
//Route nouveau clients
Route::get('clients_new',[CitlController::class, 'clients_new']);
//Route ajout de nouveau client
Route::post('FNew',[CitlController::class, 'FNew']);
//Route liste des clients
Route::get('clients_liste',[CitlController::class, 'liste_client']);
//Route de suppression
Route::get('delClient',[CitlController::class, 'delClient']);
//Route de lecture de client en foncton de l'id
Route::get('readClID',[CitlController::class, 'readClID']);
//Route de modification du client
Route::get('modif',[CitlController::class, 'modif']);
//Filtre automatique des clients
Route::get('filtreCl',[CitlController::class, 'filtreCl']);
//Route des export d'un clients
Route::get('expCl',[CitlController::class, 'expCl']);


#Gestion des devis
//Route de demande de devis
Route::get('devis_demande',[CitlController::class, 'devis_demande']);
//Route de demande validées
Route::get('devis_valide',[CitlController::class, 'devis_valide']);
//Route de demande rejetées
Route::get('devis_lock',[CitlController::class, 'devis_lock']);
//Route de validation de devis
Route::get('valideDevis',[CitlController::class, 'valideDevis']);
//Route de rejet de devis
Route::get('rejeteDevis',[CitlController::class, 'rejeteDevis']);
//Route de filtre Nouvelle demande
Route::get('filtreNewDv',[CitlController::class, 'filtreNewDv']);
//Route de filtre devis validé
Route::get('filtreValDv',[CitlController::class, 'filtreValDv']);
//Route de filtre devis rejetée
Route::get('filtreRjtDv',[CitlController::class, 'filtreRjtDv']);
//Route de suppression de devis
Route::get('supDevis',[CitlController::class, 'supDevis']);
//Route de lecture des details des export
Route::get('readDet',[CitlController::class, 'readDet']);
//Route de validation d'une exportation
Route::get('export',[CitlController::class, 'export']);
//Route de mise en etat
Route::get('upExp',[CitlController::class, 'upExp']);






#Gestion des opérations
//Route Validation de l'exports
Route::get('valideExp',[CitlController::class, 'valideExp']);
//Route de Suppression de l'exports
Route::get('DelExp',[CitlController::class, 'DelExp']);
//Route nouveau Export
Route::get('new_export',[CitlController::class, 'new_export']);
//Route Export livré
Route::get('new_exportLv',[CitlController::class, 'new_exportLv']);
//Route nouveau Import
Route::get('new_import',[CitlController::class, 'new_import']);
//Route Import Livré
Route::get('new_importLV',[CitlController::class, 'new_importLV']);
//Route Filtre des opérations d'exports
Route::get('filtreExp',[CitlController::class, 'filtreExp']);
//Route filtre
Route::get('filtreExpv',[CitlController::class, 'filtreExpv']);
//Route d'ajout d'une exportation
Route::get('addExport',[CitlController::class, 'addExport']);
//Route d'enregistrement
Route::post('addExp',[CitlController::class, 'addExp']);





#Gestion des Importations
//Route d'enregistrement d'une exportation
Route::post('addImp',[CitlController::class, 'addImp']);
//Route d'ajout d'une importation
Route::get('addImport',[CitlController::class, 'addImport']);
//Route de validation d'une importations
Route::get('valideImp',[CitlController::class, 'valideImp']);
//Route de suppression d'une importations
Route::get('DelImp',[CitlController::class, 'DelImp']);
//Route de détails des importations
Route::get('readImpDet',[CitlController::class, 'readImpDet']);
//Route d'importations
Route::get('import',[CitlController::class, 'import']);
//Route de filtrage des imports en cours
Route::get('filtreImp',[CitlController::class, 'filtreImp']);
//Route de filtrage des imports soldées
Route::get('filtreImpv',[CitlController::class, 'filtreImpv']);
//Route des importations des clients
Route::get('impCl',[CitlController::class, 'impCl']);











#Gestion des coordonnées
//Route des coordonnées
Route::get('coordonnes',[CitlController::class, 'coordonnes']);
//Route des unités SMS
Route::get('unite_sms',[CitlController::class, 'unite_sms']);
//Route des coordonnées
Route::get('coordonnes',[CitlController::class, 'coordonnes']);
