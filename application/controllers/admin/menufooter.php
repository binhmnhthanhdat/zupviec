<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# menufooter controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class menufooter extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('danhmucdichvu/menufooter_model', 'menufooter');
		
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục menu footer' => base_url().'admin/menufooter-ad/home');
		$data['heading_title'] = 'Quản lý danh mục';
		$data['url_create'] = base_url().'admin/menufooter-ad/add_edit';
		$data['action'] = base_url().'admin/menufooter-ad/add_edit';
		
		$del = $this->input->post('selected');

		if($this->input->post('act_del') == 'act_del') {
			
			if($del) {
			
				if(gettype($del) == 'array' && count($del) > 0) {
				
					foreach($del as $id) {
						
						if($this->menufooter->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/menufooter-ad/home');
						}
						
					} //End foreach
				redirect('admin/menufooter-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/menufooter-ad/home');
			}
			
		}
		
			
		
		$article = $this->menufooter->get_menufooter_where(null, array('id' => 'asc'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'ord' 		=> $result->ord,
					'name'		=> $result->name,
					'link'		=> $result->link,
					'parent' 	=> $result->parent,
                    
					'url_edit'	=> base_url().'admin/menufooter-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/menufooter-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/menufooter/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin', 'Danh mục menu footer' => base_url().'admin/menufooter-ad/home');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/menufooter-ad/add_edit';
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		
		$data['name'] = $this->input->post('name');
		$data['ord'] = $this->input->post('ord');
        $data['parent'] = $this->input->post('parent');
	    $data['link'] = $this->input->post('link');
		$id = (int)$this->input->post('id');
		
		if($this->form_validation->run() == TRUE) {
			
			if($id && $id !='') {
			
				if($this->menufooter->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/menufooter-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/menufooter-ad/add_edit');
				}
			} else {
				
					if($this->menufooter->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/menufooter-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/menufooter-ad/add_edit');
					}
				
			}
			
		}
        $sql="select * from group_menufooter order by ord asc";	
         $data['cat']= $this->db->query($sql)->result();
	//	$data['cat'] = $this->menufooter->get_menufooter_where(array('parent'=>'0'), array('id' => 'DESC'), null);
		if($_id !='') $data['article'] = $this->menufooter->get_by_id($_id);
		//$data['root'] = $this->menufooter->get_root_menufooter(0);
		
		$this->render($this->load->view('admin/menufooter/menufooter_form', $data, TRUE));
		
	}
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
		/*if($this->menufooter->parent_exists($id)) {
			$this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
			redirect('admin/menufooter');
		} else {
		*/
			if($this->menufooter->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/menufooter-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/menufooter-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/menufooter.php */