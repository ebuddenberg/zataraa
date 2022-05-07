<?php $this->load->view('inc/header'); ?>

<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li>Checkout</li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-checkout ps-section--shopping">
    <div class="container">
        <!-- <div class="ps-section__header">
            <h1>Checkout</h1>
        </div> -->
        <div class="ps-section__content">
            <form class="ps-form--checkout" action="<?php echo site_url('checkout/process'); ?>" method="post">
                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12  ">
                        <div class="ps-form__billing-info">
                            
                            <h3 class="ps-form__heading">Billing Details</h3>
                            <div class="form-group">
                                <label>First Name<sup>*</sup>
                                </label>
                                <div class="form-group__content">
                                    <input name="first_name" value="<?php echo $users->first_name ; ?>" class="form-control" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Last Name<sup>*</sup>
                                </label>
                                <div class="form-group__content">
                                    <input name="last_name" value="<?php echo $users->last_name ; ?>" required class="form-control" type="text">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Email Address<sup>*</sup>
                                </label>
                                <div class="form-group__content">
                                    <input class="form-control" name="email" value="<?php echo $users->email; ?>" required  type="email">
                                </div>
                            </div>
                                                   


                            <div class="form-group">
                                <label>Phone<sup>*</sup>
                                </label>
                                <div class="form-group__content">
                                    <input required class="form-control" name="user_phone" value="<?php echo $users->phone_no ; ?>" type="text">
                                </div>
                            </div>
                                                      <div class="setting-content personal-data">
                            <h4>Country</h4>
                            <div class="block-content">
                            
                                    <div class="form-group">
                                        <div class="form-group__content">
<?php 

$countrys = array();
if(isset($users->country)){
    $c = $users->country;
}else{
     $c = '';
}
foreach ($country as $data) {
    # code...
    $countrys[$data->id] = $data->name ; 
}
$countrys[''] = 'Select Country';
$js = 'class="pcategories country"';
echo form_dropdown('country', $countrys,$c, $js);
 ?>
                       
                                        
                                        </div>
                                    </div>
                                 
                           
                            </div>
                        </div>
                         <div class="setting-content personal-data">
                            <h4>State</h4>
                            <div class="block-content">
                            
                                    <div class="form-group">
                                        <div class="form-group__content">

                                            <?php 

$states = array();
if(isset($users->state)){
    $s = $users->state;
}else{
     $s = '';
}
foreach ($state as $data) {
    # code...
    $states[$data->id] = $data->name ; 
}
$js = 'class="pcategories pmcat"';
echo form_dropdown('state', $states,$s, $js);
 ?>
                                        </div>
                                    </div>
                                 
                           
                            </div>
                        </div>
                         <div class="setting-content personal-data">
                            <h4>City</h4>
                            <div class="block-content">
                            
                                    <div class="form-group">
                                        <div class="form-group__content">

                                            <?php 

$citys = array();
if(isset($users->city)){
    $ci = $users->city;
}else{
     $ci = '';
}
foreach ($city as $data) {
    # code...
    $citys[$data->id] = $data->name ; 
}
$js = 'class="pcategories city"';
echo form_dropdown('city', $citys, $ci, $js);
 ?>
                                        
                                        </div>
                                    </div>
                                 
                           
                            </div>
                        </div>
                            <div class="form-group">
                                <label>Address Line one<sup>*</sup>
                                </label>
                                <div class="form-group__content">
                                    <input required class="form-control" name="address_line_1" value="<?php echo $users->address_one ; ?>" type="text">
                                </div>
                            </div>
                           <div class="form-group">
                                <label>Address Line two<sup>*</sup>
                                </label>
                                <div class="form-group__content">
                                    <input required class="form-control" name="address_line_2" value="<?php echo $users->address_two ; ?>" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Zip<sup>*</sup>
                                </label>
                                <div class="form-group__content">
                                    <input required class="form-control" name="zip" value="<?php echo $users->zip ; ?>" type="text">
                                </div>
                            </div>
                            <h3 class="mt-40"> Addition information</h3>
                            <div class="form-group">
                                <label>Order Notes</label>
                                <div class="form-group__content">
                                    <textarea name="add_info" class="form-control" rows="7" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
<!--<h3 class="mt-40"> Payment Methods</h3>-->
<!--                            <div class="form-group">-->
<!--                                 <div class="radio">-->
<!--  <label class="container-custom-style">Cash on Delivery-->
<!--  <input type="radio" checked="checked" name="payment_method" value="cod" >-->
<!--  <span class="checkmark"></span>-->
<!--</label>-->

<!-- <label class="container-custom-style">Pay with Credit card-->
<!--  <input type="radio" checked="checked" name="payment_method" value="tap_pay" >-->
<!--  <span class="checkmark"></span>-->
<!--</label>-->

