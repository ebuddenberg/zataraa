
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
                <li><a href="index.html">Home</a> </li>
                 <li class="active">Submenu</li>
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
              <h1>Menu</h1>
       </div>
          </div>
          <div class="vd_content-section clearfix">
            <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title" style="display: inline-block;"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Menu   </h3>
                    <h3 class="panel-title text-center" style="display: inline-block;width: 100%; position: absolute; left: 0; cursor: pointer;">
                          <span data-toggle="modal" data-target="#myModaladduser" ><i class="fa fa-plus fa-fw"></i>Add Submenu</span>
                    </h3>
                  </div>
                  <div class="panel-body table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Main Menu</th>
                          <th>Parent Menu</th>
                          <th>Child Menu</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                         foreach ($childmenu_list as $data) { ?>

                        <tr>
                          <td><?php echo $data->id ; ?></td>
                           
                          <td class="center"><?php echo $data->main_menus ; ?></td>
                          <td class="center"><?php echo $data->parent_menus ; ?></td>
                          <td class="center"><?php echo $data->children_menus ; ?></td>
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
          <h4 class="modal-title">Categories</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
               <div class="col-md-12"> 
                 <form action="<?php echo site_url('admin/product/update_menu') ; ?>" class="form-horizontal" id="login-form" method="post" enctype='multipart/form-data' >
                  <input type="hidden"  class="width-60 required" name="menuid" id="menuid">
                        <div id="error"></div>
                        
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Main Heading<span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <select class="width-60 required"   name="main_menu1" id="mheading1">
                              <option value="Wholesale">Wholesale</option>
                              <option value="Free Shipping Deals">Free Shipping Deals</option>
                              <option value="Stock lot deals">Stock lot deals</option>
                              <option value="Personal Shopping">Personal Shopping</option>
                              <option value="Abaya Fabric">Abaya Fabric</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Parent Menu</label>
                      <div id="company-input-wrapper" class="controls col-sm-8">
                        <input type="text" placeholder="Parent Menu" class="width-60 required" name="parent" id="pmenu">
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
          <h4 class="modal-title">Submenu</h4>
        </div>
        <div class="modal-body">
          <div class="row"> 
                     <div class="col-md-12"> 

                  <form action="<?php echo site_url('admin/product/add_submenu') ; ?>" class="form-horizontal" id="login-form" method="post" enctype='multipart/form-data' >
                        <div id="error"></div>
                        
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Main Heading<span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <select class="width-60 required"   name="main_menu" id="main_menu" required="">
                              <option >--Select Main Heading--</option>
                              <option value="Wholesale">Wholesale</option>
                              <option value="Free Shipping Deals">Free Shipping Deals</option>
                              <option value="Stock lot deals">Stock lot deals</option>
                              <option value="Personal Shopping">Personal Shopping</option>
                              <option value="Abaya Fabric">Abaya Fabric</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Parent Menu</label>
                      <div id="company-input-wrapper" class="controls col-sm-8">
                        <select class="width-60 required" name="parent" id="parent_menu" required="">
                          <option>--Select Parent Menu--</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Submenu Menu</label>
                      <div id="company-input-wrapper" class="controls col-sm-8">

                        <select class="width-60 required" name="sub_menu">
                               <?php foreach ($categorielist as $categ): ?>
                                <option value="<?php echo $categ->categories_name; ?>"><?php echo $categ->categories_name; ?></option>
                               <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
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

<script type="text/javascript">
  $(document).ready(function(){
         $('.table').on('click', '.vd_bd-yellow', function(){
  
     var id = $(this).data('id'); // get id of clicked row
    
    $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/menu_view/'+id ,
      cache: false,
      dataType: 'json'
  })

  .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
       $('#menuid').val(data.id);
      $('#mheading1').val(data.main_heading);
      $('#pmenu').val(data.parent_menu);

  })
 
 .fail(function(data){
      $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
  })

  });
$('.table').on('click', '.vd_bd-red', function(){
    if (window.confirm("Do you really want to delete?")) { 
    var id = $(this).data("id");
      var $tr = $(this).closest('tr');
    $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/product/delete_childmenu/') ; ?>'+id ,
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
<script>
  $(document).ready(function(){
    $("#main_menu").change(function() {
       var valu = $(this).val();
        $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/parentmenu_view/'+valu ,
      cache: false,
      dataType: 'json'
       })
   .done(function(data){ 
      $('#dynamic-content').hide(); // hide dynamic div
      $('#dynamic-content').show(); // show dynamic div
       $('#parent_menu').html(data);
      
      })
    });
   });
 </script>
<style type="text/css">
  .chosen-container.chosen-container-multi {
    width: 100% !important;
}
</style>
</body>
</html>