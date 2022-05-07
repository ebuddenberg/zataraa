<?php $this->load->view('inc/head', $this->data); ?>

<body id="dashboard" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="dashboard "  data-smooth-scrolling="1">     
<div class="vd_body">
<!-- Header Start -->
  <header class="header-1" id="header">
      <div class="vd_top-menu-wrapper">
        <div class="container ">
          <div class="vd_top-nav vd_nav-width  ">
          <div class="vd_panel-header">
          	<div class="logo">
            	<a href="index.html"><img alt="logo" src="<?php echo base_url(); ?>admin-assets/img/logo.png"></a>
            </div>
            <!-- logo -->
            <div class="vd_panel-menu  hidden-sm hidden-xs" data-intro="<strong>Minimize Left Navigation</strong><br/>Toggle navigation size to medium or small size. You can set both button or one button only. See full option at documentation." data-step=1>
            		                	<span class="nav-medium-button menu" data-toggle="tooltip" data-placement="bottom" data-original-title="Medium Nav Toggle" data-action="nav-left-medium">
	                    <i class="fa fa-bars"></i>
                    </span>
                                		                    
                	<span class="nav-small-button menu" data-toggle="tooltip" data-placement="bottom" data-original-title="Small Nav Toggle" data-action="nav-left-small">
	                    <i class="fa fa-ellipsis-v"></i>
                    </span> 
                                       
            </div>
            <div class="vd_panel-menu left-pos visible-sm visible-xs">
                                 
                        <span class="menu" data-action="toggle-navbar-left">
                            <i class="fa fa-ellipsis-v"></i>
                        </span>  
                            
                              
            </div>
            <div class="vd_panel-menu visible-sm visible-xs">
                	<span class="menu visible-xs" data-action="submenu">
	                    <i class="fa fa-bars"></i>
                    </span>        
                          
                        <span class="menu visible-sm visible-xs" data-action="toggle-navbar-right">
                            <i class="fa fa-comments"></i>
                        </span>                   
                   	 
            </div>                                     
            <!-- vd_panel-menu -->
          </div>
          <!-- vd_panel-header -->
            
          </div>    
          <div class="vd_container">
          	<div class="row">
            	<div class="col-sm-5 col-xs-12">
                </div>
                <div class="col-sm-7 col-xs-12">
              		<div class="vd_mega-menu-wrapper">
                    	<div class="vd_mega-menu pull-right">
            				<ul class="mega-ul">
    
      
      
     
    <li id="top-menu-profile" class="profile mega-li"> 
        <a href="#" class="mega-link"  data-action="click-trigger"> 
            <span  class="mega-image">
                <img src="<?php echo base_url(); ?>admin-assets/img/avatar/avatar.jpg" alt="example image" />               
            </span>
            <span class="mega-name">
                <?php echo $this->session->userdata('fname'); ?><i class="fa fa-caret-down fa-fw"></i> 
            </span>
        </a> 
      <div class="vd_mega-menu-content  width-xs-2  left-xs left-sm" data-action="click-target">
        <div class="child-menu"> 
        	<div class="content-list content-menu">
                <ul class="list-wrapper pd-lr-10">
                    <!-- <li> <a href="#"> <div class="menu-icon"><i class=" fa fa-user"></i></div> <div class="menu-text">Edit Profile</div> </a> </li> -->
                    <li class="line"></li> 
                    <li> <a href="#"> <div class="menu-icon"><i class=" fa fa-sign-out"></i></div>  <div class="menu-text">Sign Out</div> </a> </li>
                              
                </ul>
            </div> 
        </div> 
      </div>     
  
    </li>               
       
	</ul>
<!-- Head menu search form ends -->                         
                        </div>
                    </div>
                </div>

            </div>
          </div>
        </div>
        <!-- container --> 
      </div>
      <!-- vd_primary-menu-wrapper --> 

  </header>
  <!-- Header Ends --> 
<div class="content">
  <div class="container">
    
<?php 

$this->load->view('inc/left-menu', $this->data);
 ?>
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
                <li class="active">Report</li>
              </ul>
              <div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5  data-position="left">
    <div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"> <i class="fa fa-arrows-h"></i> </div>
      <div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>
      <div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>
      
</div>
 
            </div>
          </div>
          <!-- vd_head-section -->
          
          <div class="vd_title-section clearfix">
            <div class="vd_panel-header">
              <h1>Reports</h1>
              <small class="subtitle">Orders</small>
              <div class="vd_panel-menu  hidden-xs">
  <!-- menu -->
</div>
<!-- vd_panel-menu --> 
            </div>
            <!-- vd_panel-header --> 
          </div>
          <!-- vd_title-section -->
          
          <div class="vd_content-section clearfix">
           <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-green widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/order_amount_orders') ?>">
            <div class="clearfix">
             <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
                <span class="menu-value">
                    <?php echo $total_order ; ?>
                </span>  
            </div>   
            <div class="menu-text clearfix">
                Total Orders Till Now
            </div>                                                               
    </a>        
</div>                </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/order_this_month_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $current_month_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Orders This Month
        </div>  
     </a>                                                                
</div>                </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mgbt-xs-15">
                <div class="vd_status-widget vd_bg-blue widget">                             
    <a class="panel-body" href="<?php echo site_url('admin/orders/today_orders') ?>">                                  
        <div class="clearfix">
             <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
                <?php echo $today_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
            Today Orders
        </div>
     </a>                                                                  
</div>               </div>

    <div class="col-lg-4 col-md-6 col-sm-6 mgbt-xs-15">
                <div class="vd_status-widget vd_bg-blue widget">                             
    <a class="panel-body" href="<?php echo site_url('admin/orders/order_amount_orders') ?>">                                  
        <div class="clearfix">
             <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
                <?php echo round($get_order_amount,2) ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
            Orders Amount
        </div>
     </a>                                                                  
</div>               </div>
    
        
        <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/shipped_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $shipped_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Shipped Orders 
        </div>  
     </a>                                                                
</div>                </div>

        <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/confirmed_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $confirmed_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Confirmed Orders 
        </div>  
     </a>                                                                
</div>                </div>


        <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/processing_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $processing_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Processing Orders 
        </div>  
     </a>                                                                
</div>                </div>

    <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/on_hold_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $on_hold_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total On-Hold Orders 
        </div>  
     </a>                                                                
</div>                </div>

    <div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/completed_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $completed_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Completed Orders 
        </div>  
     </a>                                                                
</div>                </div>
<div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/cancelled_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $cancelled_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Cancelled Orders 
        </div>  
     </a>                                                                
</div>                </div>
<div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/refunded_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $refunded_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Refunded Orders 
        </div>  
     </a>                                                                
</div>                </div>
<div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/failed_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $failed_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Failed Orders 
        </div>  
     </a>                                                                
</div>                </div>
<div class="col-lg-4 col-md-6 col-sm-6 mgbt-sm-15">
                <div class="vd_status-widget vd_bg-red  widget">
                                 
    <a class="panel-body" href="<?php echo site_url('admin/orders/delivered_orders') ?>">                                
        <div class="clearfix">
            <span class="menu-icon">
                <i class="icon-bars"></i>
            </span>
            <span class="menu-value">
               <?php echo $delivered_order ; ?>
            </span>  
        </div>   
        <div class="menu-text clearfix">
           Total Delivered Orders 
        </div>  
     </a>                                                                
</div>                </div>
              
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
  

</div>

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<?php 

$this->load->view('inc/footer', $this->data);
 ?>


</body>
</html>