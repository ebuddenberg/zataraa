
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
                 
                <li class="active"><?php $title; ?></li>
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
              <h1>Product Size List</h1>
       </div>
          </div>
          <div class="vd_content-section clearfix">
            <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title" style="display: inline-block;"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Product Size List   </h3>
                    <h3 class="panel-title text-center" style="display: inline-block;width: 100%; position: absolute; left: 0; cursor: pointer;">
                          <span data-toggle="modal" data-target="#myModaladduser" ><i class="fa fa-plus fa-fw"></i> Add Product Size</span>
                    </h3>
                  </div>
                  <div class="panel-body table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Product Size Name</th>
                          <th>Selected Categories</th>
                           
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                         foreach ($product_size_list as $data) { ?>

                        <tr>
                          <td><?php echo $data->id ; ?></td>
                         
                          <td class="center"><?php echo $data->size_name ; ?></td>
                          <td class="center"><?php echo $data->category_name ; ?></td>
                          
                          <td class="menu-action">
                             <a   data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#myModaledit"> <i class="fa fa-pencil" ></i> </a> 
                            <a data-original-title="delete" data-toggle="tooltip" data-placement="top"  data-id="<?php echo $data->id; ?>" class="btn menu-icon vd_bd-red vd_red"> <i class="fa fa-times"></i> </a>
                        </td>
                        </tr>


                    <?php
                        } ?>
                        
                      </tbody>
                    </table>

                    <?php echo $links ; ?>
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


<!-- popup edit-->
<div class="modal fade popup-style" id="myModaledit" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Product Size</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 

                  <form action="<?php echo site_url('admin/product/update_roductSize') ; ?>" class="form-horizontal"  method="post"  enctype="multipart/form-data">
                        <div id="error"></div>
                <input type="hidden" name="size_id1" id="Size_id">        
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Product Size Name<span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Size Name" class="width-60 required" required="" name="psize_name" id="Size_name01">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                       <div class="col-md-12">
                      <label class="control-label  col-sm-4">Select Category</label>
                      <div id="company-input-wrapper" class="controls col-sm-8">
                        <select class="width-60 required catelist" id="categ01" name="cate_name[]"  multiple="multiple" >
                           <?php foreach ($categorielist as $cate): ?>
                            <option value="<?php echo $cate->categories_name; ?>">
                               <?php echo $cate->categories_name; ?>
                            </option>
                           <?php endforeach ?>
                        </select>
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

<!-- add to user -->
<div class="modal fade popup-style" id="myModaladduser" role="dialog" >
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Product Size</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                  <div class="col-md-12"> 
                  <form  class="form-horizontal"  method="post" >
                        <div id="error11"></div>
                <input type="hidden" name="Product Size_id" id="Product Size_id">        
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Product Size Name<span class="vd_red">*</span></label>

                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Size Name" class="width-60 required" required="" name="psize_name" id="Size_name">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Select Category</label>
                      <div id="company-input-wrapper" class="controls col-sm-8">
                        <select class="width-60 required catelist"   name="cate[]"   multiple="multiple" id="catev">
                          <?php foreach ($categorielist as $cate): ?>
                            <option data-name="<?php echo $cate->categories_name; ?>" value="<?php echo $cate->id; ?>">
                               <?php echo $cate->categories_name; ?>
                            </option>
                           <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-md-7 mgbt-xs-10 ">
                       <div class="mgtp-10">
                        <button class="btn edit vd_bg-green vd_white pull-right add_size" type="button" id="submit-register" name="submit-register">Submit</button>
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
<script type="text/javascript" src="<?php echo base_url(); ?>admin-assets/js/chosen.jquery.js"></script>
 
<script type="text/javascript">
  jQuery(document).ready(function(){
  jQuery(".catelist").chosen();
 });
 </script>
 <script type="text/javascript">
   $(document).ready(function(){
      $('.table').on('click', '.vd_bd-yellow', function(){
         var id = $(this).data('id');
          $.ajax({
                  type:'post',
                  url:'<?php echo site_url() ; ?>/admin/product/size_view/'+id ,
                  cache: false,
                  dataType: 'json'
              })
          .done(function(data){ 
              $('#dynamic-content').hide(); // hide dynamic div
              $('#dynamic-content').show(); // show dynamic div

              $('#Size_id').val(data.id);
              $('#Size_name01').val(data.size_name);
              $('#categ01').val(data.category_name);
              
          })
          .fail(function(data){
      $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
  })
          
       });
  
     });
 </script>
 
<script type="text/javascript">

  $('.table').on('click', '.vd_bd-red', function(){
  
    if (window.confirm("Do you really want to delete?")) { 
    var id = $(this).data("id");
      var $tr = $(this).closest('tr');
    $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/product/delete_psize/') ; ?>'+id ,
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
</script>
<script type="text/javascript">
$( ".add_size" ).click(function() {
       var size_cat_name = $('#catev').find('option:selected', this);
       var results = [];
        size_cat_name.each(function() {
        results.push($(this).data('name'));
       });
       var cate_id = $("#catev").val();
       var size_name = $("#Size_name").val();
       
      
      $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/product/add_psize') ; ?>',
      data : { size_cat_name1 : results,
               cate_id1 :  cate_id,
               size_name1 :  size_name, },
      cache: false, 
      dataType: 'json',      
      success: function(response){            
        $("#error11").html(response); 
      },
      error: function(){            
        $("#error11").html("Something going wrong...");
      }
     });
});
   //  $('').on('click', '.vd_bd-red', function(){
   //   if (window.confirm("Do you really want to delete?")) { 
   //  var id = $(this).data("id");
   //    var $tr = $(this).closest('tr');
   //  $.ajax({
   //    type: "post",
   //    url:'<?php //echo site_url('admin/product/delete_psize/') ; ?>'+id ,
   //    cache: false,       
   //    success: function(response){            
   //     $tr.fadeOut();   
   //    },
   //    error: function(){            
   //      alert('Error while request..');
   //    }
   //   });
   //  }
   // });
</script>
<style type="text/css">
 .chosen-container.chosen-container-multi {
    width: 60% !important;
}
</style>
</body>
</html>