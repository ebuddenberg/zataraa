<?php  $this->load->view('inc/header'); ?>
<style type="text/css">.ps-product__desc ul {
    margin-bottom: 2rem;
    margin: 0;
    padding: 0;
}
/*submenu*/
.breadcrumb_sub {
    position: absolute;
    background: #fff;
    border: 1px solid #ddd;
    z-index: 99;
    padding: 10px;
    min-width: 167px;
}
.breadcrumb_sub {
    display: none;
}
.breadcrumb_sub p {
    margin-bottom: 5px;
}
ul.breadcrumb li:hover > .breadcrumb_sub {
    display: block;
    transform: all 1.5;
}
/*submenu*/
</style>
<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">

            <li><a href="<?php echo site_url(); ?>">Home</a></li>
<?php 
    $images = array();
foreach ($variable_product as $data) {
    $images[] = $data->image ;
}

$image = json_decode($product->imgOption);

if($image != ''){
foreach ($image as $data) { 
$images[] =  $data ;
}
}

$images = array_unique($images);



    $var = explode('/', $product->product_categories);
$i = 0 ; 
    foreach ($var as $data) {

$cat = ltrim($data);
$slugs = str_replace(" & ", '----',$cat );
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs);
if($i == 0){
    $slugs = $slugs.'&parent=true' ;
}elseif($i == 1){
 $slugs = $slugs.'&sub_child=true' ;
}else{
    $slugs =  $slugs ;
}
     ?>
       
  
            <li><a href="<?php echo site_url('categories/?cats='.$slugs.''); ?>" ><?php echo $cat ; ?> </a>

                
                    <?php if($i == 0){
                        echo '<div class="breadcrumb_sub">';
                        foreach ($parent__cats as $data) {
                           $slugs = str_replace(" & ", '----',$data->categories_name );
                            $slugs = str_replace(', ', '--', $slugs);
                            $slugs = str_replace("'", '---', $slugs); 
                            $slugs = str_replace(" ", '_', $slugs);
                           echo ' <p><a href="'.site_url('categories/?cats='.$slugs.'&sub_child=true').'">'.$data->categories_name.'</a></p>';
                           
                        }
                        echo '</div>';
                    }elseif($i == 1){

                        echo '<div class="breadcrumb_sub">';

                        foreach ($parent_sub_cats as $data) {
                           $slugs = str_replace(" & ", '----',$data->categories_name );
                            $slugs = str_replace(', ', '--', $slugs);
                            $slugs = str_replace("'", '---', $slugs); 
                            $slugs = str_replace(" ", '_', $slugs);
                           echo ' <p><a href="'.site_url('categories/?cats='.$slugs.'').'">'.$data->categories_name.'</a></p>';
                        }

                        echo '</div>';
                    } ?>
                   
                     
                
            </li>
<?php    $i++ ; }
 ?>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-page--product ps-page--product-box">
    <div class="container">
        <div class="ps-product--detail ps-product--box">
            <div class="ps-product__header ps-product__box row">
             <div class="product_show col-md-4"> 
                <!-- new_gallery -->
                <div class="product_show_info"> 
                <?php    $i = 0 ;
foreach ($variable_product as $data) {
   
    if($i == 0){
?>
<input type="hidden" name="sku" data-id="<?php echo $data->sku ; ?>">
<input type="hidden" name="img" data-id="<?php echo $data->image ; ?>">
<?php
}
$i++;
}
 ?>
