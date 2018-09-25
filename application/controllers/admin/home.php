<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# Home Controler
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 28/04/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class Home extends Admin_controller {
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->check_login();
		
		//$this->load->helper('counter');
		
	}
	
		
	public function index() {
		
		$data = array();
		//begin gửi email
		//echo $this->session->userdata('user_name')
		$this->render($this->load->view('admin/home', $data, TRUE));
		
	}

}
/* End file home controller */
/* Local file: application/controllers/admin/home.php */