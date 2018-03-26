<!--script>  function statusChangeCallback(response) {    if (response.status === 'connected') {      GetDataFromFacebook();    }  }  function checkLoginState() {    FB.getLoginStatus(function(response) {      statusChangeCallback(response);    });  }  window.fbAsyncInit = function() {  FB.init({    appId      : '324186571290929',    cookie     : true,      xfbml      : true,      version    : 'v2.8'  });  FB.getLoginStatus(function(response) {    statusChangeCallback(response);  });  };  (function(d, s, id) {    var js, fjs = d.getElementsByTagName(s)[0];    if (d.getElementById(id)) return;    js = d.createElement(s); js.id = id;    js.src = "//connect.facebook.net/en_US/sdk.js";    fjs.parentNode.insertBefore(js, fjs);  }(document, 'script', 'facebook-jssdk'));  function GetDataFromFacebook() {    FB.api('/me?fields=name,picture,email,first_name,last_name,birthday', function(c) {             document.getElementById('nom').value =c.last_name;		document.getElementById('prenom').value =c.first_name;		document.getElementById('calendar').value =c.birthday;		document.getElementById('email0').value =c.email;		document.getElementById('').value =c.hometown;		          		    });  }</script>  <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button-->

<table  width="100%" border="0">

<tr>
     <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">
  <h1>Intitul&eacute; du profil </h1> 
  </div></td>
</tr>
 
 <tr>
     <td><label>Titre de votre profil  </label>
<font style="color:red;">*</font> <br />
<input id="titre"  type="text" placeholder="Titre de profil" title="Veuillez entrez le titre de profil" name="titre" style="width:200px" value="<?php if(isset($titre)){echo htmlspecialchars_decode($titre, ENT_QUOTES);}  ?>"  maxlength="100"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  required/></td>

         
       
<td colspan="2">
         <br><a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>

     <em><span></span>  (exp:D&eacute;veloppeur informatique,Consultant SI,Chef de projet...) </em>

 </a>
</td>
                          
 </tr>      
      
      
            <tr>

              <td colspan="3"><div class="subscription" style="margin: 10px 0pt;">

                  <h1>&Eacute;tat civil </h1>

                </div></td>

            </tr>

            <tr>

              <td width="32%"><label>Civilit&eacute; </label>

                <font style="color:red;">*</font> <br />

                <select id="civilite" name="civilite" title="Veuillez selectionez votre civilité" required/>
        
             <option value=""></option>

                  <?php     $req_ci = mysql_query( "SELECT * FROM prm_civilite");       
          while ( $ci = mysql_fetch_array( $req_ci ) ) {          
          $ci_id = $ci['id_civi'];          
          $ci_desc = $ci['civilite'];         
            if(isset($civilite) and $civilite==$ci_id){         
            echo '<option value="'.$ci_id.'" selected="selected">'.$ci_desc.'</option>';
            }   else  {         
            echo '<option value="'.$ci_id.'">'.$ci_desc.'</option>';          
            }
          }   
          ?>

                </select></td>

              <td width="38%"><label>Nom </label>

                <font style="color:red;">*</font> <br />
<?php
$nom___v='';
 if(isset($nom)){$nom___v=htmlspecialchars_decode($nom, ENT_QUOTES) ;} 
 elseif(isset($_SESSION['fb___nom'] )){$nom___v=$_SESSION['fb___nom'];} 
 ?>
                <input  type="text" placeholder="Nom candidat" title="Veuillez entrez votre nom" id="nom" name="nom" value="<?php  echo $nom___v;  ?>" maxlength="30"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   required/></td>

              <td width="30%"><label>Prénom </label>

                <font style="color:red;">*</font> <br />