</div>
                <div class="exzoom hidden" id="exzoom">
                    <div class="exzoom_img_box">
                        <ul class='exzoom_img_ul'>
                            <?php
                 foreach ($images as $data){  ?>
                            <li><img src="<?php  echo base_url(); ?>/admin-assets/images/<?php echo $data; ?>"/></li>
                             <?php }  ?>
                        </ul>
                    </div>
                    <div class="exzoom_nav"></div>
                    <p class="exzoom_btn">
                        <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                        <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                    </p>
                </div>
                <!-- new_gallery -->
              </div>
                <div class="ps-product__info col-md-8">
                    <h1><?php echo $product->product_name; ?></h1>
                    <div class="ps-product__meta">
                         
                            <!--Brand:--><a href="<?php echo site_url() ; ?>"><?php echo $product->product_brand ; ?></a> 
                       <div class="star-ratings-sprite"><span style="width:<?php echo $product->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span><span class="rating_count">(<?php echo $product->count_ratings ; ?>)</span></div>

                    </div>
                    <h4 class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <span class="product_det_price">
                        <?php  echo $this->frontend_m->convert(round(($product->price+$product->price*(int)$product->comission/100) - ($product->price*(int)$product->comission/100)*(int)$product->product_offer/100,2)) ; 
                        if($product->product_offer >0 ){
                          echo '<del > '.$this->frontend_m->convert(($product->price+$product->price*$product->comission/100)).'</del>' ;
                        }?>
                    <?php if($product->product_offer >0 ){
                      echo ' <div class="ps-product__badge" style="position: inherit">'.
                      (int) $this->frontend_m->cal_percent($this->frontend_m->convert(round(($product->price+$product->price*$product->comission/100) - ($product->price*$product->comission/100)*$product->product_offer/100,2)) , $this->frontend_m->convert(($product->price+$product->price*$product->comission/100)) ).'%</div>';
                    } ?>

                    </span></h4>
                    <input type="hidden" name="price" value="<?php  echo $this->frontend_m->convert(round(($product->price+$product->price*(int)$product->comission/100) - ($product->price*(int)$product->comission/100)*(int)$product->product_offer/100,2)); ?>">

                    <div class="ps-product__desc">
                        
                    

                        <?php 
                            echo $product->product_short_disc;
                         ?>
                    </div>
                    <div class="ps-product__variations">
         <?php  

$var_type = json_decode($product->commodityDifference) ;
if($var_type[0] != ""){
$var_type_count = count($var_type);
$var_type_value = array();

foreach ($variable_product as $data) {
$var_type_val = json_decode($data->varietyCommodityDifferenceOption);
for ($x = 0; $x < $var_type_count; $x++) {
    $var_type_value[$var_type[$x]][] = $var_type_val[$x] ;
} 

}
?>
 <form class="variation">
<?php


foreach ($var_type as $data) {

 $var_type_option = array_unique($var_type_value[$data]);
  ?>
     <div class="ps-size">
                            <div class="form-group">
                          <label><?php echo $data ; ?>:</label>
                          <select name="<?php echo $data ; ?>" class="form-control notranslate option-drp" required  >
                             <option>--Select--</option>
                            <?php
                            foreach ($var_type_option as $data) {
                                ?>
                                <option><?php echo $data ; ?></option>
                                <?php
                            }
                             ?>
                          </select>
                        </div>
                        </div>

<?php 
} }
 ?>
</form>
                    </div>
                    <div class="ps-product__shopping">
                        <figure >
                            <figcaption>Quantity</figcaption>
                            <div class="form-group--number">
                                <button class="up"><i class="fa fa-plus"></i></button>
                                <button class="down"><i class="fa fa-minus"></i></button>
                                <input class="form-control input-qty" min="1" type="number" max="<?php echo $product->product_quantity ; ?>" value="1" placeholder="1">
                            </div>
                        </figure><a class="ps-btn ps-btn-gray add_to_cart" data-id="<?php echo $product->id ; ?>"  data-name="<?php echo $product->product_name ; ?>" href="#">Add to cart</a>
                        <a class="ps-btn buy_now" data-id="<?php echo $product->id ; ?>" data-name="<?php echo $product->product_name ; ?>" href="#">Buy Now</a>
                    </div>
                    <div class="ps-product__specification">
                        <!-- <a class="report" href="#">Report Abuse</a> -->
                <?php  $i = 0 ;
