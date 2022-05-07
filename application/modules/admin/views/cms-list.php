<?php $this->load->view('inc/head', $this->data); ?>    

<body id="dashboard" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="dashboard "  data-smooth-scrolling="1">     
<div class="vd_body">
<!-- Header Start -->
  <?php $this->load->view('inc/inner-header', $this->data); ?>
  <!-- Header Ends --> 
<div class="content">
  <div class="container">
    
<?php $this->load->view('inc/left-menu', $this->data); ?>
        <div class="vd_navbar vd_nav-width vd_navbar-chat vd_bg-black-80 vd_navbar-right   ">
	<div class="navbar-tabs-menu clearfix">
			<span class="expand-menu" data-action="expand-navbar-tabs-menu">
            	<span class="menu-icon menu-icon-left">
            		<i class="fa fa-ellipsis-h"></i>
                    <span class="badge vd_bg-red">
                        20
                    </span>                    
                </span>
            	<span class="menu-icon menu-icon-right">
            		<i class="fa fa-ellipsis-h"></i>
                    <span class="badge vd_bg-red">
                        20
                    </span>                    
                </span>                
            </span>  
            <div class="menu-container">               
        		 <div class="navbar-search-wrapper">
    <div class="navbar-search vd_bg-black-30">
        <span class="append-icon"><i class="fa fa-search"></i></span>
        <input type="text" placeholder="Search" class="vd_menu-search-text no-bg no-bd vd_white width-70" name="search">
        <div class="pull-right search-config">                                
            <a  data-toggle="dropdown" href="javascript:void(0);" class="dropdown-toggle" ><span class="prepend-icon vd_grey"><i class="fa fa-cog"></i></span></a>
            <ul role="menu" class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>                                    
        </div>
    </div>
</div>  
            </div>        
                                                 
    </div>
	
</div>    
    <!-- Middle Content Start -->
    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_head-section clearfix">
            <div class="vd_panel-header">
              <ul class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>/admin">Home</a> </li>
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
                    <h3 class="panel-title" style="display: inline-block;"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> <?php echo $title ; ?>   <span> </span></h3>
                    
                  </div>
                  <div class="panel-body table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <!-- <th>Id</th> -->
                          <th>Title</th>
                          <th>Content</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
<?php foreach ($cms as $data) {   ?>


                        <tr>
                          <td><?php echo $data->id ; ?></td>
                          <td><?php echo $data->title ; ?></td>
                          <td><?php echo $data->content;  ?></td>
                          
                         <td class="menu-action">
                           
                            <a  href="<?php echo site_url('admin/cms_update/'.$data->id) ; ?>" data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow" data-id="" > <i class="fa fa-pencil" ></i> </a> 
                            
                        </td>
                        </tr>
<?php } ?>
                      </tbody>
                    </table>
                   
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
          <h4 class="modal-title">Order Details</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 
                        
                     <div class="table-responsive">
                       <table class="table table-striped table-bordered">
                     <tbody>
                     <tr>
                     <th width="102">Product Image</th>
                     <th width="230">Product Details</th>
                     <th width="100">Size</th>
                     </tr>
                                     
                     <tr>
                     <td><img src="<?php echo base_url(); ?>/admin-assets/img/products/06.jpg" width="100"></td>
                     <td id="txt_lname" >
                       <table class="table table-striped table-bordered">
                         <tr>
                           <td>Product Name</td>
                         </tr>
                         <tr>
                           <td>Color :<span class="color_attrib"></span></td>
                         </tr>
                         <tr>
                           <td>
                             Style: Long neck
                           </td>
                         </tr>
                         <tr>
                           <td>
                             Fabric: demo
                           </td>
                         </tr>
                          
                       </table>
                     </td>
                     <td  >
                       Size: 52-2 | Size: 54-4 | Size: 56-2 | Size: 58-2 |
                              Size: 60-2 | Size: 62-2
                     </td>
                     </tr>
                     <tr>
                     <td><img src="<?php echo base_url(); ?>/admin-assets/img/products/06.jpg" width="100"></td>
                     <td id="txt_lname" >
                       <table class="table table-striped table-bordered">
                         <tr>
                           <td>Product Name</td>
                         </tr>
                         <tr>
                           <td>Color :<span class="color_attrib"></span></td>
                         </tr>
                         <tr>
                           <td>
                             Style: Long neck
                           </td>
                         </tr>
                         <tr>
                           <td>
                             Fabric: demo
                           </td>
                         </tr>
                          
                       </table>
                     </td>
                     <td  >
                       Size: 52-2 | Size: 54-4 | Size: 56-2 | Size: 58-2 |
                              Size: 60-2 | Size: 62-2
                     </td>
                     </tr>
                     <tr>
                     <td><img src="<?php echo base_url(); ?>/admin-assets/img/products/06.jpg" width="100"></td>
                     <td id="txt_lname" >
                       <table class="table table-striped table-bordered">
                         <tr>
                           <td>Product Name</td>
                         </tr>
                         <tr>
                           <td>Color :<span class="color_attrib"></span></td>
                         </tr>
                         <tr>
                           <td>
                             Style: Long neck
                           </td>
                         </tr>
                         <tr>
                           <td>
                             Fabric: demo
                           </td>
                         </tr>
                          
                       </table>
                     </td>
                     <td  >
                       Size: 52-2 | Size: 54-4 | Size: 56-2 | Size: 58-2 |
                              Size: 60-2 | Size: 62-2
                     </td>
                     </tr>
                                         
                     
                                        
                                         
                     </tbody>
                   </table>
                     </div>
                                       
                   </div> 
              </div>
        </div>
        <style type="text/css">
          .color_attrib{
            height: 20px;
            width: 20px;
            background-color: red;
            display: inline-block;
            margin-left: 10px;
          }
         </style>
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
          <h4 class="modal-title">Update Orders</h4>
        </div>
        <div class="modal-body" id="dynamic-content" >
          <div class="row"> 
                     <div class="col-md-12"> 

                  <form action="<?php echo site_url('admin/orders/update_orders') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8">
                        
                        <input type="hidden" id="id" name="id" value="">
                
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Order Status<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="order_status" class="width-60" id="order_status">
                        <option value="pending_payments">Pending Payments</option>
                         <option value="processing">Processing</option>
                        <option value="on_hold">On Hold</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="refunded">Refunded</option>
                        <option value="failed">Failed</option>
                      </select>
                  
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Payment Status<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="payment_status" class="width-60" id="user_status">
                       <option value="pending">Pending</option>
                         <option value="approved">Approved</option>
                      </select>
                  
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Shipping Status<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                     <textarea class="width-60" id="shipping_status" name="shipping_status"></textarea>                  
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


<!-- user list -->

<script type="text/javascript">
  $(document).ready(function(){
         $('.table').on('click', '.vd_bd-yellow', function(){
  
     var id = $(this).data('id'); // get id of clicked row
  
    $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/orders/order_status_view/'+id ,
      cache: false,
      dataType: 'json'
  })

  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
       $('input#id:hidden').val(data.id);
      $('select#order_status').val(data.order_status);
      $('select#payment_status').val(data.payment_status);
      $('textarea#shipping_status').text(data.shipping_status);
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
      url:'<?php echo site_url() ; ?>/admin/orders/order_information/'+id ,
      cache: false
  })
  .done(function(data){ 
     $('#myModal .modal-body').empty();
     $('#myModal .modal-body').append(data);
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
    var id = $(this).data("id");
      var $tr = $(this).closest('tr');
    $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/users/delete') ; ?>'+id ,
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
</body>
</html>