<?php 
$prenom___v='';
if(isset($prenom)){$prenom___v=htmlspecialchars_decode($prenom, ENT_QUOTES) ;}
elseif(isset($_SESSION['fb___prenom'] )){$prenom___v=$_SESSION['fb___prenom'];} 
?>
                <input  type="text" placeholder="Prénom candidat" title="Veuillez entrez votre prénom"  id="prenom" name="prenom"  value="<?php  echo $prenom___v; ?>" maxlength="30"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   required/>

              </td>

            </tr>

            <tr>

              <td colspan="2"><label>Adresse </label>

                <font style="color:red;">*</font> <br />

                <input  id="adresse"  type="text" placeholder="Adresse candidat" title="Veuillez entrez votre adresse" name="adresse" value="<?php if(isset($adresse)){echo htmlspecialchars_decode($adresse, ENT_QUOTES) ;}?>" style="width:432px" maxlength="100"     required/>

              </td>

              <td><label>Code postal </label> <br />

                <input id="code" type="text" placeholder="Code postal " title="Veuillez entrez votre code postal" name="code" value="<?php if(isset($code)){echo htmlspecialchars_decode($code, ENT_QUOTES)  ;}?>"  maxlength="30"   pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  /></td>

            </tr>

            <tr>

              <td><label>Ville </label>

                <font style="color:red;">*</font> <br />

                <select id="ville" name="ville" placeholder="Ville candidat " title="Veuillez selectionnez votre ville" required>

                  <option value=""></option>

                  <?php     $req_ville = mysql_query( "SELECT * FROM prm_villes");        
          while ( $ville1 = mysql_fetch_array( $req_ville ) ) {         
          $pays_id = $ville1['id_vill'];          $ville_desc = $ville1['ville'];         
          if(isset($ville) and $ville==$ville_desc)         {         
          echo '<option value="'.$ville_desc.'" selected="selected">'.$ville_desc.'</option>';          }         
          else          {         echo '<option value="'.$ville_desc.'">'.$ville_desc.'</option>';          }             }   ?>

                </select>
                 </td>

              <td><label>Pays de r&eacute;sidence </label>

                <font style="color:red;">*</font> <br />

                <select id="pays" name="pays" placeholder="Pays candidat " title="Veuillez selectionnez votre pays de résidence" required>

                  <option value="22">Maroc</option>

                  <?php     $req_pays = mysql_query( "SELECT * FROM prm_pays ORDER BY pays Asc");       
          while ( $pays1 = mysql_fetch_array( $req_pays ) ) {         
          $pays_id = $pays1['id_pays'];         $pays_desc = $pays1['pays'];          
          if(isset($pays) and $pays==$pays_id)          {         
          echo '<option value="'.$pays_id.'" selected="selected">'.$pays_desc.'</option>';          }         
          else          {         echo '<option value="'.$pays_id.'">'.$pays_desc.'</option>';          }             }   ?>

                </select></td>

              <td><label>Date de naissance </label>

                <font style="color:red;">*</font> <br />

                <input  id="calendar" name="date"  placeholder="Date de naissance " title="Veuillez entrez votre date de naissance"         value="<?php if(isset($date)){echo $date;}?>"   pattern="(?:(?:0[1-9]|1[0-2])[\/\\-. ]?(?:0[1-9]|[12][0-9])|(?:(?:0[13-9]|1[0-2])[\/\\-. ]?30)|(?:(?:0[13578]|1[02])[\/\\-. ]?31))[\/\\-. ]?(?:19|20)[0-9]{2}"     placeholder="  01/01/1980  " required/>

              </td>

            </tr>

            <tr>

              <td><label>Nationalit&eacute; </label>

                <font style="color:red;">*</font> <br />

                <input id="nationalite" placeholder="Nationalité" title="Veuillez entrez votre nationalité"
                 name="nationalite" type="text" value="<?php if(isset($nationalite)){echo htmlspecialchars_decode($nationalite, ENT_QUOTES) ;}?>"  maxlength="30"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   required/>

              </td>

              <td><label>T&eacute;l&eacute;phone </label>

                <font style="color:red;">*</font> <br />
