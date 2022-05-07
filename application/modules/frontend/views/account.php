<?php  $this->load->view('inc/header'); ?>
<!--- Account-Wrapper --->
<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li><?php echo $title ; ?></li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->
<div class="col-md-12"><div class="text-center w-75 m-auto">
                                   
                             
<?php if($this->session->flashdata('error') ||  validation_errors()){ ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                           <span aria-hidden="true">×</span>
                                       </button>
                                       <?php echo $this->session->flashdata('error'); ?>

                    <?php echo validation_errors(); ?> 
                                   </div>

<?php } ?>
<?php if($this->session->flashdata('success')){ ?>  
                                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                           <span aria-hidden="true">×</span>
                                       </button>
                                      <?php echo $this->session->flashdata('success'); ?>
                                   </div>
 <?php } ?>    

                                </div></div>
<div class="ps-contact-info">
    <div class="container">
<div class="account-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-order" role="tab" aria-controls="v-pills-order" aria-selected="true">Orders</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                    <a class="nav-link" id="v-pills-address-tab" data-toggle="pill" href="#v-pills-address" role="tab" aria-controls="v-pills-profile" aria-selected="false">Address</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                    <a class="nav-link" id="v-pills-balance-tab" data-toggle="pill" href="#v-pills-balance" role="tab" aria-controls="v-pills-balance" aria-selected="false">Balance</a>
                    <a class="nav-link" id="v-pills-gift-tab" data-toggle="pill" href="#v-pills-gift" role="tab" aria-controls="v-pills-gift" aria-selected="false">Gift</a>
                    <a class="nav-link"  href="<?php echo site_url('users/logout'); ?>">Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab">
                        <h3>my orders</h3>
                        <div class="order-table">
                            <div class="table table-responsive">
                                <table class="table">
                                    <thead>
                                       <tr>
                                           <th>Product</th>
                                           <th>Description</th>
                                           <th>Order ID</th>
                                           <th>Price</th>
                                           <th>Quantity</th>
                            
                                           <th>Status</th>
                                           <th>Order On</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        foreach ($orders as $data) {             $qty =0 ;
                                       ?>
                                        <tr> <td colspan="7" style="
    background: aliceblue;" class="text-center">Order Id : Z37<?php echo str_pad($data->id, 8, '0', STR_PAD_LEFT); ?></td></tr>
                                        <?php 

                                        $ps = json_decode($data->product_orderd);
                                        foreach ($ps as $ps_data) {
                                            if(isset( $variation[$ps_data])){
                                            $v_data = $variation[$ps_data];
                                         ?>
                                        <tr>
                                            <td><img src="<?php echo base_url('admin-assets/images/'.$v_data->image.''); ?>" alt=""> </td>
                                            <td>
                                                <h5><?php echo $v_data->product_name; ?></h5>
                                                <p>VARIATION : <span><?php echo $v_data->commodityDifferenceOption  ; ?></span></p>


                                                <p>SKU : ZAT37<span><?php echo substr($v_data->sku,5) ; ?></span></p>
                                                
                                            </td>
                                            <td>Z37<?php echo str_pad($data->id, 8, '0', STR_PAD_LEFT); ?></td>
                                            <td><?php echo $currency ; ?> <?php echo $curr_symbol[$currency];?><?php 
                                            echo  $this->frontend_m->convert(round(($v_data->price+$v_data->price*(int)$v_data->comission/100) - ($v_data->price*(int)$v_data->comission/100)*(int)$v_data->product_offer/100,2));
                                              ?></td>
                                            
                                              <td>

                                              <?php 

$quantity  = json_decode($data->quantity);
$sku = $v_data->sku;
echo $quantity->$sku;
$qty += $quantity->$sku;


                                               ?> </td>
                                            <td>
                                                <h5><?php 

                                                    echo $data->order_status;
                                                 ?>
                                                     
                                                     <br>
                                                     <span>Tracking id : 
                                                        <a target=”_blank”  href="<?php echo   $data->tracking_link ;  ?>"><?php echo $data->shipping_status ; ?></a></span>
                                                 </h5>
                                                
                                            </td>
                                        <td><?php echo $data->createdAt; ?></td>
                                        </tr>
                                        <?php }  

                                    }
?>

      <tr> <td colspan="2" style="
    background: #ffff0047;" class="text-center">Total Order Amount: <?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?><?php echo $data->order_amount ; ?></td>
<td colspan="2" style="
    background: #ffff0047;" class="text-center">Shipping Charge : <?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?><?php echo $data->shipping_charge; ?></td>
    <td  style="
    background: #ffff0047;" class="text-center">Total : <?php echo $qty; ?></td>
    <td colspan="2" style="
    background: #ffff0047;" class="text-center">Shipping Method : <?php 


if($data->shipping_method == 'ExpressShipping'){
    echo 'Express Shipping';
}
if($data->shipping_method == 'RegisteredShipping'){

    echo 'Registered Shipping';

}
if($data->shipping_method == 'DHL'){

    echo 'DHL';

}


     ?></td>
    
</tr>
                                        <?php
                                } ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h3>Profile</h3>
                        <div class="setting-content personal-data">
                            <h4>Personal Information</h4>
                            <div class="block-content">
                                <form method="post" action="<?php echo site_url('users/update_user_details'); ?>">
                                    <div class="form-group row">
                                        <div class="form-group__content col-md-6">
                                            <input class="form-control" type="text" placeholder="First Name"  name="first_name" value="<?php echo $users->first_name; ?>">
                                        </div>

                                        <div class="form-group__content col-md-6">
                                            <input class="form-control" type="text" placeholder="Last Name" name="last_name" value="<?php echo $users->last_name ; ?>" >
                                        </div>
                                    </div>
                                   
                                
                            </div>
                        </div>
                <div class="setting-content personal-data">
                            <h4>Gender</h4>
                            <div class="block-content">
                
                                    <div class="form-group">
                                        <div class="form-group__content">

                                            <?php
                                          if(isset($users->gender)){
                                            $gender =  $users->gender ;
                                          }else{
                                            $gender =  'male';
                                          }
