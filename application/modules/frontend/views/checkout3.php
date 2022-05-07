 <?php $this->load->view('inc/header', $this->data); ?>
    
  <section class="breadcrumb parallax margbot30"></section>
    <!-- //BREADCRUMBS -->
    
    
    <!-- PAGE HEADER -->
    <section class="page_header">
      
      <!-- CONTAINER -->
      <div class="container border0 margbot0">
        <h3 class="pull-left"><b>Checkout</b></h3>
        
        <div class="pull-right">
          <a href="<?php echo site_url('cart'); ?>" >Back shopping bag<i class="fa fa-angle-right"></i></a>
        </div>
      </div><!-- //CONTAINER -->
    </section><!-- //PAGE HEADER -->
    
    
    <!-- CHECKOUT PAGE -->
    <section class="checkout_page">
      
      <!-- CONTAINER -->
      <div class="container">

        <!-- CHECKOUT BLOCK -->
        <div class="checkout_block">
          <ul class="checkout_nav">
            <li class="done_step2">1. Shipping Address</li>
            <li class="done_step">2. Delivery</li>
            <li class="active_step">3. Payment</li>
            <li class="last">4. Confirm Orded</li>
          </ul>
          
          <div class="checkout_payment clearfix col-md-9 text-center">
            <div class="col-md-12">
              <p class="checkout_title">payment Method</p>
              
              <ul class="clearfix newcart">
                <li>
                  <input id="ridio1" type="radio" name="radio" hidden />
                  <label for="ridio1">Visa / Master Card<br><strong>8% Fee will apply</strong><br><img src="<?php echo base_url(); ?>frontend-assets/images/visa.jpg" alt="" /></label>
                </li>
                 
                <li>
                  <input id="ridio3" type="radio" name="radio" hidden />
                  <label for="ridio3">PayPal<br><strong>8% Fee will apply</strong><br><img src="<?php echo base_url(); ?>frontend-assets/images/paypal.jpg" alt="" /></label>
                </li>
                <li>
                  <input id="ridio4" type="radio" name="radio" hidden />
                  <label for="ridio4">Western Union<br><img src="<?php echo base_url(); ?>frontend-assets/images/western.png" alt="" width="120" /></label>
                </li>
                <li>
                  <input id="ridio2" type="radio" name="radio" hidden />
                  <label for="ridio2Automated webinar for the global business solutions directory
