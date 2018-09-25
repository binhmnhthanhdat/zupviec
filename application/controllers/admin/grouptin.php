<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# grouptin controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class grouptin extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('grouptin/grouptin_model', 'grouptin');
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục tin tuc' => base_url().'admin/grouptin-ad/home');
		$data['heading_title'] = 'Quản lý tin tuc';
		$data['url_create'] = base_url().'admin/grouptin-ad/add_edit';
		$data['action'] = base_url().'admin/grouptin-ad/add_edit';
		
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
						
						if($this->grouptin->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/grouptin-ad/home');
						}
						
					} //End foreach
				
				} // End if
			redirect('admin/grouptin-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/grouptin-ad/home');
			}
			
		}
		
			
		
		$article = $this->grouptin->get_grouptin_where(array('type'=>'1'), array('id' => 'asc'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'title' 		=> $result->title,
					'name'		=> $result->name,
                    'description'		=> $result->description,
					'tag' 		=> $result->tag,
                    'content' 		=> $result->content,
					'images' 		=> $result->images,
                    'icon' 		=> $result->icon,
					'alias'		=> $result->alias,
					'type' 		=> $result->type,
                    'metakeyword' 		=> $result->metakeyword,
                    'metadescription' 		=> $result->metadescription,
					
					'url_edit'	=> base_url().'admin/grouptin-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/grouptin-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/grouptin/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục group tin tức' => base_url().'admin/grouptin-ad/home');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/grouptin-ad/add_edit';
		
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		$data['title'] = $this->input->post('title');
        
		$data['name'] = $this->input->post('name');
        $data['alias'] = $this->util->alias($data['name']);
        $data['metakeyword'] =trim($this->input->post('metakeyword'));
        $data['metadescription'] = trim($this->input->post('metadescription'));
      
		$id = (int)$this->input->post('id');
		$oldImage = $this->input->post('oldImage');
		if($this->form_validation->run() == TRUE) {
			
            
            $config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath(APPPATH . '../images/slide'),
							'max_size' => 200000
						);
						$this->load->library('upload', $config);
						$this->upload->do_upload();
						$image_data = $this->upload->data();
						//$avatar ='images/tintuc/'.$image_data['file_name'];
				
                
			if($image_data['file_name'] !='')
			{
						if($oldImage !='')
						{
							$this->deleteFile($oldImage);
							//$this->deleteFile($oldImageThumb);
						}
				$data['image'] = 'images/slide/'.$image_data['file_name'];
				
			} else {
				if($oldImage !='' ) {
					$data['image'] = $oldImage;
					
				} else {
					$data['image'] = '';
					//$data['image_thumb'] = '';
				}
			} // End upload file
			



			if($id && $id !='') {
			
				if($this->grouptin->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/grouptin-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/grouptin-ad/add_edit');
				}
			} else {
				
					if($this->grouptin->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/grouptin-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/grouptin-ad/add_edit');
					}
				
			}
			
		}
		
		if($_id !='') $data['article'] = $this->grouptin->get_by_id($_id);
		
		
		$this->render($this->load->view('admin/grouptin/grouptin_form', $data, TRUE));
		
	}
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
		/*if($this->grouptin->parent_exists($id)) {
			$this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
			redirect('admin/grouptin');
		} else {
		*/
			if($this->grouptin->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/grouptin-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/grouptin-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/grouptin.php */