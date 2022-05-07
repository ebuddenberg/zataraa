

<?php $this->load->view('inc/head', $this->data); ?>    
<style type="text/css">
  .variation-product {
    border: 1px solid;
    margin-top: 15px;
    padding: 10px 20px 0px;
}
a.add_more {
    margin-top: 10px;
    float: right;
}
</style>



<body id="dashboard" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="dashboard "  data-smooth-scrolling="1">     
<div class="vd_body">
<!-- Header Start -->
  <?php $this->load->view('inc/inner-header', $this->data); ?>
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
                <li><a href="<?php echo site_url('admin') ; ?>">Home</a> </li>
               
                <li class="active">Add Product</li>
              </ul>
              
            </div>
          </div>
          <div class="vd_title-section clearfix">
            <div class="vd_panel-header">
              <h1>Add Product</h1>
<br>
            <a href="<?php  echo site_url('/admin/product/'); ?>" class="btn btn-sm btn-default" style="background-color: #e91e63ab; color:white;"> << Back to Product List</a>

            <a class="btn btn-sm btn-success" href="<?php  echo site_url('admin/product/add_product/') ; ?>">+ Add another Product</a>

            <a class="btn btn-sm btn-info" href="<?php  echo site_url('admin/product/add_product/') ; ?>"><i class="fa fa-info-circle "></i> view this Product</a>


               

              
            </div>
          </div>
          

          <div class="vd_content-section clearfix" id="ecommerce-product-add">
            <div class="row">
              <div class="col-sm-3 col-md-4 col-lg-3">
                <div class="form-wizard condensed mgbt-xs-20">
                  <ul class="nav nav-tabs nav-stacked">
                    <li class="active"><a href="#tabinfo" data-toggle="tab"> <i class="fa fa-info-circle append-icon"></i> Information </a></li>
                    
                    <li><a href="#tabship" data-toggle="tab"> <i class="fa  append-icon"></i> Product Variation</a></li>
                    
                    <li><a href="#tabimage" data-toggle="tab"> <i class="fa fa-picture-o append-icon"></i> Product Gallery </a></li>
                     
                  </ul>
                </div>
              </div>
              <div class="col-sm-9 col-md-8 col-lg-9 tab-right">
                <div class="panel widget panel-bd-left light-widget">
                  <div class="panel-heading no-title"> </div>
                  <div  class="panel-body">
                    <div class="tab-content no-bd mgbt-xs-20">
                      <div id="tabinfo" class="tab-pane active">
                        <form class="form-horizontal"  id="form_step_1" method="post" action="#"  autocomplete="off">
                          
                          <div class="vd_panel-menu">
                            <div> <a class="btn vd_btn vd_bg-blue btn-sm save-btn save_product_step_1"><i class="fa fa-save append-icon"></i> Save Changes</a>  </div>
                          </div>
                          <h3 class="mgtp-15 mgbt-xs-20"> Product Information</h3>
                          <input type="hidden" name="id" value="">
                           <div class="form-group col-lg-12">
                            <label for="enable_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Enable product" > Enable </span> </label>
                            <div class="col-lg-3">
                              <input id="enable_1" name="enable_1"  type="checkbox" data-rel="switch" data-wrapper-class="inverse" data-size="small" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"  checked>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="The public name for this product. Invalid characters &lt;&gt;;=#{}">Product Name </span> </label>
                            <div class="col-lg-9">
                               
                                  <input type="text" required  name="product_name" class="  updateCurrentText " id="product_name" value="" >
                                
                            </div>
                         </div>
                          <div class="form-group">
                            <label  class="control-label col-lg-3" ><span data-toggle="tooltip" class="label-tooltip" data-original-title="Product type">Categories </span></label>
                            <div class="col-lg-3">
                              <?php 
                      $css = array(
                              'class' => 'pcategories'
                      );
             echo form_multiselect('product_categories[]', $categories,'',$css);
              ?>
                            
                            </div>
                           <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Product reference number (SKU-10423, etc.)">Offer </span> </label>
                            <div class="col-lg-3">
                              <input type="text"   name="product_offer" class="updateCurrentText" value=""  >
                            </div>
                          </div>
                          <!-- form-group -->
                          
                          <div class="form-group">
                            
                            
                               <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="product variation like color size (color,size)"> Product Difference option</span> </label>
                            <div class="col-lg-9">

               <input type="text" placeholder="color,size" name="commodityDifferenceOption" class="  updateCurrentText " id="product_name" value="">
                            </div>

                          
                          </div>
                          <div class="form-group">
                             <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Product reference number (SKU-10423, etc.)"> Price </span> </label>
                            <div class="col-lg-3">
                              <input type="text"   name="price" class="updateCurrentText" value="" id="code_1" >
                            </div>
                            <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip"  > Item code </span> </label>
                            <div class="col-lg-3">
                              <input type="text"   value="" name="sku" class="  updateCurrentText " id="code_1" >
                            </div>
                          </div>
                           <div class="form-group">
                          
                            <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Product reference number (SKU-10423, etc.)"> Quantities </span> </label>
                            <div class="col-lg-3">
                              <input type="number" required value="" name="quantity" class="  updateCurrentText " id="code_1" >
                            </div>

                             <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Product reference number (SKU-10423, etc.)"> Brand </span> </label>
                            <div class="col-lg-3">
                               <?php 
                                 $css = array( 'class' => 'color');
                              echo form_dropdown('brand', $brand,'',$css); 
                               ?>
                            </div>
                          </div>
                          
                          <div class="form-group">
                          
                            <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Comission"> Comission </span> </label>
                            <div class="col-lg-3">
                              <input type="number" required="" value="" name="comission" class="  updateCurrentText " id="code_1">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="description_short_1" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Appears in the product list(s), and at the top of the product page."> Short description </span> </label>
                            <div class="col-lg-9 mgbt-xs-10 mgbt-lg-0">
                              <textarea name="description_short" id="description_short" data-rel="ckeditor" rows="1" ></textarea>
                            </div>
                            
                          </div>
                          
                          <!-- form-group -->
                          
                          <div class="form-group">
                            <label for="description_1" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Appears in the body of product detail."> Description </span> </label>
                            <div class="col-lg-9 mgbt-xs-10 mgbt-lg-0">
                              <textarea name="description" id="description_1" data-rel="ckeditor" rows="1" ></textarea>
                            </div>
                            
                          </div>
                          <input type="hidden" value="" class="product_id" name="product_id">
                        </form>
                      </div>
                       <div id="tabship" class="tab-pane">
                        <h3 class="mgtp-15 mgbt-xs-20">Product Variation</h3>
                        <div class="vd_panel-menu">
                            <div> <a class="btn vd_btn vd_bg-blue btn-sm save-btn"><i class="fa fa-save append-icon"></i> Save Changes</a></div>
                          </div>
                        <div class="variation-product-container">

                         
                            
                         
                        <div class=" variation-product">
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('admin/product/update_variation'); ?>" id="form_step_2">
                           <input type="hidden" id="product_ids" class="product_id" name="product_id" value="">
                           <input type="hidden" name="parent_id" value="">
                          


                          <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="sku">Sku </span> </label>
                            <div class="col-lg-3">
                               
                                  <input type="text" required  name="sku" class="  updateCurrentText " id="product_name" value="" >
                                
                            </div>
                             <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Price">Price </span> </label>
                            <div class="col-lg-3">
                               
                                  <input type="text" required  name="price" class="  updateCurrentText " id="product_name" value="" >
                                
                            </div>
                         </div>

                          <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Weight">Weight </span> </label>
                            <div class="col-lg-3">
                               
                                  <input type="text" required  name="weight" class="  updateCurrentText " id="weight" value="" >
                                
                            </div>

                             <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Specification">Specification </span> </label>
                            <div class="col-lg-3">
                               
                                  <input type="text" required  name="Specification" class="  updateCurrentText " id="specification" value="" >
                                
                            </div>
                         </div>

                         <div class="form-group">
                            <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Product Difference Option">Product Different Option </span> </label>
                            <div class="col-lg-3">
                               
                                  <input type="text" required  name="commodityDifferenceOption" placeholder="red, black" class="  updateCurrentText " id="weight" value="" >
                                
                            </div>

                             <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Image">Image </span> </label>
                            <div class="col-lg-3">
                                 <input type="file" name="image">
                            </div>
                         </div>
                         <div class="form-group">
                           <div class="clearfix"></div>
                            <input type="submit"  class="btn btn-info  pull-right">
                         </div>
                           
                        </form>

                      </div>

                      