<!-- <label class="container-custom-style">Pay With Paypal-->
<!--  <input type="radio" checked="checked" name="payment_method" value="paypal" >-->
<!--  <span class="checkmark"></span>-->
<!--</label>-->
<!--   <label><input type="radio" checked="" name="payment_method" ></label> -->
<!--</div>-->
<!--                            </div>-->
                       
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12  ">
                        <div class="ps-form__total">
                            <h3 class="ps-form__heading">Your Order</h3>
                            <div class="content">
                                <div class="ps-block--checkout-total">
                                    
                                    <div class="ps-block__content">
                                        <table class="table ps-block__products">
                                            <tbody>
                                                <?php $i = 1; 
 foreach ($this->cart->contents() as $item){ 

    ?>
                                            <tr>
                                                <td><a href="#"> <?php echo $item['name']; ?> × <?php echo $item["qty"]; ?></a>
                                                
                                                </td>
                                                <td><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php echo $this->frontend_m->convert($item["subtotal"]) ; ?></td>
                                            </tr>
<?php  } ?>
                                            
                                            </tbody>
                                        </table>
                                        <h4 class="ps-block__title">Subtotal <span><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php echo  $this->frontend_m->convert($this->cart->total()); ?></span></h4>
                                        <div class="ps-block__shippings">
                                          <!--  <select required="" name="shippings_meth" class="shippings_meth">
                                                <?/*php 
$pc = 0;
$i = 0;
                                                 foreach ($shipping_method as $key => $value) { 
                                                    if($i == 0 ){
                                                         $pc = $this->frontend_m->convert($value['price']);
                                                    }
                                                   
                                                 ?>
 <option value="<?php echo $key; ?>" data-id="<?php echo $this->frontend_m->convert($value['price']); ?>" <?php
if($key == 'ExpressShipping'){
    echo 'Expedited Insured';
}
if($key == 'RegisteredShipping'){

    echo 'Standard Shipping';

}if($key == 'DHL'){

    echo 'DHL';

}
   ?>> 


 <?php echo $this->frontend_m->convert($value['price']) ; ?></option>
                                                    <?php
                                               $i++; 
                                                } */?>
                                               
                                                
                                            </select>-->
                                            <select required="" name="shippings_meth" class="shippings_meth">
                                                <?php 
                                                    $pc = 0;
                                                    $i = 0;
                                                 foreach ($shipping_method as $key => $value) { 
                                                    if($i == 0 ){
                                                         $pc = $this->frontend_m->convert($value['price']);
                                                    }
                                                   
                                                 ?>
 <option value="<?php echo $key; ?>" data-id="<?php echo $this->frontend_m->convert($value['price']); ?>"> <?php echo $this->frontend_m->convert($value['price']) ; ?></option>
                                                    <?php
                                               $i++; 
                                                } ?>
                                               
                                                
                                            </select>
                                            <figure>
                                              <input type="hidden" name="shipping_method" class="shippings_meths" value ="<?php echo $pc ; ?>"> 
                                                <p>Shipping price : <span class="shipping_price"><?php echo $pc ; ?></span></p>
                                            </figure>
                                        </div>
                                        <h3>Total <span><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <span class="total_amt"><?php echo  $this->frontend_m->convert($this->cart->total())+$pc; ?></span></span></h3>
                                        <h3 class="mt-40"> Payment Methods</h3>
                            <div class="form-group">
                                 <div class="radio">
<!--  <label class="container-custom-style">Cash on Delivery-->
<!--  <input type="radio" checked="checked" name="payment_method" value="cod" >-->
<!--  <span class="checkmark"></span>-->
<!--</label>-->

 <label class="container-custom-style">Pay with Credit card
  <input type="radio" checked="checked" name="payment_method" value="tap_pay" >
  <span class="checkmark"></span>
</label>

 <label class="container-custom-style">Pay With Paypal
  <input type="radio" checked="checked" name="payment_method" value="paypal" >
  <span class="checkmark"></span>
</label>
<!--   <label><input type="radio" checked="" name="payment_method" ></label> -->
</div>
                            </div>
 
 <?php if($exis_users->balance != 0){?>
<h3 class="mt-40">User Balance</h3>                                    
<div class="form-group">
<div class="radio">
 <label class="container-custom-style">Balance
  <input type="checkbox"  name="balance" value="<?php echo $exis_users->balance?>" >
  <span class="checkmark"></span>
</label>
</div>
</div>
<?php } ?>
                                <div class="form-group">
                                <label>Promo Code<sup></sup>
                                </label>
                                <div class="form-group__content">
                                    <input type="hidden" name="amount_data" id="amount_data" value="<?php echo  $this->frontend_m->convert($this->cart->total())+$pc; ?>">
                                    <input type="hidden" name="promo_price" id="promo_price" value="">
                                    <input type="hidden" name="promo_code_id" id="promo_code_id" value="">
                                    <input  class="form-control" name="promo_code" id="promo_code" value="" type="text">
                                </div>
                            </div>
                            
                            <div class="form-group">
                            <?php if($exis_users->gift_id && $getUserGift){?>
                                 <label>Gift option (Gifts will be shipped free for you along with this order.)<sup></sup>
                                </label>
                            <?php foreach($getUserGift as $gift){
                                        $p_name =$gift[0]['product_name'] ;
                                        $slugs = str_replace(" & ", '----', $p_name);
                                        $slugs = str_replace(', ', '--', $slugs);
                                        $slugs = str_replace("'", '---', $slugs); 
                                        $slugs = str_replace(" ", '_', $slugs);
                            ?>
                             
                               
                                <label><a href="<?php echo site_url('products/'.$slugs.'');  ?>"><?php echo $gift[0]['product_name']; ?></a></label>
                                <?php }?>
                                <div class="form-group__content">
                                    <input type="hidden" name="gift_card" id="gift_card" value="<?php echo $exis_users->gift_id?>">
                                </div>
                            </div>
                            <?php }?>
                                     
                                        
                                    </div>
                                </div>
                                <button type="submit" class="ps-btn ps-btn--fullwidth  place_order">Place order</button>
                            </div>
                        </div>

                        <div style ="margin-top:20px;">

                            <h5 class="text-center">Shipping method T&C </h5>
                            <?php echo $get_shipping_method_page_content->content; ?>
                            
