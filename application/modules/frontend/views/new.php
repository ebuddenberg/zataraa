<?php $this->load->view('inc/header'); ?>
<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li>New</li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<!--- Product List --->
<div class="ps-page--shop" id="shop-sidebar">
    <div class="container">
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                <aside class="widget widget_shop">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="ps-list--categories">
                    <?php foreach ($parent_cats as $data) { ?>

                        <li class="menu-item-has-children"><a  class="sub-toggle1" href="#"><?php echo $data->categories_name ; ?></a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                            <ul class="sub-menu">
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
                 
               ?>
                                    <li class="menu-item-has-children"><a  class="sub-toggle1" href="#"><?php echo $data_child['categories_name'] ; ?></a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                                        <?php if(count($sub_child_array) >0){ ?>
                                        <ul class="sub-menu">
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
                                    <?php } ?>
                                    </li>

                            <?php } ?>
                               
                            </ul>
                        </li>


                    <?php } ?>






        
                    </ul>
                </aside>
                <aside class="widget widget_shop">
                    <!-- <h4 class="widget-title">BY BRANDS</h4>
                    <form class="ps-form--widget-search" action="">
                        <input class="form-control" type="text" placeholder="">
                        <button><i class="icon-magnifier"></i></button>
                    </form> -->
             <!--        <figure class="ps-custom-scrollbar" data-height="250">
                <?php 
                $i =1 ;
                foreach ($brand as $key => $value) { ?>
            
                        <div class="ps-checkbox">
                            <input class="form-control sidebar_search" type="checkbox" value="<?php echo $key ; ?>" id="brand-<?php echo $i ; ?>" name="brand"/>
                            <label for="brand-<?php echo $i ; ?>"><?php echo $value; ?> </label>
                        </div>
                <?php  $i++ ; } ?>
                        
                    </figure> -->
                    <figure>
                        <h4 class="widget-title">By Price</h4>
                        <div class="ps-slider notranslate" data-default-min="0" data-default-max="100" data-max="101" data-step="1" data-unit="$"></div>
                        <p class="ps-slider__meta notranslate">Price:<span class="ps-slider__value ps-slider__min sidebar_search notranslate"></span>-<span class="ps-slider__value ps-slider__max sidebar_search notranslate"></span></p>
                    </figure>
                  
                </aside>
            </div>
            <div class="ps-layout__right">
                <div class="ps-shopping ps-tab-root">
                    
                    <a class="ps-shop__filter-mb" href="#" id="filter-sidebar"><i class="icon-menu"></i> Show Filter</a>
                    <div class="ps-shopping__header">

                        <div class="ps-shopping__actions">
                            <input type="number" min="0" class="sidebar_search min_f notranslate" value="<?php echo $this->input->get('f_min'); ?>" name="min" placeholder="min amount">
                            <input type="number" min="0" class="sidebar_search max_f notranslate" value="<?php echo $this->input->get('f_max'); ?>" name="max" placeholder="max amount">

                            <?php
                            $css =  'class="ps-select sidebar_search per_page notranslate"';
                             $data =array('20'=>'20 per page','50'=>'50 per page','100'=>'100 per page','200'=>'200 per page','500'=>'500 per page'); 
                             $per_page = $this->input->get('per_pages');
                             echo form_dropdown('per_page', $data, $per_page,$css);
                             ?>
                             
                             <?php
                            $css =  'class="ps-select sort sidebar_search notranslate"';

                             $data =array('latest'=>'Sort by latest','low_to_high'=>'Sort by price: low to high','high_to_low'=>'Sort by price: high to low'); 
                             $sort = $this->input->get('sort');
                             echo form_dropdown('sort_by', $data, $per_page,$css);
                             ?>
                            
                            <div class="ps-shopping__view">
                                <p>View</p>
                                <ul class="ps-tab-list">
                                    <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                    <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <img id="loading-image" src="<?php echo site_url(); ?>admin-assets/tenor.gif" style="display: block; margin: auto;">
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="row">
                                
                                <?php foreach ($new_product as $data) {
                                    $image = '';
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name); 
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);
$slugs = str_replace(" ", '_', $slugs); 
                                    ?>
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                    <div class="ps-product">
                                        <div class="ps-product__thumbnail">

                                            <a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php   echo base_url(); ?>/admin-assets/images/<?php echo $data->image ; ?>" alt=""/></a>
                                             <?php if($data->product_offer != NULL){ ?>
                                                    <?php 
                                                    if($data->product_offer != 0){
                                                        echo '<div class="ps-product__badge">-'. (int)$this->frontend_m->cal_percent($this->frontend_m->convert(($data->price+$data->price*$data->comission/100)) ,$this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ).'%'.'</div>' ;
                                                        
                                                    }/*else{
                                                        echo '<div class="ps-product__badge">-0%</div>';
                                                    }*/
                                                     ?>
                                                <?php } ?>
                                            <ul class="ps-product__actions">
                                                <li><a href="<?php echo site_url('products/'.$slugs.''); ?>" data-id=""  data-toggle="tooltip" data-placement="top" title="Add to Cart" class="add_to_cart"><i class="icon-bag2"></i></a></li>
                                                <li><a href="#" data-id="<?php echo $data->id ; ?>" data-toggle="tooltip" data-placement="top" title="Add to Whishlist" class="add_to_wishlist"><i class="icon-heart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="#"><?php echo $data->product_name; ?></a>
                <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*(int)$data->comission/100) - ($data->price*(int)$data->comission/100)*(int)$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*(int)$data->comission/100)).'</del>' ;
                        } ?></p>
                                            </div>
                                            <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.'');  ?>"><?php echo $data->product_name; ?></a>
                                                <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?>   <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*(int)$data->comission/100) - ($data->price*(int)$data->comission/100)*(int)$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*(int)$data->comission/100)).'</del>' ;
                        } ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php 
                                } ?>
                                <?php if(count($new_product) == 0){
                                    echo '<h2>No result Found</h2>';

                                } ?>
                            </div>
                            <div class="ps-pagination">
                                 <?php  echo $links ; ?>
                            </div>
                        </div>
                        <div class="ps-tab" id="tab-2">
                    <?php foreach ($deal_of_the_Week as $data) {
                         $image = '';
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name); 
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);
$slugs = str_replace(" ", '_', $slugs); 
                    ?>

                            <div class="ps-product ps-product--wide">
            
                                <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.'');  ?>"><img src="<?php   echo base_url(); ?>/admin-assets/images/<?php echo $data->product_image ; ?>" alt=""/></a>
                                </div>
                                <div class="ps-product__container">
                                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.'');  ?>"><?php echo $data->product_name ; ?></a>
                                        
                                    </div>
                                    <div class="ps-product__shopping">
                                        <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*(int)$data->comission/100) - ($data->price*(int)$data->comission/100)*(int)$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*(int)$data->comission/100)).'</del>' ;
                        } ?></p><a class="ps-btn add_to_cart" data-id="<?php echo $data->id; ?>" href="<?php echo site_url('products/'.$slugs.''); ?>">Add to cart</a>
                                        <ul class="ps-product__actions">
                                            <li><a href="#"  data-id="<?php echo $data->id; ?>" class="add_to_wishlist" ><i class="icon-heart"></i> Add to Wishlish</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

