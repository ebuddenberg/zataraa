<?php $this->load->view('inc/header'); ?>

<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li>Checkout</li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-checkout ps-section--shopping">
    <div class="container">
        <div class="ps-section__header" style="padding-bottom: 40px">
            <h1>Order Details</h1>
        </div>
        <div class="ps-section__content">
           
        <div class="ps-section__header">
        <h4> Thaks for your order</h4>
        <h6>Your Order Id : Z37<?php echo str_pad($order_id, 8, '0', STR_PAD_LEFT); ?></h6>  
        <a  style="color: #000; font-weight: bold;" href="<?php echo site_url('products') ?>"> <<< Shop More Products</a>    
        </div>

        </div>
    </div>
</div>
<?php $this->load->view('inc/footer'); ?>
