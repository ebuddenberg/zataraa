<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="https://zataraa.com//frontend-assets/favicon.png" />
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
        <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://zataraa.com//frontend-assets/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://zataraa.com//frontend-assets/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://zataraa.com//frontend-assets/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="https://zataraa.com//frontend-assets/favicon.png">
    <link rel="shortcut icon" href="https://zataraa.com//frontend-assets/favicon.png">
    <title>Zataraa Online Shopping</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/plugins/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/css/style.css">
    <link rel="stylesheet" href="<?php  echo base_url() ;  ?>/frontend-assets/css/home-wrapper.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/frontend-assets/translate/style.css">
       <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/frontend-assets/translate/style.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
   
</head>
<body>
<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5dfc05a0d96992700fcd1ee5/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->
<div class="ps-site-overlay"></div>
<div id="loader-wrapper">
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!---- Menus For Desktop View --->
<header class="header  header--market-place-3" data-sticky="true">
    <div class="top-section">
        <div class="container">
            <ul class="header__top-links">
        <li>
        
          <!-- new dropdown -->
          <div class="ps-dropdown"><a href="#">Ship To <?php echo $this->session->userdata('country'); ?>/<?php echo $this->session->userdata('currency'); ?></a>
            <ul class="ps-dropdown-menu new_dropdown1 ">
              <li> 
                  <h4>Select Regional Settings</h4>
              </li>
              <li> 
                  <p>Ship to</p>
                  <input list="country" name="country" class="country099">
                  <datalist id="country">
                    <?php foreach ($country as $data) {
                      ?>
<option value="<?php echo $data->name ; ?>">
                      <?php
                    } ?>
                  </datalist>
              </li>
              <li> 
                  <p>Currency</p>

                   <input list="currencies" name="currencies" class="country099">
                  <datalist id="currencies">
                    <?php foreach ($currencies as $data) {
                      ?>

<option value="<?php echo $data->code ; ?>">
                      <?php
                     
                    } ?>
                    
                   
                  </datalist>
                  
                   
              </li>
              <li> <button class="btn btn-lg btn-info apply_currencies">Apply</button> </li>
            </ul>
          </div>
          <!-- End Dropdown -->
        </li>
        <li>
          <div class="ps-dropdown language" id="google_translate_element">
          </div>
        </li>
      </ul>
        </div>

    </div>
    <div class="header__top">
        <div class="container">



            <div class="header__left">
        <div class="menu--product-categories">
          <div class="menu__toggle"><i class="icon-menu"></i><span> Shop by Category</span></div>
          <div class="menu__content">
            <ul class="menu--dropdown">
              <?php foreach ($parent_cats as $data) {

$p_name =$data->categories_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);  
$slugs = str_replace(" ", '_', $slugs);  
               ?>
              <li class="menu-item-has-children has-mega-menu"><a href="<?php echo site_url('categories/?cats='.$slugs.'&parent=true'); ?>"><?php echo $data->categories_name ; ?></a>
                <div class="mega-menu">
                    <?php 
                  $child_cats_array = array();
                  foreach ($child_cats as $datas) {
                    if($datas->parent_id == $data->cats_id){
                    $child_cats_array[] = array('categories_name' =>$datas->categories_name ,'parent_id'=>$datas->parent_id,'cats_id'=>$datas->cats_id);
                    }
                  }
                foreach ($child_cats_array as $data_child) {
                    $sub_child_array = array();
                  foreach ($child_cats as $data_sub) {
                    if($data_sub->parent_id == $data_child['cats_id']){
                      $sub_child_array[] = array('categories_name' =>$data_sub->categories_name ,'parent_id'=>$data_sub->parent_id,'cats_id'=>$data_sub->cats_id);
                    }
                  }
                      $d_cats_name =$data_child['categories_name'] ;
$slugs = str_replace(" & ", '----', $d_cats_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs);      
               ?>
                  <div class="mega-menu__column">

                    <h4><a href="<?php echo site_url('categories/?cats='.$slugs.'&sub_child=true'); ?>"><?php echo $data_child['categories_name'] ; ?></a></h4>
                    <ul class="mega-menu__list">
                    <?php foreach ($sub_child_array as $data_cats_child) { 
$d_s_cats_name =$data_cats_child['categories_name'] ;
$slugs = str_replace(" & ", '----', $d_s_cats_name); 
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);
$slugs = str_replace(" ", '_', $slugs);  
                     ?>
                      <li><a href="<?php echo site_url('categories/?cats='.$slugs.''); ?>"><?php echo $data_cats_child['categories_name']; ?></a>
                      </li>
                    <?php } ?>
                    </ul>
                  </div>
                 <?php } ?>
                </div>
              </li>
 <?php } ?>
            </ul>
          </div>
        </div><a class="ps-logo" href="<?php echo site_url() ; ?>"><img src="<?php  echo base_url() ;  ?>/frontend-assets/img/logo.png" alt=""></a>
      </div>
            <div class="header__center">
                <form class="ps-form--quick-search" action="<?php echo site_url('products'); ?>" method="get">
          <div class="form-group--icon"><i class="icon-chevron-down"></i>
            <select name="cats" class="form-control">
              <option value="">All</option>
              <?php foreach ($parent_cats as $data) {   ?>
               <option value="<?php echo $data->cats_id ; ?>"><?php echo $data->categories_name ; ?></option>
              <?php } ?>
            </select>
          </div>
          <input class="form-control" name="s" type="text" placeholder="I'm shopping for...">
          <button type="submit">Search</button>
        </form>
            </div>
            <div class="header__right">
                
        <div class="header__actions">
          <div class="ps-cart--mini"><a class="header__extra" href="<?php echo site_url('wishlist'); ?>"><i class="icon-heart"></i><span class="wish-list"><i><?php echo $wishlist_count ; ?></i></span></a>
          <div class="ps-cart__content">
              <div class="ps-cart__items">
                 
