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
                    <h3 class="panel-title" style="display: inline-block;"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> <?php echo $title ; ?>   </h3>
                    
                  </div>
                  <div class="panel-body table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Images</th>
                          <th>Popup Style</th>
                          <th>Select Popup</th>
                          <th>Show popup</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($popuplist as $data) {   ?>
 
                        <tr>
                          <td><?php echo $data->id ; ?></td>
                          <td><?php echo $data->title ; ?></td>
                          <td><?php echo $data->desc;  ?></td>
                          <td class="center"><img src="<?php echo site_url() ; ?>admin-assets/<?php echo $data->banner; ?>" width="150"></td>
                          <td class="center"><?php echo $data->shape_name  ; ?></td>
                          <td><?php echo $data->select_popup ; ?></td>
                          <td><input type="radio" name="selected_p" value="Yes" class="sl_vlue" data-id="<?php echo $data->id ; ?>" <?php if($data->select_popup == "Yes"){ echo "checked"; } ?> ></td>
                          <td class="menu-action">
                            <a   data-placement="top" class="btn menu-icon vd_bd-green vd_green" data-id="<?php echo $data->id ; ?>" data-toggle="modal" data-target="#myModal"> <i class="fa fa-eye"></i> </a> 
                            <a   data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow" data-id="<?php echo $data->id ; ?>"  data-toggle="modal" data-target="#myModaledit"> <i class="fa fa-pencil" ></i> </a> 
                            
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
          <h4 class="modal-title">Style</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 
                        
                     <div class="table-responsive">
                        <p id="demo"></p>
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
          <h4 class="modal-title">Update Popup Content</h4>
        </div>
        <div class="modal-body" id="dynamic-content" >
          <div class="row"> 
                     <div class="col-md-12"> 

                  <form action="<?php echo site_url('admin/popup/update_popup') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        
                        <input type="hidden" id="id" name="id" value="">
                
                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">
                                  Title<span class="vd_red">*</span>
                      </label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                        <input type="text"  name="title" id="title" value="">   
                       </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">
                                  Description<span class="vd_red">*</span>
                      </label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                        <input type="text"  name="desc" id="desc" value="">   
                       </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">
                                  Images<span class="vd_red">*</span>
                      </label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                        <input type="file"  name="thumbnail" id="img11" value="">
                        <p id="img"></p>   
                       </div>
                    </div>
                  </div>
 
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
      url:'<?php echo site_url() ; ?>/admin/popup/view_popup/'+id ,
      cache: false,
      dataType: 'json'
  })

  .done(function(data){ 

      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
       $('input#id:hidden').val(data.id);
      $('#title').val(data.title);
      $('#desc').val(data.desc);
      $('#img').html('<img src="<?php echo site_url() ; ?>admin-assets/'+data.banner+'" width="150">');
  })
 
 .fail(function(data){
      $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
  })

  });

  });

  $(document).ready(function(){
 $('.table').on('click', '.vd_bd-green', function(){
  
     var id = $(this).data('id'); // get id of clicked row
  
     if(id==1){
      $('#demo').html('<img src="<?php echo site_url() ; ?>admin-assets/square.jpg" width="100%">');
     }
     if(id==2){
      $('#demo').html('<img src="<?php echo site_url() ; ?>admin-assets/elips.jpg" width="100%">');
     }
     if(id==3){
      $('#demo').html('<img src="<?php echo site_url() ; ?>admin-assets/no_banner.jpg" width="100%">');
     }
  });
  });
  
</script>
<script>
$(document).ready(function(){
  $(".sl_vlue").click(function(){
  var id = $(this).data('id'); 

 
  $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/popup/update_seletor/'+id ,
      cache: false,
      dataType: 'json'
  })

  .done(function(data){ 
      if(data == true){
        location.reload();
      }
  })

  });
});
</script>

</body>
</html>