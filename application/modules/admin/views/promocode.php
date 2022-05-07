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
                <li><a href="<?php echo site_url('admin/'); ?>">Home</a> </li>
                <li><a href="<?php echo site_url('admin/product/'); ?>">Products</a> </li>
                <li><a href="<?php echo site_url('admin/product/promocode'); ?>">Promo Code</a> </li>
               
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
                          <span data-toggle="modal" data-target="#myModaladdpromocode" ><i class="fa fa-plus fa-fw"></i> Add promo code</span>
                    </h3>
                  </div>
                  <div class="panel-body table-responsive">
                    <table class="table table-hover" id="example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Coupon Code</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Discount Type</th>
                          <th>Amount</th>
                          <th>Type</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
<?php foreach ($promocodes as $promocode) {   ?>


                        <tr>
                          <td><?php echo $promocode->id ; ?></td>
                          <td><?php echo $promocode->coupon_code ;  ?></td>
                          <td class="center"><?php echo $promocode->offer_desc ; ?></td>
                          <td class="center"><?php if($promocode->enable == 1) {
                                  echo '<span class="label label-success"> active </span>';
                          }else{
                             echo '<span class="label label-danger"> inactive </span>';
                          }  ?></span></td>
                          <td><?php echo $promocode->type ; ?></td>
                          <td class="center"><?php if($promocode->percent != 0) {
                                  echo $promocode->percent ;
                          }else{
                             echo $promocode->flat;
                          }  ?></td>
                          
                          <td><?php echo $promocode->use_limit_per_user ; ?></td>
                          <td class="menu-action">
                            <a   data-placement="top" class="btn menu-icon vd_bd-green vd_green" data-id="<?php echo $promocode->id ; ?>" data-toggle="modal" data-target="#myModal"> <i class="fa fa-eye"></i> </a> 
                            <a   data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow" data-id="<?php echo $promocode->id ; ?>"  data-toggle="modal" data-target="#myModaledit"> <i class="fa fa-pencil" ></i> </a> 
                            <a data-original-title="delete" data-id="<?php echo $promocode->id ; ?>"  data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-red vd_red"> <i class="fa fa-times"></i> </a>
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


<!-- end add to user -->

<!-- add to promo code -->
<div class="modal fade popup-style" id="myModaladdpromocode" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add promo code</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 

                  <form action="<?php echo site_url('admin/product/add_promo_code') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8">
                        <div id="error"></div>
                     <!-- <form class="form-horizontal"  action="#" role="form" id="register-form"> -->
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Coupon Code <span class="vd_red">*</span></label>
                      <div id="coupon-code-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Coupon code" class="width-60 required" name="coupon_code" id="coupon_code" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Offer Description<span class="vd_red">*</span></label>
                      <div id="offer-description-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Offer description" class="width-60 required" name="offer_desc" id="offer_desc" required="">
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Status<span class="vd_red">*</span></label>
                      <div id="status-wrapper" class="controls col-sm-8">
                      <select name="enable" class="width-60" id="enable">
                       <option value="1">Enable</option>
                         <option value="0">Disable</option>                       
                      </select>
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Discount Type<span class="vd_red">*</span></label>
                      <div id="discount-type-wrapper" class="controls col-sm-8">
                      <select name="discount-type" class="width-60" id="discount-type">
                       <option value="flat">Flat</option>
                         <option value="percent">Percent</option>                       
                      </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Amount<span class="vd_red">*</span></label>
                      <div id="type-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Amount" class="width-60 required" name="type" id="type" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Max off<span class="vd_red">*</span></label>
                      <div id="max-off-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Max Off" class="width-60 required" name="max_off" id="max_off" required="">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Active from<span class="vd_red">*</span></label>
                      <div id="use-date-begin-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Active from" class="width-60 required" name="use_date_begin" id="use_date_begin" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Active to<span class="vd_red">*</span></label>
                      <div id="use-date-end-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Active to" class="width-60 required" name="use_date_end" id="use_date_end" required="">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Range begin<span class="vd_red">*</span></label>
                      <div id="total-range-begin-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Active to" class="width-60 required" name="total_range_begin" id="total_range_begin" required="">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Range end<span class="vd_red">*</span></label>
                      <div id="total-range-end-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Active to" class="width-60 required" name="total_range_end" id="total_range_end" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Promo code type<span class="vd_red">*</span></label>
                      <div id="use-limit-per-user-wrapper" class="controls col-sm-8">
                      <select name="use_limit_per_user" class="width-60" id="use_limit_per_user">
                       <option value="one time">One time</option>
                         <option value="many time">Many time</option>                       
                      </select>
                      </div>
                    </div>
                  </div>
                  
                  
                  <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                  <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-md-7 mgbt-xs-10 ">
                      <div class="mgtp-10">
                        <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-register" name="submit-register">Add</button>
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
<!-- add end popup -->

<!--- view popup-->
<div class="modal fade popup-style" id="myModal" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Promo code details</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 
                        
                     <div class="table-responsive">
                             
                     <table class="table table-striped table-bordered">
                     <tbody><tr>
                     <th>Coupon Code</th>
                     <td id="txt_coupon_code"> </td>
                     </tr>
                                     
                     <tr>
                     <th>Description</th>
                     <td id="txt_offer_description"> </td>
                     </tr>
                                         
                     <tr>
                     <th>Status</th>
                     <td id="txt_status"> </td>
                     </tr>
                                         
                     <tr>
                     <th>Type</th>
                     <td id="txt_type"> </td>
                     </tr>
					 <th>Amount</th>
                     <td id="txt_amount"> </td>
                     </tr>
                     <tr>
                     <th>Maximum Off</th>
                     <td id="txt_max_offer"> </td>
                     </tr>
                     <tr>
                     <th>Active From</th>
                     <td id="txt_use_date_begin"> </td>
                     </tr>
					 <th>Active To</th>
                     <td id="txt_use_date_end"> </td>
                     </tr>
					 <th>Range From</th>
                     <td id="txt_total_range_begin"> </td>
                     </tr>
					 <th>Range To</th>
                     <td id="txt_total_range_end"> </td>
                     </tr>
					  <th>Type</th>
                     <td id="txt_use_limit_per_user"> </td>
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
<!--- end popup-->
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

                  <form action="<?php echo site_url('admin/product/update_promo_code') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8">
                           <div id="error"></div>
                     <!-- <form class="form-horizontal"  action="#" role="form" id="register-form"> -->
                      <input type="hidden" id="promo_id" name="guid" value="357">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Coupon Code <span class="vd_red">*</span></label>
                      <div id="coupon-code-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Coupon code" class="width-60 required" name="coupon_code" id="text_coupon_code" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Offer Description<span class="vd_red">*</span></label>
                      <div id="offer-description-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Offer description" class="width-60 required" name="offer_desc" id="text_offer_description" required="">
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Status<span class="vd_red">*</span></label>
                      <div id="status-wrapper" class="controls col-sm-8">
                      <select name="enable" class="width-60" id="text_enable">
                       <option value="1">Enable</option>
                         <option value="0">Disable</option>                       
                      </select>
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Discount Type<span class="vd_red">*</span></label>
                      <div id="discount-type-wrapper" class="controls col-sm-8">
                      <select name="discount-type" class="width-60" id="text_discount-type">
                       <option value="flat">Flat</option>
                         <option value="percent">Percent</option>                       
                      </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Amount<span class="vd_red">*</span></label>
                      <div id="type-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Amount" class="width-60 required" name="type" id="text_type" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Max off<span class="vd_red">*</span></label>
                      <div id="max-off-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Max Off" class="width-60 required" name="max_off" id="text_max_off" required="">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Active from<span class="vd_red">*</span></label>
                      <div id="use-date-begin-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Active from" class="width-60 required" name="use_date_begin" id="text_use_date_begin" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Active to<span class="vd_red">*</span></label>
                      <div id="use-date-end-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Active to" class="width-60 required" name="use_date_end" id="text_use_date_end" required="">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Range begin<span class="vd_red">*</span></label>
                      <div id="total-range-begin-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Active to" class="width-60 required" name="total_range_begin" id="text_total_range_begin" required="">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Range end<span class="vd_red">*</span></label>
                      <div id="total-range-end-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Active to" class="width-60 required" name="total_range_end" id="text_total_range_end" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Promo code type<span class="vd_red">*</span></label>
                      <div id="use-limit-per-user-wrapper" class="controls col-sm-8">
                      <select name="use_limit_per_user" class="width-60" id="text_use_limit_per_user">
                       <option value="one time">One time</option>
                         <option value="many time">Many time</option>                       
                      </select>
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



</div>

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<?php $this->load->view('inc/footer', $this->data); ?>
<link rel="stylesheet" type="text/css" href="<?php  echo base_url('admin-assets/plugins/dataTables/css/jquery.dataTables.min.css') ; ?>">

<!-- user list -->
</body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<script>
$(function () {
    $('#use_date_begin').datepicker({
        autoclose: true
    });
});
$(function () {
    $('#use_date_end').datepicker({
        autoclose: true
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
      url:'<?php echo site_url('admin/product/promo_code_delete') ; ?>/'+id ,
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
  
  $(document).ready(function(){
 $('.table').on('click', '.vd_bd-green', function(){
  
     var id = $(this).data('id'); // get id of clicked row
  
    $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/view_promo_code/'+id ,
      cache: false,
      dataType: 'json'
  })
  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
      $('#txt_coupon_code').val(data.coupon_code);
      $('#txt_offer_description').val(data.offer_desc);
      if(data.enable == 0){
      $('#txt_status').html("Inactive");
      }else{
          $('#txt_status').html("active");
      }
      $('#txt_type').html(data.type);
      if(data.flat == 0){
	  $('#txt_amount').html(data.percent);
      }else{
           $('#txt_amount').html(data.flat);
      }
      $('#txt_max_offer').html(data.max_off);
      $('#txt_use_date_begin').html(data.use_date_begin);
	  $('#txt_use_date_end').html(data.use_date_end);
	  $('#txt_total_range_begin').html(data.total_range_begin);
	  $('#txt_total_range_end').html(data.total_range_end);
	  $('#txt_use_limit_per_user').html(data.use_limit_per_user);
  })
  .fail(function(){
      $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
  });


  });

  });
  
  $(document).ready(function(){
 $('.table').on('click', '.vd_bd-yellow', function(){
  
     var id = $(this).data('id'); // get id of clicked row
  
    $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/view_promo_code/'+id ,
      cache: false,
      dataType: 'json'
  })
  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
      $('input#promo_id:hidden').val(data.id);
      $('#text_coupon_code').val(data.coupon_code);
      $('#text_offer_description').val(data.offer_desc);
      $('#text_enable').val(data.enable);
      $('#text_discount-type').val(data.type);
      if(data.flat == 0){
	  $('#text_type').val(data.percent);
      }else{
           $('#text_type').val(data.flat);
      }
      $('#text_max_off').val(data.max_off);
      $('#text_use_date_begin').val(data.use_date_begin);
	  $('#text_use_date_end').val(data.use_date_end);
	  $('#text_total_range_begin').val(data.total_range_begin);
	  $('#text_total_range_end').val(data.total_range_end);
	  $('#text_use_limit_per_user').val(data.use_limit_per_user);
  })
  .fail(function(){
      $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
  });


  });

  });
  
</script>