<?php foreach ($g_wishlist as $item){  ?>
                <div class="ps-product--cart-mobile">
                  <div class="ps-product__thumbnail"><a href="#"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $item->product_image; ?>" alt=""></a></div>
                  <div class="ps-product__content"><a class="ps-product__remove" href="<?php echo site_url('remove_wishlist/'.$item->id); ?>"><i class="icon-cross"></i></a><a href="#"><?php echo $item->product_name ?></a>
                    <small><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php echo $this->frontend_m->convert($g_wishlist_price[$item->product_id]) ; ?></small>
                  </div>
                </div>
<?php } ?>
              </div>
               <div class="ps-cart__footer">
                <figure><a class="ps-btn" href="<?php echo site_url('wishlist'); ?>">View Wishlist</a></figure>
              </div>
            </div>
          </div>
          <div class="ps-cart--mini"><a class="header__extra" href="<?php echo site_url('cart'); ?>"><i class="icon-bag2"></i><span class="mini-cart-count"><i><?php  echo count($this->cart->contents()); ?></i></span></a>
            <div class="ps-cart__content">
              <div class="ps-cart__items">
 <?php foreach ($this->cart->contents() as $item){  ?>
                <div class="ps-product--cart-mobile">
                  <div class="ps-product__thumbnail"><a href="#"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $item['image']; ?>" alt=""></a></div>
                  <div class="ps-product__content"><a class="ps-product__remove" href="<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>"><i class="icon-cross"></i></a><a href="#"><?php echo $item['name'] ?></a>
                    <p><strong>Sold by:</strong>  Zataara store</p><small><?php echo $item["qty"]; ?> x $<?php echo $item['price'] ; ?></small>
                  </div>
                </div>
                <?php } ?>
              </div>
              <div class="ps-cart__footer">
                <h3>Sub Total:<strong>$<?php  echo $this->cart->total(); ?></strong></h3>
                <figure><a class="ps-btn" href="<?php echo site_url('cart'); ?>">View Cart</a><a class="ps-btn" href="<?php echo site_url('checkout'); ?>">Checkout</a></figure>
              </div>
            </div>
          </div>
          <div class="ps-block--user-header">
          <div class="ps-block__left"><a href="<?php echo site_url('users') ?>"><i class="icon-user" title="<?php  if($this->session->userdata('email') != ''){ echo  $this->session->userdata('fname');  } ?>"></i></a><!--<a href="<?php echo site_url('users/logout') ?>">Logout</a>--></div>

            <?php if($this->session->userdata('email') != ""){  ?>
              <!--<a href="<?php echo site_url('users') ?>"><?php echo  $this->session->userdata('fname'); ?> </a>-->
              <div class="ps-block__right"><a href="<?php echo site_url('users') ?>"><?php echo  $this->session->userdata('fname'); ?></a><a href="<?php echo site_url('users/logout') ?>">Logout</a></div>       
            <?php 
            }
            else{ ?>
              <div class="ps-block__right"><a href="<?php echo site_url('users/login') ?>">Login</a><a href="<?php echo site_url('users/login?action=register') ?>">Register</a></div>
            <?php } ?>
          </div>
        </div>
      
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container">
            <div class="navigation__left">
                <div class="menu--product-categories">
                    <div class="menu__toggle active"><i class="icon-menu"></i><span> Shop by Category</span></div>
                    <div class="menu__content"></div>
                </div>
            </div>
            <div class="navigation__right">

                <ul class="navigation__extra">
                    <li><a href="<?php echo site_url('deals'); ?>">Deals</a></li>
                    <li><a href="<?php echo site_url('new'); ?>">New</a></li>
                    <!--<li><a href="#">Local Warehouse</a></li>-->
                </ul>
            </div>
        </div>
    </nav>
