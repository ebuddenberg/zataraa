<?php $this->load->view('inc/header'); ?>

<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li>Wishlist</li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-section--shopping ps-whishlist">
    <div class="container">
        <!--<div class="ps-section__header">-->
        <!--    <h1>Wishlist</h1>-->
        <!--</div>-->
        <div class="ps-section__content">
            <div class="table-responsive">
                <table class="table ps-table--whishlist" border="1" bordercolor="#ddd">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Product name</th>
                        <th>Unit Price</th>
                        <th>Stock Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
              <?php
               foreach ($products as $data) { 
               ?>
                    <tr>
                        <td><a href="<?php echo site_url('remove_wishlist/'.$data->id.''); ?>"><i class="icon-cross"></i></a></td>
                        <td>
                            <div class="ps-product--cart">
                                <div class="ps-product__thumbnail"><a href="#"><img src="<?php  echo base_url() ; ?>/admin-assets/images/<?php echo $data->product_image  ; ?>" alt=""></a></div>
                                <div class="ps-product__content"><a href="#"><?php $data->product_name; ?></a></div>
                            </div>
                        </td>
                        <td class="price">$<?php 
                        echo $price[$data->product_id] ;
                         ?></td>
                        <td><span class="ps-tag ps-tag--in-stock">In-stock</span></td>


                                         <?php                   
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name); 
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);
$slugs = str_replace(" ", '_', $slugs); ?>
                        <td><a class="ps-btn" href="<?php echo site_url('products/'.$slugs.''); ?>">Add to cart</a></td>
                    </tr>

<?php  } ?>

                    
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('inc/footer'); ?>