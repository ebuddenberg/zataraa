 <?php $this->load->view('inc/header', $this->data); ?> 
    <section id="home" class="padbot0"> <img src="<?php echo base_url(); ?>frontend-assets/images/breadcrumb_bg1.jpg"> </section>
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
         
        <li class="active">My Account</li>
      </ol>
    </div>
    <section class="shopping_bag_block">
			
			<!-- CONTAINER -->
			<div class="container">
			
				<!-- ROW -->
				<div class="row">
					<!-- CART TABLE -->
					<div class="col-lg-10 col-md-10 col-md-offset-1 col-lg-offset-1" style="margin-bottom: 58px;"  >
						
						 <h2>My Account</h2>
              <p>Click on the buttons inside the tabbed menu:</p>
             <div class="warapper_tabs">
              <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'my_details')" id="defaultOpen">My Details</button>
                <button class="tablinks" onclick="openCity(event, 'my_address')">My Address</button>
                <button class="tablinks" onclick="openCity(event, 'my_order')">My Orders</button>
                
              </div>

              <div id="my_details" class="tabcontent">
                <h2>My Details</h2>
                <hr class="clear">
            <form action="" id="my_form_details">
            <div class="checkout_form_input first_name">
              <label>First Name <span class="color_red">*</span></label>
              <input type="text" name="first_name" value="<?php echo $users->first_name ; ?>" placeholder="">
            </div>
            
            <div class="checkout_form_input last_name">
              <label>Last name <span class="color_red">*</span></label>
              <input type="text" name="last_name" value="<?php echo $users->last_name ; ?>" placeholder="">
            </div>
            
            <div class="checkout_form_input phone">
              <label>Mobile Number <span class="color_red">*</span></label>
              <input type="text" name="user_phone" value="<?php echo $users->user_phone ; ?>" placeholder="">
            </div>
            
            <div class="checkout_form_input last E-mail">
              <label>e-mail <span class="color_red">*</span></label>
              <input type="text" name="email" disabled="" value="<?php echo $users->email ; ?>" placeholder="">
            </div>
            <hr class="clear">
            <div class="clear"></div>
            
            <div class="checkout_form_note">All fields marked with (<span class="color_red">*</span>) are required</div>
            <button class="btn active pull-right my_details" type="submit">Update</button>
        </form>

              </div>
              <div id="my_address" class="tabcontent">
                <h3>My Address</h3>
                <hr class="clear">
                <form id="my_address_details">
            <div class="checkout_form_input country">
              <label>Country <span class="color_red">*</span></label>
               <div class="fancy-select"><select class="basic fancified" style="width: 1px; height: 1px; display: block; position: absolute; top: 0px; left: 0px; opacity: 0;" name="user_country">
                  <option value="Select Country" selected="">Select Country</option>
                <option data-countrycode="DZ" value="213">Algeria (+213)</option>
                <option data-countrycode="AD" value="376">Andorra (+376)</option>
                <option data-countrycode="AO" value="244">Angola (+244)</option>
                <option data-countrycode="AI" value="1264">Anguilla (+1264)</option>
                <option data-countrycode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                <option data-countrycode="AR" value="54">Argentina (+54)</option>
                <option data-countrycode="AM" value="374">Armenia (+374)</option>
                <option data-countrycode="AW" value="297">Aruba (+297)</option>
                <option data-countrycode="AU" value="61">Australia (+61)</option>
                <option data-countrycode="AT" value="43">Austria (+43)</option>
                <option data-countrycode="AZ" value="994">Azerbaijan (+994)</option>
                <option data-countrycode="BS" value="1242">Bahamas (+1242)</option>
                <option data-countrycode="BH" value="973">Bahrain (+973)</option>
                <option data-countrycode="BD" value="880">Bangladesh (+880)</option>
                <option data-countrycode="BB" value="1246">Barbados (+1246)</option>
                <option data-countrycode="BY" value="375">Belarus (+375)</option>
                <option data-countrycode="BE" value="32">Belgium (+32)</option>
                <option data-countrycode="BZ" value="501">Belize (+501)</option>
                <option data-countrycode="BJ" value="229">Benin (+229)</option>
                <option data-countrycode="BM" value="1441">Bermuda (+1441)</option>
                <option data-countrycode="BT" value="975">Bhutan (+975)</option>
                <option data-countrycode="BO" value="591">Bolivia (+591)</option>
                <option data-countrycode="BA" value="387">Bosnia Herzegovina (+387)</option>
                <option data-countrycode="BW" value="267">Botswana (+267)</option>
                <option data-countrycode="BR" value="55">Brazil (+55)</option>
                <option data-countrycode="BN" value="673">Brunei (+673)</option>
                <option data-countrycode="BG" value="359">Bulgaria (+359)</option>
                <option data-countrycode="BF" value="226">Burkina Faso (+226)</option>
                <option data-countrycode="BI" value="257">Burundi (+257)</option>
                <option data-countrycode="KH" value="855">Cambodia (+855)</option>
                <option data-countrycode="CM" value="237">Cameroon (+237)</option>
                <option data-countrycode="CA" value="1">Canada (+1)</option>
                <option data-countrycode="CV" value="238">Cape Verde Islands (+238)</option>
                <option data-countrycode="KY" value="1345">Cayman Islands (+1345)</option>
                <option data-countrycode="CF" value="236">Central African Republic (+236)</option>
                <option data-countrycode="CL" value="56">Chile (+56)</option>
                <option data-countrycode="CN" value="86">China (+86)</option>
                <option data-countrycode="CO" value="57">Colombia (+57)</option>
                <option data-countrycode="KM" value="269">Comoros (+269)</option>
                <option data-countrycode="CG" value="242">Congo (+242)</option>
                <option data-countrycode="CK" value="682">Cook Islands (+682)</option>
                <option data-countrycode="CR" value="506">Costa Rica (+506)</option>
                <option data-countrycode="HR" value="385">Croatia (+385)</option>
                <option data-countrycode="CU" value="53">Cuba (+53)</option>
                <option data-countrycode="CY" value="90392">Cyprus North (+90392)</option>
                <option data-countrycode="CY" value="357">Cyprus South (+357)</option>
                <option data-countrycode="CZ" value="42">Czech Republic (+42)</option>
                <option data-countrycode="DK" value="45">Denmark (+45)</option>
                <option data-countrycode="DJ" value="253">Djibouti (+253)</option>
                <option data-countrycode="DM" value="1809">Dominica (+1809)</option>
                <option data-countrycode="DO" value="1809">Dominican Republic (+1809)</option>
                <option data-countrycode="EC" value="593">Ecuador (+593)</option>
                <option data-countrycode="EG" value="20">Egypt (+20)</option>
                <option data-countrycode="SV" value="503">El Salvador (+503)</option>
                <option data-countrycode="GQ" value="240">Equatorial Guinea (+240)</option>
                <option data-countrycode="ER" value="291">Eritrea (+291)</option>
                <option data-countrycode="EE" value="372">Estonia (+372)</option>
                <option data-countrycode="ET" value="251">Ethiopia (+251)</option>
                <option data-countrycode="FK" value="500">Falkland Islands (+500)</option>
                <option data-countrycode="FO" value="298">Faroe Islands (+298)</option>
                <option data-countrycode="FJ" value="679">Fiji (+679)</option>
                <option data-countrycode="FI" value="358">Finland (+358)</option>
                <option data-countrycode="FR" value="33">France (+33)</option>
                <option data-countrycode="GF" value="594">French Guiana (+594)</option>
                <option data-countrycode="PF" value="689">French Polynesia (+689)</option>
                <option data-countrycode="GA" value="241">Gabon (+241)</option>
                <option data-countrycode="GM" value="220">Gambia (+220)</option>
                <option data-countrycode="GE" value="7880">Georgia (+7880)</option>
                <option data-countrycode="DE" value="49">Germany (+49)</option>
                <option data-countrycode="GH" value="233">Ghana (+233)</option>
                <option data-countrycode="GI" value="350">Gibraltar (+350)</option>
                <option data-countrycode="GR" value="30">Greece (+30)</option>
                <option data-countrycode="GL" value="299">Greenland (+299)</option>
                <option data-countrycode="GD" value="1473">Grenada (+1473)</option>
                <option data-countrycode="GP" value="590">Guadeloupe (+590)</option>
                <option data-countrycode="GU" value="671">Guam (+671)</option>
                <option data-countrycode="GT" value="502">Guatemala (+502)</option>
                <option data-countrycode="GN" value="224">Guinea (+224)</option>
                <option data-countrycode="GW" value="245">Guinea - Bissau (+245)</option>
                <option data-countrycode="GY" value="592">Guyana (+592)</option>
                <option data-countrycode="HT" value="509">Haiti (+509)</option>
                <option data-countrycode="HN" value="504">Honduras (+504)</option>
                <option data-countrycode="HK" value="852">Hong Kong (+852)</option>
                <option data-countrycode="HU" value="36">Hungary (+36)</option>
                <option data-countrycode="IS" value="354">Iceland (+354)</option>
                <option data-countrycode="IN" value="91">India (+91)</option>
                <option data-countrycode="ID" value="62">Indonesia (+62)</option>
                <option data-countrycode="IR" value="98">Iran (+98)</option>
                <option data-countrycode="IQ" value="964">Iraq (+964)</option>
                <option data-countrycode="IE" value="353">Ireland (+353)</option>
                <option data-countrycode="IL" value="972">Israel (+972)</option>
                <option data-countrycode="IT" value="39">Italy (+39)</option>
                <option data-countrycode="JM" value="1876">Jamaica (+1876)</option>
                <option data-countrycode="JP" value="81">Japan (+81)</option>
                <option data-countrycode="JO" value="962">Jordan (+962)</option>
                <option data-countrycode="KZ" value="7">Kazakhstan (+7)</option>
                <option data-countrycode="KE" value="254">Kenya (+254)</option>
                <option data-countrycode="KI" value="686">Kiribati (+686)</option>
                <option data-countrycode="KP" value="850">Korea North (+850)</option>
                <option data-countrycode="KR" value="82">Korea South (+82)</option>
                <option data-countrycode="KW" value="965">Kuwait (+965)</option>
                <option data-countrycode="KG" value="996">Kyrgyzstan (+996)</option>
                <option data-countrycode="LA" value="856">Laos (+856)</option>
                <option data-countrycode="LV" value="371">Latvia (+371)</option>
                <option data-countrycode="LB" value="961">Lebanon (+961)</option>
                <option data-countrycode="LS" value="266">Lesotho (+266)</option>
                <option data-countrycode="LR" value="231">Liberia (+231)</option>
                <option data-countrycode="LY" value="218">Libya (+218)</option>
                <option data-countrycode="LI" value="417">Liechtenstein (+417)</option>
                <option data-countrycode="LT" value="370">Lithuania (+370)</option>
                <option data-countrycode="LU" value="352">Luxembourg (+352)</option>
                <option data-countrycode="MO" value="853">Macao (+853)</option>
                <option data-countrycode="MK" value="389">Macedonia (+389)</option>
                <option data-countrycode="MG" value="261">Madagascar (+261)</option>
                <option data-countrycode="MW" value="265">Malawi (+265)</option>
                <option data-countrycode="MY" value="60">Malaysia (+60)</option>
                <option data-countrycode="MV" value="960">Maldives (+960)</option>
                <option data-countrycode="ML" value="223">Mali (+223)</option>
                <option data-countrycode="MT" value="356">Malta (+356)</option>
                <option data-countrycode="MH" value="692">Marshall Islands (+692)</option>
                <option data-countrycode="MQ" value="596">Martinique (+596)</option>
                <option data-countrycode="MR" value="222">Mauritania (+222)</option>
                <option data-countrycode="YT" value="269">Mayotte (+269)</option>
                <option data-countrycode="MX" value="52">Mexico (+52)</option>
                <option data-countrycode="FM" value="691">Micronesia (+691)</option>
                <option data-countrycode="MD" value="373">Moldova (+373)</option>
                <option data-countrycode="MC" value="377">Monaco (+377)</option>
                <option data-countrycode="MN" value="976">Mongolia (+976)</option>
                <option data-countrycode="MS" value="1664">Montserrat (+1664)</option>
                <option data-countrycode="MA" value="212">Morocco (+212)</option>
                <option data-countrycode="MZ" value="258">Mozambique (+258)</option>
                <option data-countrycode="MN" value="95">Myanmar (+95)</option>
                <option data-countrycode="NA" value="264">Namibia (+264)</option>
                <option data-countrycode="NR" value="674">Nauru (+674)</option>
                <option data-countrycode="NP" value="977">Nepal (+977)</option>
                <option data-countrycode="NL" value="31">Netherlands (+31)</option>
                <option data-countrycode="NC" value="687">New Caledonia (+687)</option>
                <option data-countrycode="NZ" value="64">New Zealand (+64)</option>
                <option data-countrycode="NI" value="505">Nicaragua (+505)</option>
                <option data-countrycode="NE" value="227">Niger (+227)</option>
                <option data-countrycode="NG" value="234">Nigeria (+234)</option>
                <option data-countrycode="NU" value="683">Niue (+683)</option>
                <option data-countrycode="NF" value="672">Norfolk Islands (+672)</option>
                <option data-countrycode="NP" value="670">Northern Marianas (+670)</option>
                <option data-countrycode="NO" value="47">Norway (+47)</option>
                <option data-countrycode="OM" value="968">Oman (+968)</option>
                <option data-countrycode="PW" value="680">Palau (+680)</option>
                <option data-countrycode="PA" value="507">Panama (+507)</option>
                <option data-countrycode="PG" value="675">Papua New Guinea (+675)</option>
                <option data-countrycode="PY" value="595">Paraguay (+595)</option>
                <option data-countrycode="PE" value="51">Peru (+51)</option>
                <option data-countrycode="PH" value="63">Philippines (+63)</option>
                <option data-countrycode="PL" value="48">Poland (+48)</option>
                <option data-countrycode="PT" value="351">Portugal (+351)</option>
                <option data-countrycode="PR" value="1787">Puerto Rico (+1787)</option>
                <option data-countrycode="QA" value="974">Qatar (+974)</option>
                <option data-countrycode="RE" value="262">Reunion (+262)</option>
                <option data-countrycode="RO" value="40">Romania (+40)</option>
                <option data-countrycode="RU" value="7">Russia (+7)</option>
                <option data-countrycode="RW" value="250">Rwanda (+250)</option>
                <option data-countrycode="SM" value="378">San Marino (+378)</option>
                <option data-countrycode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                <option data-countrycode="SA" value="966">Saudi Arabia (+966)</option>
                <option data-countrycode="SN" value="221">Senegal (+221)</option>
                <option data-countrycode="CS" value="381">Serbia (+381)</option>
                <option data-countrycode="SC" value="248">Seychelles (+248)</option>
                <option data-countrycode="SL" value="232">Sierra Leone (+232)</option>
                <option data-countrycode="SG" value="65">Singapore (+65)</option>
                <option data-countrycode="SK" value="421">Slovak Republic (+421)</option>
                <option data-countrycode="SI" value="386">Slovenia (+386)</option>
                <option data-countrycode="SB" value="677">Solomon Islands (+677)</option>
                <option data-countrycode="SO" value="252">Somalia (+252)</option>
                <option data-countrycode="ZA" value="27">South Africa (+27)</option>
                <option data-countrycode="ES" value="34">Spain (+34)</option>
                <option data-countrycode="LK" value="94">Sri Lanka (+94)</option>
                <option data-countrycode="SH" value="290">St. Helena (+290)</option>
                <option data-countrycode="KN" value="1869">St. Kitts (+1869)</option>
                <option data-countrycode="SC" value="1758">St. Lucia (+1758)</option>
                <option data-countrycode="SD" value="249">Sudan (+249)</option>
                <option data-countrycode="SR" value="597">Suriname (+597)</option>
                <option data-countrycode="SZ" value="268">Swaziland (+268)</option>
                <option data-countrycode="SE" value="46">Sweden (+46)</option>
                <option data-countrycode="CH" value="41">Switzerland (+41)</option>
                <option data-countrycode="SI" value="963">Syria (+963)</option>
                <option data-countrycode="TW" value="886">Taiwan (+886)</option>
                <option data-countrycode="TJ" value="7">Tajikstan (+7)</option>
                <option data-countrycode="TH" value="66">Thailand (+66)</option>
                <option data-countrycode="TG" value="228">Togo (+228)</option>
                <option data-countrycode="TO" value="676">Tonga (+676)</option>
                <option data-countrycode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                <option data-countrycode="TN" value="216">Tunisia (+216)</option>
                <option data-countrycode="TR" value="90">Turkey (+90)</option>
                <option data-countrycode="TM" value="7">Turkmenistan (+7)</option>
                <option data-countrycode="TM" value="993">Turkmenistan (+993)</option>
                <option data-countrycode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                <option data-countrycode="TV" value="688">Tuvalu (+688)</option>
                <option data-countrycode="UG" value="256">Uganda (+256)</option>
                <option data-countrycode="GB" value="44">UK (+44)</option>
                <option data-countrycode="UA" value="380">Ukraine (+380)</option>
                <option data-countrycode="AE" value="971">United Arab Emirates (+971)</option>
                <option data-countrycode="UY" value="598">Uruguay (+598)</option>
                <option data-countrycode="US" value="1">USA (+1)</option>
                <option data-countrycode="UZ" value="7">Uzbekistan (+7)</option>
                <option data-countrycode="VU" value="678">Vanuatu (+678)</option>
                <option data-countrycode="VA" value="379">Vatican City (+379)</option>
                <option data-countrycode="VE" value="58">Venezuela (+58)</option>
                <option data-countrycode="VN" value="84">Vietnam (+84)</option>
                <option data-countrycode="VG" value="84">Virgin Islands - British (+1284)</option>
                <option data-countrycode="VI" value="84">Virgin Islands - US (+1340)</option>
                <option data-countrycode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                <option data-countrycode="YE" value="969">Yemen (North)(+969)</option>
                <option data-countrycode="YE" value="967">Yemen (South)(+967)</option>
                <option data-countrycode="ZM" value="260">Zambia (+260)</option>
                <option data-countrycode="ZW" value="263">Zimbabwe (+263)</option>
               </select><div class="trigger">Select Country</div><ul class="options"><li data-raw-value="Select Country" class="selected">Select Country</li><li data-raw-value="213">Algeria (+213)</li><li data-raw-value="376">Andorra (+376)</li><li data-raw-value="244">Angola (+244)</li><li data-raw-value="1264">Anguilla (+1264)</li><li data-raw-value="1268">Antigua &amp; Barbuda (+1268)</li><li data-raw-value="54">Argentina (+54)</li><li data-raw-value="374">Armenia (+374)</li><li data-raw-value="297">Aruba (+297)</li><li data-raw-value="61">Australia (+61)</li><li data-raw-value="43">Austria (+43)</li><li data-raw-value="994">Azerbaijan (+994)</li><li data-raw-value="1242">Bahamas (+1242)</li><li data-raw-value="973">Bahrain (+973)</li><li data-raw-value="880">Bangladesh (+880)</li><li data-raw-value="1246">Barbados (+1246)</li><li data-raw-value="375">Belarus (+375)</li><li data-raw-value="32">Belgium (+32)</li><li data-raw-value="501">Belize (+501)</li><li data-raw-value="229">Benin (+229)</li><li data-raw-value="1441">Bermuda (+1441)</li><li data-raw-value="975">Bhutan (+975)</li><li data-raw-value="591">Bolivia (+591)</li><li data-raw-value="387">Bosnia Herzegovina (+387)</li><li data-raw-value="267">Botswana (+267)</li><li data-raw-value="55">Brazil (+55)</li><li data-raw-value="673">Brunei (+673)</li><li data-raw-value="359">Bulgaria (+359)</li><li data-raw-value="226">Burkina Faso (+226)</li><li data-raw-value="257">Burundi (+257)</li><li data-raw-value="855">Cambodia (+855)</li><li data-raw-value="237">Cameroon (+237)</li><li data-raw-value="1">Canada (+1)</li><li data-raw-value="238">Cape Verde Islands (+238)</li><li data-raw-value="1345">Cayman Islands (+1345)</li><li data-raw-value="236">Central African Republic (+236)</li><li data-raw-value="56">Chile (+56)</li><li data-raw-value="86">China (+86)</li><li data-raw-value="57">Colombia (+57)</li><li data-raw-value="269">Comoros (+269)</li><li data-raw-value="242">Congo (+242)</li><li data-raw-value="682">Cook Islands (+682)</li><li data-raw-value="506">Costa Rica (+506)</li><li data-raw-value="385">Croatia (+385)</li><li data-raw-value="53">Cuba (+53)</li><li data-raw-value="90392">Cyprus North (+90392)</li><li data-raw-value="357">Cyprus South (+357)</li><li data-raw-value="42">Czech Republic (+42)</li><li data-raw-value="45">Denmark (+45)</li><li data-raw-value="253">Djibouti (+253)</li><li data-raw-value="1809">Dominica (+1809)</li><li data-raw-value="1809">Dominican Republic (+1809)</li><li data-raw-value="593">Ecuador (+593)</li><li data-raw-value="20">Egypt (+20)</li><li data-raw-value="503">El Salvador (+503)</li><li data-raw-value="240">Equatorial Guinea (+240)</li><li data-raw-value="291">Eritrea (+291)</li><li data-raw-value="372">Estonia (+372)</li><li data-raw-value="251">Ethiopia (+251)</li><li data-raw-value="500">Falkland Islands (+500)</li><li data-raw-value="298">Faroe Islands (+298)</li><li data-raw-value="679">Fiji (+679)</li><li data-raw-value="358">Finland (+358)</li><li data-raw-value="33">France (+33)</li><li data-raw-value="594">French Guiana (+594)</li><li data-raw-value="689">French Polynesia (+689)</li><li data-raw-value="241">Gabon (+241)</li><li data-raw-value="220">Gambia (+220)</li><li data-raw-value="7880">Georgia (+7880)</li><li data-raw-value="49">Germany (+49)</li><li data-raw-value="233">Ghana (+233)</li><li data-raw-value="350">Gibraltar (+350)</li><li data-raw-value="30">Greece (+30)</li><li data-raw-value="299">Greenland (+299)</li><li data-raw-value="1473">Grenada (+1473)</li><li data-raw-value="590">Guadeloupe (+590)</li><li data-raw-value="671">Guam (+671)</li><li data-raw-value="502">Guatemala (+502)</li><li data-raw-value="224">Guinea (+224)</li><li data-raw-value="245">Guinea - Bissau (+245)</li><li data-raw-value="592">Guyana (+592)</li><li data-raw-value="509">Haiti (+509)</li><li data-raw-value="504">Honduras (+504)</li><li data-raw-value="852">Hong Kong (+852)</li><li data-raw-value="36">Hungary (+36)</li><li data-raw-value="354">Iceland (+354)</li><li data-raw-value="91">India (+91)</li><li data-raw-value="62">Indonesia (+62)</li><li data-raw-value="98">Iran (+98)</li><li data-raw-value="964">Iraq (+964)</li><li data-raw-value="353">Ireland (+353)</li><li data-raw-value="972">Israel (+972)</li><li data-raw-value="39">Italy (+39)</li><li data-raw-value="1876">Jamaica (+1876)</li><li data-raw-value="81">Japan (+81)</li><li data-raw-value="962">Jordan (+962)</li><li data-raw-value="7">Kazakhstan (+7)</li><li data-raw-value="254">Kenya (+254)</li><li data-raw-value="686">Kiribati (+686)</li><li data-raw-value="850">Korea North (+850)</li><li data-raw-value="82">Korea South (+82)</li><li data-raw-value="965">Kuwait (+965)</li><li data-raw-value="996">Kyrgyzstan (+996)</li><li data-raw-value="856">Laos (+856)</li><li data-raw-value="371">Latvia (+371)</li><li data-raw-value="961">Lebanon (+961)</li><li data-raw-value="266">Lesotho (+266)</li><li data-raw-value="231">Liberia (+231)</li><li data-raw-value="218">Libya (+218)</li><li data-raw-value="417">Liechtenstein (+417)</li><li data-raw-value="370">Lithuania (+370)</li><li data-raw-value="352">Luxembourg (+352)</li><li data-raw-value="853">Macao (+853)</li><li data-raw-value="389">Macedonia (+389)</li><li data-raw-value="261">Madagascar (+261)</li><li data-raw-value="265">Malawi (+265)</li><li data-raw-value="60">Malaysia (+60)</li><li data-raw-value="960">Maldives (+960)</li><li data-raw-value="223">Mali (+223)</li><li data-raw-value="356">Malta (+356)</li><li data-raw-value="692">Marshall Islands (+692)</li><li data-raw-value="596">Martinique (+596)</li><li data-raw-value="222">Mauritania (+222)</li><li data-raw-value="269">Mayotte (+269)</li><li data-raw-value="52">Mexico (+52)</li><li data-raw-value="691">Micronesia (+691)</li><li data-raw-value="373">Moldova (+373)</li><li data-raw-value="377">Monaco (+377)</li><li data-raw-value="976">Mongolia (+976)</li><li data-raw-value="1664">Montserrat (+1664)</li><li data-raw-value="212">Morocco (+212)</li><li data-raw-value="258">Mozambique (+258)</li><li data-raw-value="95">Myanmar (+95)</li><li data-raw-value="264">Namibia (+264)</li><li data-raw-value="674">Nauru (+674)</li><li data-raw-value="977">Nepal (+977)</li><li data-raw-value="31">Netherlands (+31)</li><li data-raw-value="687">New Caledonia (+687)</li><li data-raw-value="64">New Zealand (+64)</li><li data-raw-value="505">Nicaragua (+505)</li><li data-raw-value="227">Niger (+227)</li><li data-raw-value="234">Nigeria (+234)</li><li data-raw-value="683">Niue (+683)</li><li data-raw-value="672">Norfolk Islands (+672)</li><li data-raw-value="670">Northern Marianas (+670)</li><li data-raw-value="47">Norway (+47)</li><li data-raw-value="968">Oman (+968)</li><li data-raw-value="680">Palau (+680)</li><li data-raw-value="507">Panama (+507)</li><li data-raw-value="675">Papua New Guinea (+675)</li><li data-raw-value="595">Paraguay (+595)</li><li data-raw-value="51">Peru (+51)</li><li data-raw-value="63">Philippines (+63)</li><li data-raw-value="48">Poland (+48)</li><li data-raw-value="351">Portugal (+351)</li><li data-raw-value="1787">Puerto Rico (+1787)</li><li data-raw-value="974">Qatar (+974)</li><li data-raw-value="262">Reunion (+262)</li><li data-raw-value="40">Romania (+40)</li><li data-raw-value="7">Russia (+7)</li><li data-raw-value="250">Rwanda (+250)</li><li data-raw-value="378">San Marino (+378)</li><li data-raw-value="239">Sao Tome &amp; Principe (+239)</li><li data-raw-value="966">Saudi Arabia (+966)</li><li data-raw-value="221">Senegal (+221)</li><li data-raw-value="381">Serbia (+381)</li><li data-raw-value="248">Seychelles (+248)</li><li data-raw-value="232">Sierra Leone (+232)</li><li data-raw-value="65">Singapore (+65)</li><li data-raw-value="421">Slovak Republic (+421)</li><li data-raw-value="386">Slovenia (+386)</li><li data-raw-value="677">Solomon Islands (+677)</li><li data-raw-value="252">Somalia (+252)</li><li data-raw-value="27">South Africa (+27)</li><li data-raw-value="34">Spain (+34)</li><li data-raw-value="94">Sri Lanka (+94)</li><li data-raw-value="290">St. Helena (+290)</li><li data-raw-value="1869">St. Kitts (+1869)</li><li data-raw-value="1758">St. Lucia (+1758)</li><li data-raw-value="249">Sudan (+249)</li><li data-raw-value="597">Suriname (+597)</li><li data-raw-value="268">Swaziland (+268)</li><li data-raw-value="46">Sweden (+46)</li><li data-raw-value="41">Switzerland (+41)</li><li data-raw-value="963">Syria (+963)</li><li data-raw-value="886">Taiwan (+886)</li><li data-raw-value="7">Tajikstan (+7)</li><li data-raw-value="66">Thailand (+66)</li><li data-raw-value="228">Togo (+228)</li><li data-raw-value="676">Tonga (+676)</li><li data-raw-value="1868">Trinidad &amp; Tobago (+1868)</li><li data-raw-value="216">Tunisia (+216)</li><li data-raw-value="90">Turkey (+90)</li><li data-raw-value="7">Turkmenistan (+7)</li><li data-raw-value="993">Turkmenistan (+993)</li><li data-raw-value="1649">Turks &amp; Caicos Islands (+1649)</li><li data-raw-value="688">Tuvalu (+688)</li><li data-raw-value="256">Uganda (+256)</li><li data-raw-value="44">UK (+44)</li><li data-raw-value="380">Ukraine (+380)</li><li data-raw-value="971">United Arab Emirates (+971)</li><li data-raw-value="598">Uruguay (+598)</li><li data-raw-value="1">USA (+1)</li><li data-raw-value="7">Uzbekistan (+7)</li><li data-raw-value="678">Vanuatu (+678)</li><li data-raw-value="379">Vatican City (+379)</li><li data-raw-value="58">Venezuela (+58)</li><li data-raw-value="84">Vietnam (+84)</li><li data-raw-value="84">Virgin Islands - British (+1284)</li><li data-raw-value="84">Virgin Islands - US (+1340)</li><li data-raw-value="681">Wallis &amp; Futuna (+681)</li><li data-raw-value="969">Yemen (North)(+969)</li><li data-raw-value="967">Yemen (South)(+967)</li><li data-raw-value="260">Zambia (+260)</li><li data-raw-value="263">Zimbabwe (+263)</li></ul></div>
            </div>
            
            <div class="checkout_form_input sity">
              <label>City <span class="color_red">*</span></label>
              <input type="text" name="user_city" value="<?php echo $users->user_city ; ?>" placeholder="">
            </div>
            
            <div class="checkout_form_input territory">
              <label>Province / Territory <span class="color_red">*</span></label>
              <input type="text" name="user_state" value="<?php echo $users->user_state; ?>" placeholder="">
            </div>
            
            <div class="checkout_form_input last postcode">
              <label>Postcode <span class="color_red">*</span></label>
              <input type="text" name="user_zip" value="<?php echo $users->user_zip ; ?>" placeholder="">
            </div>
            
            <div class="checkout_form_input2 adress">
              <label>Street Adress 1 <span class="color_red">*</span></label>
              <input type="text" name="address" value="<?php echo $users->address ; ?>" placeholder="">
            </div>
            
            <div class="checkout_form_input2 last adress">
              <label>Street Adress 2</label>
              <input type="text" name="address2" value="<?php echo $users->address2 ; ?>" placeholder="">
            </div>
            
            <hr class="clear">
             
            <div class="clear"></div>
            
            <div class="checkout_form_note">All fields marked with (<span class="color_red">*</span>) are required</div>
            <button type="submit" class="btn active pull-right address_details">Update</button>
          </form>
              </div>
              <div id="my_order" class="tabcontent">
                <h2>My Orders</h2>
                <hr class="clear">
             
            <div class="clear"></div>
                <table class="shop_table">
              <thead>
                <tr>
                  <th></th>
                  <th>Item</th>
                  <th>Price</th>
                  <th>Date</th>
                  <th>Action</th>
                  <th class="product-remove">Remove</th>
                </tr>
              </thead>
              <tbody>
                <tr class="cart_item">
                  <td><a href="#" ><img src="<?php echo base_url(); ?>frontend-assets/images/tovar/women/1.jpg" width="100px" alt="" /></a></td>
                  <td class="product-name">
                    <a href="#">Embroidered bib peasant top</a>
                  </td>
                  <td class="product-price"  >USD$ 88.00</td>
                  <td><strong>June 20, 2019</strong></td>
                  <td><strong><a href="#" style="display: inline-block; background: #000; color: #fff; width: 100px;  text-align: center; margin-top: 20px; font-size: 15px; padding: 5px 0px;">Add to Cart</a></strong>
                  </td>
                  <td class="product-remove"><a href="javascript:void(0);" style="background: #ffffff;" >  <i>X</i></a></td>
                </tr>
                <tr class="cart_item">
                  <td><a href="#" ><img src="<?php echo base_url(); ?>frontend-assets/images/tovar/women/1.jpg" width="100px" alt="" /></a></td>
                  <td class="product-name">
                    <a href="#">Embroidered bib peasant top</a>
                  </td>
                  <td class="product-price"  >USD$ 88.00</td>
                  <td><strong>June 20, 2019</strong></td>
                  <td><strong><a href="#" style="display: inline-block; background: #000; color: #fff; width: 100px;  text-align: center; margin-top: 20px; font-size: 15px; padding: 5px 0px;">Add to Cart</a></strong>
                  </td>
                  <td class="product-remove"><a href="javascript:void(0);" style="background: #ffffff;" >  <i>X</i></a></td>
                </tr>
                <tr class="cart_item">
                  <td><a href="#" ><img src="<?php echo base_url(); ?>frontend-assets/images/tovar/women/1.jpg" width="100px" alt="" /></a></td>
                  <td class="product-name">
                    <a href="#">Embroidered bib peasant top</a>
                  </td>
                  <td class="product-price"  >USD$ 88.00</td>
                  <td><strong>June 20, 2019</strong></td>
                  <td><strong><a href="#" style="display: inline-block; background: #000; color: #fff; width: 100px;  text-align: center; margin-top: 20px; font-size: 15px; padding: 5px 0px;">Add to Cart</a></strong>
                  </td>
                  <td class="product-remove"><a href="javascript:void(0);" style="background: #ffffff;" >  <i>X</i></a></td>
                </tr>
                <tr class="cart_item">
                  <td><a href="#" ><img src="<?php echo base_url(); ?>frontend-assets/images/tovar/women/1.jpg" width="100px" alt="" /></a></td>
                  <td class="product-name">
                    <a href="#">Embroidered bib peasant top</a>
                  </td>
                  <td class="product-price"  >USD$ 88.00</td>
                  <td><strong>June 20, 2019</strong></td>
                  <td><strong><a href="#" style="display: inline-block; background: #000; color: #fff; width: 100px;  text-align: center; margin-top: 20px; font-size: 15px; padding: 5px 0px;">Add to Cart</a></strong>
                  </td>
                  <td class="product-remove"><a href="javascript:void(0);" style="background: #ffffff;" >  <i>X</i></a></td>
                </tr>
                
              </tbody>
            </table>
              </div>
             </div>
              
					</div><!-- //CART TABLE -->
				 
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
		</section>
       <?php $this->load->view('inc/footer', $this->data); ?> 

       <script type="text/javascript">

            $(".my_details").click(function(e){
                e.preventDefault();
            $.ajax({
                          url:"<?php  echo site_url(); ?>users/update_user_details",
                          type:'post',
                          data:$( "#my_form_details" ).serialize(),
                           success:function(data){
                              
                           }
        }); });

   $(".address_details").click(function(e){
                e.preventDefault();
            $.ajax({
                          url:"<?php  echo site_url(); ?>users/update_address_details",
                          type:'post',
                          data:$( "#my_address_details" ).serialize(),
                           success:function(data){
                             
                           }
        }); });
       </script>
<style type="text/css">
  div#undefined-sticky-wrapper {
    position: inherit !important;
}
.is-sticky header {
    
    background: #fff;
}
/*tabs*/
.tab {
  float: left;
  border: 1px solid #ccc;
  border-right: 0px solid #ccc;
  background-color: #f1f1f1;
  width: 20%;
   
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: #f90881;
    color: #fff;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 80%;
   
   padding-top: 10px;
   padding-bottom: 10px;
}
.warapper_tabs{   width: 100%; float: left; }
.warapper_tabs .checkout_form_input2 {
    float: left;
    width: 100%;
    }
 .warapper_tabs .checkout_form_input {
    float: left;
    width: 49%;
    
    margin-right: 1%;
}
 .warapper_tabs h2{font-size: 20px;}
</style>
<!-- Demo --> 
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script> 
  