<!--                            <table class="table table-striped table-bordered">-->
<!--                                <thead>-->
<!--                                    <tr>-->
<!--                                        <th>Shipping Method</th>-->
<!--                                        <th>-->
<!--                                            Estimated Shipping Time-->
<!--                                        </th>-->
<!--                                        <th>Tracking Number Provided</th>-->
<!--                                    </tr>-->
<!--                                </thead>-->
<!--                                <tbody>-->
<!--                                    <tr>-->
<!--                                        <td>Express Shipping</td>-->
<!--                                        <td>7 – 15 Days</td>-->
<!--                                        <td>yes</td>-->
<!--                                    </tr>-->
<!--                                     <tr>-->
<!--                                        <td>Registered Shipping</td>-->
<!--                                        <td>10 – 20 Days</td>-->
<!--                                        <td>Yes-->

<!--</td>-->
<!--                                    </tr>-->
<!--                                     <tr>-->
<!--                                        <td>DHL</td>-->
<!--                                        <td>4 – 7 Days</td>-->
<!--                                        <td>yes</td>-->
<!--                                    </tr>-->
<!--                                </tbody>-->
<!--                            </table>-->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('inc/footer'); ?>
<script type="text/javascript">
$( ".country" ).change(function() {

  var id  = this.value ;
       $.ajax(
        {  
            type:'POST',
            url:'<?php echo site_url('get_state'); ?>',
            data:
            {
                id:id,
            },
            success:function(data)
            {
            $('select.pmcat').empty();
            $('select.pmcat').append(data);
            $(".pmcat").val('').trigger("chosen:updated");
            }
        });

          $.ajax(
        {  
            type:'POST',
            url:'<?php echo site_url('checkout/set_country'); ?>',
            data:
            {
                id:id,
            },
            success:function(data)
            {
           
            }
        });

          $.ajax(
        {  
            type:'POST',
            url:'<?php echo site_url('checkout/update_shipping_method'); ?>',
            data:
            {
                id:id,
            },
            success:function(data)
            {
            $('.shippings_meth').html('');
            $('.shippings_meth').html(data);
               var data = $('.shippings_meth').find(':selected').attr('data-id');
 $('.shipping_price').html(data);
$('.shippings_meths').val(data);
 var value = $('.shippings_meth').find(':selected').attr('data-id');

 $.ajax(
        {  
            type:'POST',
            url:'<?php echo site_url('checkout/get_total_checkout_price') ; ?>',
            data:
            {
                shipping_method:value,
            },
            success:function(data)
            {
               $('.total_amt').html(data);
            }
        });
            }
        });
}); 


$( ".pmcat" ).change(function() {
  var id  = this.value ;
       $.ajax(
        {  
            type:'POST',
            url:'<?php echo site_url('get_city'); ?>',
            data:
            {
                id:id,
            },
            success:function(data)
            {
                $('select.city').empty();
                $('select.city').append(data);
                $(".city").val('').trigger("chosen:updated");
            }
        });
}); 

$(".shippings_meth").change(function(){
   var data = $(this).find(':selected').attr('data-id');
 $('.shipping_price').html(data);
$('.shippings_meths').val(data);
 var value = $(this).find(':selected').attr('data-id');

 $.ajax(
        {  
            type:'POST',
            url:'<?php echo site_url('checkout/get_total_checkout_price') ; ?>',
            data:
            {
                shipping_method:value,
            },
            success:function(data)
            {
               $('.total_amt').html(data);
            }
        });

});


    $("#promo_code").change(function(){
        var promoCode = $(this).val();
        var amount = $("#amount_data").val();
        $.ajax(
        {  
            type:'POST',
             dataType : 'json',
            url:'<?php echo site_url('checkout/check_promo_code') ; ?>',
            data:
            {
                promoCode:promoCode,
                amount:amount,
            },
            success:function(data)
            {
                if (data.status=='true')
                {   
                    $('input[name=promo_price]').val(data.amount);
                    $('input[name=promo_code_id]').val(data.promo_id);
                    alert(data.message);
                }else{
                    $('input[name=promo_price]').val("");
                    $('input[name=promo_code_id]').val("");
                    alert(data.message);
                }
            }
        });
        });


</script>