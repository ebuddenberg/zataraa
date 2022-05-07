<?php $this->load->view('inc/header'); ?>

<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li><?php echo $cms->title ; ?></li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-contact-info">
    <div class="container">
        <?php echo $cms->content; ?>
    </div>
</div>

<?php $this->load->view('inc/footer'); ?>