</div>

                      <div class="form-group">
                           <div class="clearfix"></div>
                            <a href="#" class="btn btn-info btn-sm  add_more">Add more </a>
                         </div>

                      </div>
                       
                      <!-- tab-pane -->
                      <div id="tabimage" class="tab-pane">
                        <h3 class="mgtp-15 mgbt-xs-20"> Images</h3>
                        <form class="form-horizontal" action="<?php echo site_url('admin/product/upload_images'); ?>" method="post" id="form_step_3" enctype="multipart/form-data">
                          <input type="hidden" id="product_ids" class="product_id" name="product_id" value="9">
                          <div class="form-group">
                            <label class="control-label col-lg-3 file_upload_label"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Format JPG, GIF, PNG. Filesize 8.00 MB max."> Add a new image to this product </span> </label>
                            <div class="col-lg-9"> <span class="btn vd_btn vd_bg-green fileinput-button"> <i class="glyphicon glyphicon-plus"></i> <span>Add files...</span> 
                              <!-- The file input field used as target for the file upload widget -->
                              <input type="file" name="file" id="fileupload">
                              </span> <br>
    
                              <br>
                                        <button class="btn btn-success upload_images" id="btn_upload" type="submit">Upload</button>
                                      </form>
                                      <form>
                            </div>
                          </div>
                          <table id="imageTable" class="table">
                            <thead>
                              <tr class="nodrag nodrop">
                            
                                <th class="fixed-width-lg" style="width:80px"><span class="title_box">Image</span></th>
                  
                               <th>Cover</th>
                                <!-- action --> 
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="imageList">

                            </tbody>
                          </table>
                        </form>
                      </div>
                      <!-- tab-pane -->
                     
                    </div>
                    <!-- tab-content --> 
                    
                  </div>
                  <!-- panel-body --> 
                  
                  <!-- form-horizontal --> 
                </div>
                <!-- Panel Widget --> 
              </div>
              <!-- col-sm-12--> 
            </div>
            <!-- row --> 
            
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header vd_bg-blue vd_white">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title" id="myModalLabel">Cancel Changes</h4>
      </div>
      <div class="modal-body">
        <h5>Are you sure you want to cancel your changes?</h5>
      </div>
      <div class="modal-footer background-login">
        <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Yes</button>
        <button type="button" class="btn vd_btn vd_bg-green"  data-dismiss="modal">No</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal -->
 