foreach ($variable_product as $data) {
   
    if($i == 0){  ?>
        <p><strong>Total Price:</strong><span class="total-price"><?php echo $this->frontend_m->convert(round(($product->price+$product->price*(int)$product->comission/100) - ($product->price*(int)$product->comission/100)*(int)$product->product_offer/100,2)) ?></span></p>
                        <p><strong>SKU:</strong> ZAT37<span class="sku-d"><?php echo substr($data->sku,5) ; ?></span></p>

                    <?php } $i ++ ;}?>
                        <p class="categories"><strong> Categories:</strong>

                            <?php  $cats = explode('/', $product->product_categories);
                             $var = ltrim(end($cats)) ;
                             ?>
<?php $slugs = str_replace(" & ", '----',$var );
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs);  ?>
                            <a href="<?php echo site_url('categories/?cats='.$slugs.'') ; ?>"><?php   echo $product->product_categories  ; ?></a>,
                    </div>
                    <div class="ps-product__sharing">

<!-- Sharingbutton Facebook -->
<a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode(current_url()); ?>" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Twitter -->
<a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=<?php echo urlencode($product->product_name); ?>&amp;url=<?php echo urlencode(current_url()); ?>" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Tumblr -->
<a class="resp-sharing-button__link" href="https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=<?php echo urlencode($product->product_name); ?>&amp;content=<?php echo urlencode(current_url()); ?>&amp;canonicalUrl=<?php echo urlencode(current_url()); ?>&amp;shareSource=tumblr_share_button" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--tumblr resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.5.5v5h5v4h-5V15c0 5 3.5 4.4 6 2.8v4.4c-6.7 3.2-12 0-12-4.2V9.5h-3V6.7c1-.3 2.2-.7 3-1.3.5-.5 1-1.2 1.4-2 .3-.7.6-1.7.7-3h3.8z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Pinterest -->
<a class="resp-sharing-button__link" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(current_url()); ?>&amp;media=<?php echo urlencode(current_url()); ?>&amp;description=<?php echo urlencode($product->product_name); ?>" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--pinterest resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.14.5C5.86.5 2.7 5 2.7 8.75c0 2.27.86 4.3 2.7 5.05.3.12.57 0 .66-.33l.27-1.06c.1-.32.06-.44-.2-.73-.52-.62-.86-1.44-.86-2.6 0-3.33 2.5-6.32 6.5-6.32 3.55 0 5.5 2.17 5.5 5.07 0 3.8-1.7 7.02-4.2 7.02-1.37 0-2.4-1.14-2.07-2.54.4-1.68 1.16-3.48 1.16-4.7 0-1.07-.58-1.98-1.78-1.98-1.4 0-2.55 1.47-2.55 3.42 0 1.25.43 2.1.43 2.1l-1.7 7.2c-.5 2.13-.08 4.75-.04 5 .02.17.22.2.3.1.14-.18 1.82-2.26 2.4-4.33.16-.58.93-3.63.93-3.63.45.88 1.8 1.65 3.22 1.65 4.25 0 7.13-3.87 7.13-9.05C20.5 4.15 17.18.5 12.14.5z"/></svg>
    </div>
  </div>
