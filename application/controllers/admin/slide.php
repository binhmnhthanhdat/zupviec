<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# slide controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class Slide extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('slide/slide_model', 'slide');
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục slide' => base_url().'admin/slide-ad/home');
		$data['heading_title'] = 'Quản lý slide';
		$data['url_create'] = base_url().'admin/slide-ad/add_edit';
		$data['action'] = base_url().'admin/slide-ad/add_edit';
		
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
						
						if($this->slide->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/slide-ad/home');
						}
						
					} //End foreach
				redirect('admin/slide-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/slide-ad/home');
			}
			
		}
		
			
		
		$article = $this->slide->get_slide_where(null, array('id' => 'DESC'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'name' 		=> $result->name,
					'contents'		=> $result->contents,
					'img'		=> $result->img,
					'url'		=> $result->url,
					'ord'		=> $result->ord,
					'active'		=> $result->active,
					'url_edit'	=> base_url().'admin/slide-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/slide-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/slide/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh sách slide' => base_url().'admin/slide-ad/home');
		$data['heading_title'] = 'Tạo - Cập nhật slide';
		$data['action'] = base_url().'admin/slide-ad/add_edit';
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
	

		//$this->form_validation->set_rules('ord', 'Sap xep', 'trim|required');
		//$this->form_validation->set_rules('', 'Name', 'trim|required');
		//$this->form_validation->set_rules('show_home', 'Show home', '');
		
		$data['name'] = $this->input->post('name');
		$data['active'] = ($this->input->post('active') == 'on') ? 1 : 0;
		$data['ord'] = $this->input->post('ord');
		$data['url'] = $this->input->post('url');
		
		$data['contents'] = $this->input->post('detail');	
		$id = (int)$this->input->post('id');
		$oldImage = $this->input->post('oldImage');
		if($this->form_validation->run() == TRUE) {
			
			$config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath(APPPATH . '../images/slide'),
							'max_size' => 2000000
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
			
				if($this->slide->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/slide-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/slide-ad/add_edit');
				}
			} else {
				
					if($this->slide->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/slide-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/slide-ad/add_edit');
					}
				
			}
			
		}
		
		if($_id !='') $data['article'] = $this->slide->get_by_id($_id);
		//$data['root'] = $this->slide->get_root_slide(0);
		
		$this->render($this->load->view('admin/slide/slide_form', $data, TRUE));
		
	}
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
		/*if($this->slide->parent_exists($id)) {
			$this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
			redirect('admin/slide');
		} else {
		*/
			if($this->slide->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/slide-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/slide-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/slide.php */