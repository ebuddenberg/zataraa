<!--- Footer --->
<footer class="ps-footer ps-footer--3">
    <div class="container">
        <div class="ps-block--site-features ps-block--site-features-2">
            <div class="ps-block__item">
                <div class="ps-block__left"><i class="icon-rocket"></i></div>
                <div class="ps-block__right">
                    <h4>Fast Delivery</h4>
                    <!-- <p>For all oders over $99</p> -->
                </div>
            </div>
            <div class="ps-block__item">
                <div class="ps-block__left"><i class="icon-sync"></i></div>
                <div class="ps-block__right">
                    <h4>30 Days Return</h4>
                    <p>If goods have problems</p>
                </div>
            </div>
            <div class="ps-block__item">
                <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                <div class="ps-block__right">
                    <h4>Secure Payment</h4>
                    <p>100% secure payment</p>
                </div>
            </div>
            <div class="ps-block__item">
                <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                <div class="ps-block__right">
                    <h4>24/7 Support</h4>
                    <p>Dedicated support</p>
                </div>
            </div>
        </div>
        <div class="ps-footer__widgets">
            <aside class="widget widget_footer widget_contact-us">
                <h4 class="widget-title">Contact us</h4>
                <div class="widget_content">
                    <p>Call us 24/7</p>
                    <h3><?php echo $g_seeting->contact_no ; ?></h3>
                    <p><?php echo $g_seeting->address ; ?> <br><a href="<?php echo  $g_seeting->address  ; ?>"><span class="__cf_email__" data-cfemail="<?php echo $g_seeting->email ; ?>"><?php echo $g_seeting->email ; ?></span></a></p>
                    <ul class="ps-list--social">
                        <li><a class="facebook" href="<?php echo $g_seeting->facebook_link ; ?>"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="<?php echo $g_seeting->twitter_link ; ?>"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="google-plus" href="<?php echo $g_seeting->g_plus_link ; ?>"><i class="fa fa-google-plus"></i></a></li>
                        <li><a class="instagram" href="<?php echo $g_seeting->instagram_link ; ?>"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Quick links</h4>
                <ul class="ps-list--link">
                    <li><a href="<?php echo site_url('policy'); ?>">Privacy Policy </a></li>
                    <li><a href="<?php echo site_url('terms_condition'); ?>">Term & Condition</a></li>
                    <li><a href="<?php echo site_url('shipping'); ?>">Shipping</a></li>
                    <li><a href="<?php echo site_url('return'); ?>">Return</a></li>
                    <li><a href="<?php echo site_url('faqs'); ?>">FAQs</a></li>
                </ul>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Company</h4>
                <ul class="ps-list--link">
                    <li><a href="<?php echo site_url('about'); ?>">About Us</a></li>
                    <li><a href="<?php echo site_url('payment_method') ?>">Payment Method</a></li>
                    <!-- <li><a href="#">Career</a></li> -->
                    <li><a href="<?php echo site_url('contact'); ?>">Contact</a></li>
                </ul>
            </aside>
            <aside class="widget widget_footer">
                <h4 class="widget-title">Bussiness</h4>
                <ul class="ps-list--link">
                    <li><a href="<?php echo site_url('our_press'); ?>">Our Press</a></li>
                    <li><a href="<?php echo site_url('checkout'); ?>">Checkout</a></li>
                    <li><a href="<?php echo site_url('users') ?>">My account</a></li>
                    <li><a href="<?php echo site_url('products'); ?>">Shop</a></li>
                </ul>
            </aside>
        </div>
        <div class="ps-footer__copyright">
            <p><?php echo $g_seeting->copyright ; ?></p>
            <!-- <p><a href="http://corbsoftware.com">Website Design & Developed by Corb Software</a></p> -->
            <p><span>We Using Safe Payment For:</span><a href="#"><img src="<?php  echo base_url() ;  ?>/frontend-assets/img/paypal.jpeg" alt="" style="
    height: 30px;
"></a><a href="#"><img src="<?php  echo base_url() ;  ?>/frontend-assets/img/payment-method/3.jpg" alt=""></a><a href="#"><img src="<?php  echo base_url() ;  ?>/frontend-assets/img/payment-method/5.jpg" alt=""></a></p>
        </div>
    </div>
</footer>
<!--- /Footer --->

<div id="back2top"><i class="pe-7s-angle-up"></i></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'fi,fr,ar,en,es,ru,cs,da,lb,sv,pt-PT,de,it,pl,pt,is,no,hu,nl', autoDisplay: false}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">$(document).ready(function() { 
  $.ajax({
            type: "post",
            url:'<?php echo site_url('get_home_banner_cats'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#home-banner_cats").html(data);
            }
        });


    $.ajax({
            type: "post",
            url:'<?php echo site_url('get_header_menu_cats'); ?>',
            cache: false,       
            success: function(data){ 
                $( ".header_menu-cats").html(data);
            }
        });
  });
</script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/translate/script.js"></script>

<?php if($this->router->fetch_class() == "products"){ ?>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/script/zoom-image.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/script/mains.js"></script>
<?php  } ?>

