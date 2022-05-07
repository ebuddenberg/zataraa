<?php $this->load->view('inc/head', $this->data); ?>    

<body id="dashboard" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="dashboard "  data-smooth-scrolling="1">     
<div class="vd_body">
<!-- Header Start -->
  <?php $this->load->view('inc/inner-header', $this->data); ?>
  <!-- Header Ends --> 
<div class="content">
  <div class="container">
    
<?php $this->load->view('inc/left-menu', $this->data); ?>
            
    <!-- Middle Content Start -->
    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_head-section clearfix">
            <div class="vd_panel-header">
              <ul class="breadcrumb">
                <li><a href="index.html">Home</a> </li>
                <li><a href="listtables-tables-variation.html"><?php echo $title ; ?></a> </li>
               
              </ul>
              <div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5  data-position="left">
    <div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"> <i class="fa fa-arrows-h"></i> </div>
      <div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>
      <div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>
      
</div>
 
            </div>
          </div>
          <div class="vd_title-section clearfix">
            <div class="vd_panel-header">
              <h1><?php echo $title ; ?></h1>
       </div>
          </div>
          <div class="vd_content-section clearfix">
            <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title" style="display: inline-block;"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> <?php echo $title ; ?>   </h3>
                    <h3 class="panel-title text-center" style="display: inline-block;width: 100%; position: absolute; left: 0; cursor: pointer;">
                          <span data-toggle="modal" data-target="#myModaladduser" ><i class="fa fa-plus fa-fw"></i> Add user</span>
                    </h3>
                  </div>
                  <div class="panel-body table-responsive">
                    <table class="table table-hover" id="example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Country</th>
                          <th>Address</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
<?php foreach ($users as $user) {   ?>


                        <tr>
                          <td><?php echo $user->id ; ?></td>
                          <td><?php echo $user->first_name . '  '.$user->last_name ;  ?></td>
                          <td class="center"><?php echo $user->email ; ?></td>
                          <td class="center"><?php echo $user->user_phone ; ?></td>
                          <td><?php echo $user->user_country ; ?></td>
                          <td><?php echo $user->address ; ?></td>
                          
                          <td class="center"><?php if($user->status == "active") {
                                  echo '<span class="label label-success"> active </span>';
                          }else{
                             echo '<span class="label label-danger"> inactive </span>';
                          }  ?></span></td>
                          <td class="menu-action">
                            <a   data-placement="top" class="btn menu-icon vd_bd-green vd_green" data-id="<?php echo $user->id ; ?>" data-toggle="modal" data-target="#myModal"> <i class="fa fa-eye"></i> </a> 
                            <a   data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow" data-id="<?php echo $user->id ; ?>"  data-toggle="modal" data-target="#myModaledit"> <i class="fa fa-pencil" ></i> </a> 
                            <a   data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow gift_opt" data-id="<?php echo $user->id ; ?>"  data-toggle="modal" data-target="#myModalgift"> <i class="fa fa-gift" ></i> </a> 
                            <a data-original-title="delete" data-id="<?php echo $user->id ; ?>"  data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-red vd_red"> <i class="fa fa-times"></i> </a>
                        </td>
                        </tr>
<?php } ?>
                      </tbody>
                    </table>
                    <?php echo $links ; ?>
               
                  </div>
                </div>
                <!-- Panel Widget --> 
              </div>
              <!-- col-md-12 --> 
            </div>
          </div>
          <!-- .vd_content-section --> 
          
        </div>
        <!-- .vd_content --> 
      </div>
      <!-- .vd_container --> 
    </div>


    <!-- .vd_content-wrapper --> 
    
    <!-- Middle Content End --> 
    
  </div>
  <!-- .container --> 
</div>
<!-- .content -->

<!-- Footer Start -->
  <footer class="footer-1"  id="footer">      
    <div class="vd_bottom ">
        <div class="container">
            <div class="row">
              <div class=" col-xs-12">
                <div class="copyright">
                  	Copyright &copy;2019 Zataara. All Rights Reserved 
                </div>
              </div>
            </div><!-- row -->
        </div><!-- container -->
    </div>
  </footer>
