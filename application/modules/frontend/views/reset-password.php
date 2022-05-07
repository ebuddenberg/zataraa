<!-- End of Data -->
<?php $this->load->view('inc/head', $this->data); ?>

<body id="pages" class="full-layout no-nav-left no-nav-right  nav-top-fixed background-login     responsive remove-navbar login-layout   clearfix" data-active="pages "  data-smooth-scrolling="1">     
<div class="vd_body">
<!-- Header Start -->

<!-- Header Ends --> 
<div class="content"><div class="container">





<!-- Middle Content Start -->

<div class="vd_content-wrapper">
    <div class="vd_container">
    
        <div class="vd_content clearfix">               
            <div class="vd_content-section clearfix" style="background-image: url(<?php  echo base_url() ; ?>/admin-assets/img/bgcolor.png);
    background-size: cover; background-repeat: no-repeat;">  

            <div class="vd_login-page" style="background: #fff;margin-bottom: 30px;box-shadow: 6px 8px 11px #000;">     
            	<div class="heading clearfix" >
                	<div class="logo" style="padding: 15px 0;"><h2 class="mgbt-xs-5"><img src="<?php  echo base_url() ; ?>/admin-assets/img/logo.png" alt="logo"></h2></div>
                    <h4 class="text-center font-semibold vd_grey">UPDATE PASSWORD FORM</h4>                     
                </div>
               
                <div class="panel widget">
                    <div class="panel-body">
                    
                          <div class="login-icon">
                                <i class="fa fa-lock"></i>
                          </div>            
                          <form class="form-horizontal"  method="post" role="form" id="forget-password-form" action="<?php echo site_url('users/reset_password'); ?>">

                              <?php if($this->session->flashdata('error') ||  validation_errors()){ ?>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>

                    <?php echo validation_errors(); ?> </div>
                  <?php } ?>
                  <?php if($this->session->flashdata('success')){ ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span> <?php echo $this->session->flashdata('success'); ?></div> 
                  <?php } ?>

                             <div class="form-group mgbt-xs-20">
                                 <div class="col-md-12">
                                 	<p class="text-center"><strong>Enter Your New Password.</strong> </p>
                                    <div class="vd_input-wrapper" id="email-input-wrapper">
                                        <span class="menu-icon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <input type="password" placeholder="New Password" id="email" name="password" class="required">
                                    </div>
                                        <div class="vd_input-wrapper" id="email-input-wrapper">
                                        <span class="menu-icon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <input type="password" placeholder="Conform  Password" id="email" name="confirmpass" class="required">
                                        <input type="hidden" name="key" value="<?php echo $this->input->get('key'); ?>">
                                    </div>     
                                
                                  </div>                            
                            </div>   
                            
                                                                                                        
                            <div class="form-group" id="submit-password-wrapper">
                              <div class="col-md-12 text-center mgbt-xs-5">
                                  <button class="btn vd_bg-green vd_white width-100" type="submit" id="submit-password" name="submit-password">Update password</button>   
                              </div>

                            </div>
                          </form>

                          
                    </div>
                </div> <!-- Panel Widget --> 
                <div class="register-panel text-center font-semibold">	
                	<a href="<?php echo site_url('users/login') ; ?>" class="btn vd_bg-green vd_white width-100" style="width: 85% !important; margin-bottom: 14px;">LOGIN</a> <!-- <span class="mgr-10 mgl-10">|</span>  	
                    <a href="pages-register.html">CREATE AN ACCOUNT</a>   -->	
                </div>
                </div> <!-- vd_login-page -->

                
                                                           
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
  

</div>

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>

<?php $this->load->view('inc/footer-admin' , $this->data); ?>

</body>
</html>