<!--===============================================================-->
<select style="width: 70px;" name="tel1_Code" id="" >
		<option data-countryCode="MA" value="212" Selected>(+212) Maroc</option> 
	<optgroup label="Autres pays">
		<option data-countryCode="DZ" value="213">Algeria (+213)</option> 
		<option data-countryCode="AD" value="376">Andorra (+376)</option>
		<option data-countryCode="AO" value="244">Angola (+244)</option>
		<option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
		<option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
		<option data-countryCode="AR" value="54">Argentina (+54)</option>
		<option data-countryCode="AM" value="374">Armenia (+374)</option>
		<option data-countryCode="AW" value="297">Aruba (+297)</option>
		<option data-countryCode="AU" value="61">Australia (+61)</option>
		<option data-countryCode="AT" value="43">Austria (+43)</option>
		<option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
		<option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
		<option data-countryCode="BH" value="973">Bahrain (+973)</option>
		<option data-countryCode="BD" value="880">Bangladesh (+880)</option>
		<option data-countryCode="BB" value="1246">Barbados (+1246)</option>
		<option data-countryCode="BY" value="375">Belarus (+375)</option>
		<option data-countryCode="BE" value="32">Belgium (+32)</option>
		<option data-countryCode="BZ" value="501">Belize (+501)</option>
		<option data-countryCode="BJ" value="229">Benin (+229)</option>
		<option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
		<option data-countryCode="BT" value="975">Bhutan (+975)</option>
		<option data-countryCode="BO" value="591">Bolivia (+591)</option>
		<option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
		<option data-countryCode="BW" value="267">Botswana (+267)</option>
		<option data-countryCode="BR" value="55">Brazil (+55)</option>
		<option data-countryCode="BN" value="673">Brunei (+673)</option>
		<option data-countryCode="BG" value="359">Bulgaria (+359)</option>
		<option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
		<option data-countryCode="BI" value="257">Burundi (+257)</option>
		<option data-countryCode="KH" value="855">Cambodia (+855)</option>
		<option data-countryCode="CM" value="237">Cameroon (+237)</option>
		<option data-countryCode="CA" value="1">Canada (+1)</option>
		<option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
		<option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
		<option data-countryCode="CF" value="236">Central African Republic (+236)</option>
		<option data-countryCode="CL" value="56">Chile (+56)</option>
		<option data-countryCode="CN" value="86">China (+86)</option>
		<option data-countryCode="CO" value="57">Colombia (+57)</option>
		<option data-countryCode="KM" value="269">Comoros (+269)</option>
		<option data-countryCode="CG" value="242">Congo (+242)</option>
		<option data-countryCode="CK" value="682">Cook Islands (+682)</option>
		<option data-countryCode="CR" value="506">Costa Rica (+506)</option>
		<option data-countryCode="HR" value="385">Croatia (+385)</option>
		<option data-countryCode="CU" value="53">Cuba (+53)</option>
		<option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
		<option data-countryCode="CY" value="357">Cyprus South (+357)</option>
		<option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
		<option data-countryCode="DK" value="45">Denmark (+45)</option>
		<option data-countryCode="DJ" value="253">Djibouti (+253)</option>
		<option data-countryCode="DM" value="1809">Dominica (+1809)</option>
		<option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
		<option data-countryCode="EC" value="593">Ecuador (+593)</option>
		<option data-countryCode="EG" value="20">Egypt (+20)</option>
		<option data-countryCode="SV" value="503">El Salvador (+503)</option>
		<option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
		<option data-countryCode="ER" value="291">Eritrea (+291)</option>
		<option data-countryCode="EE" value="372">Estonia (+372)</option>
		<option data-countryCode="ET" value="251">Ethiopia (+251)</option>
		<option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
		<option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
		<option data-countryCode="FJ" value="679">Fiji (+679)</option>
		<option data-countryCode="FI" value="358">Finland (+358)</option>
		<option data-countryCode="FR" value="33">France (+33)</option>
		<option data-countryCode="GF" value="594">French Guiana (+594)</option>
		<option data-countryCode="PF" value="689">French Polynesia (+689)</option>
		<option data-countryCode="GA" value="241">Gabon (+241)</option>
		<option data-countryCode="GM" value="220">Gambia (+220)</option>
		<option data-countryCode="GE" value="7880">Georgia (+7880)</option>
		<option data-countryCode="DE" value="49">Germany (+49)</option>
		<option data-countryCode="GH" value="233">Ghana (+233)</option>
		<option data-countryCode="GI" value="350">Gibraltar (+350)</option>
		<option data-countryCode="GR" value="30">Greece (+30)</option>
		<option data-countryCode="GL" value="299">Greenland (+299)</option>
		<option data-countryCode="GD" value="1473">Grenada (+1473)</option>
		<option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
		<option data-countryCode="GU" value="671">Guam (+671)</option>
		<option data-countryCode="GT" value="502">Guatemala (+502)</option>
		<option data-countryCode="GN" value="224">Guinea (+224)</option>
		<option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
		<option data-countryCode="GY" value="592">Guyana (+592)</option>
		<option data-countryCode="HT" value="509">Haiti (+509)</option>
		<option data-countryCode="HN" value="504">Honduras (+504)</option>
		<option data-countryCode="HK" value="852">Hong Kong (+852)</option>
		<option data-countryCode="HU" value="36">Hungary (+36)</option>
		<option data-countryCode="IS" value="354">Iceland (+354)</option>
		<option data-countryCode="IN" value="91">India (+91)</option>
		<option data-countryCode="ID" value="62">Indonesia (+62)</option>
		<option data-countryCode="IR" value="98">Iran (+98)</option>
		<option data-countryCode="IQ" value="964">Iraq (+964)</option>
		<option data-countryCode="IE" value="353">Ireland (+353)</option> 
		<option data-countryCode="IT" value="39">Italy (+39)</option>
		<option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
		<option data-countryCode="JP" value="81">Japan (+81)</option>
		<option data-countryCode="JO" value="962">Jordan (+962)</option>
		<option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
		<option data-countryCode="KE" value="254">Kenya (+254)</option>
		<option data-countryCode="KI" value="686">Kiribati (+686)</option>
		<option data-countryCode="KP" value="850">Korea North (+850)</option>
		<option data-countryCode="KR" value="82">Korea South (+82)</option>
		<option data-countryCode="KW" value="965">Kuwait (+965)</option>
		<option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
		<option data-countryCode="LA" value="856">Laos (+856)</option>
		<option data-countryCode="LV" value="371">Latvia (+371)</option>
		<option data-countryCode="LB" value="961">Lebanon (+961)</option>
		<option data-countryCode="LS" value="266">Lesotho (+266)</option>
		<option data-countryCode="LR" value="231">Liberia (+231)</option>
		<option data-countryCode="LY" value="218">Libya (+218)</option>
		<option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
		<option data-countryCode="LT" value="370">Lithuania (+370)</option>
		<option data-countryCode="LU" value="352">Luxembourg (+352)</option>
		<option data-countryCode="MO" value="853">Macao (+853)</option>
		<option data-countryCode="MK" value="389">Macedonia (+389)</option>
		<option data-countryCode="MG" value="261">Madagascar (+261)</option>
		<option data-countryCode="MW" value="265">Malawi (+265)</option>
		<option data-countryCode="MY" value="60">Malaysia (+60)</option>
		<option data-countryCode="MV" value="960">Maldives (+960)</option>
		<option data-countryCode="ML" value="223">Mali (+223)</option>
		<option data-countryCode="MT" value="356">Malta (+356)</option>
		<option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
		<option data-countryCode="MQ" value="596">Martinique (+596)</option>
		<option data-countryCode="MR" value="222">Mauritania (+222)</option>
		<option data-countryCode="YT" value="269">Mayotte (+269)</option>
		<option data-countryCode="MX" value="52">Mexico (+52)</option>
		<option data-countryCode="FM" value="691">Micronesia (+691)</option>
		<option data-countryCode="MD" value="373">Moldova (+373)</option>
		<option data-countryCode="MC" value="377">Monaco (+377)</option>
		<option data-countryCode="MN" value="976">Mongolia (+976)</option>
		<option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
		<!--<option data-countryCode="MA" value="212">Morocco (+212)</option>-->
		<option data-countryCode="MZ" value="258">Mozambique (+258)</option>
		<option data-countryCode="MN" value="95">Myanmar (+95)</option>
		<option data-countryCode="NA" value="264">Namibia (+264)</option>
		<option data-countryCode="NR" value="674">Nauru (+674)</option>
		<option data-countryCode="NP" value="977">Nepal (+977)</option>
		<option data-countryCode="NL" value="31">Netherlands (+31)</option>
		<option data-countryCode="NC" value="687">New Caledonia (+687)</option>
		<option data-countryCode="NZ" value="64">New Zealand (+64)</option>
		<option data-countryCode="NI" value="505">Nicaragua (+505)</option>
		<option data-countryCode="NE" value="227">Niger (+227)</option>
		<option data-countryCode="NG" value="234">Nigeria (+234)</option>
		<option data-countryCode="NU" value="683">Niue (+683)</option>
		<option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
		<option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
		<option data-countryCode="NO" value="47">Norway (+47)</option>
		<option data-countryCode="OM" value="968">Oman (+968)</option>
		<option data-countryCode="PW" value="680">Palau (+680)</option>
		<option data-countryCode="PA" value="507">Panama (+507)</option>
		<option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
		<option data-countryCode="PY" value="595">Paraguay (+595)</option>
		<option data-countryCode="PE" value="51">Peru (+51)</option>
		<option data-countryCode="PH" value="63">Philippines (+63)</option>
		<option data-countryCode="PL" value="48">Poland (+48)</option>
		<option data-countryCode="PT" value="351">Portugal (+351)</option>
		<option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
		<option data-countryCode="QA" value="974">Qatar (+974)</option>
		<option data-countryCode="RE" value="262">Reunion (+262)</option>
		<option data-countryCode="RO" value="40">Romania (+40)</option>
		<option data-countryCode="RU" value="7">Russia (+7)</option>
		<option data-countryCode="RW" value="250">Rwanda (+250)</option>
		<option data-countryCode="SM" value="378">San Marino (+378)</option>
		<option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
		<option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
		<option data-countryCode="SN" value="221">Senegal (+221)</option>
		<option data-countryCode="CS" value="381">Serbia (+381)</option>
		<option data-countryCode="SC" value="248">Seychelles (+248)</option>
		<option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
		<option data-countryCode="SG" value="65">Singapore (+65)</option>
		<option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
		<option data-countryCode="SI" value="386">Slovenia (+386)</option>
		<option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
		<option data-countryCode="SO" value="252">Somalia (+252)</option>
		<option data-countryCode="ZA" value="27">South Africa (+27)</option>
		<option data-countryCode="ES" value="34">Spain (+34)</option>
		<option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
		<option data-countryCode="SH" value="290">St. Helena (+290)</option>
		<option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
		<option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
		<option data-countryCode="SD" value="249">Sudan (+249)</option>
		<option data-countryCode="SR" value="597">Suriname (+597)</option>
		<option data-countryCode="SZ" value="268">Swaziland (+268)</option>
		<option data-countryCode="SE" value="46">Sweden (+46)</option>
		<option data-countryCode="CH" value="41">Switzerland (+41)</option>
		<option data-countryCode="SI" value="963">Syria (+963)</option>
		<option data-countryCode="TW" value="886">Taiwan (+886)</option>
		<option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
		<option data-countryCode="TH" value="66">Thailand (+66)</option>
		<option data-countryCode="TG" value="228">Togo (+228)</option>
		<option data-countryCode="TO" value="676">Tonga (+676)</option>
		<option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
		<option data-countryCode="TN" value="216">Tunisia (+216)</option>
		<option data-countryCode="TR" value="90">Turkey (+90)</option>
		<option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
		<option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
		<option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
		<option data-countryCode="TV" value="688">Tuvalu (+688)</option>
		<option data-countryCode="UG" value="256">Uganda (+256)</option>
		<option data-countryCode="GB" value="44">UK (+44)</option>
		<option data-countryCode="UA" value="380">Ukraine (+380)</option>
		<option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
		<option data-countryCode="UY" value="598">Uruguay (+598)</option>
		<option data-countryCode="US" value="1">USA (+1)</option>
		<option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
		<option data-countryCode="VU" value="678">Vanuatu (+678)</option>
		<option data-countryCode="VA" value="379">Vatican City (+379)</option>
		<option data-countryCode="VE" value="58">Venezuela (+58)</option>
		<option data-countryCode="VN" value="84">Vietnam (+84)</option>
		<option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
		<option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
		<option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
		<option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
		<option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
		<option data-countryCode="ZM" value="260">Zambia (+260)</option>
		<option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
	</optgroup>
