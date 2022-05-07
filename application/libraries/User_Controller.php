<?php
class User_Controller extends MY_Controller
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
			'users/login', 
			'users/logout',
			'users/forget_password',
			'users/register',
			'users/reset_password'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_m->loggedin_user() == FALSE ) {
				redirect('users/login');
			}
		}
	
	}
}