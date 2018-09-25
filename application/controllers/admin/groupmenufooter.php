<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# menu controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class groupmenufooter extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('danhmucdichvu/groupmenufooter_model', 'groupmenufooter');
			$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục Group menu footer' => base_url().'admin/groupmenufooter-ad/home');
		$data['heading_title'] = 'Quản lý danh mục';
		$data['url_create'] = base_url().'admin/groupmenufooter-ad/add_edit';
		$data['action'] = base_url().'admin/groupmenufooter-ad/add_edit';
		
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
						
						if($this->groupmenufooter->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/groupmenufooter-ad/home');
						}
						
					} //End foreach
				redirect('admin/groupmenufooter-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/groupmenufooter-ad/home');
			}
			
		}
		
			
		
		$article = $this->groupmenufooter->get_menu_where(null, array('id' => 'asc'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'ord' 		=> $result->ord,
                    'link' 		=> $result->link,
					'name'		=> $result->name,
					'active' 		=> $result->active,
					'metakeyword' 		=> $result->metakeyword,
                    'metadescription' 		=> $result->metadescription,
					'url_edit'	=> base_url().'admin/groupmenufooter-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/groupmenufooter-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/groupmenufooter/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin', 'Danh mục Grou[ menu footer' => base_url().'admin/groupmenufooter');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/groupmenufooter-ad/add_edit';
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$data['name'] = $this->input->post('name');
	
		$data['ord'] = $this->input->post('ord');
        $data['link'] = $this->input->post('link');
         $data['metakeyword'] =trim($this->input->post('metakeyword'));
        $data['metadescription'] = trim($this->input->post('metadescription'));
		$data['active'] = ($this->input->post('active') == 'on') ? 1 : 0;		
		$id = (int)$this->input->post('id');
		
		if($this->form_validation->run() == TRUE) {
			
			if($id && $id !='') {
			
				if($this->groupmenufooter->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/groupmenufooter-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/groupmenufooter-ad/add_edit');
				}
			} else {
				
					if($this->groupmenufooter->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/groupmenufooter-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/groupmenufooter-ad/add_edit');
					}
				
			}
			
		}
	//	$data['cat'] = $this->menu->get_menu_where(array('parent'=>'0'), array('id' => 'DESC'), null);
		if($_id !='') $data['article'] = $this->groupmenufooter->get_by_id($_id);
		//$data['root'] = $this->menu->get_root_menu(0);
		
		$this->render($this->load->view('admin/groupmenufooter/menu_form', $data, TRUE));
		
	}
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
		/*if($this->menu->parent_exists($id)) {
			$this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
			redirect('admin/menu');
		} else {
		*/
			if($this->groupmenufooter->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/groupmenufooter-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/groupmenufooter-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/menu.php */