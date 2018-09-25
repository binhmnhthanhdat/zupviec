<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# tintuc controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class Tinhienthi extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('tintuc/tintuc_model', 'tintuc');
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	
	public function index() {
		
		
		
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục giới thiệu' => base_url().'admin/tinhienthi-ad/home');
		$data['heading_title'] = 'Giới thiệu';
		$data['action'] = base_url().'admin/tinhienthi-ad/home';
		
		
		$this->form_validation->set_rules('detail', 'Content', 'trim|required');
		
		$data['title'] = $this->input->post('title');//
		$data['content'] = $this->input->post('detail');//title	
		$id = (int)$this->input->post('id');
		
		if($this->form_validation->run() == TRUE) {
			
			if($id && $id !='') {
			
				if($this->tintuc->tinhienthi($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/tinhienthi-ad/home');
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/tinhienthi-ad/home');
				}
			} 
			else{

				redirect('admin/tinhienthi-ad/home');
			}
			
		}
		
		$data['article'] = $this->tintuc->laytinhienthi();
	
		
		$this->render($this->load->view('admin/tinhienthi/tinhienthi', $data, TRUE));
		
	}
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
		/*if($this->tintuc->parent_exists($id)) {
			$this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
			redirect('admin/tintuc');
		} else {
		*/
			if($this->tintuc->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/tinhienthi-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/tinhienthi-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/tintuc.php */