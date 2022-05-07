<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

        $this->load->library('pagination');
		$this->load->library('email');
		$this->load->model('frontend_m');
		$this->load->model('product_m');
		$this->load->library('email');
		$this->load->library('cart');
	    $wishlist_id = $this->session->userdata('wishlist_id');
	    if(!empty($wishlist_id)){
	     $wishlist_id = array_unique($wishlist_id);
	    }
    	if($this->session->userdata('wishlist_id')){
          $wishlist_count = count($this->session->userdata('wishlist_id'));
        }else{
           $wishlist_count = 0 ;
        }
         if($this->input->get('country')){

        $array = array(
            'country' => $this->input->get('country')
        );
        
        $this->session->set_userdata( $array );

        }if($this->input->get('currencies')){
             $array = array(
            'currency' => $this->input->get('currencies')
        );
             $this->session->set_userdata($array);
        }
        
    $this->data['child_cats'] =$this->product_m->gets_category();
    $this->data['parent_cats'] =$this->product_m->gets_parent_cats();
    $this->data['wishlist_count'] = $wishlist_count;
	    $this->data['brand'] = $this->product_m->get_brands();
	    $this->data['color'] = $this->product_m->get_color();
	    $this->data['size'] = $this->product_m->get_size();
	    //$this->data['parent_menu'] =$this->frontend_m->parent_menu();
        $this->data['currencies'] = $this->product_m->get_currencies();
    
        $this->data['country'] =$this->product_m->get_country();
	    $currency = $this->session->userdata('currency');
	    $this->data['currency']=  ($currency != "") ? $currency : "USD";
	    $this->data['curr_symbol'] = $this->product_m->currency_code_symbol();
         $this->data['g_seeting'] = $this->product_m->g_setting();
        $this->data['g_wishlist'] = $this->getWishlist();
        $this->data['g_wishlist_price'] = $this->getWishlistPrice();
 	}

   

	public function index()
	{

		$slug = $this->uri->segment(2);
        // $slugs =  $this->product_m->get_product_id_()
		if($slug == NULL || is_numeric($slug)){
        if($this->input->get('per_pages') && $this->input->get('per_pages') != '' ){
            $config['per_page'] = $this->input->get('per_pages') ;
        }else{
            $config['per_page'] = 20;
        }
        
         if(!$this->input->get('per_page') || $this->input->get('per_page')=="")
        {
            $offset = 0;
        }
        else
        {
            $offset = ($config['per_page'])*($this->input->get('per_page')-1);
        }
        $products = $this->product_m->adv_cats_search();
        $product = $this->product_m->adv_cats_search($config["per_page"], $offset);
        $config["base_url"] = base_url() . "categories";
        $config["total_rows"] = count($products);
        $config["total_rows"] = $config["total_rows"];
        $config["num_links"] = $config["total_rows"];
        $config['use_page_numbers'] = TRUE;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = '&laquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&raquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['page_query_string'] =TRUE ;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
		$this->data['products'] = $product;


		$this->load->view('products', $this->data);
		}else{

			$product_id = array();
			if($this->product_m->get_product_id_by_slug($slug)){
				$p_details = $this->product_m->get_product_id_by_slug($slug);
                $id = $p_details->id ;
                $slug = $p_details->product_id ;
			$product_details = $this->product_m->get_product_details($id);

            // $this->product_m->get_product_api_checked($product_details->api_called , $product_details->product_id);
            $this->data['variable_product'] = $this->product_m->variable_product($slug);
			$product_cats = $product_details->product_categories ;
            $cats_id = $product_details->categories_id ;
			$this->data['product'] = $product_details;
            $this->data['parent_sub_cats'] = $this->product_m->get_sub_parent_cats($cats_id)  ;
            $this->data['parent__cats'] = $this->product_m->get_parent_cats($cats_id)  ;
            $this->data['reviews'] = $this->product_m->get_reviews_by_product($product_details->product_id);
 			$related_products = $this->product_m->get_related_product($product_cats , $id); 

		foreach ($related_products as $data) {
				$product_id[$data->product_id] = $data->product_id ;
		}
		$this->data['related_products'] = $related_products;
		$this->data['related_price'] = $this->product_m->products_price($product_id);	 
		$this->data['price'] = $this->product_m->products_price($slug);
		$this->load->view('product-details', $this->data);
		}
		}
	}