</select>
<!--===============================================================-->
                <input style="width: 128px;" id="tel1" placeholder="exemple : 0623456789" title="Veuillez entrez votre numéro de téléphone"
                pattern="^\d{7,14}$"
                 name="tel1" type="tel" value="<?php if(isset($tel1)){echo $tel1;}  /*pattern="[\+]\d{3}[\(]\d{2}[\)]\d{4}[\-]\d{4}"  placeholder="(Format: +999(99)9999-9999)" ^((\+\d{1,4}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{5})(( x| ext)\d{1,5}){0,1}$*/  ?>"  maxlength="20" required/>

              </td>

              <td>
              <?php if($_SESSION['r_prm_cin_candidat']==0){ ?> 
              <label>CIN <font style="color:red;">*</font> </label>
              <?php }else{ ?>
              <label>T&eacute;l&eacute;phone secondaire</label>
              <?php } ?>
                <br />

<!--===============================================================-->

<?php if($_SESSION['r_prm_cin_candidat']==0){ ?> 
<input style="width: 200px;" id="tel2" name="tel2" required
placeholder="Votre CIN" title="Veuillez entrez votre numéro de CIN"
type="tel" value="<?php if(isset($tel2)){echo $tel2;}?>"   maxlength="20"/>
<?php }else{ ?>
<select style="width: 70px;" name="tel2_Code" id="" >
        <option data-countryCode="MA" value="212" Selected>(+212) Maroc</option> 
    <optgroup label="Autres pays">
        <option data-countryCode="DZ" value="213">Algeria (+213)</option> 
        <option data-countryCode="AD" value="376">Andorra (+376)</option>
        <option data-countryCode="AO" value="244">Angola (+244)</option>
        <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
        <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
        <option data-countryCode="AR" value="54">Argentina (+54)</option>
        <option data-countryCode="AM" value="374">Armenia (+374)</option>
        <option data-countryCode="AW" value="297">Aruba (+297)</option>
        <option data-countryCode="AU" value="61">Australia (+61)</option>
        <option data-countryCode="AT" value="43">Austria (+43)</option>
        <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
        <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
        <option data-countryCode="BH" value="973">Bahrain (+973)</option>
        <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
        <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
        <option data-countryCode="BY" value="375">Belarus (+375)</option>
        <option data-countryCode="BE" value="32">Belgium (+32)</option>
        <option data-countryCode="BZ" value="501">Belize (+501)</option>
        <option data-countryCode="BJ" value="229">Benin (+229)</option>
        <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
        <option data-countryCode="BT" value="975">Bhutan (+975)</option>
        <option data-countryCode="BO" value="591">Bolivia (+591)</option>
        <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
        <option data-countryCode="BW" value="267">Botswana (+267)</option>
        <option data-countryCode="BR" value="55">Brazil (+55)</option>
        <option data-countryCode="BN" value="673">Brunei (+673)</option>
        <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
        <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
        <option data-countryCode="BI" value="257">Burundi (+257)</option>
        <option data-countryCode="KH" value="855">Cambodia (+855)</option>
        <option data-countryCode="CM" value="237">Cameroon (+237)</option>
        <option data-countryCode="CA" value="1">Canada (+1)</option>
        <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
        <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
        <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
        <option data-countryCode="CL" value="56">Chile (+56)</option>
        <option data-countryCode="CN" value="86">China (+86)</option>
        <option data-countryCode="CO" value="57">Colombia (+57)</option>
        <option data-countryCode="KM" value="269">Comoros (+269)</option>
        <option data-countryCode="CG" value="242">Congo (+242)</option>
        <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
        <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
        <option data-countryCode="HR" value="385">Croatia (+385)</option>
        <option data-countryCode="CU" value="53">Cuba (+53)</option>
        <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
        <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
        <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
        <option data-countryCode="DK" value="45">Denmark (+45)</option>
        <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
        <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
        <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
        <option data-countryCode="EC" value="593">Ecuador (+593)</option>
        <option data-countryCode="EG" value="20">Egypt (+20)</option>
        <option data-countryCode="SV" value="503">El Salvador (+503)</option>
        <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
        <option data-countryCode="ER" value="291">Eritrea (+291)</option>
        <option data-countryCode="EE" value="372">Estonia (+372)</option>
        <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
        <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
        <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
        <option data-countryCode="FJ" value="679">Fiji (+679)</option>
        <option data-countryCode="FI" value="358">Finland (+358)</option>
        <option data-countryCode="FR" value="33">France (+33)</option>
        <option data-countryCode="GF" value="594">French Guiana (+594)</option>
        <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
        <option data-countryCode="GA" value="241">Gabon (+241)</option>
        <option data-countryCode="GM" value="220">Gambia (+220)</option>
        <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
        <option data-countryCode="DE" value="49">Germany (+49)</option>
        <option data-countryCode="GH" value="233">Ghana (+233)</option>
        <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
        <option data-countryCode="GR" value="30">Greece (+30)</option>
        <option data-countryCode="GL" value="299">Greenland (+299)</option>
        <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
        <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
        <option data-countryCode="GU" value="671">Guam (+671)</option>
        <option data-countryCode="GT" value="502">Guatemala (+502)</option>
        <option data-countryCode="GN" value="224">Guinea (+224)</option>
        <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
        <option data-countryCode="GY" value="592">Guyana (+592)</option>
        <option data-countryCode="HT" value="509">Haiti (+509)</option>
        <option data-countryCode="HN" value="504">Honduras (+504)</option>
        <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
        <option data-countryCode="HU" value="36">Hungary (+36)</option>
        <option data-countryCode="IS" value="354">Iceland (+354)</option>
        <option data-countryCode="IN" value="91">India (+91)</option>
        <option data-countryCode="ID" value="62">Indonesia (+62)</option>
        <option data-countryCode="IR" value="98">Iran (+98)</option>
        <option data-countryCode="IQ" value="964">Iraq (+964)</option>
        <option data-countryCode="IE" value="353">Ireland (+353)</option> 
        <option data-countryCode="IT" value="39">Italy (+39)</option>
        <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
        <option data-countryCode="JP" value="81">Japan (+81)</option>
        <option data-countryCode="JO" value="962">Jordan (+962)</option>
        <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
        <option data-countryCode="KE" value="254">Kenya (+254)</option>
        <option data-countryCode="KI" value="686">Kiribati (+686)</option>
        <option data-countryCode="KP" value="850">Korea North (+850)</option>
        <option data-countryCode="KR" value="82">Korea South (+82)</option>
        <option data-countryCode="KW" value="965">Kuwait (+965)</option>
        <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
        <option data-countryCode="LA" value="856">Laos (+856)</option>
        <option data-countryCode="LV" value="371">Latvia (+371)</option>
        <option data-countryCode="LB" value="961">Lebanon (+961)</option>
        <option data-countryCode="LS" value="266">Lesotho (+266)</option>
        <option data-countryCode="LR" value="231">Liberia (+231)</option>
        <option data-countryCode="LY" value="218">Libya (+218)</option>
        <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
        <option data-countryCode="LT" value="370">Lithuania (+370)</option>
        <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
        <option data-countryCode="MO" value="853">Macao (+853)</option>
        <option data-countryCode="MK" value="389">Macedonia (+389)</option>
        <option data-countryCode="MG" value="261">Madagascar (+261)</option>
        <option data-countryCode="MW" value="265">Malawi (+265)</option>
        <option data-countryCode="MY" value="60">Malaysia (+60)</option>
        <option data-countryCode="MV" value="960">Maldives (+960)</option>
        <option data-countryCode="ML" value="223">Mali (+223)</option>
        <option data-countryCode="MT" value="356">Malta (+356)</option>
        <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
        <option data-countryCode="MQ" value="596">Martinique (+596)</option>
        <option data-countryCode="MR" value="222">Mauritania (+222)</option>
        <option data-countryCode="YT" value="269">Mayotte (+269)</option>
        <option data-countryCode="MX" value="52">Mexico (+52)</option>
        <option data-countryCode="FM" value="691">Micronesia (+691)</option>
        <option data-countryCode="MD" value="373">Moldova (+373)</option>
        <option data-countryCode="MC" value="377">Monaco (+377)</option>
        <option data-countryCode="MN" value="976">Mongolia (+976)</option>
        <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
        <!--<option data-countryCode="MA" value="212">Morocco (+212)</option>-->
        <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
        <option data-countryCode="MN" value="95">Myanmar (+95)</option>
        <option data-countryCode="NA" value="264">Namibia (+264)</option>
        <option data-countryCode="NR" value="674">Nauru (+674)</option>
        <option data-countryCode="NP" value="977">Nepal (+977)</option>
        <option data-countryCode="NL" value="31">Netherlands (+31)</option>
        <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
        <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
        <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
        <option data-countryCode="NE" value="227">Niger (+227)</option>
        <option data-countryCode="NG" value="234">Nigeria (+234)</option>
        <option data-countryCode="NU" value="683">Niue (+683)</option>
        <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
        <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
        <option data-countryCode="NO" value="47">Norway (+47)</option>
        <option data-countryCode="OM" value="968">Oman (+968)</option>
        <option data-countryCode="PW" value="680">Palau (+680)</option>
        <option data-countryCode="PA" value="507">Panama (+507)</option>
        <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
        <option data-countryCode="PY" value="595">Paraguay (+595)</option>
        <option data-countryCode="PE" value="51">Peru (+51)</option>
        <option data-countryCode="PH" value="63">Philippines (+63)</option>
        <option data-countryCode="PL" value="48">Poland (+48)</option>
        <option data-countryCode="PT" value="351">Portugal (+351)</option>
        <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
        <option data-countryCode="QA" value="974">Qatar (+974)</option>
        <option data-countryCode="RE" value="262">Reunion (+262)</option>
        <option data-countryCode="RO" value="40">Romania (+40)</option>
        <option data-countryCode="RU" value="7">Russia (+7)</option>
        <option data-countryCode="RW" value="250">Rwanda (+250)</option>
        <option data-countryCode="SM" value="378">San Marino (+378)</option>
        <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
        <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
        <option data-countryCode="SN" value="221">Senegal (+221)</option>
        <option data-countryCode="CS" value="381">Serbia (+381)</option>
        <option data-countryCode="SC" value="248">Seychelles (+248)</option>
        <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
        <option data-countryCode="SG" value="65">Singapore (+65)</option>
        <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
        <option data-countryCode="SI" value="386">Slovenia (+386)</option>
        <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
        <option data-countryCode="SO" value="252">Somalia (+252)</option>
        <option data-countryCode="ZA" value="27">South Africa (+27)</option>
        <option data-countryCode="ES" value="34">Spain (+34)</option>
        <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
        <option data-countryCode="SH" value="290">St. Helena (+290)</option>
        <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
        <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
        <option data-countryCode="SD" value="249">Sudan (+249)</option>
        <option data-countryCode="SR" value="597">Suriname (+597)</option>
        <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
        <option data-countryCode="SE" value="46">Sweden (+46)</option>
        <option data-countryCode="CH" value="41">Switzerland (+41)</option>
        <option data-countryCode="SI" value="963">Syria (+963)</option>
        <option data-countryCode="TW" value="886">Taiwan (+886)</option>
        <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
        <option data-countryCode="TH" value="66">Thailand (+66)</option>
        <option data-countryCode="TG" value="228">Togo (+228)</option>
        <option data-countryCode="TO" value="676">Tonga (+676)</option>
        <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
        <option data-countryCode="TN" value="216">Tunisia (+216)</option>
        <option data-countryCode="TR" value="90">Turkey (+90)</option>
        <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
        <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
        <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
        <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
        <option data-countryCode="UG" value="256">Uganda (+256)</option>
        <option data-countryCode="GB" value="44">UK (+44)</option>
        <option data-countryCode="UA" value="380">Ukraine (+380)</option>
        <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
        <option data-countryCode="UY" value="598">Uruguay (+598)</option>
        <option data-countryCode="US" value="1">USA (+1)</option>
        <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
        <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
        <option data-countryCode="VA" value="379">Vatican City (+379)</option>
        <option data-countryCode="VE" value="58">Venezuela (+58)</option>
        <option data-countryCode="VN" value="84">Vietnam (+84)</option>
        <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
        <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
        <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
        <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
        <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
        <option data-countryCode="ZM" value="260">Zambia (+260)</option>
        <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
    </optgroup>
</select>
<!--===============================================================-->
                <input style="width: 126px;" id="tel2" name="tel2" placeholder="exemple : 0623456789" title="Veuillez entrez votre numéro de téléphone secondaire"
                pattern="^\d{7,14}$"
                type="tel" value="<?php if(isset($tel2)){echo $tel2;}?>"  maxlength="20"/>
<?php } ?>
              </td>

            </tr>

            <tr>

              <td colspan="3"><div class="subscription" style="margin: 10px 0pt;">

                  <h1>Indentifiants </h1>

                </div></td>

            </tr>

            <tr>

              <td><label>Adresse e-mail </label>

                <font style="color:red;">*</font> <br />
