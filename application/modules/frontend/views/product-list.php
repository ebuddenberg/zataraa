<?php $this->load->view('inc/head', $this->data); ?>    
<style type="text/css">
  .search-continer{
    height: 100px;
    padding-top: 20px;
    border-radius: 6px;
    background-color: white;
  }
  .search-continer , label{
    margin-left: 15px;
  }
  .input-text{
        border-radius: 6px;
    height: 32px;
  }
</style>
<body id="dashboard" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="dashboard "  data-smooth-scrolling="1">     
<div class="vd_body">
<!-- Header Start -->
  <?php $this->load->view('inc/inner-header', $this->data); ?>
  <link href="<?php echo base_url(); ?>admin-assets/css/chosen.css" rel="stylesheet" />  
  <!-- Header Ends --> 
<div class="content">
  <div class="container">
<?php $this->load->view('inc/left-menu', $this->data); ?>
      
    <!-- Middle Content Start -->
    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_head-section clearfix">
            <div class="vd_panel-header">
              <ul class="breadcrumb">
                <li><a href="">Home</a> </li>
               
                <li class="active">Products</li>
              </ul>
              
            </div>
          </div>
          <div class="vd_title-section clearfix">
            <div class="vd_panel-header">
              <h1>Products</h1>
            </div>
            <div class="col-md-6"><a href="<?php echo site_url('admin/product/delete_all'); ?>" class="btn btn-sm btn-info">Delete All</a></div>
          </div>
          <div class="vd_content-section clearfix">
             
            <div class="row">
              <label>Product Filter</label>
              <form action="<?php echo site_url('admin/product'); ?>" method="get">
              <div class="search-continer">
              <div class="col-md-2">
             <label>Per Page<span class="vd_red"></span></label>
                  <div id="first-name-input-wrapper" class=" col-sm-12">
              

                          <?php 
                          $per_page = $this->input->get('per_pages');
                          if(!$per_page){
                            $per_page = 20 ;
                          }
                          $per_page_array = array('20'=> 20,'50' => 50,'100' => 100,'500' => 500);
                
               echo form_dropdown('per_pages', $per_page_array,$per_page); ?>
                  </div>
            </div>

              <div class="col-md-2">
               <label>Parent Categories<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">
                              <?php 
                      $css = array(
                              'class' => 'pcategories pmcat'
                      );
               echo form_dropdown('', $get_imp_parent_cats,'',$css); ?>
                    </div>
              </div>
              <div class="col-md-2">
               <label>Child Categories<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">
                            <select class="pcategories ccats " ></select>
                    </div>
              </div>
              <div class="col-md-2">
               <label>Sub Child Cats<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">

                    <select class="pcategories subcats " name="product_categories"></select>
                    </div>
              </div>
               <div class="col-md-2">
               <label>Product Name</label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">
                     <input type="text"  placeholder="Product Name" class="input-text required" name="s">       
                    </div>
              </div>

              <div class="col-md-2">
                <label><span class="vd_red"></span></label>
                <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-register">Search Products</button>
              </div>

              
              
              </div>
              </form>
              </div>
            </div>

            <div class="vd_content-section clearfix">
             
            <div class="row">
              <label>Apply Discount</label>
              <form action="<?php echo site_url('admin/product/apply_discount_product'); ?>" method="get">
              <div class="search-continer">

              <div class="col-md-2">
               <label>Min Price<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">
                     <input type="number" min="0"  placeholder="Min Price" class="input-text required" required="" name="min_price">       
                    </div>
              </div>
              <div class="col-md-2">
               <label>Max Price<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">
                            <input type="number" required="" min="0" placeholder="Max Price" class="input-text required" name="max_price">
                    </div>
              </div>
              <div class="col-md-2">
               <label>Discount<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">

                    <input type="number"  placeholder="Discount" class="input-text required" min="0" name="discount">  
                    </div>
              </div>
               

              <div class="col-md-2">
                <label><span class="vd_red"></span></label>
                <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-register">Apply Discount</button>
              </div>

              
              
              </div>
              </form>
              </div>
            </div>

            <div class="vd_content-section clearfix">
             
            <div class="row">
              <label>Apply Margin</label>
              <form action="<?php echo site_url('admin/product/apply_margin_product'); ?>" method="get">
              <div class="search-continer">

              <div class="col-md-2">
               <label>Min Price<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">
                     <input type="number" min="0"  placeholder="Min Price" class="input-text required" required="" name="min_price">       
                    </div>
              </div>
              <div class="col-md-2">
               <label>Max Price<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">
                            <input type="number" required="" min="0" placeholder="Max Price" class="input-text required" name="max_price">
                    </div>
              </div>
              <div class="col-md-2">
               <label>Margin<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">

                    <input type="number"  placeholder="Discount" class="input-text required" min="0" name="discount">  
                    </div>
              </div>
               

              <div class="col-md-2">
                <label><span class="vd_red"></span></label>
                <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-register">Apply Margin</button>
              </div>

              
              
              </div>
              </form>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
                  <div class="panel-heading vd_bg-grey">
                  