<!-- Footer END -->
<!-- view popup -->
<div class="modal fade popup-style" id="myModal" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User details</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 
                        
                     <div class="table-responsive">
                             
                     <table class="table table-striped table-bordered">
                     <tbody><tr>
                     <th>First Name</th>
                     <td id="txt_fname"> </td>
                     </tr>
                                     
                     <tr>
                     <th>Last Name</th>
                     <td id="txt_lname"> </td>
                     </tr>
                                         
                     <tr>
                     <th>Email ID</th>
                     <td id="txt_email"> </td>
                     </tr>
                                         
                     <tr>
                     <th>User type</th>
                     <td id="txt_user"> </td>
                     </tr>
                     <tr>
                     <th>Status</th>
                     <td id="txt_status"> </td>
                     </tr>
                     <tr>
                     <th>Balance</th>
                     <td id="txt_balance"> </td>
                     </tr>
                                        
                                         
                     </tbody></table>
                                
                     </div>
                                       
                   </div> 
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- view end popup -->

<!-- popup edit-->
<div class="modal fade popup-style" id="myModaledit" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Users</h4>
        </div>
        <div class="modal-body" id="dynamic-content" >
          <div class="row"> 
                     <div class="col-md-12"> 

                  <form action="<?php echo site_url('admin/users/update_user') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8">
                        <div id="error"></div>
                        <input type="hidden" id="user_id" name="id" value="357">
                     <!-- <form class="form-horizontal"  action="#" role="form" id="register-form"> -->
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">First Name <span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="John" class="width-60 required" name="firstname" id="firstname" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Last Name <span class="vd_red">*</span></label>
                      <div id="company-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Last name" class="width-60 required" required="" name="lastname" id="lastname">
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">User Type<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="user_type" class="width-60" id="user_type">
                       
                        <option value="customer">Customer</option>
                                               
                        <option value="admin">Admin</option>
                      </select>
                  
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">User Status<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="user_status" class="width-60" id="user_status">
                       <option value="active">Active</option>
                         <option value="inactive">Inactive</option>
                      </select>
                  
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Phone<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Contact No" class="width-60" name="phone" id="phone">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Email <span class="vd_red">*</span></label>
                      <div id="email-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Email" class="width-60 required" name="email" id="email">
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Balance <span class="vd_red">*</span></label>
                      <div id="balance-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Balance" class="width-60 required" name="balance" id="balance">
                        <input type="hidden" class="width-60 required" name="change_balance" id="change_balance">
                      </div>
                    </div>
                  </div>
                  
                  
                  <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                  <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-md-7 mgbt-xs-10 ">
                      
                    
                      <div class="mgtp-10">
                        <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-register" name="submit-register">Update</button>
                      </div>
                    </div>
                    <div class="col-md-12 mgbt-xs-5"> </div>
                  </div>
                </form>
                                       
                   </div> 
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- edit end popup -->

<!-- add to user -->
<div class="modal fade popup-style" id="myModaladduser" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add user</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 

                  <form action="<?php echo site_url('admin/users/add_user') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8">
                        <div id="error"></div>
                        <input type="hidden" id="user_id" name="id" value="357">
                     <!-- <form class="form-horizontal"  action="#" role="form" id="register-form"> -->
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">First Name <span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="firstname" class="width-60 required" name="firstname" id="firstname" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Last Name <span class="vd_red">*</span></label>
                      <div id="company-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Last name" class="width-60 required" required="" name="lastname" id="lastname">
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">User Type<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="user_type" class="width-60" id="user_type">
                       <option value="customer">Customer</option>
                         <option value="shop-manager">Shop Manager</option>                       
                        <option value="admin">Admin</option>
                      </select>
                  
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Password<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                        <input type="password" placeholder="Password" class="width-60" name="password" id="password">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Phone<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Contact No" class="width-60" name="phone" id="phone">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Email <span class="vd_red">*</span></label>
                      <div id="email-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Email" class="width-60 required" name="email" id="email">
                      </div>
                    </div>
                  </div>
                
                  
                  <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                  <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-md-7 mgbt-xs-10 ">
                      
                    
                      <div class="mgtp-10">
                        <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-register" name="submit-register">Update</button>
                      </div>
                    </div>
                    <div class="col-md-12 mgbt-xs-5"> </div>
                  </div>
                </form>
                                       
                   </div> 
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- edit end popup -->
    <!-- popup gift-->
