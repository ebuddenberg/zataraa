<?php $this->load->view('inc/header'); ?>

<!--- Homepage-wrapper --->
<div id="homepage-wrapper">
  <div class="ps-home-banner auto-scroll" data-id="banner_slider">
    <div class="container">
      <div class="ps-section__left" id="home-banner_cats">
        
      </div>
      <div class="ps-section__center">
        <div class="ps-carousel--dots owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" id="banner_home">
          <a href="<?php   echo $home_setting->h_slider_one_link; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php   echo $home_setting->home_page_slider_one; ?>" alt=""></a>
          <a href="<?php   echo $home_setting->h_slider_two_link; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php   echo $home_setting->home_page_slider_two; ?>" alt=""></a>
          <a href="<?php   echo $home_setting->h_slider_three_link; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php   echo $home_setting->home_page_slider_three; ?>" alt=""></a>
        </div>
      </div>

    </div>
  </div>

  <div class="ps-search-trending" >
    <div class="container">
      <div class="ps-section__header">
        <h3>Search Trending</h3>
      </div>
      <div class="ps-section__content">
        <div class="ps-block--categories-tabs ps-tab-root">
          <div class="ps-block__header">
            <div class="ps-carousel--nav ps-tab-list owl-slider auto-scroll" id="search_trending" data-id="search_trending"

            data-owl-auto="false" data-owl-speed="1000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="8" data-owl-item-xs="3" data-owl-item-sm="4" data-owl-item-md="6" data-owl-item-lg="6" data-owl-duration="500" data-owl-mousedrag="on">
     
             
              <?php 
              $child_cats =  $this->data['child_cats'] ;
    $parent_cats =  $this->data['parent_cats'];
              $child_cats_array = array();
              foreach ($parent_cats as $data) { 

                  foreach ($child_cats as $datas) {
                    
                    if($datas->parent_id == $data->cats_id){

                      $child_cats_array[] = array('categories_name' =>$datas->categories_name ,'parent_id'=>$datas->parent_id,'cats_id'=>$datas->cats_id,'categories_image'=>$datas->categories_image);
                    }

           
                  }
              }
              $i = 0 ;
              foreach ($child_cats_array as $data) {
               if($i == 0){
                $class = 'active';
              }else{
                $class ="";
              }  

               ?>
                
          <div class="owl-item active" style="width: 130px; margin-right: 0px;">
              <a class="<?php echo $class ; ?> " href="#<?php echo $data['cats_id'] ?>">


                    <i class="icon-star"></i>
                 
                

                <span><?php echo $data['categories_name']; ?></span></a>
              </div>
               <?php  $i++ ; }
               ?>
             
<div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style=""><i class="icon-chevron-left"></i></div><div class="owl-next" style=""><i class="icon-chevron-right"></i></div></div><div class="owl-dots" style="display: block;"><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div></div></div>
            </div>
          </div>
          <div class="ps-tabs">
            <div class="ps-tabs" id="search_trending_tab">
              

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-deal-of-day auto-scroll"  data-id="section_one">
    <div class="container">
      <div class="ps-section__header">
        <div class="ps-block--countdown-deal">
          <div class="ps-block__left">
            <h3><a href="<?php echo site_url('deals'); ?>">Deal of the Week</a></h3>
          </div>
        </div><a href="<?php echo site_url('deals'); ?>">View all</a>
      </div>
      <div class="ps-section__content"  id="deal_of_the_Week">
        
      </div>
    </div>
  </div>
  <div class="ps-product-box">
    <div class="container">

      <?php if($home_setting->hide_section_one !='yes'){ ?>
      <div class="ps-block--product-box">
        <div class="ps-block__header">
          <h3><i class="icon-laundry"></i> <a href="<?php   echo $home_setting->h_slider_two_link; ?>"><?php echo $home_setting->sec_1_title ; ?></a></h3>
        </div>
        <div class="ps-block__content">
          <div class="ps-block__left">
            <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on"><a href="<?php echo $home_setting->section_one_cat_link ; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $home_setting->section_one_banner_one ; ?>" alt=""></a><a href="<?php echo $home_setting->section_one_cat_link ; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $home_setting->section_one_banner_two ; ?>" alt=""></a></div>
            <div class="ps-block__products ps-tab-root">
            
              <div class="ps-tabs">
                <div class="ps-tab active auto-scroll" data-id="section_two" id="product-box-e-1">
                  
                </div>
                
                
              </div>
            </div>
          </div>
          <div class="ps-block__right ">
            <figure id="recomended_product_one">
              

            </figure>
          </div>
        </div>
      </div>
    <?php } if($home_setting->hide_section_two !='yes'){ ?>
      <div class="ps-block--product-box">
        <div class="ps-block__header">
          <h3><i class="icon-shirt"></i> <a href="<?php   echo $home_setting->h_slider_one_link; ?>"> <?php echo $home_setting->sec_2_title ; ?></a></h3>
        
        </div>
        <div class="ps-block__content">
          <div class="ps-block__left">
            <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on"><a href="<?php echo $home_setting->section_two_cat_link ; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $home_setting->section_two_banner_one ; ?>" alt=""></a><a href="<?php echo $home_setting->section_two_cat_link ; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $home_setting->section_two_banner_two ; ?>" alt=""></a></div>
            <div class="ps-block__products ps-tab-root">
              
              <div class="ps-tabs">
                <div class="ps-tab active auto-scroll" data-id="section_three" id="product-box-c-1">
                  

                </div>
                
                
              </div>
            </div>
          </div>
          <div class="ps-block__right">
            <figure id ="recomended_product_two">
              

            </figure>
          </div>
        </div>
      </div>

    <?php } if($home_setting->hide_section_two !='yes'){ ?>
      <div class="ps-block--product-box">
        <div class="ps-block__header">
          <h3><i class="icon-shirt"></i> <a href="<?php   echo $home_setting->h_slider_three_link; ?>"><?php echo $home_setting->sec_3_title ; ?></a></h3>
         
        </div>
        <div class="ps-block__content">
          <div class="ps-block__left">
            <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on"><a href="<?php echo $home_setting->section_three_cat_link ; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $home_setting->section_three_banner_one ; ?>" alt=""></a><a href="<?php echo $home_setting->section_three_cat_link ; ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $home_setting->section_three_banner_two ; ?>" alt=""></a></div>
            <div class="ps-block__products ps-tab-root">
              <div class="ps-tabs">
                <div class="ps-tab active auto-scroll" data-id="our_collection" id="product-box-h-1">
                  

                </div>
                
                
              </div>
            </div>
          </div>
          <div class="ps-block__right">
            <figure id="recomended_product_three">
              

            </figure>
          </div>
        </div>
      </div>

    <?php } ?>
      <div class="ps-block--product-box">
        <div class="ps-block__header">
          <h3>Our Collections</h3>
          <a href="<?php echo site_url('products'); ?>">See More</a>
        </div>
        <div class="ps-block__content">
          <div class="ps-block__products" id="our_collection">
            

          </div>

        </div>
         <div class="text-center" style="width:100%;clear: both;padding-top: 20px;"> <button class="load-more btn  btn-info text-center" data-id="1" style="font-size: 18px; margin-top: 12px;">Load More</button></div>
      </div>
    </div>
  </div>
