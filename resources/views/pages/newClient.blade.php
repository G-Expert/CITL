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
                          <h1 class="mb-0 h2 font-weight-bold">Ouvrir le compte d'un nouveau client</h1>
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


                <form class="form-row" action="FNew" method="post">
                  @csrf
                 <!-- First name -->
                 <div class="form-group col-12 col-md-3">
                   <label class="form-label" for="fname">Entreprise</label>
                   <input type="text" name="entreprise" id="fname" class="form-control" required/>
                 </div>
                 <div class="form-group col-12 col-md-3">
                   <label class="form-label" for="fname-2">Nom client</label>
                   <input type="text" id="fname-2" name="client_nom" class="form-control"required/>
                 </div>

                 <div class="form-group col-12 col-md-3">
                   <label class="form-label" for="fname-3">Pr??nom client</label>
                   <input type="text" id="fname-3" name="prenom_client" class="form-control"required/>
                 </div>
                 <div class="form-group col-12 col-md-3">
                   {{-- <label class="form-label" for="fname-7">Pays</label>
                   <input type="text" id="fname-7" name="pays" class="form-control"required/> --}}
                   <label class="form-label">Country</label>

                    <select class="selectpicker pays" id="basic-example" name="pays" data-width="100%">
                 <option value="225" selected>C??te d'ivoire</option>
                 <option value="93">Afghanistan</option>
                 <option value="27">Afrique du Sud</option>
                 <option value="355">Albanie</option>
                 <option value="213">Alg??rie</option>
                 <option value="49">Allemagne</option>
                 <option value="376">Andorre</option>
                 <option value="244">Angola</option>
                 <option value="1264">Anguilla</option>
                 <option value="1268">Antigua-et-Barbuda</option>
                 <option value="599">Antigua-et-Barbuda</option>
                 <option value="966">Arabie saoudite</option>
                 <option value="54">Argentine</option>
                 <option value="374">Arm??nie</option>
                 <option value="297">Aruba</option>
                 <option value="61">Australie</option>
                 <option value="43">Autriche</option>
                 <option value="994">Azerba??djan</option>
                 <option value="12421">Bahamas</option>
                 <option value="973">Bahre??n</option>
                 <option value="880">Bangladesh</option>
                 <option value="12461">Barbade</option>
                 <option value="32">Belgique</option>
                 <option value="501">Belize</option>
                 <option value="229">B??nin</option>
                 <option value="14411">Bermudes</option>
                 <option value="975">Bhoutan</option>
                 <option value="375">Bi??lorussie</option>
                 <option value="95">Birmanie</option>
                 <option value="591">Bolivie</option>
                 <option value="387">Bosnie-Herz??govine</option>
                 <option value="267">Botswana</option>
                 <option value="55">Br??sil</option>
                 <option value="673">Brunei</option>
                 <option value="359">Bulgarie</option>
                 <option value="226">Burkina Faso</option>
                 <option value="257">Burundi</option>
                 <option value="855">Cambodge</option>
                 <option value="237">Cameroun</option>
                 <option value="1">Canada</option>
                 <option value="238">Cap-Vert</option>
                 <option value="13451">??les Ca??mans</option>
                 <option value="236">R??publique centrafricaine
                 </option>
                 <option value="56">Chili</option>
                 <option value="86">Chine(R??publique Populaire de Chine)</option>
                 <option value="357">Chypre</option>
                 <option value="57">Colombie</option>
                 <option value="243">R??publique d??mocratique du Congo</option>
                 <option value="242">R??publique du Congo</option>
                 <option value="682">??les Cook</option>
                 <option value="850">Cor??e du Nord</option>
                 <option value="82">Cor??e du Sud</option>
                 <option value="506">Costa Rica</option>
                 <option value="225">C??te d'Ivoire</option>
                 <option value="385">Croatie</option>
                 <option value="53">Cuba</option>
                 <option value="45">Danemark</option>
                 <option value="246">Diego Garcia</option>
                 <option value="253">Djibouti</option>
                 <option value="1">R??publique dominicaine</option>
                 <option value="17671">Dominique</option>
                 <option value="20">??gypte</option>
                 <option value="971">??mirats arabes unis</option>
                 <option value="593">??quateur</option>
                 <option value="291">??rythr??e</option>
                 <option value="34">Espagne</option>
                 <option value="372">Estonie</option>
                 <option value="1">??tats-Unis</option>
                 <option value="251">??thiopie</option>
                 <option value="298">??les F??ro??</option>
                 <option value="679">Fidji</option>
                 <option value="358">Finlande</option>
                 <option value="33">France</option>
                 <option value="241">Gabon</option>
                 <option value="220">Gambie</option>
                 <option value="995">G??orgie</option>
                 <option value="233">Ghana</option>
                 <option value="350">Gibraltar</option>
                 <option value="30">Gr??ce</option>
                 <option value="1473">Grenade</option>
                 <option value="590">Guadeloupe</option>
                 <option value="1671">Guam</option>
                 <option value="224">Guin??e</option>
                 <option value="240">Guin??e ??quatoriale</option>
                 <option value="245">Guin??e-Bissau</option>
                 <option value="592">Guyana</option>
                 <option value="594">Guyane</option>
                 <option value="509">Ha??ti</option>
                 <option value="504">Honduras</option>
                 <option value="852">Hong Kong</option>
                 <option value="36">Hongrie</option>
                 <option value="91">Inde</option>
                 <option value="62">Indon??sie</option>
                 <option value="964">Irak</option>
                 <option value="98">Iran</option>
                 <option value="353">Irlande</option>
                 <option value="354">Islande</option>
                 <option value="972">Isra??l</option>
                 <option value="39">Italie</option>
                 <option value="1876">Jama??que</option>
                 <option value="81">Japon</option>
                 <option value="962">Jordanie</option>
                 <option value="7">Kazakhstan</option>
                 <option value="254">Kenya</option>
                 <option value="996">Kirghizistan</option>
                 <option value="686">Kiribati</option>
                 <option value="965">Kowe??t</option>
                 <option value="856">Laos</option>
                 <option value="266">Lesotho</option>
                 <option value="371">Lettonie</option>
                 <option value="961">Liban</option>
                 <option value="231">Liberia</option>
                 <option value="218">Libye</option>
                 <option value="423">Liechtenstein</option>
                 <option value="370">Lituanie</option>
                 <option value="352">Luxembourg</option>
                 <option value="853">Macao</option>
                 <option value="389">Mac??doine</option>
                 <option value="261">Madagascar</option>
                 <option value="60">Malaisie</option>
                 <option value="265">Malawi</option>
                 <option value="960">Maldives</option>
                 <option value="223">Mali</option>
                 <option value="500">Malouines</option>
                 <option value="356">Malte</option>
                 <option value="1670">??les Mariannes du Nord</option>
                 <option value="212">Maroc</option>
                 <option value="692">??les Marshall</option>
                 <option value="596">Martinique</option>
                 <option value="230">Maurice</option>
                 <option value="222">Mauritanie</option>
                 <option value="262">Mayotte</option>
                 <option value="52">Mexique</option>
                 <option value="691">??tats f??d??r??s de Micron??sie
                 </option>
                 <option value="373">Moldavie</option>
                 <option value="377">Monaco</option>
                 <option value="976">Mongolie</option>
                 <option value="382">Mont??n??gro</option>
                 <option value="1664">Montserrat</option>
                 <option value="258">Mozambique</option>
                 <option value="264">Namibie</option>
                 <option value="674">Nauru</option>
                 <option value="977">N??pal</option>
                 <option value="505">Nicaragua</option>
                 <option value="227">Niger</option>
                 <option value="234">Nigeria</option>
                 <option value="683">Niue</option>
                 <option value="47">Norv??ge</option>
                 <option value="687">Nouvelle-Cal??donie</option>
                 <option value="64">Nouvelle-Z??landee</option>
                 <option value="968">Oman</option>
                 <option value="256">Ouganda</option>
                 <option value="998">Ouzb??kistan</option>
                 <option value="92">Pakistan</option>
                 <option value="680">Palaos</option>
                 <option value="970">Palestine</option>
                 <option value="507">Panama</option>
                 <option value="675">Papouasie-Nouvelle-Guin??e
                 </option>
                 <option value="595">Paraguay</option>
                 <option value="31">Pays-Bas</option>
                 <option value="51">P??rou</option>
                 <option value="63">Philippines</option>
                 <option value="48">Pologne</option>
                 <option value="689">Polyn??sie fran??aise</option>
                 <option value="1">Porto Rico</option>
                 <option value="351">Portugal</option>
                 <option value="974">Qatar</option>
                 <option value="262">La R??union</option>
                 <option value="40">Roumanie</option>
                 <option value="44">Royaume-Uni</option>
                 <option value="7">Russie</option>
                 <option value="250">Rwanda</option>
                 <option value="1869">Saint-Christophe-et-Ni??v??s</option>
                 <option value="1758">Sainte-Lucie</option>
                 <option value="378">Saint-Marin</option>
                 <option value="378">Saint-Pierre-et-Miquelon</option>
                 <option value="1784">Saint-Vincent-et-les-Grenadines</option>
                 <option value="677">Salomon</option>
                 <option value="503">Salvador</option>
                 <option value="685">Samoa</option>
                 <option value="1684">Samoa am??ricaines</option>
                 <option value="239">Sao Tom??-et-Principe</option>
                 <option value="221">S??n??gal</option>
                 <option value="381">Serbie</option>
                 <option value="248">Seychelles</option>
                 <option value="65">Sierra Leone</option>
                 <option value="421">Slovaquie</option>
                 <option value="386">Slov??nie</option>
                 <option value="252">Somalie</option>
                 <option value="249">Soudan</option>
                 <option value="211">Soudan du Sud</option>
                 <option value="94">Sri Lanka</option>
                 <option value="46">Su??de</option>
                 <option value="41">Suisse</option>
                 <option value="597">Suriname</option>
                 <option value="268">Eswatini</option>
                 <option value="963">Syrie</option>
                 <option value="992">Tadjikistan</option>
                 <option value="255">Tanzanie</option>
                 <option value="886">Ta??wan</option>
                 <option value="235">Tchad</option>
                 <option value="420">R??publique tch??que</option>
                 <option value="66">Tha??lande</option>
                 <option value="670">Timor oriental</option>
                 <option value="228">Togo</option>
                 <option value="690">Tokelau</option>
                 <option value="676">Tonga</option>
                 <option value="1868">Trinit??-et-Tobago</option>
                 <option value="216">Tunisie</option>
                 <option value="993">Turkm??nistan</option>
                 <option value="1649">??les Turques-et-Ca??ques
                 </option>
                 <option value="90">Turquie</option>
                 <option value="688">Tuvalu</option>
                 <option value="380">Ukraine</option>
                 <option value="598">Uruguay</option>
                 <option value="678">Vanuatu</option>
                 <option value="379">Vatican (Saint-Si??ge)</option>
                 <option value="58">Venezuela</option>
                 <option value="1340">??les Vierges des ??tats-Unis</option>
                 <option value="1284">??les Vierges britanniques</option>
                 <option value="84">Vi??t Nam</option>
                 <option value="681">Wallis-et-Futuna</option>
                 <option value="967">Y??men</option>
                 <option value="260">Zambie</option>
                 <option value="263">Zimbabwe</option>
                 <option value="228">Togo</option>
                 <option value="229">Benin</option>
                 <option value="226">Burkina-Faso</option>
                 <option value="223">Mali</option>
                 <option value="224">Guin??e</option>
                 <option value="233">Ghana</option>
                </select>
                 </div>
                 <div class="form-group col-12 col-md-3">
                   <label class="form-label" for="fname-4">T??l??phone client(<span class="prfix">225</span>)</label>
                   <input type="number" id="fname-4" name="tel_client" class="form-control" required/>
                 </div>

                 <div class="form-group col-12 col-md-3">
                   <label class="form-label" for="fname-5">Email client</label>
                   <input type="email" id="fname-5" name="mail_client" class="form-control"/>
                 </div>
                 <div class="form-group col-12 col-md-6">
                   <label class="form-label" for="fname-6">Mot de passe</label>
                   <input type="text" id="fname-6" name="pass_client" class="form-control" disabled/>
                 </div>

                 <div class="col-12">
										<!-- Button open count -->
										<button class="btn btn-warning" type="submit">
											Ouvrir le compte
										</button>
                    	<!-- Button close count -->
                      <a href="clients_new"><button class="btn btn-danger" type="button">Annuler</button></a>
									</div>

               </form>


              </div>
          </div>

        </div>
        <!-- Container fluid -->

    </div>
    <!-- Page Content -->
</div>
