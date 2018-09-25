<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# menu controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class grouphoidap extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('danhmucdichvu/grouphoidap_model', 'grouphoidap');
			$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục Group hỏi đáp' => base_url().'admin/grouphoidap-ad/home');
		$data['heading_title'] = 'Quản lý danh mục';
		$data['url_create'] = base_url().'admin/grouphoidap-ad/add_edit';
		$data['action'] = base_url().'admin/grouphoidap-ad/add_edit';
		
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
						
						if($this->grouphoidap->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/grouphoidap-ad/home');
						}
						
					} //End foreach
				redirect('admin/grouphoidap-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/grouphoidap-ad/home');
			}
			
		}
		
			
		
		$article = $this->grouphoidap->get_menu_where(null, array('id' => 'asc'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'ord' 		=> $result->ord,
					'name'		=> $result->name,
					'active' 		=> $result->active,
					'metakeyword' 		=> $result->metakeyword,
                    'metadescription' 		=> $result->metadescription,
					'url_edit'	=> base_url().'admin/grouphoidap-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/grouphoidap-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/grouphoidap/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục Group hỏi đáp' => base_url().'admin/grouphoidap-ad/home');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/grouphoidap-ad/add_edit';
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$data['name'] = $this->input->post('name');
	
		$data['ord'] = $this->input->post('ord');
        $data['metakeyword'] =trim($this->input->post('metakeyword'));
        $data['metadescription'] = trim($this->input->post('metadescription'));
 	     // $data['type'] = $this->input->post('type');
		$data['active'] = ($this->input->post('active') == 'on') ? 1 : 0;		
		$id = (int)$this->input->post('id');
		
		if($this->form_validation->run() == TRUE) {
			
			if($id && $id !='') {
			
				if($this->grouphoidap->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/grouphoidap-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/grouphoidap-ad/add_edit');
				}
			} else {
				
					if($this->grouphoidap->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/grouphoidap-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/grouphoidap-ad/add_edit');
					}
				
			}
			
		}
		if($_id !='') $data['article'] = $this->grouphoidap->get_by_id($_id);
		$this->render($this->load->view('admin/grouphoidap/menu_form', $data, TRUE));
		
	}
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
			if($this->grouphoidap->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/grouphoidap-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/grouphoidap-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/menu.php */