</div>
<!--- Homepage-wrapper --->
<?php $this->load->view('inc/footer'); ?>

<script type="text/javascript">


        $(".icon-menu").click(function () {
 $(this).toggleClass('active');
        });
</script>

<script type="text/javascript">
  let firedEvents = [];

$(window).scroll(function() {
  $("div.auto-scroll").each(function() {
    if (!firedEvents.includes(this)  && $(window).scrollTop() > $(this).offset().top) {
     
      firedEvents.push(this);
      if($(this).data("id") == "section_one"){

          $.ajax({
            type: "post",
            url:'<?php echo site_url('get_section_one'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#product-box-e-1").html(data);
            }
        });

        $.ajax({
            type: "post",
            url:'<?php echo site_url('recomended_product_one'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#recomended_product_one").html(data);
            }
        });
      }
      if($(this).data("id") == "section_two"){

          $.ajax({
            type: "post",
            url:'<?php echo site_url('get_section_two'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#product-box-c-1").html(data);
            }
        });

        $.ajax({
            type: "post",
            url:'<?php echo site_url('recomended_product_two'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#recomended_product_two").html(data);
            }
        });
      }

       if($(this).data("id") == "section_three"){

          $.ajax({
            type: "post",
            url:'<?php echo site_url('get_section_three'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#product-box-h-1").html(data);
            }
        });

        $.ajax({
            type: "post",
            url:'<?php echo site_url('recomended_product_three'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#recomended_product_three").html(data);
            }
        });
      }
    if($(this).data("id") == "our_collection"){
      $.ajax({
            type: "post",
            url:'<?php echo site_url('our_collection'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#our_collection").html(data);
            }
        });
    }

 if($(this).data("id") == "banner_slider"){

     $.ajax({
            type: "post",
            url:'<?php echo site_url('search_trending'); ?>',
            cache: false,       
            success: function(data){ 
               // $( "#search_trending").html(data);
                $( "#search_trending > .owl-stage-outer > .owl-stage" ).empty();
          $( "#search_trending > .owl-stage-outer > .owl-stage" ).append(data);
            }
        });

  $.ajax({
            type: "post",
            url:'<?php echo site_url('search_trending_tab'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#search_trending_tab").html(data);
            }
        });
}
 if($(this).data("id") == "search_trending"){

    $.ajax({
            type: "post",
            url:'<?php echo site_url('deals_of_the_weak'); ?>',
            cache: false,       
            success: function(data){ 
                $( "#deal_of_the_Week").html(data);
            }
        });

  }

      

    }
  });
});
   $('search_trending').on('click', ' li > a',function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            $(this).closest('li').siblings('li').removeClass('active');
            $(this).closest('li').addClass('active');
            $(target).addClass('active');
            $(target).siblings('.ps-tab').removeClass('active');
        });
 $('#search_trending').on('click', '.owl-item a', function(e){
            e.preventDefault();
            var target = $(this).attr('href');
            $(this).closest('.owl-item').siblings('.owl-item').removeClass('active');
            $(this).closest('.owl-item').addClass('active');
            $(target).addClass('active');
            $(target).siblings('.ps-tab').removeClass('active');
        });
 $('.load-more').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
              $.ajax({
            type: "post",
            url:'<?php echo site_url('our_collection'); ?>',
            cache: false,
            data : id,       
            success: function(data){ 
                $( "#our_collection").append(data);
            }
        });
        });
        
 
    //     $('.add_to_wishlist').on('click',function(e){
    //     var id  = $(this).data("id");
    //      $.ajax({
    //         type: "post",
    //         url:'<?php echo site_url('add_to_wishlist'); ?>',
    //         data:{id},
    //         cache: false,       
    //         success: function(response){ 

    //             $.ajax({
    //                     type: "post",
    //                     url:'<?php echo site_url('wishlist_count'); ?>',
    //                     data:{id},
    //                     cache: false,       
    //                     success: function(response){ 

    //                         $('.wish-list').html(response); 
    //                         window.location.reload();
    //                     },
                
    //                 });       
    //             },
    //         error: function(){            
    //           alert('Error while request..');
    //         }
    //     });
        
    //  });

</script>
