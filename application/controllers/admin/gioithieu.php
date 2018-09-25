<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# tintuc controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class Gioithieu extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('tintuc/tintuc_model', 'tintuc');
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	
	public function index() {
		
		
		
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục giới thiệu' => base_url().'admin/gioithieu-ad/home');
		$data['heading_title'] = 'Giới thiệu';
		$data['action'] = base_url().'admin/gioithieu-ad/home';
		
		
		$this->form_validation->set_rules('detail', 'Content', 'trim|required');
		
		$data['content'] = $this->input->post('detail');
			
		$id = (int)$this->input->post('id');
		
		if($this->form_validation->run() == TRUE) {
			
			if($id && $id !='') {
			
				if($this->tintuc->update_gioithieu($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/gioithieu-ad/home');
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/gioithieu-ad/home');
				}
			} 
			else{

				redirect('admin/gioithieu-ad/home');
			}
			
		}
		
		$data['article'] = $this->tintuc->gioithieu();
	
		
		$this->render($this->load->view('admin/gioithieu/gioithieu_form', $data, TRUE));
		
	}
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
		
			if($this->tintuc->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/gioithieu-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/gioithieu-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/tintuc.php */