$js = 'class="form-control"';
                        $options = array('' => 'Select Gender','male' =>'Male','female' =>'Female');
echo form_dropdown('gender', $options, $gender,$js);

                                             ?>

                                           
                                          
                                        </div>
                                    </div>
                                   
                            </div>
                        </div>
                        <div class="setting-content personal-data">
                            <h4>Email Address</h4>
                            <div class="block-content">
                
                                    <div class="form-group">
                                        <div class="form-group__content">
                                            <input class="form-control" disabled="" name="email" value="<?php echo $users->email ; ?>" name="email" type="text" placeholder="Email Address">
                                        </div>
                                    </div>
                                   
                            </div>
                        </div>
                        <div class="setting-content personal-data">
                            <h4>Phone Number</h4>
                            <div class="block-content">
                            
                                    <div class="form-group">
                                        <div class="form-group__content">
                                          
                                            <input class="form-control" type="text" placeholder="contact No" value="<?php echo $users->user_phone; ?>">
                                        </div>
                                    </div>
                                 
                           
                            </div>
                        </div>
                        <div class="setting-content personal-data">
                            <h4>Address </h4>
                            <div class="block-content">
                               
                                    <div class="form-group">
                                        <div class="form-group__content">
                                            <textarea class="form-control" name="address" type="text" placeholder="Address"><?php echo $users->address ; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="edit-btn">
                                        <button class="ps-btn" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                      
                    </div>



                     <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
<h3 class="text-center">Address</h3>
                        <div class="row">
                            
                            <?php foreach ($address as $data) {
                                ?>
                            <div class="col-md-4 address-card">
                                <p>Name : <span><?php echo $data->first_name ; ?></span></p>
                                <p>Email : <span><?php echo $data->email ; ?></span></p>
                                <p>Phone : <span><?php echo $data->phone_no ; ?></span></p>
                                <p><a href="<?php echo site_url('users/'.$data->id.'/?tab=address') ; ?>">edit</a></p>
                            </div>
                        <?php } ?>
                    
                        </div>
                        <h3><a class="btn btn-info" href="<?php echo site_url('users') ; ?>">Add New</a></h3>
                        <div class="setting-content personal-data">
                            <h4>Personal Information</h4>
                            <div class="block-content">
                                <form method="post" action="<?php echo site_url('users/add_address'); ?>">
                                      <input type="hidden" name="address_id" value="<?php if(isset($address_details->id)){ echo $address_details->id ; } ?>" >
                                    <div class="form-group row">
                                        <div class="form-group__content col-md-6">
                                            <input class="form-control" type="text" placeholder="First Name" required=""  name="first_name" value="<?php if(isset($address_details->first_name)){ echo $address_details->first_name ; } ?>">
                                        </div>
                                        <div class="form-group__content col-md-6">
                                            <input class="form-control" required="" type="text" placeholder="Last Name" name="last_name" value="<?php if(isset($address_details->last_name)){ echo $address_details->last_name ; } ?>" >
                                        </div>
                                    </div>
                                   
                                
                            </div>
                        </div>
                        <div class="setting-content personal-data">
                            <h4>Email Address</h4>
                            <div class="block-content">
                
                                    <div class="form-group">
                                        <div class="form-group__content">
                                            <input required="" class="form-control" name="email" value="<?php if(isset($address_details->email)){ echo $address_details->email ; } ?>" name="email" type="text" placeholder="Email Address">
                                        </div>
                                    </div>
                                   
                            </div>
                        </div>
                        <div class="setting-content personal-data">
                            <h4>Phone Number</h4>
                            <div class="block-content">
                            
                                    <div class="form-group">
                                        <div class="form-group__content">
                                            <input class="form-control" name="phone_no" type="text" placeholder="contact No" required="" value="<?php if(isset($address_details->phone_no)){ echo $address_details->phone_no ; } ?>">
                                        </div>
                                    </div>
                                 
                           
                            </div>
                        </div>
                         <div class="setting-content personal-data">
                            <h4>Country</h4>
                            <div class="block-content">
                            
                                    <div class="form-group">
                                        <div class="form-group__content">