<div class="modal fade popup-style" id="myModalgift" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Gift</h4>
        </div>
        <div class="modal-body" id="dynamic-content" >
          <div class="row"> 
                     <div class="col-md-12">   
                     <form action="<?php echo site_url('admin/users/add_gift') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8">
                        <div id="error"></div>
                        <input type="hidden" id="user_id" name="guid" value="357">
                     <!-- <form class="form-horizontal"  action="#" role="form" id="register-form"> -->
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Choose Gift <span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <select name="user_gift[]" multiple="true" class="user_gift">
                             <option value="">Select Gift</option>
                             <?php
                            foreach ($get_product_array as $key => $item) {
                                ?>
                                <option value="<?= $key ?>"><?= $item ?></option>
                                <?php
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                  <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-md-7 mgbt-xs-10 ">
                      
                    
                      <div class="mgtp-10">
                        <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-gift" name="submit-gift">Add</button>
                      </div>
                    </div>
                    <div class="col-md-12 mgbt-xs-5"> </div>
                  </div>
                </form>
                 
                   </div> 
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- gift end popup -->


<!-- end add to user -->




</div>

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<?php $this->load->view('inc/footer', $this->data); ?>
<link rel="stylesheet" type="text/css" href="<?php  echo base_url('admin-assets/plugins/dataTables/css/jquery.dataTables.min.css') ; ?>">

<!-- user list -->

<script type="text/javascript">
  $(document).ready(function(){
         $('.table').on('click', '.vd_bd-yellow', function(){
  
     var id = $(this).data('id'); // get id of clicked row
  
    $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/users/view/'+id ,
      cache: false,
      dataType: 'json'
  })

  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
       $('input#user_id:hidden').val(data.id);
      $('input#firstname:text').val(data.first_name);
      $('input#lastname:text').val(data.last_name);
      $('select#user_type').val(data.user_type);
      $('select#user_status').val(data.status);
      $('input#phone:text').val(data.user_phone);
      $('input#email:text').val(data.email);
      $('input#balance:text').val(data.balance);

  })
 
 .fail(function(data){
      $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
  })

  });

  });

  $(document).ready(function(){
 $('.table').on('click', '.vd_bd-green', function(){
  
     var id = $(this).data('id'); // get id of clicked row
  
    $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/users/view/'+id ,
      cache: false,
      dataType: 'json'
  })
  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
      $('#txt_fname').html(data.first_name);
      $('#txt_lname').html(data.last_name);
      $('#txt_email').html(data.email);
      $('#txt_user').html(data.user_type);
      $('#txt_status').html(data.status);
      $('#txt_balance').html(data.balance);
  })
  .fail(function(){
      $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
  });


  });

  });
</script>
<script type="text/javascript">
  $(document).ready(function(){

 $('.table').on('click', '.vd_bd-red', function(){
  if (window.confirm("Do you really want to delete?")) { 
    var id = $(this).attr("data-id");
      var $tr = $(this).closest('tr');
    $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/users/delete') ; ?>/'+id ,
      cache: false,       
      success: function(response){            
       $tr.fadeOut();   
      },
      error: function(){            
        alert('Error while request..');
      }
     });
    }
  });
  
  });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>admin-assets/js/chosen.jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
    $(".user_gift").chosen({ width:"95%" });
} );
$("#balance").on('change', function(){
    
  $("#change_balance").val($(this).val());
 });
  
</script>
<script type="text/javascript">
  $(document).ready(function(){

 $('.table').on('click', '.gift_opt', function(){ 
    var id = $(this).attr("data-id");
    $('input[name=guid]').val(id);
  });
  
  });
</script>
</body>
</html>