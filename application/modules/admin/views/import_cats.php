
<?php $this->load->view('inc/head', $this->data); ?>    
<style type="text/css">#loadingDiv {
    margin-left: 44%;
    position: absolute;
    z-index: 1;
    top: 244px;
}

img.loading-img {
    height: 40px;
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
        <div class="vd_navbar vd_nav-width vd_navbar-chat vd_bg-black-80 vd_navbar-right   ">
	<div class="navbar-tabs-menu clearfix">
			<span class="expand-menu" data-action="expand-navbar-tabs-menu">
            	<span class="menu-icon menu-icon-left">
            		<i class="fa fa-ellipsis-h"></i>
                    <span class="badge vd_bg-red">
                        20
                    </span>                    
                </span>
            	<span class="menu-icon menu-icon-right">
            		<i class="fa fa-ellipsis-h"></i>
                    <span class="badge vd_bg-red">
                        20
                    </span>                    
                </span>                
            </span>  
            <div class="menu-container">               
        		 <div class="navbar-search-wrapper">
    <div class="navbar-search vd_bg-black-30">
        <span class="append-icon"><i class="fa fa-search"></i></span>
        <input type="text" placeholder="Search" class="vd_menu-search-text no-bg no-bd vd_white width-70" name="search">
        <div class="pull-right search-config">                                
            <a  data-toggle="dropdown" href="javascript:void(0);" class="dropdown-toggle" ><span class="prepend-icon vd_grey"><i class="fa fa-cog"></i></span></a>
            <ul role="menu" class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>                                    
        </div>
    </div>
</div>  
            </div>        
                                                 
    </div>
	
</div>    
    <!-- Middle Content Start -->
    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_head-section clearfix">
            <div class="vd_panel-header">
              <ul class="breadcrumb">
                <li><a href="index.html">Home</a> </li>
                <li><a href="listtables-tables-variation.html">List &amp; Tables</a> </li>
                <li class="active">Tables Variation</li>
              </ul>
              <div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5  data-position="left">
    <div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"> <i class="fa fa-arrows-h"></i> </div>
      <div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>
      <div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>
      
</div>
 
            </div>
          </div>
          <div class="vd_title-section clearfix">
            <div class="vd_panel-header">
              <h1>Import Categories</h1>
       </div>
          </div>
          <div class="vd_content-section clearfix">
            <div class="row">
              <div id="loadingDiv"><img class="loading-img" src="<?php echo base_url('admin-assets/ajax-loader.gif'); ?>"></div>
              <div class="col-md-12">
                
                <form action="#" class="form-horizontal"  method="post"  >
                        <div id="error"></div>
                     
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Select Page No<span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <input type="number" min="1" placeholder="Page No" class="width-60 required" required="" name="page_no" id="page_no">
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label  col-sm-4">Select  No of Categories per page<span class="vd_red">*</span></label>
                      <div id="first-name-input-wrapper" class="controls col-sm-8">
                        <input type="number" min="20" max="50" placeholder="Cats Per Page" class="width-60 required" required="" name="cats_per_page">
                      </div>
                    </div>
                  </div>
                  
                  
                  <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                  <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-md-7 mgbt-xs-10 ">
                      
                    
                      <div class="mgtp-10">
                        <button class="btn edit vd_bg-green vd_white pull-right" type="submit" id="submit-register" name="submit-register">Sync Categories</button>
                      </div>
                    </div>
                    <div class="col-md-12 mgbt-xs-5"> </div>
                  </div>
                </form>
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
        <div class="container">
            <div class="row">
              <div class=" col-xs-12">
                <div class="copyright">
                  	Copyright &copy;2019 Zataara. All Rights Reserved 
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
<script type="text/javascript">
  
$(document).ready(function(){
$("form").submit(function(e) {  
    e.preventDefault();
    $('#loadingDiv').show();
    var data = $("form").serialize();
  
    $.ajax({
      type:'post',
      url:'<?php echo site_url() ; ?>/admin/product/sync_cats/' ,
      data : data
  })

  .done(function(data){ 
        $('#loadingDiv').hide();
   alert("categories Sync successfully");

  })
 
 .fail(function(data){
   $('#loadingDiv').hide();
    alert("Something Went wrong");
  })

  });

  });

$('#loadingDiv')
    .hide()  // Hide it initially
    .ajaxStart(function() {
        $(this).show();
    })
    .ajaxStop(function() {
        $(this).hide();
    })
;
</script>
</body>
</html>