<?php 

$countrys = array();
if(isset($address_details->country)){
    $c = $address_details->country;
}else{
     $c = '';
}
foreach ($country as $data) {
    # code...
    $countrys[$data->id] = $data->name ; 
}
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
if(isset($address_details->state)){
    $s = $address_details->state;
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
if(isset($address_details->city)){
    $ci = $address_details->city;
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
                          <div class="setting-content personal-data">
                            <h4>Zip</h4>
                            <div class="block-content">
                            
                                    <div class="form-group">
                                        <div class="form-group__content">
                                            <input class="form-control" type="text" placeholder="zip" value="<?php if(isset($address_details->zip)){ echo $address_details->zip ; } ?>" name="zip" required="">
                                        </div>
                                    </div>
                                 
                           
                            </div>
                        </div>
                        <div class="setting-content personal-data">
                            <h4>Address Line One</h4>
                            <div class="block-content">
                            
                                    <div class="form-group">
                                        <div class="form-group__content">
                                           <textarea class="form-control" name="address_one"  required="" type="text" placeholder="Address"><?php if(isset($address_details->address_one)){ echo $address_details->address_one ; } ?></textarea>
                                        </div>
                                    </div>
                                 
                           
                            </div>
                        </div>
                        <div class="setting-content personal-data">
                            <h4>Address Line Two</h4>
                            <div class="block-content">
                               
                                    <div class="form-group">
                                        <div class="form-group__content">
                                            <textarea class="form-control" name="address_two"   type="text" placeholder="Address"><?php if(isset($address_details->address_two)){ echo $address_details->address_two ; } ?></textarea>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <div class="form-group__content">
                                        <label class="checkbox-inline">
                                            <?php if(isset($address_details->is_default) && $address_details->is_default =="yes"){ $checked =  'checked'; }else{
 $checked =  '';
                                            } ?>
      <input type="checkbox" <?php echo $checked ; ?>  name="is_default" value="yes"> Is Default</label>
                                        </div>
                                    </div>
                                    <div class="edit-btn">
                                        <button class="ps-btn" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                      
                    </div>



                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h3>Settings</h3>
                        <div class="setting-content">
                            <h4>Change Password</h4>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- <h5>Your new password must:</h5>
                                        <p>Be at least 4 characters in length</p>
                                        <p>Not be same as your current password</p>
                                        <p>Not contain common passwords.</p> -->
                                    </div>
                                    <div class="col-md-8">
                                        <form action="<?php echo site_url('users/reset_pass') ?>" method="post">
                                            <div class="form-group">
                                                <label>Current Password
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="password" name="old_password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>New Password
                                                </label>
                                                <div class="form-group__content">
                                                    <input class="form-control" type="password" name="new_password">
                                                </div>
                                            </div>
                                            <button type="submit" class="ps-btn ps-btn--fullwidth">Change Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="v-pills-balance" role="tabpanel" aria-labelledby="v-pills-balance-tab">
                        <h3>Balance</h3>
                        <div class="balance-content">
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>Your Balance:</h4>
                                        <span><?php echo $users->balance; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="tab-pane fade" id="v-pills-gift" role="tabpanel" aria-labelledby="v-pills-gift-tab">
                        <h3>Gift</h3>
                        <div class="balance-content">
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>Your Gift:</h4>
                                        <div class="row">
                                        <?php if($getUserGift){
                                            foreach($getUserGift as $gift){
                                        $p_name =$gift[0]['product_name'] ;
                                        $slugs = str_replace(" & ", '----', $p_name);
                                        $slugs = str_replace(', ', '--', $slugs);
                                        $slugs = str_replace("'", '---', $slugs); 
                                        $slugs = str_replace(" ", '_', $slugs);
                                        ?>
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                       <div class="ps-product">
                                        <div class="ps-product__thumbnail">
                                            <a href="<?php echo site_url('products/'.$slugs.'');  ?>"><img src="<?php   echo base_url(); ?>/admin-assets/images/<?php echo $gift[0]['product_image'] ; ?>" alt=""/><?php echo $gift[0]['product_name']; ?></a>
                                            </div>
                                            </div></div>
                                            </div>
                                            <?php }
                                            }
                                            else{?>
                                            <h4>No result found</h4>
                                                <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!--- /Account-Wrapper --->
<?php  $this->load->view('inc/footer'); ?>
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

</script>
