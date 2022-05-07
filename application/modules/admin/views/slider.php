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
                     <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Slide Image</th>
                          <th>Slide url</th>
                          <th>Slider Name</th>
                          <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>

                <?php foreach ($slider as $data) {   ?>
 
                        <tr>
                          <td><?php echo $data->id; ?></td>
                          <td><img src="<?php echo base_url('admin-assets/sliders/') ?><?php echo $data->slide_image; ?>" width="100"></td>
                          <td><?php echo $data->image_title; ?></td>
                          <td><?php echo $data->slider_name;  ?></td>
                          <td>
                            <a   data-placement="top" class="btn menu-icon vd_bd-green vd_green" data-id="<?php echo $data->id ; ?>" data-toggle="modal" data-target="#myModal"> <i class="fa fa-eye"></i> </a> 
                            <a   data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow" data-id="<?php echo $data->id ; ?>"  data-toggle="modal" data-target="#myModaledit"> <i class="fa fa-pencil" ></i> </a> 
                            <a data-original-title="delete" data-id="<?php echo $data->id ; ?>" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-red vd_red"> <i class="fa fa-times"></i> </a>
                            
                          </td>              
                        </tr>
                       <?php } ?>
                      </tbody>
                    </table>
                    <?php  echo $links ; ?>
                    <!-- <ul class="pagination">
                      <li><a href="#">&laquo;</a></li>
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul> -->
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
          <h4 class="modal-title">View Slider</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 
                        
                     <div class="table-responsive">
                             
                     <table class="table table-striped table-bordered">
                     <tbody><tr>
                     <th>Slide url</th>
                     <td id="txt_url"> </td>
                     </tr>
                                     
                     <tr>
                     <th>Slide Image</th>
                     <td id="txt_image"> </td>
                     </tr>
                                         
                     <tr>
                     <th>Slider Name</th>
                     <td id="txt_name"> </td>
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

                  <form action="<?php echo site_url('admin/general_setting/update_slider') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div id="error"></div>
                        <input type="hidden" id="id01" name="id" value="357">
                     <!-- <form class="form-horizontal"  action="#" role="form" id="register-form"> -->
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Slide url <span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="http://" class="width-60 required" name="url"  required="" id="url01">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Slide Image <span class="vd_red">*</span></label>
                      <div id="company-input-wrapper" class="controls col-sm-8">
                        <input type="file"  class="width-60 required" name="thumbnail" >
                        <p id="image01"></p>
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Slider Type<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="slider_type" id="type01" class="width-60" id="user_type">
                         <option value="Main Slider">Main Slider</option>
                         <option value="Small Slider 1">Small Slider 1</option>                       
                         <option value="Small Slider 2">Small Slider 2</option>
                         <option value="Small Slider 3">Small Slider 3</option>
                         <option value="Category Slider">Category Slider</option>
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

<!-- add to user -->
<div class="modal fade popup-style" id="myModaladduser" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Slider</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                <div class="col-md-12"> 
                   <form action="<?php echo site_url('admin/general_setting/add_slider') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div id="error"></div>
                        <input type="hidden" id="user_id" name="id" value="357">
                     <!-- <form class="form-horizontal"  action="#" role="form" id="register-form"> -->
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Slide url <span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="http://" class="width-60 required" name="url10"  required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Slide Image <span class="vd_red">*</span></label>
                      <div id="company-input-wrapper" class="controls col-sm-8">
                        <input type="file"  class="width-60 required" required="" name="thumbnail" id="lastname">
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Slider Type<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="slider_type" class="width-60" id="user_type">
                         <option value="Main Slider">Main Slider</option>
                         <option value="Small Slider 1">Small Slider 1</option>                       
                         <option value="Small Slider 2">Small Slider 2</option>
                         <option value="Small Slider 3">Small Slider 3</option>
                         <option value="Category Slider">Category Slider</option>
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
<!-- end add to user -->




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
      url:'<?php echo site_url() ; ?>/admin/general_setting/view_slider/'+id ,
      cache: false,
      dataType: 'json'
  })

  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
       $('#id01').val(data.id);
      $('#image01').html('<img src="<?php echo site_url() ; ?>admin-assets/sliders/'+data.slide_image+'" width="100">');
      $('#url01').val(data.image_title);
      $('#type01').val(data.slider_name);
      
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
      url:'<?php echo site_url() ; ?>/admin/general_setting/view_slider/'+id ,
      cache: false,
      dataType: 'json'
  })
  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
      $('#txt_url').html(data.image_title);
      $('#txt_image').html('<img src="<?php echo site_url() ; ?>admin-assets/sliders/'+data.slide_image+'" width="100">');
      $('#txt_name').html(data.slider_name);
      
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
      url:'<?php echo site_url('admin/general_setting/delete/') ; ?>'+id ,
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