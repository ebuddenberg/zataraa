<?php 
  $this->load->view('inc/head', $this->data);
?>
<body id="pages" class="full-layout no-nav-left no-nav-right  nav-top-fixed background-login     responsive remove-navbar login-layout   clearfix"  >     
<div class="vd_body" >
<!-- Header Start -->

<!-- Header Ends --> 
<div class="content">
  <div class="container"> 
    
    <!-- Middle Content Start -->
    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_content-section clearfix" style="background-image: url(<?php echo base_url(); ?>/admin-assets/img/bgcolor.png);
    background-size: cover; background-repeat: no-repeat;" >
            <div class="vd_login-page" style="background: #fff;margin-bottom: 30px;box-shadow: 6px 8px 11px #000;">
              <div class="heading clearfix">
                <div class="logo" style="padding: 15px 0;">
                  <h2 class="mgbt-xs-5"><img src="<?php echo base_url(); ?>/admin-assets/img/logo.png" alt="logo"></h2>
                </div>
                <h4 class="text-center font-semibold vd_grey">CREATE A NEW ACCOUNT</h4>
              </div>
              <div class="panel widget">
                <div class="panel-body">
                  <div class="login-icon entypo-icon"> <i class="icon-key"></i> </div>

                  <form class="form-horizontal" method="post" id="login-form" action="<?php echo site_url('users/register'); ?>" role="form">

                  
                  
                  <?php if($this->session->flashdata('error') ||  validation_errors()){ ?>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>

                    <?php echo validation_errors(); ?> </div>
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>      
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong><?php echo $this->session->flashdata('success'); ?></strong>. </div>
                    <?php } ?>                  
                    <div class="form-group  mgbt-xs-20">
                      <div class="col-md-12">
                        <div class="label-wrapper sr-only">
                          <label class="control-label" for="email">Email</label>
                        </div>
                        <div class="vd_input-wrapper" id="email-input-wrapper" style="    margin-bottom: 25px;"> <span class="menu-icon"> <i class="fa fa-envelope"></i> </span>
                          <input type="email" placeholder="Email" id="email" name="email" class="required" required>
                        </div>
                         <div class="label-wrapper sr-only">
                          <label class="control-label" for="phone">Phone</label>
                        </div>
                        <div class="vd_input-wrapper" id="email-input-wrapper" style="    margin-bottom: 25px;"> <span class="menu-icon"> <i class="fa fa-envelope"></i> </span>
                          <input type="text" placeholder="phone" id="phone" name="phone" class="required" required>
                        </div>
                        <div class="label-wrapper">
                          <label class="control-label sr-only" for="password">Password</label>
                        </div>
                        <div class="vd_input-wrapper" id="password-input-wrapper" style="    margin-bottom: 25px;" > <span class="menu-icon"> <i class="fa fa-lock"></i> </span>
                          <input type="password" placeholder="Password" id="password" name="password" class="required" required>
                        </div>
                        <div class="label-wrapper">
                          <label class="control-label sr-only" for="password">Conform Password</label>
                        </div>
                        <div class="vd_input-wrapper" id="password-input-wrapper" > <span class="menu-icon"> <i class="fa fa-lock"></i> </span>
                          <input type="password" placeholder="Confirm Password" id="password" name="confirmpass" class="required" required>
                        </div>
                      </div>
                    </div>
                    <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                    <div class="form-group">
                      <div class="col-md-12 text-center mgbt-xs-5">
                        <button class="btn vd_bg-green vd_white width-100" type="submit" id="login-submit">Register</button>
                      </div>
                       <div class="col-md-12 text-center mgbt-xs-5">
                        <a class="btn vd_bg-green vd_white width-100" href="<?php echo site_url('users/login'); ?>">Login </a> </div>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-xs-6 text-right">
                            <div class=""> <a href="<?php echo site_url('users/forget_password'); ?>">Forget Password? </a> </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </form>


                </div>
              </div>
              <!-- Panel Widget -->
              <!-- <div class="register-panel text-center font-semibold"> <a href="pages-register.html">CREATE AN ACCOUNT<span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a> </div> -->
            </div>
            <!-- vd_login-page --> 
            
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
  <!-- <footer class="footer-2"  id="footer">      
    <div class="vd_bottom ">
        <div class="container">
            <div class="row">
              <div class=" col-xs-12">
                <div class="copyright text-center">
                  	Copyright &copy;2014 Venmond Inc. All Rights Reserved 
                </div>
              </div>
            </div> 
        </div> 
    </div>
  </footer> -->
<!-- Footer END -->

</div>

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<!--
<a class="back-top" href="#" id="back-top"> <i class="icon-chevron-up icon-white"> </i> </a> -->
<?php $this->load->view('inc/footer-admin', $this->data); ?>

</body>
</html>