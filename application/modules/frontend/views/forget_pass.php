<?php $this->load->view('inc/head'); ?>

<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li>Forget Password</li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-my-account">
    <div class="container">
    
            <div class="ps-form--account ps-tab-root">
                
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
                                      <?php echo $this->session->flashdata('success'); ?>
                                   </div>
 <?php } ?>    

                                </div>
                        <h5>Forget password</h5>
                        <form action="<?php  echo site_url('users/forget_password'); ?>" method="post">
                        <div class="form-group">
                            <input class="form-control" name="email" type="text" placeholder="Username or email address">
                        </div>
        
                        
                        <div class="form-group submtit">
                            <button type="submit" class="ps-btn ps-btn--fullwidth">Froget Password</button>
                        </div>
                        </form>
                    </div>
                    <div class="ps-form__footer">
                        <p></p>
                        
                    </div>
                
            </div>
    </div>
</div>

<?php $this->load->view('inc/footer'); ?>