<?php  } ?>
                    <div class="ps-pagination">
                                 <?php  echo $links ; ?>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- /Product List --->
<?php $this->load->view('inc/footer'); ?>

<script type="text/javascript">
   $('.sizes label').click(function(){
          $(this).addClass('active');
     })
    $('.sidebar_search').on('change', function(e) {
    // e.type is the type of event fired
        var brand = [];
        var color = [];
        var review = [];
        var size = [];
        $.each($("input[name='brand']:checked"), function(){
            brand.push($(this).val());
        });
        $.each($("input[name='color']:checked"), function(){
            color.push($(this).val());
        });
        $.each($("input[name='review']:checked"), function(){
            review.push($(this).val());
        });
        $.each($("input[name='size']:checked"), function(){
            size.push($(this).val());
        });
         var per_page =  $(".per_page option:selected").val();
        var sort = $(".sort option:selected").val();
        var min = $('.ps-slider__min').html();
        var max = $('.ps-slider__max').html();
        var f_min = $('.min_f').val();
        var f_max = $('.max_f').val();
        var cats = "<?php echo $this->input->get('cats'); ?>" ;
        var id = "<?php echo $this->input->get('id'); ?>" ;
        var parent = "<?php echo $this->input->get('parent'); ?>" ;
        var sub_child = "<?php echo $this->input->get('sub_child'); ?>" ;
          <?php 
$class = $this->router->fetch_class();
        $url = site_url($class); ?>
        window.location.replace("<?php echo $url ?>?min="+min+"&max="+max+"&sort="+sort+"&per_pages="+per_page+"&cats="+cats+"&parent="+parent+"&sub_child="+sub_child+"&f_min="+f_min+"&f_max="+f_max+"");


           // $.ajax({
           //      type: "post",
           //      url:'<?php echo site_url('products/adv_search'); ?>',
           //      data:{brand,color,review,size,sort,min,max,per_page,id ,f_min,f_max,cats,parent,sub_child},
           //      cache: false,       
           //      success: function(response){ 
           //          $('.ps-tabs').html(response);
           //      },
                
           //  }); 

      


});


$('#loading-image').hide();
  $(".ps-slider").on("slidestop", function(event, ui) {
        var brand = [];
        var color = [];
        var review = [];
        var size =[];
         $('#loading-image').show();
        $.each($("input[name='brand']:checked"), function(){
            brand.push($(this).val());
        });
        $.each($("input[name='color']:checked"), function(){
            color.push($(this).val());
        });
        $.each($("input[name='review']:checked"), function(){
            review.push($(this).val());
        });
        $.each($("input[name='size']:checked"), function(){
            size.push($(this).val());
        });

        var sort = $(".sort option:selected").val();
        var per_page =  $(".per_page option:selected").val();
        var min = $('.ps-slider__min').html();
        var max = $('.ps-slider__max').html();
        var id = "<?php echo $this->input->get('id'); ?>" ;
        var cats = "<?php echo $this->input->get('cats'); ?>" ;
        var parent = "<?php echo $this->input->get('parent'); ?>" ;
        var sub_child = "<?php echo $this->input->get('sub_child'); ?>" ;

        <?php 
$class = $this->router->fetch_class();
        $url = site_url($class); ?>
   //     window.location.replace("<?php echo $url ?>?min="+min+"&max="+max+"&sort="+sort+"&per_pages="+per_page+"&cats="+cats+"&parent="+parent+"&sub_child="+sub_child+"");
        $.ajax({
            type: "post",
            url:'<?php echo site_url('products/adv_search'); ?>',
            data:{brand,color,review,size,sort,min,max, per_page,id,cats,parent,sub_child},
            cache: false,       
            success: function(response){ 
                $('#loading-image').hide();
                $('.ps-tabs').html(response);
            },
            
        });  
     });
</script>
<script>
     $('.add_to_cart').on('click', function(e) {
        var id  = $(this).data("id");
        console.log(id);
     });
        $('.ps-tabs').on('click', '.add_to_wishlist', function(e){
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