<!-- Footer Start -->
<footer class="footer-1"  id="footer">      
    <div class="vd_bottom ">
        <div class="container">
            <div class="row">
              <div class=" col-xs-12">
                <div class="copyright">
                    Copyright &copy;2019 zataara. All Rights Reserved 
                </div>
              </div>
            </div><!-- row -->
        </div><!-- container -->
    </div>
  </footer>
<!-- Footer END -->
 </div>
 <!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<?php $this->load->view('inc/footer', $this->data); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>admin-assets/js/chosen.jquery.js"></script>
<script type="text/javascript" src='<?php echo base_url(); ?>admin-assets/plugins/ckeditor/ckeditor.js'></script>
<script type="text/javascript" src='<?php echo base_url(); ?>admin-assets/plugins/ckeditor/adapters/jquery.js'></script>
<script type="text/javascript">
  $( '[data-rel^="ckeditor"]' ).ckeditor();
jQuery(document).ready(function(){
  jQuery(".pcategories").chosen();
  jQuery(".Fabric").chosen();
  jQuery(".style").chosen();
  jQuery(".color").chosen();
});

// Add new input with associated 'remove' link when 'add' button is clicked.
$('.add_project_file').click(function(e) {
    e.preventDefault();

    $(".project_images").prepend('<p><input type="text" placeholder="abhaya 1" class="width-60 required" name="firstname"  required="" style="margin-bottom: 10px;">'
      + '<a href="#" class="remove_project_file" border="2"><img src="images/delete.gif" /></a>'
      + '</p>');
});

