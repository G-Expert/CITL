


<h2 class="h3 text-center " style="margin-top:200px;"><b class="text-uppercase">Obtenez Gratuitement un devis</b></h2><br>

@if (isset($alert))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
   <strong>{{$alert}}</strong>, votre demande de devis a été réçu avec succès! Nous vous répondrons dans 24h
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">×</span>
   </button>
 </div>
@endif

<div class="container space-2-bottom space-3-bottom--lg">
  <div class="w-lg-80 mx-auto">

    <form action="devisF" method="post">
      @csrf
      <div class="row">
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="exampleFormControlSelect1">
            Quelle opération souhaiter vous effectuer ?
          </label>
          <select class="form-control" id="exampleFormControlSelect1" name="operation" required>
            <option></option>
            <option value="export">Exporter des marchandises</option>
            <option value="import">Importer des marchandises</option>
          </select>
        </div>
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="nature">Nature de marchandises</label>
          <input type="text" class="form-control" id="nature" name="nature" required/>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="conteneurtype">Type de conteneur</label>
          <select class="form-control" id="conteneurtype" name="conteneur">
            <option></option>
            <option>tc 40""</option>
            <option>tc 20""</option>
            <option>Freezer</option>
          </select>
        </div>
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="paysSelect">Pays de destination</label>
          <select class="form-control" id="paysSelect" name="pays" required>
                   <option selected>Côte d'ivoire</option>
                   <option>Afghanistan</option>
                   <option>Afrique du Sud</option>
                   <option>Albanie</option>
                   <option>Algérie</option>
                   <option>Allemagne</option>
                   <option>Andorre</option>
                   <option>Angola</option>
                   <option>Anguilla</option>
                   <option>Antigua-et-Barbuda</option>
                   <option>Antigua-et-Barbuda</option>
                   <option>Arabie saoudite</option>
                   <option>Argentine</option>
                   <option>Arménie</option>
                   <option>Aruba</option>
                   <option>Australie</option>
                   <option>Autriche</option>
                   <option>Azerbaïdjan</option>
                   <option>Bahamas</option>
                   <option>Bahreïn</option>
                   <option>Bangladesh</option>
                   <option>Barbade</option>
                   <option>Belgique</option>
                   <option>Belize</option>
                   <option>Bénin</option>
                   <option>Bermudes</option>
                   <option>Bhoutan</option>
                   <option>Biélorussie</option>
                   <option>Birmanie</option>
                   <option>Bolivie</option>
                   <option>Bosnie-Herzégovine</option>
                   <option>Botswana</option>
                   <option>Brésil</option>
                   <option>Brunei</option>
                   <option>Bulgarie</option>
                   <option>Burkina Faso</option>
                   <option>Burundi</option>
                   <option>Cambodge</option>
                   <option>Cameroun</option>
                   <option>Canada</option>
                   <option >Cap-Vert</option>
                   <option >Îles Caïmans</option>
                   <option >République centrafricaine
                   </option>
                   <option >Chili
                   </option>
                   <option >Chine(République Populaire de Chine)
                   </option>
                   <option >Chypre</option>
                   <option >Colombie</option>
                   <option >République démocratique du Congo</option>
                   <option >République du Congo</option>
                   <option >Îles Cook</option>
                   <option >Corée du Nord</option>
                   <option >Corée du Sud</option>
                   <option >Costa Rica</option>
                   <option >Croatie</option>
                   <option >Cuba</option>
                   <option >Danemark</option>
                   <option >Diego Garcia</option>
                   <option >Djibouti</option>
                   <option >République dominicaine</option>
                   <option >Dominique</option>
                   <option >Égypte</option>
                   <option >Émirats arabes unis</option>
                   <option >Équateur</option>
                   <option >Érythrée</option>
                   <option >Espagne</option>
                   <option >Estonie</option>
                   <option >États-Unis</option>
                   <option >Éthiopie</option>
                   <option >Îles Féroé</option>
                   <option >Fidji</option>
                   <option >Finlande</option>
                   <option >France</option>
                   <option >Gabon</option>
                   <option>Gambie</option>
                   <option>Géorgie</option>
                   <option>Ghana</option>
                   <option>Gibraltar</option>
                   <option>Grèce</option>
                   <option>Grenade</option>
                   <option>Guadeloupe</option>
                   <option>Guam</option>
                   <option>Guinée</option>
                   <option>Guinée équatoriale</option>
                   <option>Guinée-Bissau</option>
                   <option>Guyana</option>
                   <option>Guyane</option>
                   <option>Haïti</option>
                   <option>Honduras</option>
                   <option>Hong Kong</option>
                   <option>Hongrie</option>
                   <option>Inde</option>
                   <option>Indonésie</option>
                   <option>Irak</option>
                   <option>Iran</option>
                   <option>Irlande</option>
                   <option>Islande</option>
                   <option>Israël</option>
                   <option>Italie</option>
                   <option>Jamaïque</option>
                   <option>Japon</option>
                   <option>Jordanie</option>
                   <option>Kazakhstan</option>
                   <option>Kenya</option>
                   <option>Kirghizistan</option>
                   <option>Kiribati</option>
                   <option>Koweït</option>
                   <option>Laos</option>
                   <option>Lesotho</option>
                   <option>Lettonie</option>
                   <option>Liban</option>
                   <option>Liberia</option>
                   <option>Libye</option>
                   <option>Liechtenstein</option>
                   <option>Lituanie</option>
                   <option>Luxembourg</option>
                   <option>Macao</option>
                   <option>Macédoine</option>
                   <option>Madagascar</option>
                   <option>Malaisie</option>
                   <option>Malawi</option>
                   <option>Maldives</option>
                   <option>Mali</option>
                   <option>Malouines</option>
                   <option>Malte</option>
                   <option>Îles Mariannes du Nord</option>
                   <option>Maroc</option>
                   <option>Îles Marshall</option>
                   <option >Martinique</option>
                   <option >Maurice</option>
                   <option >Mauritanie</option>
                   <option >Mayotte</option>
                   <option >Mexique</option>
                   <option >États fédérés de Micronésie
                   </option>
                   <option >Moldavie</option>
                   <option Monaco</option>
                   <option >Mongolie</option>
                   <option >Monténégro</option>
                   <option >Montserrat</option>
                   <option >Mozambique</option>
                   <option >Namibie</option>
                   <option >Nauru</option>
                   <option >Népal</option>
                   <option >Nicaragua</option>
                   <option >Niger</option>
                   <option >Nigeria</option>
                   <option >Niue</option>
                   <option >Norvège</option>
                   <option >Nouvelle-Calédonie</option>
                   <option >Nouvelle-Zélandee</option>
                   <option >Oman</option>
                   <option >Ouganda</option>
                   <option >Ouzbékistan</option>
                   <option >Pakistan</option>
                   <option >Palaos</option>
                   <option >Palestine</option>
                   <option >Panama</option>
                   <option >Papouasie-Nouvelle-Guinée
                   </option>
                   <option >Paraguay</option>
                   <option >Pays-Bas</option>
                   <option>Pérou</option>
                   <option >Philippines</option>
                   <option >Pologne</option>
                   <option >Polynésie française</option>
                   <option >Porto Rico</option>
                   <option >Portugal</option>
                   <option >Qatar</option>
                   <option >La Réunion</option>
                   <option >Roumanie</option>
                   <option >Royaume-Uni</option>
                   <option >Russie</option>
                   <option >Rwanda</option>
                   <option >Saint-Christophe-et-Niévès
                   </option>
                   <option >Sainte-Lucie</option>
                   <option >Saint-Marin</option>
                   <option >Saint-Pierre-et-Miquelon
                   </option>
                   <option >Saint-Vincent-et-les-Grenadines
                   </option>
                   <option >Salomon</option>
                   <option >Salvador</option>
                   <option >Samoa</option>
                   <option >Samoa américaines</option>
                   <option >Sao Tomé-et-Principe</option>
                   <option >Sénégal</option>
                   <option >Serbie</option>
                   <option >Seychelles</option>
                   <option >Sierra Leone</option>
                   <option >Slovaquie</option>
                   <option >Slovénie</option>
                   <option >Somalie</option>
                   <option >Soudan</option>
                   <option >Soudan du Sud</option>
                   <option >Sri Lanka</option>
                   <option >Suède</option>
                   <option >Suisse</option>
                   <option >Suriname</option>
                   <option >Eswatini</option>
                   <option>Syrie</option>
                   <option >Tadjikistan</option>
                   <option >Tanzanie</option>
                   <option >Taïwan</option>
                   <option >Tchad</option>
                   <option >République tchèque</option>
                   <option >Thaïlande</option>
                   <option >Timor oriental</option>
                   <option >Togo</option>
                   <option >Tokelau</option>
                   <option >Tonga</option>
                   <option >Trinité-et-Tobago</option>
                   <option >Tunisie</option>
                   <option >Turkménistan</option>
                   <option >Îles Turques-et-Caïques
                   </option>
                   <option >Turquie</option>
                   <option >Tuvalu</option>
                   <option >Ukraine</option>
                   <option >Uruguay</option>
                   <option >Vanuatu</option>
                   <option >Vatican (Saint-Siège)</option>
                   <option >Venezuela</option>
                   <option >Îles Vierges des États-Unis
                   </option>
                   <option >Îles Vierges britanniques
                   </option>
                   <option >Viêt Nam</option>

                   <option >Wallis-et-Futuna</option>
                   <option >Yémen</option>
                   <option >Zambie</option>
                   <option >Zimbabwe</option>
                   <option >Togo</option>
                   <option >Benin</option>
                   <option >Burkina-Faso</option>
                   <option >Mali</option>
                   <option >Guinée</option>
                   <option >Ghana</option>
                  </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="voieSelect">Voie maritime/aérien</label>
          <select class="form-control" id="voieSelect" name="voie" required>
            <option></option>
            <option class="text-uppercase">Voie maritime</option>
            <option class="text-uppercase">Voie aerien</option>
          </select>
        </div>
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="portlb">Port/Aéroport de destination</label>
          <input type="text" class="form-control" id="portlb" placeholder="" name="port" required/>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="poidslb">Poids</label>
          <input type="text" class="form-control" id="poidslb" aria-describedby="emailHelp"
          placeholder="" name="poids" required/>
        </div>
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="maillb">Votre Mail</label>
          <input type="email" class="form-control" id="maillb" placeholder="" name="mail" required/>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="nomlb">Votre Nom/Votre entreprise</label>
          <input type="text" class="form-control" id="nomlb" aria-describedby="emailHelp"
          placeholder="" name="nom" required/>
        </div>
        <div class="form-group col-6">
          <label class="h6 small d-block text-uppercase" for="telLB">Votre Numéro de téléphone</label>
          <input type="number" class="form-control" id="telLB" placeholder="" name="tel" required/>
        </div>
      </div>

      {{-- <button type="submit" class="btn btn-primary text-uppercase" style="background-color:#00a0e1;">
         Soumettre
      </button> --}}
      <button type="submit" class="btn btn-primary mb-2 text-uppercase" style="background-color:#00a0e1;">Soumettre</button>
  </form>

  </div>

</div>
<!-- End Features Section -->