site">Bank Wire<br><img src="<?php echo base_url(); ?>frontend-assets/images/wb.png" alt="" width="120" /></label>
                </li>
                <li>
                  <input id="ridio5" type="radio" name="radio" hidden />
                  <label for="ridio5">Money Gram<br><img src="<?php echo base_url(); ?>frontend-assets/images/oks.png" alt="" width="120" /></label>
                </li>
              </ul>
            </div>
            
           <!--  <div class="col-md-6">
              <p class="checkout_title">Credit Card Number</p>
              
              <form class="credit_card_number_form clearfix" action="javascript:void(0);" method="get">
                  <input type="text" name="" placeholder="Name"    /><br>
                  <input type="text" name="" placeholder="Email"    /><br>
                <input type="text" name="" placeholder="Card Number"    />
                <div class="margrightminus20">
                  <select class="basic">
                    <option value="">MM</option>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                  </select>
                  <select class="basic last">
                    <option value="">YYYY</option>
                    <option>2010</option>
                    <option>2011</option>
                    <option>2012</option>
                    <option>2013</option>
                    <option>2014</option>
                  </select>
                  
                </div>
                <input type="text" name="" placeholder="CVV" style="width: 165px; ">
              </form>
            </div> -->
            
            <div class="clear"></div>
            
            <!-- <div class="checkout_delivery_note"><i class="fa fa-exclamation-circle"></i>Express delivery options are available for in-stock items only.</div> -->
            
            <a class="btn active pull-right checkout_block_btn" href="<?php echo site_url('checkout/step_four'); ?>" >Continue</a>
          </div>
          <div class="col-lg-3 col-md-3 padbot60">
            
            <!-- BAG TOTALS -->
            <div class="sidepanel widget_bag_totals your_order_block">
              <h3>Your Order</h3>
              <table class="bag_total">
                <tr class="cart-subtotal clearfix">
                  <th>Sub total</th>
                  <td><?php echo $currency ; ?> <?php echo $curr_symbol[$currency] ; ?> <?php echo $this->frontend_m->convert($this->cart->total()); ?></td>
                </tr>
                <tr class="shipping clearfix">
                  <th>SHIPPING</th>
                  <td><span id="cart_shipping_cal_value"> <?php echo $shipping_charge['shipping_charge']; ?></span>
                                      <a href="javascript:void(0);" id="shipping_cal12" style="font-size: 10px;display: block;">Calculate Shipping</a></td>
                </tr>
                <tr id="shipping_form" class="shipping clearfix" style="display: none;">
                  <td colspan="2">
                     <form id="cart_shipping_cal"  action="#">
                      <div class="form-group col-md-12">
                        <label for="email">Select Country</label>
                         <select  name="country" class="form-control">
                           <option value="AFG">Afghanistan</option>
                        <option value="ALA">Åland Islands</option>
                        <option value="ALB">Albania</option>
                        <option value="DZA">Algeria</option>
                        <option value="ASM">American Samoa</option>
                        <option value="AND">Andorra</option>
                        <option value="AGO">Angola</option>
                        <option value="AIA">Anguilla</option>
                        <option value="ATA">Antarctica</option>
                        <option value="ATG">Antigua and Barbuda</option>
                        <option value="ARG">Argentina</option>
                        <option value="ARM">Armenia</option>
                        <option value="ABW">Aruba</option>
                        <option value="AUS">Australia</option>
                        <option value="AUT">Austria</option>
                        <option value="AZE">Azerbaijan</option>
                        <option value="BHS">Bahamas</option>
                        <option value="BHR">Bahrain</option>
                        <option value="BGD">Bangladesh</option>
                        <option value="BRB">Barbados</option>
                        <option value="BLR">Belarus</option>
                        <option value="BEL">Belgium</option>
                        <option value="BLZ">Belize</option>
                        <option value="BEN">Benin</option>
                        <option value="BMU">Bermuda</option>
                        <option value="BTN">Bhutan</option>
                        <option value="BOL">Bolivia, Plurinational State of</option>
                        <option value="BES">Bonaire, Sint Eustatius and Saba</option>
                        <option value="BIH">Bosnia and Herzegovina</option>
                        <option value="BWA">Botswana</option>
                        <option value="BVT">Bouvet Island</option>
                        <option value="BRA">Brazil</option>
                        <option value="IOT">British Indian Ocean Territory</option>
                        <option value="BRN">Brunei Darussalam</option>
                        <option value="BGR">Bulgaria</option>
                        <option value="BFA">Burkina Faso</option>
                        <option value="BDI">Burundi</option>
                        <option value="KHM">Cambodia</option>
                        <option value="CMR">Cameroon</option>
                        <option value="CAN">Canada</option>
                        <option value="CPV">Cape Verde</option>
                        <option value="CYM">Cayman Islands</option>
                        <option value="CAF">Central African Republic</option>
                        <option value="TCD">Chad</option>
                        <option value="CHL">Chile</option>
                        <option value="CHN">China</option>
                        <option value="CXR">Christmas Island</option>
                        <option value="CCK">Cocos (Keeling) Islands</option>
                        <option value="COL">Colombia</option>
                        <option value="COM">Comoros</option>
                        <option value="COG">Congo</option>
                        <option value="COD">Congo, the Democratic Republic of the</option>
                        <option value="COK">Cook Islands</option>
                        <option value="CRI">Costa Rica</option>
                        <option value="CIV">Côte d'Ivoire</option>
                        <option value="HRV">Croatia</option>
                        <option value="CUB">Cuba</option>
                        <option value="CUW">Curaçao</option>
                        <option value="CYP">Cyprus</option>
                        <option value="CZE">Czech Republic</option>
                        <option value="DNK">Denmark</option>
                        <option value="DJI">Djibouti</option>
                        <option value="DMA">Dominica</option>
                        <option value="DOM">Dominican Republic</option>
                        <option value="ECU">Ecuador</option>
                        <option value="EGY">Egypt</option>
                        <option value="SLV">El Salvador</option>
                        <option value="GNQ">Equatorial Guinea</option>
                        <option value="ERI">Eritrea</option>
                        <option value="EST">Estonia</option>
                        <option value="ETH">Ethiopia</option>
                        <option value="FLK">Falkland Islands (Malvinas)</option>
                        <option value="FRO">Faroe Islands</option>
                        <option value="FJI">Fiji</option>
                        <option value="FIN">Finland</option>
                        <option value="FRA">France</option>
                        <option value="GUF">French Guiana</option>
                        <option value="PYF">French Polynesia</option>
                        <option value="ATF">French Southern Territories</option>
                        <option value="GAB">Gabon</option>
                        <option value="GMB">Gambia</option>
                        <option value="GEO">Georgia</option>
                        <option value="DEU">Germany</option>
                        <option value="GHA">Ghana</option>
                        <option value="GIB">Gibraltar</option>
                        <option value="GRC">Greece</option>
                        <option value="GRL">Greenland</option>
                        <option value="GRD">Grenada</option>
                        <option value="GLP">Guadeloupe</option>
                        <option value="GUM">Guam</option>
                        <option value="GTM">Guatemala</option>
                        <option value="GGY">Guernsey</option>
                        <option value="GIN">Guinea</option>
                        <option value="GNB">Guinea-Bissau</option>
                        <option value="GUY">Guyana</option>
                        <option value="HTI">Haiti</option>
                        <option value="HMD">Heard Island and McDonald Islands</option>
                        <option value="VAT">Holy See (Vatican City State)</option>
                        <option value="HND">Honduras</option>
                        <option value="HKG">Hong Kong</option>
                        <option value="HUN">Hungary</option>
                        <option value="ISL">Iceland</option>
                        <option value="IND">India</option>
                        <option value="IDN">Indonesia</option>
                        <option value="IRN">Iran, Islamic Republic of</option>
                        <option value="IRQ">Iraq</option>
                        <option value="IRL">Ireland</option>
                        <option value="IMN">Isle of Man</option>
                        <option value="ISR">Israel</option>
                        <option value="ITA">Italy</option>
                        <option value="JAM">Jamaica</option>
                        <option value="JPN">Japan</option>
                        <option value="JEY">Jersey</option>
                        <option value="JOR">Jordan</option>
                        <option value="KAZ">Kazakhstan</option>
                        <option value="KEN">Kenya</option>
                        <option value="KIR">Kiribati</option>
                        <option value="PRK">Korea, Democratic People's Republic of</option>
                        <option value="KOR">Korea, Republic of</option>
                        <option value="KWT">Kuwait</option>
                        <option value="KGZ">Kyrgyzstan</option>
                        <option value="LAO">Lao People's Democratic Republic</option>
                        <option value="LVA">Latvia</option>
                        <option value="LBN">Lebanon</option>
                        <option value="LSO">Lesotho</option>
                        <option value="LBR">Liberia</option>
                        <option value="LBY">Libya</option>
                        <option value="LIE">Liechtenstein</option>
                        <option value="LTU">Lithuania</option>
                        <option value="LUX">Luxembourg</option>
                        <option value="MAC">Macao</option>
                        <option value="MKD">Macedonia, the former Yugoslav Republic of</option>
                        <option value="MDG">Madagascar</option>
                        <option value="MWI">Malawi</option>
                        <option value="MYS">Malaysia</option>
                        <option value="MDV">Maldives</option>
                        <option value="MLI">Mali</option>
                        <option value="MLT">Malta</option>
                        <option value="MHL">Marshall Islands</option>
                        <option value="MTQ">Martinique</option>
                        <option value="MRT">Mauritania</option>
                        <option value="MUS">Mauritius</option>
                        <option value="MYT">Mayotte</option>
                        <option value="MEX">Mexico</option>
                        <option value="FSM">Micronesia, Federated States of</option>
                        <option value="MDA">Moldova, Republic of</option>
                        <option value="MCO">Monaco</option>
                        <option value="MNG">Mongolia</option>
                        <option value="MNE">Montenegro</option>
                        <option value="MSR">Montserrat</option>
                        <option value="MAR">Morocco</option>
                        <option value="MOZ">Mozambique</option>
                        <option value="MMR">Myanmar</option>
                        <option value="NAM">Namibia</option>
                        <option value="NRU">Nauru</option>
                        <option value="NPL">Nepal</option>
                        <option value="NLD">Netherlands</option>
                        <option value="NCL">New Caledonia</option>
                        <option value="NZL">New Zealand</option>
                        <option value="NIC">Nicaragua</option>
                        <option value="NER">Niger</option>
                        <option value="NGA">Nigeria</option>
                        <option value="NIU">Niue</option>
                        <option value="NFK">Norfolk Island</option>
                        <option value="MNP">Northern Mariana Islands</option>
                        <option value="NOR">Norway</option>
                        <option value="OMN">Oman</option>
                        <option value="PAK">Pakistan</option>
                        <option value="PLW">Palau</option>
                        <option value="PSE">Palestinian Territory, Occupied</option>
                        <option value="PAN">Panama</option>
                        <option value="PNG">Papua New Guinea</option>
                        <option value="PRY">Paraguay</option>
                        <option value="PER">Peru</option>
                        <option value="PHL">Philippines</option>
                        <option value="PCN">Pitcairn</option>
                        <option value="POL">Poland</option>
                        <option value="PRT">Portugal</option>
                        <option value="PRI">Puerto Rico</option>
                        <option value="QAT">Qatar</option>
                        <option value="REU">Réunion</option>
                        <option value="ROU">Romania</option>
                        <option value="RUS">Russian Federation</option>
                        <option value="RWA">Rwanda</option>
                        <option value="BLM">Saint Barthélemy</option>
                        <option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
                        <option value="KNA">Saint Kitts and Nevis</option>
                        <option value="LCA">Saint Lucia</option>
                        <option value="MAF">Saint Martin (French part)</option>
                        <option value="SPM">Saint Pierre and Miquelon</option>
                        <option value="VCT">Saint Vincent and the Grenadines</option>
                        <option value="WSM">Samoa</option>
                        <option value="SMR">San Marino</option>
                        <option value="STP">Sao Tome and Principe</option>
                        <option value="SAU">Saudi Arabia</option>
                        <option value="SEN">Senegal</option>
                        <option value="SRB">Serbia</option>
                        <option value="SYC">Seychelles</option>
                        <option value="SLE">Sierra Leone</option>
                        <option value="SGP">Singapore</option>
                        <option value="SXM">Sint Maarten (Dutch part)</option>
                        <option value="SVK">Slovakia</option>
                        <option value="SVN">Slovenia</option>
                        <option value="SLB">Solomon Islands</option>
                        <option value="SOM">Somalia</option>
                        <option value="ZAF">South Africa</option>
                        <option value="SGS">South Georgia and the South Sandwich Islands</option>
                        <option value="SSD">South Sudan</option>
                        <option value="ESP">Spain</option>
                        <option value="LKA">Sri Lanka</option>
                        <option value="SDN">Sudan</option>
                        <option value="SUR">Suriname</option>
                        <option value="SJM">Svalbard and Jan Mayen</option>
                        <option value="SWZ">Swaziland</option>
                        <option value="SWE">Sweden</option>
                        <option value="CHE">Switzerland</option>
                        <option value="SYR">Syrian Arab Republic</option>
                        <option value="TWN">Taiwan, Province of China</option>
                        <option value="TJK">Tajikistan</option>
                        <option value="TZA">Tanzania, United Republic of</option>
                        <option value="THA">Thailand</option>
                        <option value="TLS">Timor-Leste</option>
                        <option value="TGO">Togo</option>
                        <option value="TKL">Tokelau</option>
                        <option value="TON">Tonga</option>
                        <option value="TTO">Trinidad and Tobago</option>
                        <option value="TUN">Tunisia</option>
                        <option value="TUR">Turkey</option>
                        <option value="TKM">Turkmenistan</option>
                        <option value="TCA">Turks and Caicos Islands</option>
                        <option value="TUV">Tuvalu</option>
                        <option value="UGA">Uganda</option>
                        <option value="UKR">Ukraine</option>
                        <option value="ARE">United Arab Emirates</option>
                        <option value="GBR">United Kingdom</option>
                        <option value="USA">United States</option>
                        <option value="UMI">United States Minor Outlying Islands</option>
                        <option value="URY">Uruguay</option>
                        <option value="UZB">Uzbekistan</option>
                        <option value="VUT">Vanuatu</option>
                        <option value="VEN">Venezuela, Bolivarian Republic of</option>
                        <option value="VNM">Viet Nam</option>
                        <option value="VGB">Virgin Islands, British</option>
                        <option value="VIR">Virgin Islands, U.S.</option>
                        <option value="WLF">Wallis and Futuna</option>
                        <option value="ESH">Western Sahara</option>
                        <option value="YEM">Yemen</option>
                        <option value="ZMB">Zambia</option>
                        <option value="ZWE">Zimbabwe</option>
                         </select>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="pwd">Select Shipping Method</label>
      
                        <select name="shipping_method" class="form-control">                       
                        <option value="Express Shipping DHL">Express Shipping DHL</option>
                         <option value="Express Shipping Fedex">Express Shipping Fedex</option>
                         <option value="Duty Free Cargo">Duty Free Cargo</option>
                         <option vlaue="Dubai Postal Fast">Dubai Postal Fast</option>   
                         <option value="Dubai Postal">Dubai Postal</option>                    
                      </select>
                      </div>
                      
                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-default" style="padding: 5px 10px ; width: 123px; float: right;">Calculate</button>
                      </div>
                    </form>
                  </td>
                </tr>
                <!-- <tr class="shipping clearfix">
                  <th>Coupon Discount</th>
                  <td>NA</td>
                </tr> -->
                <tr class="total clearfix">
                  <th>Total</th>
                  <td id="total_cart_amount"> <?php echo $shipping_charge['total_cart_price']; ?></td>
                </tr>
              </table>
              <a class="btn active" href="<?php echo site_url('checkout/step_four'); ?>" >continue</a>
              <a class="btn inactive" href="<?php echo site_url('checkout/step_two'); ?>" >Go to previous step</a>
              <a class="btn active" href="javascript:void(0);" >Save order</a>
            </div><!-- //REGISTRATION FORM -->
          </div><!-- //SIDEBAR -->
        </div><!-- //CHECKOUT BLOCK -->
      </div><!-- //CONTAINER -->
    </section><!-- //CHECKOUT PAGE --> 
  <?php $this->load->view('inc/footer', $this->data); ?> 
  <style type="text/css">
  div#undefined-sticky-wrapper {
    position: inherit !important;
}
.is-sticky header {
    
    background: #fff;
}
.checkout_delivery li {
   
    width: 100%;
}
.checkout_confirm_orded_products {
    
    margin-left: 0px;
}
</style>
 <script>
$(document).ready(function(){
  $("#shipping_cal12").click(function(){
     $("#shipping_form").toggle('slow');
  });
$("form#cart_shipping_cal").submit(function(e){
             e.preventDefault();
        $.ajax({
          url:"<?php echo site_url(); ?>calculate_shipping_in_cart",
          type:'post',
          data: $(this).serialize(),
           success:function(data){
            var obj = $.parseJSON(data);
             $('#cart_shipping_cal_value').empty();
             $('#cart_shipping_cal_value').html(obj.shipping_charge);
             $('#total_cart_amount').empty();
             $('#total_cart_amount').html(obj.total_cart_price);

           }         

        })
          });
$('select[name="country"]').val("<?php echo $this->session->userdata('shipping_country'); ?>");
$('select[name="shipping_method"]').val("<?php echo $this->session->userdata('shipping_method'); ?>");
     });
</script>