<script type="text/javascript" src="<?php echo base_url(); ?>admin-assets/js/chosen.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

    //DOM manipulation code
  $(".pcategories").chosen();

});
    <?php 

    if($this->router->fetch_class() =='products'){ ?>
    $(document).ready(function() {

        var count = $("form.variation select").length;
        if(count == 2){
        var data = $("form.variation").serialize();
        var id = "<?php if(isset($product)){ echo $product->product_id ; } ?>";
        $.ajax({
            type: "post",
            url:'<?php echo site_url('get_avail_variation'); ?>',
            data:{data,id},
            cache: false,       
            success: function(data){ 
                $( "form.variation select" ).last().empty().append(data)
            }
        });


        
    }

    });
    $( "form.variation select" ).first().click(function(){

        var count = $("form.variation select").length;
        if(count == 2){
        var data = $("form.variation").serialize();
        var id = "<?php if(isset($product)){ echo $product->product_id ; } ?>";
        $.ajax({
            type: "post",
            url:'<?php echo site_url('get_avail_variation'); ?>',
            data:{data,id},
            cache: false,       
            success: function(data){ 
                $( "form.variation select" ).last().empty().append(data)
            }
        });
        }
    
});

<?php } ?>
</script>

    <script>

        $(function() {
    
            var availableTags = [];
        $( "#tags" ).autocomplete({


            source: function (request, response)
    {

        $.ajax(
        {
           
            type:'POST',
            url:'<?php echo site_url('get_search_val'); ?>',
            data:
            {
                term: request.term,
                cats : $('.cats :selected').val()
            },
            success:function(data)
            {
               data = jQuery.parseJSON(data);
                response(data);


            }
        });
    },
    minLength: 2,

     change: function( event, ui ) {},
                            autoFocus: true,
                            select: function (event, ui) {
                                value  = encodeURI(ui.item.label) ;
            window.open("<?php echo site_url('products/?s=') ?>"+value+"","_self"); 

                           },
        });  



$("select.cats").change(function(){
var cats = $('#tags').val('');
  

    });
           
        });
    </script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/bootstrap4/js/bootstrap.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/imagesloaded.pkgd.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/isotope.pkgd.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/jquery.matchHeight-min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/slick/slick/slick.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/slick-animation.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/sticky-sidebar/dist/sticky-sidebar.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/jquery.slimscroll.min.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/plugins/select2/dist/js/select2.full.min.js"></script>
<!-- Custom scripts-->
<script src="<?php  echo base_url() ;  ?>/frontend-assets/js/main.js"></script>
<script src="<?php  echo base_url() ;  ?>/frontend-assets/js/jquery.exzoom.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e6f6c46eec7650c33204a7d/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
 
 </body>
 <?php 

        if($this->input->get('action') == 'register'){
           
           echo "<script>
            $('#login-btn').removeClass('active');
             $('#reg-btn').addClass('active');
           $('#sign-in').removeClass('active');
           $('#register').addClass('active');
                </script>";
        }


        if($this->input->get('tab') == 'address'){
           
           echo "<script>
            $('.nav-link').removeClass('active');
            $('.nav-link').removeClass('show');
            $('.nav-link').attr('aria-selected','false');
            $('#v-pills-address-tab').addClass('active');
            $('#v-pills-address-tab').addClass('show');
            $('#v-pills-address-tab').attr('aria-selected','true');
            $('.tab-pane').removeClass('active');
            $('.tab-pane').removeClass('show');
            $('#v-pills-address').addClass('active');
            $('#v-pills-address').addClass('show');
                </script>";
        }

     ?>
<script>
 $("span.s_curency").click(function(){
  $('.curency009').toggle('slow');
 });
    
 $(document).click(function(){
  $('.ps-dropdown .new_dropdown1').hide('slow'); 
 });
 $(".ps-dropdown a").click(function(e){
     e.stopPropagation(); 
  $('.ps-dropdown .new_dropdown1').toggle('slow');
 });
$(".new_dropdown1").click(function(e){
    e.stopPropagation();
  $(this).addClass('active');
 });

$(".apply_currencies").on('click', function(e){

 var currencies = $("input[name=currencies]").val();
 var country =     $("input[name=country]").val();
 var url = "<?php echo base_url(uri_string()); ?>";
 window.location.replace(""+url+"?country="+country+"&currencies="+currencies+"");
});
<?php 
// if($this->session->userdata('country') !=''){
// echo '$("input[name=country]").val("'.$this->session->userdata('country').'");';
// } if($this->session->userdata('currency') !=''){
//     echo '$("input[name=currencies]").val("'.$this->session->userdata('currency').'");';
// }
 ?>

 
</script>
<script type="text/javascript">

    $('.container').imagesLoaded( function() {
  $("#exzoom").exzoom({
        autoPlay: false,
    });
  $("#exzoom").removeClass('hidden')
});
$(function() {
  $.ajax({
            type: "post",
            url:'<?php echo site_url('get_header_menu_cats'); ?>',
            cache: false,       
            success: function(data){ 
                $( ".header_menu-cats").html(data);
            }
        });
  });
</script>
 <script type="text/javascript">
 $(document).on("click", '.add_to_wishlist', function() {
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
                           // window.location.reload();
                        },
                
                    });       
                },
            error: function(){            
              alert('Error while request..');
            }
        });
        
    });
</script>
</html>
