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
              <h1>Contact</h1>
       </div>
          </div>
          <div class="vd_content-section clearfix">
            <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title" style="display: inline-block;"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> General Settings  <span> </span></h3>
                    
                  </div>
                  <div class="panel-body table-responsive">
                    <form action="<?php echo site_url('admin/update_general_setting') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8">
                        
                        <input type="hidden" id="id" name="id" value="1">
                    <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title"> contact no </span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" required="" name=" contact_no" class="  updateCurrentText " value="<?php echo $g_setting->contact_no; ?>">
                                
                            </div>
                  </div>
                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Email</span> </label>
                            <div class="col-lg-9">
                                <input type="text" required="" name="email" class="  updateCurrentText " value="<?php echo $g_setting->email; ?>">  
                                
                            </div>
                  </div>

                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Address</span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" required="" name="address" class="  updateCurrentText " value="<?php echo $g_setting->address; ?>">
                                
                            </div>
                  </div>
                  
                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Facebook Link</span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" name="facebook_link" class="  updateCurrentText " value="<?php echo $g_setting->facebook_link; ?>">
                                
                            </div>
                  </div>
                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Twitter link </span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" name="twitter_link" class="  updateCurrentText " value="<?php echo $g_setting->twitter_link; ?>">
                                
                            </div>
                  </div>

                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Gplus Link</span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" name="g_plus_link" class="  updateCurrentText " value="<?php echo $g_setting->g_plus_link; ?>">
                                
                            </div>
                  </div>

                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">InstaGram Link</span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" name="instagram_link" class="  updateCurrentText " value="<?php echo $g_setting->instagram_link; ?>">
                                
                            </div>
                  </div>

                     <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Copyright</span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" name="copyright" class="  updateCurrentText " value="<?php echo $g_setting->copyright; ?>">
                                
                            </div>
                  </div>

                       <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Custom Script (facebook pixcel or google analytic) </span> </label>
                            <div class="col-lg-9">
                               <textarea name="custom_script"><?php echo $g_setting->custom_script; ?></textarea>
                    
                                
                            </div>
                  </div>
                  <div class="form-group">
                          <label  class="control-label col-lg-3" ><span data-toggle="tooltip" class="label-tooltip" data-original-title="Product type">Hide Categories </span></label>
                            <div class="col-lg-9">
                              <?php 
                      $css = array(
                              'class' => 'pcategories'
                      );
                      $cats = explode(",",$g_setting->hide_categories);
             echo form_multiselect('product_categories[]', $categories,$cats,$css);

              ?>
                            
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




</div>

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<?php $this->load->view('inc/footer', $this->data); ?>
<script type="text/javascript" src='<?php echo base_url(); ?>admin-assets/plugins/ckeditor/ckeditor.js'></script>
<script type="text/javascript" src='<?php echo base_url(); ?>admin-assets/plugins/ckeditor/adapters/jquery.js'></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/admin-assets/js/chosen.jquery.js"></script>
<script type="text/javascript">
  $( '[data-rel^="ckeditor"]' ).ckeditor();

  $(document).ready(function(){
  $(".pcategories").chosen();
});
</script>



</body>
</html>