<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# maillienhe controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class Maillienhe extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('maillienhe/maillienhe_model', 'maillienhe');
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục maillienhe' => base_url().'admin/maillienhe-ad/home');
		$data['heading_title'] = 'Quản lý mail liên hệ';
		$del = $this->input->post('selected');

		/*$page = $this->input->get('page') ? $this->input->get('page') : 1;
		$active = (int)$this->input->get('active');
		$show = (int)$this->input->get('show');
		//print_r($delete);
		*/
		if($this->input->post('act_del') == 'act_del') {
			
			if($del) {
			
				if(gettype($del) == 'array' && count($del) > 0) {
				
					foreach($del as $id) {
						
						if($this->maillienhe->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/maillienhe-ad/home');
						}
						
					} //End foreach
				redirect('admin/maillienhe-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/maillienhe-ad/home');
			}
			
		}
		
			
		
		$article = $this->maillienhe->get_maillienhe_where(null, array('id' => 'DESC'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'hoten' 		=> $result->hoten,
					'email'		=> $result->email,
					'tieude' 		=> $result->tieude,
					'noidung' 		=> $result->noidung,
                    'thoigian' 		=> $result->thoigian,
					'url_edit'	=> base_url().'admin/maillienhe-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/maillienhe-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/maillienhe/index', $data, TRUE));
	
	}
	
	
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
		/*if($this->maillienhe->parent_exists($id)) {
			$this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
			redirect('admin/maillienhe');
		} else {
		*/
			if($this->maillienhe->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/maillienhe-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/maillienhe-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/maillienhe.php */