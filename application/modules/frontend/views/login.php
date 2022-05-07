<?php $this->load->view('inc/head'); ?>

<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li>Login</li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-my-account">
    <div class="container">
    
            <div class="ps-form--account ps-tab-root">
            <ul class="ps-tab-list">
                <li class="active"  id="login-btn"><a href="#sign-in">Login</a></li>
                <li id="reg-btn"><a href="#register" >Register</a></li>
            </ul>
            <div class="ps-tabs">
                <div class="ps-tab active" id="sign-in">
                    <div class="ps-form__content">
                        <div class="text-center w-75 m-auto">
                                   
                             
<?php if($this->session->flashdata('error') ||  validation_errors()){ ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                           <span aria-hidden="true">×</span>
                                       </button>
                                       <?php echo $this->session->flashdata('error'); ?>

                    <?php echo validation_errors(); ?> 
                                   </div>

<?php } ?>
<?php if($this->session->flashdata('success')){ ?>  
                                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                           <span aria-hidden="true">×</span>
                                       </button>
                                       Success !
                                   </div>
 <?php } ?>    

                                </div>
                        <h5>Log In Your Account</h5>
                        <form action="<?php  echo site_url('users/login'); ?>" method="post">
                        <div class="form-group">
                            <input class="form-control" name="email" type="text" placeholder="Username or email address">
                        </div>
                        <div class="form-group form-forgot">
                            <input class="form-control" name="password" type="password" placeholder="Password"><a href="<?php echo site_url('users/forget_password') ; ?>">Forgot?</a>
                        </div>
                        <div class="form-group">
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="remember-me" name="remember-me"/>
                                <label for="remember-me">Rememeber me</label>
                            </div>
                        </div>
                        <div class="form-group submtit">
                            <button type="submit" class="ps-btn ps-btn--fullwidth">Login</button>
                        </div>
                        </form>
                    </div>
                    <div class="ps-form__footer">
                        <p>Connect with:</p>
                       <ul class="ps-list--social">
                            <li><a class="facebook" href="<?php
if(!empty($authUrl)) { echo  $authUrl ; } ?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="google" href="<?php echo  $loginURL; ?>"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="ps-tab" id="register">
                    <div class="ps-form__content">
                                                <div class="text-center w-75 m-auto">
                                   
                             
<?php if($this->session->flashdata('error') ||  validation_errors()){ ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                           <span aria-hidden="true">×</span>
                                       </button>
                                       <?php echo $this->session->flashdata('error'); ?>

                    <?php echo validation_errors(); ?> 
                                   </div>

<?php } ?>
<?php if($this->session->flashdata('success')){ ?>  
                                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                           <span aria-hidden="true">×</span>
                                       </button>
                                       Success !
                                   </div>
 <?php } ?>    

                                </div>
                        <h5>Create An Account</h5>
                        <form action="<?php  echo site_url('users/register'); ?>" method="post">
                        <div class="form-group">
                            <input class="form-control" name="first_name" type="text" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="last_name" type="text" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="Email Address" name="email">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="tel" placeholder="Phone Number" name="user_phone">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="password" type="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="conf_password" type="password" placeholder="Password">
                        </div>
                        <div class="form-group submtit">
                            <button type="submit" class="ps-btn ps-btn--fullwidth">Register</button>
                        </div>

                        
                        </form>
                    </div>
                    <div class="ps-form__footer">
                        <p>Connect with:</p>
                        <ul class="ps-list--social">
                            <li><a class="facebook" href="<?php
if(!empty($authUrl)) { echo  $authUrl ; } ?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="google" href="<?php echo  $loginURL; ?>"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('inc/footer'); ?>