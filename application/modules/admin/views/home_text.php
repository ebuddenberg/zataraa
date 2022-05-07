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
                          <th>Content</th>
                           
                          <th>Text Place</th>
                          <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>

                <?php 
                   
                foreach ($all_home_text as $data) {   ?>
 
                        <tr>
                          <td><?php echo $data->id; ?></td>
                           
                          <td width="50%">
                                <?php $content = strip_tags($data->content);
                                
                                 echo substr($content, 0, 210);
                                ?>...
                              
                          </td>
                          <td><?php echo $data->text_place; ?></td>
                           
                          <td>
                            <a   data-placement="top" class="btn menu-icon vd_bd-green vd_green" data-id="<?php echo $data->id ; ?>" data-toggle="modal" data-target="#myModal"> <i class="fa fa-eye"></i> </a> 
                            <a   data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow" data-id="<?php echo $data->id ; ?>"  data-toggle="modal" data-target="#myModaledit"> <i class="fa fa-pencil" ></i> </a> 
                            <a data-original-title="delete" data-id="<?php echo $data->id ; ?>" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-red vd_red"> <i class="fa fa-times"></i> </a>
                            
                          </td>              
                        </tr>
                       <?php } ?>
                      </tbody>
                    </table>
                    
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
          <h4 class="modal-title">View Home Text</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 
                        
                     <div class="table-responsive">
                             
                     <table class="table table-striped table-bordered">
                     <tbody>
                      
                      <tr>
                     <th> Content</th>
                     <td id="ads_url"> </td>
                     </tr>
                      <tr>
                     <th> Text Place</th>
                     <td id="ads_posi"> </td>
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
          <h4 class="modal-title">Edit Home text</h4>
        </div>
        <div class="modal-body" id="dynamic-content" >
          <div class="row"> 
                     <div class="col-md-12"> 

                 <form action="<?php echo site_url('admin/general_setting/update_home_text') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                         
                     <input type="hidden" name="id12" id="id01">
                    
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-3"><h3> Content*</h3> </label>
                      <div id="first-name-input-wrapper" class="controls col-sm-12">
                        <textarea   class="width-60 required content11" rows="1" name="editor1"  required="" id="editor2" data-sample-short></textarea>
                         
                      </div>
                    </div>
                  </div>
                   

                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Text Place<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="position" class="width-60" id="place1">
                         <option value="Top Scroll">Top Scroll</option>
                         <option value="Slider Heading">Slider Heading</option>
                         <option value="Latest News">Latest News</option>
                         <option value="Bottom Text">Bottom Text</option>
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
          <h4 class="modal-title">Add Home Text</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                <div class="col-md-12"> 
                   <form action="<?php echo site_url('admin/general_setting/add_home_text') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                         
                     
                    
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-3"><h3> Content*</h3> </label>
                      <div id="first-name-input-wrapper" class="controls col-sm-12">
                        <textarea   class="width-60 required" data-rel="ckeditor" rows="1" name="editor1"  required="" id="editor1" data-sample-short></textarea>
                         
                      </div>
                    </div>
                  </div>
                   

                    <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label col-sm-4">Text Place<span class="vd_red">*</span></label>
                      <div id="website-input-wrapper" class="controls col-sm-8">
                      <select name="position" class="width-60" id="user_type">
                         <option value="Top Scroll">Top Scroll</option>
                         <option value="Slider Heading">Slider Heading</option>
                         <option value="Latest News">Latest News</option>
                         <option value="Bottom Text">Bottom Text</option>
                      </select>
                  
                      </div>
                    </div>
                  </div>
                   <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                  <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-md-7 mgbt-xs-10 ">
                      
                    
                      <div class="mgtp-10">
                        <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-register" name="submit-register">Submit</button>
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
<script type="text/javascript" src='<?php echo base_url(); ?>admin-assets/ckeditorfull/ckeditor.js'></script>
 
<script>
    CKEDITOR.replace('editor1', {
      height: 250,
      extraPlugins: 'colorbutton,colordialog'
    });
    CKEDITOR.replace('editor2', {
      height: 250,
      extraPlugins: 'colorbutton,colordialog'
    });
</script>

<!-- user list -->

<script type="text/javascript">
  $(document).ready(function(){
     $('.table').on('click', '.vd_bd-yellow', function(){
      var id = $(this).data('id'); // get id of clicked row
     $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/general_setting/view_home_text/'+id ,
      cache: false,
      dataType: 'json'
  })

  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
       $('#id01').val(data.id);
      CKEDITOR.instances['editor2'].setData(data.content);
   
      $('#place1').val(data.text_place);
     
      
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
      url:'<?php echo site_url() ; ?>/admin/general_setting/view_home_text/'+id ,
      cache: false,
      dataType: 'json'
  })
  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
      $('#ads_url').html(data.content);
       
      $('#ads_posi').html(data.text_place);
      
      
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
      url:'<?php echo site_url('admin/general_setting/delete_home_text/') ; ?>'+id ,
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