</a>


                    </div>
                </div>
            </div>
            <div class="ps-product__content ps-tab-root">
                <div class="row">
                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-product__box">
                            <ul class="ps-tab-list">
                                <li class="active"><a href="#tab-1">Description</a></li>
                                <!-- <li><a href="#tab-2">Specification</a></li>
                                <li><a href="#tab-3">Vendor</a></li> -->
                                <li><a href="#tab-4">Reviews (<?php echo $product->count_ratings ; ?>)</a></li>
                                <!-- <li><a href="#tab-5">Questions and Answers</a></li> -->
                                <li><a href="#tab-6">More Offers</a></li>
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab active" id="tab-1">
                                    <div class="ps-document">
                                        <?php echo $product->product_long_disc ; ?>
                                    </div>
                                </div>
                        
                                <div class="ps-tab" id="tab-4">
                                    <div class="row">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
                                            <div class="ps-block--average-rating">
                                                <div class="ps-block__header">
                                                    <h3><?php echo $product->avg_ratings ; ?></h3>
                                               <div class="star-ratings-sprite"><span style="width:<?php echo $product->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>

                                              <span><?php echo $product->count_ratings ; ?> Review</span>
                                                </div>
                                                
                                               
                                                
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                            <form class="ps-form--review" action="#" method="post">
                                                <h4>Submit Your Review</h4>
                                                <p>Your email address will not be published. Required fields are marked<sup>*</sup></p>
                                                <div class="form-group form-group__rating">
                                                    <label>Your rating of this product</label>
                                                    <select class="ps-rating" data-read-only="false" name="rating" required="">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="review" required="" class="form-control" rows="6" placeholder="Write your review here"></textarea>
                                                </div>
                                                <div class="row">
<input type="hidden" name="product_id" value="<?php echo  $product->product_id; ?>">
                                                    <?php $id = $this->session->userdata('id');
if(!$id){
    ?>

                                               
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                        <div class="form-group">
                                                            <input name="names" required class="form-control" type="text" placeholder="Your Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                        <div class="form-group">
                                                            <input class="form-control" 
required="" 
                                                            name="email"type="email" placeholder="Your Email">
                                                        </div>
                                                    </div>
<?php } ?>

                                                </div>
                                                <div class="form-group submit">
                                                    <button class="ps-btn sub-review">Submit Review</button>
                                                </div>
                                            </form>


<div class="review-block">
<?php foreach ($reviews as $data) { ?>
   

                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?php echo  base_url() ; ?>/frontend-assets/img/profile.jpeg" class="img-rounded">
                            <div class="review-block-name"><?php echo $data->name ; ?></div>
                            <div class="review-block-date">
<?php $old_date_timestamp = strtotime($data->createdat);
echo $new_date = date('Y-m-d', $old_date_timestamp);   ?>
                                </div>
                        </div>
                        <div class="col-sm-9">
                              <div class="star-ratings-sprite"><span style="width:<?php echo $data->rating * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>

                            <div class="review-block-description">
                                <?php echo $data->review; ?>
                            </div>
                        </div>
                    </div>
                    <hr/>


<?php } ?>
                    
                   
                    
                </div>


                                        </div>
                                    </div>
                                </div>
                               
                                <div class="ps-tab" id="tab-6">
                                    <p>Sorry no more offers available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="ps-section--default">
            <div class="ps-section__header">
                <h3>Related products</h3>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">

                    <?php foreach ($related_products as $data) {
$p_name =$data->product_name ;
$slugs = str_replace(" + ", '___', $p_name);
$slugs = str_replace(" & ", '----', $slugs);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs);
                        ?>
                    
                
                    <div class="ps-product">
                  
                        <div class="ps-product__thumbnail"><a href="<?php  echo site_url('products/'.$slugs.'');  ?>"><img src="<?php  echo base_url(); ?>/admin-assets/images/<?php  echo $data->product_image ; ?>" alt=""/></a>
                            <?php if($data->product_offer != NULL){ ?>
                            <?php 
                            if($data->product_offer != 0){
                                echo '<div class="ps-product__badge">-'. (int)$this->frontend_m->cal_percent($this->frontend_m->convert(($data->price+$data->price*$data->comission/100)) ,$this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ).'%'.'</div>' ;
                            }
                             ?>

                        <?php } ?>
                            <ul class="ps-product__actions">
                                <li><a href="<?php  echo site_url('products/'.$slugs.'');  ?>" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                <li><a href="#" class="add_to_wishlist" data-id="<?php  echo $data->id ; ?>" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart "></i></a></li>
                            </ul>
                        </div>
                        <div class="ps-product__container">
                            <div class="ps-product__content"><a class="ps-product__title" href="<?php  echo site_url('products/'.$data->slugs.'');  ?>"><?php echo $data->product_name ;  ?></a>
                                
                     <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span><span class="rating_count">(<?php echo $data->count_ratings ; ?>)</span></div>

                                <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php 
                                 echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price+$data->price*$data->comission/100)*$data->product_offer/100,2));
                     if($product->product_offer >0 ){
                          echo '<del > '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        }?>
                                </p>
                            </div>
                            <div class="ps-product__content hover"><a class="ps-product__title" href="<?php  echo site_url('products/'.$slugs.'');  ?>"><?php echo $data->product_name  ; ?></a>
                                <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?><?php 
                                // echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ;
                                echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price+$data->price*$data->comission/100)*$data->product_offer/100,2));
                     if($product->product_offer >0 ){
                          echo '<del > '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        }?></p>
                            </div>
                        </div>
                    </div>
   <?php  } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--- Footer --->
