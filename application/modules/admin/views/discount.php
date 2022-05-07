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
              <h1>Products Discount</h1>
            </div>
            
          </div>
          <div class="vd_content-section clearfix">
             
            <div class="row">
              <label>Apply Discount on cats</label>
              <form action="<?php echo site_url('admin/product/apply_discount'); ?>" method="get">
              <div class="search-continer">
              

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
                            <select class="pcategories ccats " required="" ></select>
                    </div>
              </div>
              <div class="col-md-2">
               <label>Sub Child Cats<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">

                    <select class="pcategories subcats " required="" name="product_categories"></select>
                    </div>
              </div>
               <div class="col-md-2">
               <label>Disount(%)</label>
                    <div id="first-name-input-wrapper" class=" col-sm-12">
                     <input type="text" required="" placeholder="Discount" class="input-text required" name="discount">       
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