// Remove parent of 'remove' link when link is clicked.
$('.project_images').on('click', '.remove_project_file', function(e) {
    e.preventDefault();
    $(this).parent().remove();
});

/* Product Save Option */
$('.save_product_step_1').on('click', function(){
   var formStatus = $('#form_step_1').validate().form();

   if(formStatus == true){
 var  data = $('#form_step_1').serialize();
   $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/add_product',
      cache: false,
      data: data ,
      dataType: 'json'
  })
   .done(function(data){ 
     $('.product_id').val(data);
  })
 
 .fail(function(data){
     alert('something went wrong');
  }) }
});

$('.add_product_step_2').on('click', function(){
 var  data = $('#form_step_2').serialize();
   $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/update_shipping',
      cache: false,
      data: data ,
      dataType: 'json'
  })
   .done(function(data){ 
     $('.product_id').val(data);
  })
 
 .fail(function(data){
     alert('somehing went wrong');
  })
});
$('.upload_images').on('click', function(e){
  e.preventDefault();
    var file_data = $('#fileupload').prop('files')[0];
    var product_id = $('#product_ids').val();
                    var form_data = new FormData(this);
                    form_data.append('file', file_data);
                    form_data.append('product_id', product_id);
                    console.log(form_data);
     $.ajax({
                 url:'<?php echo site_url();?>/admin/product/upload_images',
                 type:"post",
                  data: form_data, //this is formData
                  processData:false,
                 contentType:false,
                 cache:false,
                  
             })
           .done(function(data){ 
            $( "#imageList" ).append( `<tr>
                               
                                <td><a  href="<?php echo base_url() ; ?>admin-assets/images/`+data+`"> <img src="<?php echo base_url() ; ?>admin-assets/images/`+data+`"  alt="product image"> </a></td>                         
                                <td><input type="radio" class="cover_image" name="cover_image"></td>
                                <td><a class="delete_product_image btn vd_btn vd_bg-yellow btn-sm" href="#"> <i class="icon-trash append-icon"></i> Delete this image </a></td>
                              </tr>` );
           console.log(data);
        })
       
       .fail(function(data){
           alert('somehing went wrong');
        })

});
 </script> 
 <script type="text/javascript">
  $(document).ready(function(){

 $('#imageList').on('click', '.delete_product_image', function(){
  if (window.confirm("Do you really want to delete?")) { 
    var id = $(this).data("id");
      var $tr = $(this).closest('tr');
    $.ajax({
      type: "post",
      url:'<?php echo site_url('admin/product/product_image_delete/') ; ?>'+id ,
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

  $('#imageList .cover_image').change(function(){
            if (window.confirm("Do you really want to change cover images ?")) {
              var id = $(this).data("id");
              var product_id = $('.product_id').val();
                $.ajax({
                    type: "post",
                    url:'<?php echo site_url('admin/product/product_image_update/') ; ?>'+id ,
                    data:{product_id: product_id},
                    cache: false,       
                    success: function(response){            
                     alert('cover Image Changed');   
                    },
                    error: function(){            
                      alert('Error while request..');
                    }
                });
              

            }
        });
  
  });

  $('#tabship').on('click', '.add_more', function(){
 var html = $('.variation-product').html();
  $('.variation-product-container').append('<div class=" variation-product">'+html+'</div>');
  });

$(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });
});

</script>
<style type="text/css">
 
.form-wizard.condensed .nav>li>a {
    color: #fff;
     text-align: left;
    background-color: #e91e63ab;
}
</style>