<?php  $this->load->view('inc/footer'); ?>

<script type="text/javascript">
var colorValue = "";
var sizeValue = "";

$(".up").click(function() {
    var qty = $('.input-qty').val();
    qty = parseInt(qty)+1;
    $('.input-qty').val(qty);
   
});
$(".down").click(function() {
      var qty = $('.input-qty').val();
      if(qty !=1){
         qty = parseInt(qty)-1;
         $('.input-qty').val(qty);
      }
    
});

   $('.add_to_cart').on('click', function(e) {
      if(colorValue === '' && sizeValue === ''){
           e.preventDefault();
            alert("Please select variation.");
        }else{
        var id  = $("input[name='sku']").data("id");
        var qty = $('.input-qty').val();
        var price  = $("input[name='price']").val();
        var image  = $("input[name='img']").data("id");
        var name = $(this).data("name");
         $.ajax({
            type: "post",
            url:'<?php echo site_url('cart/add_cart'); ?>',
            data:{qty,id,price,image,name},
            cache: false,       
            success: function(response){            
             //alert('cover Ima(ge Changed');  
             $(".ps-btn-gray").html("Added to cart"); 
             $('.mini-cart-count').html(response);

                $.ajax({
                    type: "post",
                    url:'<?php echo site_url('cart/mini_cart'); ?>',
                    data:{},
                    cache: false,       
                    success: function(data){            
                     //alert('cover Image Changed');  
                      $('.ps-cart__content').html(data);
                    },
                    error: function(){            
                      alert('Error while request..');
                    }
                 });

            },
            error: function(){            
              alert('Error while request..');
            }
        });
        }
     });



    $("select.option-drp").change(function(e){

    if($( this ).attr("name") == "Color"){
        colorValue = $(this).val();
    }
    if($( this ).attr("name") == "Size"){
        sizeValue =$(this).val();
    }
      var data = $("form.variation").serialize();
       var id = "<?php echo $product->product_id; ?>";
      $.ajax({
        type: "post",
        url:'<?php echo site_url('get_commodityDifferenceOption'); ?>',
        data:data,
        cache: false,       
        success: function(data){            
            var id = "<?php echo $product->product_id; ?>";
            var data = data ;
            $.ajax({
            type: "post",
            url:'<?php echo site_url('get_variation_details'); ?>',
            data:{data ,id},
            cache: false,       
            success: function(response){   
             response = response.trim() ;       
                obj = JSON.parse(response);
                $('.product_det_price').html(obj.price);
                $('..ps-product__price del').html(obj.del);
                $("input[name='price']").val(obj.price);
                var img_url = '<?php echo base_url(); ?>admin-assets/images/'+obj.image; 

                 // $('.product_show').html('<input type="hidden" name="img" data-id="'+obj.image+'" tabindex="0"><input type="hidden" name="sku" data-id="'+obj.sku+'" tabindex="0"><div class="show" href="<?php  echo base_url('admin-assets/images/'); ?>'+obj.image+'" style="position: relative;"><img src="<?php  echo base_url('admin-assets/images/'); ?>'+obj.image+'" id="show-img"></div>');
$('.exzoom_preview_img').attr('src',  '<?php echo base_url(); ?>admin-assets/images/'+obj.image+'') ;     
$('p.exzoom_nav_inner span').removeClass('current');   
$('.sku-d').text(obj.sku.substr(5));
$('.exzoom_nav_inner').find('img[src="<?php echo base_url(); ?>/admin-assets/images/'+obj.image+'"]')[0].offsetParent.className ='current';
   $('.exzoom_nav_inner').find('img[src="<?php echo base_url(); ?>/admin-assets/images/'+obj.image+'"]').trigger("mouseenter");
$('.product_show_info').html('<input type="hidden" name="img" data-id="'+obj.image+'" tabindex="0"><input type="hidden" name="sku" data-id="'+obj.sku+'" tabindex="0">');
            },
            error: function(){            
              alert('Error while request..');
            }
        });

        },
        error: function(){            
          alert('Error while request..');
        }
    });



    });
     $('.buy_now').on('click', function(e) {
         e.preventDefault(e);
        if((sizeValue === '' || sizeValue == null) && (colorValue === '' || colorValue == null)){
            alert("Please select variation.");
        }else{
          var id  = $("input[name='sku']").data("id");
        var qty = $('.input-qty').val();
        var price  = $("input[name='price']").val();
        var image  = $("input[name='img']").data("id");
        var name = $(this).data("name");
         $.ajax({
            type: "post",
            url:'<?php echo site_url('cart/add_cart'); ?>',
            data:{qty,id,price,image,name},
            cache: false,       
            success: function(response){            
             window.location.replace('<?php echo site_url('cart'); ?>')

            },
            error: function(){            
              alert('Error while request..');
            }
        });
        }
        
     });

     $('.add_to_wishlist').on('click', function(e) {
        var id  = $(this).data("id");
         $.ajax({
            type: "post",
            url:'<?php echo site_url('add_to_wishlist'); ?>',
            data:{id},
            cache: false,       
            success: function(response){ 

                $.ajax({
                        type: "post",
                        url:'<?php echo site_url('wishlist_count'); ?>',
                        data:{id},
                        cache: false,       
                        success: function(response){ 

                            $('.wish-list').html(response); 
                        },
                
                    });       
                },
            error: function(){            
              alert('Error while request..');
            }
        });
        
     });
   $('form.ps-form--review').submit(function( event ){
     event.preventDefault();

    var form_data  = $('form.ps-form--review').serialize();     
      $.ajax({
                        type: "post",
                        url:'<?php echo site_url('submit_review'); ?>',
                        data:form_data, 
                        cache: false,       
                        success: function(response){ 

                            alert("Thanks for your review, will be published soon"); 
                        },
                
                    }); 


   });   

   $(".input-qty").on("change", function(){

        var qty = parseInt($( ".input-qty" ).val());

        var price = $("[name='price']").val();

         $('.total-price').text((qty*price).toFixed(2));
   });


   $(".fa-plus").on("click", function(){

        var qty = parseInt($( ".input-qty" ).val())+1;
         var price = $("[name='price']").val();

         $('.total-price').text((qty*price).toFixed(2));
   });

   $(".fa-minus").on("click", function(){

        if($( ".input-qty" ).val() != 1){
             var qty = parseInt($( ".input-qty" ).val())-1 ;
        }else{
                var qty = parseInt($( ".input-qty" ).val()) ;
        }

         var price = $("[name='price']").val();

         $('.total-price').text((qty*price).toFixed(2));

    
        
   });
</script>