<h3 class="panel-title" style="display: inline-block;"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Product List   </h3>
                  
                    <h3 class="panel-title text-center" style="display: inline-block;width: 100%; position: absolute; left: 0; cursor: pointer;">
                          <a href="<?php echo site_url('admin/product/add_product'); ?>"><span><i class="fa fa-plus fa-fw"></i> Add Product</span></a>
                    </h3>
                  </div>
                  <div class="panel-body table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th><input type="checkbox" class="select_all"><span>Sel All</span></br><a href="#" class="delete-selected" style="color:red;">Delete Selected</a></th>
                          <th>Product Image</th>
                          <th>Product Name</th>
                          <th>Sku</th>
                          <th>Stock</th>
                          <th>Offer</th>
                          <th>Comission</th>
                          <th>Categories</th>
                          <th>Sync Product to CJ</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$i = 1 ;
                    
                         foreach ($products as $data) {  
    $image = '';
                          ?>

                        <tr>
                          <td> <input type="checkbox" name="product_ids" value="<?php echo $data->product_id; ?>" >  <span>  <?php echo $i ; ?></span> </td>
                          <td><img style="width:60px;" src="<?php  echo base_url('admin-assets/images/'.$data->product_image.'') ; ?>"></td>
                          <td class="center"><?php echo $data->product_name ; ?></td>
                          <td class="center"><?php echo $data->product_sku ; ?></td>
                          <td class="center"><?php echo $data->product_stock ; ?></td>
                          <td class="center"><?php echo $data->product_offer ; ?></td>
                          <td class="center"><?php echo $data->comission ; ?></td>
                          <td class="center"><?php echo $data->product_categories ; ?></td>
                          <td class="center">
                            
                            <a class="btn menu-icon vd_bd-yellow vd_yellow product-sync" data-id="<?php echo $data->product_id ; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                          </td>
                          
                          <td class="menu-action">
                          
                            <a href="<?php echo site_url('admin/product/update_product/'.$data->id.''); ?>"  data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow" data-id="<?php  ?>"> <i class="fa fa-pencil" ></i> </a> 
                            <a data-original-title="delete" data-toggle="tooltip" data-placement="top"  data-id="<?php echo $data->id; ?>" class="btn menu-icon vd_bd-red vd_red"> <i class="fa fa-times"></i> </a>
                        </td>
                        </tr>


                    <?php
                       $i++;
                        } ?>
                        
                      </tbody>
                    </table>

                    <?php 
                    if(isset($links)){

                       echo $links ;
                    }
                     ?>
                  
                  </div>
                </div>
                <!-- Panel Widget --> 
              </div>
              <!-- col-md-12 --> 
            </div>

            
          </div>
          <!-- .vd_content-section --> 
          
        </div>
        <!-- .vd_content --> 
      </div>
      <!-- .vd_container --> 
    </div>
    <!-- .vd_content-wrapper --> 
    
    <!-- Middle Content End --> 
    
  </div>
  <!-- .container --> 
</div>
<!-- .content -->

<!-- Footer Start -->
<footer class="footer-1"  id="footer">      
    <div class="vd_bottom ">
        
              <div class=" col-xs-12">
                <div class="copyright">
                    Copyright &copy;2019 Zataara. All Rights Reserved 
                </div>
              </div>
            
    </div>
  </footer>
<!-- Footer END -->
  

</div>

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>

<?php $this->load->view('inc/footer', $this->data); ?>
<script type="text/javascript" src="<?php echo base_url() ; ?>admin-assets/js/chosen.jquery.js"></script>
</body>
</html>
<script type="text/javascript">
  $('.select_all').change(function () {
    if ($(this).prop('checked')) {
    $('input').prop('checked', true);
    }
    else {
        $('input').prop('checked', false);
    }
});
$('.select_all').trigger('change');
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $(".pcategories").chosen();
 $('.table').on('click', '.vd_bd-red', function(){
  if (window.confirm("Do you really want to delete?")) { 
    var id = $(this).data("id");
      var $tr = $(this).closest('tr');
    $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/product/delete/') ; ?>'+id ,
      cache: false,       
      success: function(response){            
       $tr.fadeOut();   
      },
      error: function(){            
        alert('Error while request..');
      }
     });
    }
  });
  
  });
</script>

<script type="text/javascript">
  $('select.pmcat').on('change', function() {
    $('#loadingDiv').show();
    var id = $(this).val();
  $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/get_child_cats/' ,
      data : {id:id}
  }).done(function(data){ 
    $('#loadingDiv').hide();
  $('select.ccats').empty();
$('select.ccats').append(data);
  $(".ccats").val('').trigger("chosen:updated");
  }).fail(function(data){
  $('#loadingDiv').hide();

  })
});
</script>

<script type="text/javascript">
  $('select.ccats').on('change', function() {
    $('#loadingDiv').show();
    var id = $(this).val();
  $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/get_child_cats/' ,
      data : {id:id}
  }).done(function(data){ 
    $('#loadingDiv').hide();
 
$('select.subcats').append(data);
  $(".subcats").val('').trigger("chosen:updated");
  }).fail(function(data){
  $('#loadingDiv').hide();

  })
});
</script>

<script type="text/javascript">
  
  $(".delete-selected").click(function(e){
  e.preventDefault();
  var selected = new Array();
     $("input:checkbox[name=product_ids]:checked").each(function() {
       selected.push($(this).val());
  });
    if (window.confirm("Do you really want to delete?")) {

    $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/product/delete_specific/') ; ?>',
      data: {ids : selected} ,
      cache: false,       
      success: function(response){            
          window.location.href = "<?php echo site_url('admin/product/'); ?>";
      }
      
     });
    }
  });

  $('.product-sync').click(function(e){
  var id = $(this).data("id");

  $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/product/sync_cj_product/') ; ?>',
      data: {id : id} ,
      cache: false,       
      success: function(response){            
        

      }
      
     });


  });
</script>