</header>
<!---- /Menus For Desktop View --->

<!---- Menus For Mobile View --->
<header class="header header--mobile" data-sticky="true">
    <div class="header__top">
        <div class="header__left">&nbsp;</div>
        <div class="header__right">
            <ul class="navigation__extra">
                <li><a href="#">Sell on Zataraa</a></li>
                <li><a href="#">Tract your order</a></li>
                <li>
                    <div class="ps-dropdown"><a href="#">US Dollar</a>
                        <ul class="ps-dropdown-menu">
                            <li><a href="#">Us Dollar</a></li>
                            <li><a href="#">Euro</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="ps-dropdown language"><a href="#"><img src="<?php  echo base_url() ;  ?>/frontend-assets/img/flag/en.png" alt="">English</a>
                        <ul class="ps-dropdown-menu">
                            <li><a href="#"><img src="<?php  echo base_url() ;  ?>/frontend-assets/img/flag/germany.png" alt=""> Germany</a></li>
                            <li><a href="#"><img src="<?php  echo base_url() ;  ?>/frontend-assets/img/flag/fr.png" alt=""> France</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="navigation--mobile">
    <div class="navigation__left"><a class="ps-logo" href="<?php  echo site_url() ; ?>"><img src="<?php  echo base_url() ;  ?>/frontend-assets/img/logo_mobile.png" alt=""></a></div>
    <div class="navigation__right">
      <div class="header__actions">
        <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span class="mini-cart-count"><i><?php echo  count($this->cart->contents()); ?></i></span></a>
          <div class="ps-cart__content">
            <div class="ps-cart__items">
 <?php foreach ($this->cart->contents() as $item){  ?>
              <div class="ps-product--cart-mobile">
                <div class="ps-product__thumbnail"><a href="#"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $item['image']; ?>" alt=""></a></div>
                <div class="ps-product__content"><a class="ps-product__remove" href="<?php echo site_url('cart/removeItem/'.$item["rowid"]); ?>"><i class="icon-cross"></i></a><a href="#"><?php echo $item['name'] ?></a>
                  <p><strong>Sold by:</strong>  Zataara Store</p><small><?php echo $item["qty"]; ?> x $<?php echo $item['price'] ; ?></small>
                </div>
              </div>

<?php } ?>
            </div>
            <div class="ps-cart__footer">
              <h3>Sub Total:<strong>$<?php echo $this->cart->total(); ?></strong></h3>
              <figure><a class="ps-btn" href="<?php echo site_url('cart'); ?>">View Cart</a><a class="ps-btn" href="<?php echo site_url('checkout'); ?>">Checkout</a></figure>
            </div>
          </div>
        </div>
        <div class="ps-block--user-header">
          <div class="ps-block__left"><a href="<?php echo site_url('users') ?>"><i class="icon-user" title="<?php  if($this->session->userdata('email') != ''){ echo  $this->session->userdata('fname');  } ?>"></i></a><!--<a href="<?php echo site_url('users/logout') ?>">Logout</a>--></div>

            <?php if($this->session->userdata('email') != ""){  ?>
              <!--<a href="<?php echo site_url('users') ?>"><?php echo  $this->session->userdata('fname'); ?> </a>-->
              <div class="ps-block__right"><a href="<?php echo site_url('users') ?>"><?php echo  $this->session->userdata('fname'); ?></a><a href="<?php echo site_url('users/logout') ?>">Logout</a></div>       
            <?php 
            }
            else{ ?>
              <div class="ps-block__right"><a href="<?php echo site_url('users/login') ?>">Login</a><a href="<?php echo site_url('users/login?action=register') ?>">Register</a></div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="ps-search--mobile">
        <form class="ps-form--search-mobile" action="#" method="get">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
</header>

<div class="navigation--list">
    <div class="navigation__content">
        <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span> Menu</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> Categories</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span> Search</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span> Cart</span></a>
    </div>
</div>
<div class="ps-panel--sidebar" id="menu-mobile">
    <div class="ps-panel__header">
        <h3>Menu</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            <li class="current-menu-item"><a href="#">Home</a></li>
            <li class="current-menu-item"><a href="#">Shop by Deal</a></li>
            <li class="current-menu-item"><a href="#">Offer Zone</a></li>
            <li class="current-menu-item"><a href="#">Account</a></li>
            <li class="current-menu-item"><a href="#">My Orders</a></li>
            <li class="current-menu-item"><a href="#">Cart</a></li>
            <li class="current-menu-item"><a href="#">Wishlist</a></li>
            <li class="current-menu-item"><a href="#">Notification</a></li>
            <li class="current-menu-item"><a href="">Shop by Deal</a></li>
            <li class="current-menu-item menu-item-has-children"><a href="#">About</a><span class="sub-toggle"></span>
                <ul class="sub-menu">
                    <li><a href="#">Our Story</a>
                    </li>
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Terms & Condition</a>
                    </li>
                    <li><a href="#">Return Policy</a>
                    </li>
                </ul>
            </li>
            <li class="current-menu-item"><a href="#">Contact Us</a></li>
        </ul>
    </div>
</div>
<div class="ps-panel--sidebar" id="navigation-mobile">
    <div class="ps-panel__header">
        <h3>Categories</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
            <li><a href="#">Hot Promotions</a>
            </li>
            <li class="menu-item-has-children has-mega-menu"><a href="#">Consumer Electronic</a><span class="sub-toggle"></span>
                <div class="mega-menu">
                    <div class="mega-menu__column">
                        <h4>Electronic<span class="sub-toggle"></span></h4>
                        <ul class="mega-menu__list">
                            <li><a href="#">Home Audio &amp; Theathers</a>
                            </li>
                            <li><a href="#">TV &amp; Videos</a>
                            </li>
                            <li><a href="#">Camera, Photos &amp; Videos</a>
                            </li>
                            <li><a href="#">Cellphones &amp; Accessories</a>
                            </li>
                            <li><a href="#">Headphones</a>
                            </li>
                            <li><a href="#">Videosgames</a>
                            </li>
                            <li><a href="#">Wireless Speakers</a>
                            </li>
                            <li><a href="#">Office Electronic</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mega-menu__column">
                        <h4>Accessories &amp; Parts<span class="sub-toggle"></span></h4>
                        <ul class="mega-menu__list">
                            <li><a href="#">Digital Cables</a>
                            </li>
                            <li><a href="#">Audio &amp; Video Cables</a>
                            </li>
                            <li><a href="#">Batteries</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="#">Clothing &amp; Apparel</a>
            </li>
            <li><a href="#">Home, Garden &amp; Kitchen</a>
            </li>
            <li><a href="#">Health &amp; Beauty</a>
            </li>
            <li><a href="#">Yewelry &amp; Watches</a>
            </li>
            <li class="menu-item-has-children has-mega-menu"><a href="#">Computer &amp; Technology</a><span class="sub-toggle"></span>
                <div class="mega-menu">
                    <div class="mega-menu__column">
                        <h4>Computer &amp; Technologies<span class="sub-toggle"></span></h4>
                        <ul class="mega-menu__list">
                            <li><a href="#">Computer &amp; Tablets</a>
                            </li>
                            <li><a href="#">Laptop</a>
                            </li>
                            <li><a href="#">Monitors</a>
                            </li>
                            <li><a href="#">Networking</a>
                            </li>
                            <li><a href="#">Drive &amp; Storages</a>
                            </li>
                            <li><a href="#">Computer Components</a>
                            </li>
                            <li><a href="#">Security &amp; Protection</a>
                            </li>
                            <li><a href="#">Gaming Laptop</a>
                            </li>
                            <li><a href="#">Accessories</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="#">Babies &amp; Moms</a>
            </li>
            <li><a href="#">Sport &amp; Outdoor</a>
            </li>
            <li><a href="#">Phones &amp; Accessories</a>
            </li>
            <li><a href="#">Books &amp; Office</a>
            </li>
            <li><a href="#">Cars &amp; Motocycles</a>
            </li>
            <li><a href="#">Home Improments</a>
            </li>
            <li><a href="#">Vouchers &amp; Services</a>
            </li>
        </ul>
    </div>
</div>
<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
        <form class="ps-form--search-mobile" action="" method="get">
            <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
    <div class="navigation__content"></div>
</div>
<div class="ps-panel--sidebar" id="cart-mobile">
    <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
    </div>
    <div class="navigation__content">
    <div class="ps-cart--mobile">
      <div class="ps-cart__content">
        <?php foreach ($this->cart->contents() as $item){  ?>
                <div class="ps-product--cart-mobile">
                  <div class="ps-product__thumbnail"><a href="#"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $item['image']; ?>" alt=""></a></div>
                  <div class="ps-product__content"><a class="ps-product__remove" href="<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>"><i class="icon-cross"></i></a><a href="#"><?php echo $item['name'] ?></a>
                    <p><strong>Sold by:</strong>  YOUNG SHOP</p><small><?php echo $item["qty"]; ?> x $<?php echo $item['price'] ; ?></small>
                  </div>
                </div>
<?php } ?>
  
      </div>
      <div class="ps-cart__footer">
        <h3>Sub Total:<strong>$<?php  echo $this->cart->total(); ?></strong></h3>
        <figure><a class="ps-btn" href="<?php echo site_url('cart'); ?>">View Cart</a><a class="ps-btn" href="<?php echo site_url('checkout'); ?>">Checkout</a></figure>
      </div>
    </div>
  </div>
</div>
<!---- /Menus For Mobile View --->