<?php
$email___v='';
if(isset($email1)){$email___v=$email1;}
elseif(isset($_SESSION['fb___email'] )){$email___v=$_SESSION['fb___email'];} 
?>
                <input type="email" id="email0" placeholder="exemple@domaine.com" title="Veuillez entrez votre email"
                name="email1" value="<?php  echo $email___v; ?>"  style="width:200px"  placeholder="   me@example.com  " maxlength="50" required/></td>

              <td><label>Mot de passe </label>

                <font style="color:red;">*</font> <br />

                <input id="mdp1" placeholder="**********" 
                 title="Veuillez entrer le mot de passe" 
                 oninput="form.mdp2.pattern = escapeRegExp(this.value)"
                type="password" name="mdp1" style="width:198px"  maxlength="15" required/>
           <a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>

     <em><span></span>  Le mot de passe doit contenir entre 4 et 15 caractères et doit avoir au moins un chiffre et un caractère . </em>

 </a></td>

              <td><label>Confirmation mot de passe </label>

                <font style="color:red;">*</font> <br />

                <input id="mdp2" placeholder="**********" 
                pattern="" title="Veuillez retapez le mot de passe" 
                type="password" name="mdp2" style="width:200px"  maxlength="15" required /></td>

            </tr>
<script>
    function escapeRegExp(str) {
      return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }
</script>
            <tr>

              <td colspan="3"><div class="subscription" style="margin: 10px 0pt;">

                  <h1>Profil </h1>

                </div></td>

            </tr>

            <tr>

              <td><label>Situation actuelle </label>

                <font style="color:red;">*</font> <br />

                <select id="situation" name="situation" title=" Votre situation actuelle " required>
            <option value=""></option>
                  <?php     $req_si = mysql_query( "SELECT * FROM prm_situation");        
          while ( $si = mysql_fetch_array( $req_si ) ) {          
          $si_id = $si['id_situ'];          
          $si_desc = $si['situation'];          
            if(isset($civilite) and $situation==$si_id){          
            echo '<option value="'.$si_id.'" selected="selected">'.$si_desc.'</option>';
            }   else  {         
            echo '<option value="'.$si_id.'">'.$si_desc.'</option>';          
            }
          }   
          ?>
                </select></td>

              <td><label>Secteur actuel   </label>

                <font style="color:red;">*</font> <br />

                <select id="domaine" name="domaine" title=" Votre domaine " required/>

                  <option value="" ></option>

                  <?php $req_theme = mysql_query( "SELECT * FROM prm_sectors"); 
          while ( $data = mysql_fetch_array( $req_theme ) ) {   
          $Sector_id = $data['id_sect'];    $Sector = $data['FR'];    
          if(isset($domaine) and $domaine==$Sector_id){   echo '<option value="'.$Sector_id.'" selected="selected">'.$Sector.'</option>';   }   
          else    {   echo '<option value="'.$Sector_id.'">'.$Sector.'</option>';   } }?>

                </select>

              </td>

              <td><label>Fonction </label>
          <font style="color:red;">*</font> <br />
          <select id="fonction" title=" Votre fonction "  name="fonction" required/>
            <option value="" selected="selected"></option>
            <?php
            $req3_theme = mysql_query("SELECT * FROM prm_fonctions");
            while ($data3 = mysql_fetch_array($req3_theme)) {
          $fonc_id = $data3['id_fonc'];
          $fonc = $data3['fonction'];
          if (isset($fonction) and $fonc_id == $fonction)
            $selected = 'selected';
          else
            $selected = '';
          echo "<option value=\"$fonc_id\" " . $selected . ">$fonc</option>";
            }
            ?>
          </select>

              </td>

            </tr>

            <tr>

             

              <td><label>Salaire souhaité </label>

                <font style="color:red;">*</font> <br />

                <select id="salaire" name="salaire" title=" Votre salaire souhaité " required/>

                  <option value=""></option>

                  <?php     $req_salaire = mysql_query( "SELECT * FROM prm_salaires");        
          while ( $salaire1 = mysql_fetch_array( $req_salaire ) ) {         
          $salaire_id = $salaire1['id_salr'];         $salaire_desc = $salaire1['salaire'];         
          if(isset($salaire) and $salaire==$salaire_id )          {       
          echo '<option value="'.$salaire_id.'" selected="selected">'.$salaire_desc.'</option>';          }         else          {         echo '<option value="'.$salaire_id.'">'.$salaire_desc.'</option>';          }                       }   ?>

                </select></td>

              <td><label>Niveau de formation </label>

                <font style="color:red;">*</font> <br />

                <select id="formation" name="formation" title=" Votre niveau de formation"  required/>
          <option value=""></option>

                  <?php     $req_niv_formation = mysql_query( "SELECT * FROM prm_niv_formation");       
          while ( $niv_formation = mysql_fetch_array( $req_niv_formation ) ) {          
          $formation_id = $niv_formation['id_nfor'];          
          $formation_desc = $niv_formation['formation'];          
            if(isset($formation) and $formation==$formation_id )          {         
            echo '<option value="'.$formation_id.'" selected="selected">'.$formation_desc.'</option>';          }         
            else          {         
            echo '<option value="'.$formation_id.'">'.$formation_desc.'</option>';          
            }                       
          }   ?>


                </select></td>

              <td><label>Type de formation </label>

                <font style="color:red;">*</font> <br />

                <select id="type_formation" name="type_formation" title=" Votre type de formation" required/>
                <option value=""></option>

                  <?php     $req_typ_formation = mysql_query( "SELECT * FROM prm_type_formation");       
          while ( $typ_formation = mysql_fetch_array( $req_typ_formation ) ) {          
          $t_formation_id = $typ_formation['id_tfor'];          
          $t_formation_desc = $typ_formation['formation'];          
            if(isset($type_formation) and $type_formation==$t_formation_id )          {         
            echo '<option value="'.$t_formation_id.'" selected="selected">'.$t_formation_desc.'</option>';          }         
            else          {         
            echo '<option value="'.$t_formation_id.'">'.$t_formation_desc.'</option>';          
            }                       
          }   ?>

                </select>

              </td>

            

            </tr>
      <tr>
           <td><label>Disponibilité</label>
          <font style="color:red;">*</font><br />
          <select  id="dispo" title=" Votre disponibilité"  name="dispo" required/>
            <option value="" selected="selected"> </option>
            <?php
            $req2_theme = mysql_query("SELECT * FROM prm_disponibilite");
            while ($data2 = mysql_fetch_array($req2_theme)) {
          $dispo_id = $data2['id_dispo'];
          $dispo_int = $data2['intitule'];
          if (isset($dispo) and $dispo_id == $dispo)
            $selected = 'selected';
          else
            $selected = '';
          echo "<option value=\"$dispo_id\" " . $selected . ">$dispo_int</option>";
            }
            ?>
            
          </select>
         </td>
           <td ><label>Exp&eacute;rience </label>

                <font style="color:red;">*</font> <br />

                <select id="exp" name="exp" title=" Votre expérience" required/>

                  <option value=""></option>

                  <?php     $req_exp = mysql_query( "SELECT * FROM prm_experience");        
          while ( $exp1 = mysql_fetch_array( $req_exp ) ) {         
          $exp_id = $exp1['id_expe'];         $exp_desc = $exp1['intitule'];          
          if(isset($exp) and $exp==$exp_id){          
          echo '<option value="'.$exp_id.'" selected="selected">'.$exp_desc.'</option>';          }         
          else          {         echo '<option value="'.$exp_id.'">'.$exp_desc.'</option>';          }             }   ?>

                </select>
         </td>
      </tr>

       <tr>
         <td colspan="4"><br><label>Mobilité géographique </label>
		 <?php
		 $var_oui = $var_non = ''; 
		 if (isset($mobilite) AND $mobilite == 'oui') {$var_oui = 'checked';$var_non = '';} 
		 else  {$var_oui = '';$var_non = 'checked';}
		 
		 ?>
      <input name="mobilite" title=" Votre mobilité géographique" type="radio" value="oui" 
      onclick="document.getElementById('mobilite').style.display='inline'" style="width:20px" <?php  echo $var_oui; ?> />
      Oui
      <input name="mobilite" type="radio" value="non" 
      onclick="document.getElementById('mobilite').style.display='none'" style="width:20px"  <?php  echo $var_non; ?> />
      Non
      <ul id="mobilite" style="display:<?php if (isset($mobilite) AND $mobilite == 'oui') echo 'inline'; else echo 'none'; ?>;list-style:none;">
        <li style="list-style-type: none;"> Au niveau :   
           <?php
		   $i=0;
            $req1_mobi = mysql_query("SELECT * FROM prm_mobi_niv");
            while ($mobi_n1 = mysql_fetch_array($req1_mobi)) {
          $mobin_id = $mobi_n1['id_mobi_niv'];          $mobi_n = $mobi_n1['niveau'];
          if ((isset($niveau) and $mobin_id == $niveau) or ( $i==0))
            $selected = 'checked';
          else
            $selected = '';
          echo '<input name="niveau" type="radio" value="'.$mobin_id .'" style="width: 20px;" '. $selected .' /> '.$mobi_n;		  
		   $i++;
            }
            ?>
            
      </li>
        <li style="list-style-type: none;"> Taux de mobilité:
           <?php
		   $i=0;
            $req2_mobi = mysql_query("SELECT * FROM prm_mobi_taux");
            while ($mobi_t2 = mysql_fetch_array($req2_mobi)) {
          $mobit_id = $mobi_t2['id_mobi_taux'];         $mobi_t = $mobi_t2['taux'];
          if ((isset($taux) and $mobit_id == $taux) or ( $i==0))
            $selected = 'checked';
          else
            $selected = '';
          echo '<input name="taux" type="radio" value="'.$mobit_id .'" style="width: 20px;" '. $selected .' /> '.$mobi_t;
		   $i++;
            }
            
            ?>
            
      </li></ul>  </td>
       </tr>
       
                            
       
                                
                        
    
    


  
  
        
<!--  
==========================================================================================================================================  
========================================================================================================================================== 
--> 


          </table>