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
              <h1>Home Page Settings</h1>
       </div>
          </div>
          <div class="vd_content-section clearfix">
            <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title" style="display: inline-block;"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Home Page Settings  <span> </span></h3>
                    
                  </div>
                  <div class="panel-body table-responsive">
                    <form action="<?php echo site_url('admin/update_home_settings') ; ?>" class="form-horizontal" id="login-form" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                        
                        <input type="hidden" id="id" name="id" value="1">


                        <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Slider One </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="home_page_slider_one">
                            </div>
                      </div>

                      <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Slider Two </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="home_page_slider_two">
                            </div>
                      </div>
                      <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Slider Three </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="home_page_slider_three">
                            </div>
                      </div>

                      <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Slider One link </span> </label>
                            <div class="col-lg-9">    
                              <input type="text" name="h_slider_one_link"  value="<?php echo $home_setting->h_slider_one_link ; ?>">
                            </div>
                      </div>


                           <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Slider Two link</span> </label>
                            <div class="col-lg-9">    
                              <input type="text" name="h_slider_two_link" value="<?php echo $home_setting->h_slider_two_link ; ?>">
                            </div>
                      </div>


                           <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Slider Three link</span> </label>
                            <div class="col-lg-9">    
                              <input type="text" name="h_slider_three_link" value="<?php echo $home_setting->h_slider_two_link ; ?>">
                            </div>
                      </div>
<div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Slider Three link</span> </label>
                            <div class="col-lg-9">    
                              <input type="text" name="h_slider_three_link" value="<?php echo $home_setting->h_slider_two_link ; ?>">
                            </div>
                      </div>
<div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Section one cat link</span> </label>
                            <div class="col-lg-9">    
                              <input type="text" name="section_one_cat_link" value="<?php echo $home_setting->section_one_cat_link ; ?>">
                            </div>
                      </div>



                      <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Section two cat link</span> </label>
                            <div class="col-lg-9">    
                              <input type="text" name="section_two_cat_link" value="<?php echo $home_setting->section_two_cat_link ; ?>">
                            </div>
                      </div>
  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Section three  cat link</span> </label>
                            <div class="col-lg-9">    
                              <input type="text" name="section_three_cat_link" value="<?php echo $home_setting->section_three_cat_link ; ?>">
                            </div>
                      </div>

                      
                       <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Adv One </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="home_page_adv_one">
                            </div>
                      </div>

                      <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Adv Two </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="home_page_adv_two">
                            </div>
                      </div>

                      <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Adv Three </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="home_page_adv_three">
                            </div>
                      </div>

                      <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Home Page Adv Four </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="home_page_adv_four">
                            </div>
                      </div>
                
                
                    <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Cat Section one Title </span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" required="" name="sec_1_title"  class="  updateCurrentText " value="<?php echo  $home_setting->sec_1_title ; ?>">
                                
                            </div>
                  </div>

                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Hide cat section one </span> </label>
                            <div class="col-lg-9">
                               
                                 <?php 
                               $option = array('no' =>'no','yes' =>'yes');
              $hide_section_one =$home_setting->hide_section_one;
                     
               echo form_dropdown('hide_section_one', $option,$hide_section_one); ?>
                                  <!-- <select name="hide_setion_one">
                                    <option>no</option>
                                    <option>yes</option>
                                  </select> -->
                                
                            </div>
                  </div>
                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Section one categories </span> </label>
                            <div class="col-lg-9">
                            
                                   <?php 
$cats_one =$home_setting->section_1_cats ;

                      $css = array(
                              'class' => 'pcategories pmcat'
                      );
               echo form_dropdown('section_1_cats', $cats,$cats_one,$css); ?>       
                                
                            </div>
                  </div>
                     <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">section one Baneer one  </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="section_one_banner_one">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">section one Baneer two  </span> </label>
                            <div class="col-lg-9">   
                            <input type="file" name="section_one_banner_two"> 
                            </div>
                          </div>




                    <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Cat Section two Title </span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" required="" name="sec_2_title" class="  updateCurrentText " value="<?php echo  $home_setting->sec_2_title ; ?>">
                                
                            </div>
                  </div>
                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Hide cat section Two </span> </label>
                            <div class="col-lg-9">
                               
                               <?php 
                                  $option = array('no' =>'no','yes' =>'yes');
              $hide_section_two =$home_setting->hide_section_two ;
                     
               echo form_dropdown('hide_section_two', $option,$hide_section_two); ?>
                                
                                  <!-- <select name="hide_setion_two">
                                    <option>no</option>
                                    <option>yes</option>
                                  </select> -->
                                
                            </div>
                  </div>
                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Section two categories </span> </label>
                            <div class="col-lg-9">
                             <?php 

                             $cats_two =$home_setting->section_2_cats ;

                      $css = array(
                              'class' => 'pcategories pmcat'
                      );
               echo form_dropdown('section_2_cats', $cats,$cats_two,$css); ?>
                                  
                                
                            </div>
                  </div>

                    <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">section two Baneer one  </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="section_two_banner_one">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">section two Baneer two  </span> </label>
                            <div class="col-lg-9">   
                            <input type="file" name="section_two_banner_two"> 
                            </div>
                          </div>


                    <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Cat Section Three Title </span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" required="" name="sec_3_title" class="  updateCurrentText " value="<?php echo  $home_setting->sec_3_title ; ?>">
                                
                            </div>
                  </div>
                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Hide cat section Three </span> </label>
                            <div class="col-lg-9">
                               
                              <?php 
                                 $option = array('no' =>'no','yes' =>'yes');
              $hide_section_three =$home_setting->hide_section_three;
                     
               echo form_dropdown('hide_section_three', $option,$hide_section_three); ?>    
                                  <!-- <select name="hide_setion_three">
                                    <option>no</option>
                                    <option>yes</option>
                                  </select> -->
                                
                            </div>
                  </div>
                  <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">Section Three categories </span> </label>
                            <div class="col-lg-9">
              <?php 

              $cats_three =$home_setting->section_3_cats ;
                      $css = array(
                              'class' => 'pcategories pmcat'
                      );
               echo form_dropdown('section_3_cats', $cats,$cats_three,$css); ?>
                                  
                                
                            </div>
                  </div>
 <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">section three Baneer one  </span> </label>
                            <div class="col-lg-9">    
                              <input type="file" name="section_three_banner_one">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="page title">section three Baneer two  </span> </label>
                            <div class="col-lg-9">   
                            <input type="file" name="section_three_banner_two"> 
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
<link href="<?php echo site_url(); ?>/admin-assets/css/chosen.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>/admin-assets/js/chosen.jquery.js"></script>
<script type="text/javascript">
  $( '[data-rel^="ckeditor"]' ).ckeditor();

  $(document).ready(function(){
  $(".pcategories").chosen();
});
</script>



</body>
</html>