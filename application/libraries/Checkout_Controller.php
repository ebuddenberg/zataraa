<?php
class Checkout_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();
		$this->data['meta_title'] = 'GetCure';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->model('frontend_m');
		$this->load->model('user_m');
		
		// Login check
		$exception_uris = array(
			'checkout/first_step',
			'checkout/second_step',
			'checkout/third_step',
			'checkout/fourth_step'
		);
		if (in_array(uri_string(), $exception_uris) == TRUE) {
			if ($this->user_m->checkout_valid_user() == FALSE ) {
				redirect('users/login');
			}
		}
	
	}
}

