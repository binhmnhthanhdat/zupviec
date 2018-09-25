<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# tintuc controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class listgioithieu extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('tintuc/listgioithieu_model', 'listgioithieu');
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục tin tuc' => base_url().'admin/listgioithieu-ad/home');
		$data['heading_title'] = 'Quản lý tin tuc';
		$data['url_create'] = base_url().'admin/listgioithieu-ad/add_edit';
		$data['action'] = base_url().'admin/listgioithieu-ad/add_edit';
		
		$del = $this->input->post('selected');

	   if($this->input->post('act_del') == 'act_del') {
			
			if($del) {
			
				if(gettype($del) == 'array' && count($del) > 0) {
				
					foreach($del as $id) {
						
						if($this->listgioithieu->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/listgioithieu-ad/home');
						}
						
					} //End foreach
				redirect('admin/listgioithieu-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/listgioithieu-ad/home');
			}
			
		}
	
           // $article = $this->listgioithieu->get_listgioithieu_where(array('type'=>'2'), array('id' => 'asc'), null);
        $sql="select * from group_new where type=2 or type=5 order by id asc";	
        $article= $this->db->query($sql);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'name' 		=> $result->name,
                    'title' 		=> $result->title,
				    'metakeyword' 		=> $result->metakeyword,
                    'metadescription' 		=> $result->metadescription,
                    
                   'content'=> $result->content,
					'url_edit'	=> base_url().'admin/listgioithieu-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/listgioithieu-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/listgioithieu/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh sách tin tức' => base_url().'admin/listgioithieu-ad/home');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/listgioithieu-ad/add_edit';
		
		
		$this->form_validation->set_rules('title', 'Name', 'trim|required');
	   	$data['name'] = $this->input->post('name');
		$data['title'] = $this->input->post('title');
        $data['alias'] = $this->util->alias($data['name']);
		
        $data['metakeyword'] =trim($this->input->post('metakeyword'));
        $data['metadescription'] = trim($this->input->post('metadescription'));	
        $data['content'] = $this->input->post('detail');	
		$id = (int)$this->input->post('id');
	
		if($this->form_validation->run() == TRUE) {
			
			
            if($id && $id !='') {
			
				if($this->listgioithieu->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/listgioithieu-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/listgioithieu-ad/add_edit');
				}
			} else {
				
					if($this->listgioithieu->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/listgioithieu-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/listgioithieu-ad/add_edit');
					}
				
			}
			
		}
		
		if($_id !='') $data['article'] = $this->listgioithieu->get_by_id($_id);
		//$data['root'] = $this->tintuc->get_root_tintuc(0);
        
		
		$this->render($this->load->view('admin/listgioithieu/listgioithieu_form', $data, TRUE));
		
	}
	
	
	function delete(){
			$id = $this->uri->segment(4);
			if($this->listgioithieu->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/listgioithieu-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/listgioithieu-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/tintuc.php */