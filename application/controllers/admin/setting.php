<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# Setting controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 30/04/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class Setting extends Admin_controller {

	public function __construct() {
	
		parent:: __construct();
		
		// Kiem tra dang nhap
		$this->check_login();
		
		// Load model setting_model
		$this->load->model('other/setting_model', 'setting');
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' =>  base_url().'admin', 'Setting' => '');
		$data['heading_title'] = 'Cấu hình chung cho site';
		$data['action'] =  base_url().'admin/setting-ad/home';
		
		$data['site_name'] = $this->input->post('site_title');
		$data['meta_key'] = trim($this->input->post('meta_key'));
		$data['meta_desc'] = trim($this->input->post('meta_desc'));
		$data['site_status'] = $this->input->post('site_status');
		$data['google_analytic'] = $this->input->post('google_analytics');
		$data['product_perpage'] = $this->input->post('product_perpage');
		$data['address'] = $this->input->post('address');
		$data['phone'] = $this->input->post('phone');		
		$action = $this->input->post('_action');
		
		if($action == 'let_go') {
		
			if($this->setting->update($data)) {
				$this->session->set_flashdata('warning', 'Cập nhật cấu hình thành công');
				redirect('admin/setting-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
				redirect('admin/setting-ad/home');
			}
		}
		
		
		$data['setting'] = $this->setting->get();
		
		$this->render($this->load->view('admin/other/setting', $data, TRUE));
			
	}

}
/* End file setting controler */
/* Local application/controllers/admin/setting.php */