/*  product adv search */
	public function adv_search(){
		$product_id = array();
        $cats= $this->product_m->get_cats_adv_search();
		$products = $this->product_m->adv_product_search($cats);
			// foreach ($products as $data) {
			// 	$product_id[$data->product_id] = $data->product_id ;
			// }
            // $price =  $this->product_m->products_price($product_id);

		?>
                        <div class="ps-tab active" id="tab-1">
                            <div class="row">
                                
                                <?php foreach ($products as $data) {
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs);
                                    ?>
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                    <div class="ps-product">
                                        <div class="ps-product__thumbnail">

                                            <a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php   echo base_url(); ?>/admin-assets/images/<?php echo $data->product_image ; ?>" alt=""/></a>
                                            <ul class="ps-product__actions">
                                                <li><a href="<?php echo site_url('products/'.$slugs.''); ?>" data-id=""  data-toggle="tooltip" data-placement="top" title="Add to Cart" class="add_to_cart"><i class="icon-bag2"></i></a></li>
                                                <li><a href="#" data-id="<?php echo $data->id ; ?>" data-toggle="tooltip" data-placement="top" title="Add to Whishlist" class="add_to_wishlist"><i class="icon-heart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="#"><?php echo $data->product_name; ?></a>
                <p class="ps-product__price">$<?php   echo round($data->price,2) - round($data->price*$data->product_offer/100,2) ; ?></p>
                                            </div>
                                            <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.'');  ?>"><?php echo $data->product_name; ?></a>
                                                <p class="ps-product__price">$ <?php echo round($data->price,2) - round($data->price*$data->product_offer/100,2) ;

                                                ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php 
                                } ?>
                                <?php if(count($products) == 0){
                                    echo '<h2>No result Found</h2>';

                                } ?>
                            </div>
                            
                        </div>
                        <div class="ps-tab" id="tab-2">
                    <?php foreach ($products as $data) {
                         $image = '';
                    ?>

                            <div class="ps-product ps-product--wide">
            
                                <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.'');  ?>"><img src="<?php   echo base_url(); ?>/admin-assets/images/<?php echo $data->product_image ; ?>" alt=""/></a>
                                </div>
                                <div class="ps-product__container">
                                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.'');  ?>"><?php echo $data->product_name ; ?></a>
                                        <!-- <p class="ps-product__vendor">Sold by:<a href="#">Zatara  STORE</a></p> -->
                                    <!--     <ul class="ps-product__desc">
                                            <li> Unrestrained and portable active stereo speaker</li>
                                            <li> Free from the confines of wires and chords</li>
                                            <li> 20 hours of portable capabilities</li>
                                            <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                            <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                        </ul> -->
                                    </div>
                                    <div class="ps-product__shopping">
                                        <p class="ps-product__price">$<?php  echo round($data->price,2); ?></p><a class="ps-btn add_to_cart" data-id="<?php echo $data->id; ?>" href="<?php echo site_url('products/'.$slugs.''); ?>">Add to cart</a>
                                        <ul class="ps-product__actions">
                                            <li><a href="#"  data-id="<?php echo $data->id; ?>" class="add_to_wishlist" ><i class="icon-heart"></i> Add to Wishlish</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

<?php  } ?>
                            <!-- <div class="ps-pagination">
                                <ul class="pagination">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li>
                                </ul>
                            </div> -->
                        </div>
                    
		<?php


	}
/* end product adv search */

public function getWishlist(){
    $wishlist_id = $this->session->userdata('wishlist_id');
    if(count($wishlist_id) > 0){
     $wishlist_id = array_unique($wishlist_id);
    }
    

    $wishlist = $this->frontend_m->get_products($wishlist_id);  
    return $wishlist;
	}
    
    public function getWishlistPrice(){
    $wishlist_id = $this->session->userdata('wishlist_id');
    if(count($wishlist_id) > 0){
     $wishlist_id = array_unique($wishlist_id);
    }
        $wishlist = $this->frontend_m->get_products($wishlist_id);
   foreach ($wishlist as $data) {
        $product_id[$data->product_id] = $data->product_id ;
      }
      if(!isset($product_id)){
        $product_id = array();
      }
    $price=array();
    $price=  $this->product_m->products_price($product_id);

    return $price;
   }


}

/* End of file Products.php */
/* Location: ./application/modules/frontend/controllers/Products.php */