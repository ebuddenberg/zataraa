<?php $this->load->view('inc/header'); ?>

<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li>Contact</li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-contact-info">
    <div class="container">
        <div class="ps-section__header">
            <h3><?php echo $contact->contact_title ; ?></h3>
        </div>
        <div class="ps-section__content">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                    <div class="ps-block--contact-info">
                        <h4><?php echo $contact->sec_1_title ; ?></h4>
                        <p><?php echo $contact->sec_1_cont ; ?></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                    <div class="ps-block--contact-info">
                        <h4><?php echo $contact->sec_2_title ; ?></h4>
                        <p><span><?php echo $contact->sec_2_cont ; ?></span></p>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                    <div class="ps-block--contact-info">
                        <h4><?php echo $contact->sec_3_title ; ?></h4>
                        <p><?php echo $contact->sec_3_cont ; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ps-contact-form">
    <div class="container">
        <form class="ps-form--contact-us" action="" method="get">
            <h3>Get In Touch</h3>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Name *">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Email *">
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Subject *">
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="form-group">
                        <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group submit">
                <button class="ps-btn">Send message</button>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('inc/footer'); ?>