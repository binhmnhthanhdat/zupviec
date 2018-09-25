<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# tintuc controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class Tintuc extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('tintuc/tintuc_model', 'tintuc');
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin', 'Danh mục tin tuc' => base_url().'admin/new');
		$data['heading_title'] = 'Quản lý tin tuc';
		$data['url_create'] = base_url().'admin/tintuc/add_edit';
		$data['action'] = base_url().'admin/tintuc/add_edit';
		
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
						
						if($this->tintuc->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							//redirect('admin/article_type');
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/tintuc');
						}
						
					} //End foreach
				
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/tintuc');
			}
			
		}
		
			
		
		$article = $this->tintuc->get_tintuc_where( array('type' => '0'), array('id' => 'DESC'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'title' 		=> $result->title,
					'img'		=> $result->img,
                    'img_big'		=> $result->img_big,
					'description' 		=> $result->description,
                    'content' 		=> $result->content,
					'tag' 		=> $result->tag,
                    'id_group_new' 		=> $result->id_group_new,
					'hot'		=> $result->hot,
					'display' 		=> $result->display,
					'id_group_project' 		=> $result->id_group_project,
                    'type' => $result->type,
                    'alias' 		=> $result->alias,
					'url_edit'	=> base_url().'admin/tintuc/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/tintuc/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/tintuc/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin', 'Danh mục sản phẩm' => base_url().'admin/tintuc');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/tintuc/add_edit';
		
		
		$this->form_validation->set_rules('title', 'Name', 'trim|required');
	//	$this->form_validation->set_rules('detail', 'Name', 'trim|required');

		//$this->form_validation->set_rules('ord', 'Sap xep', 'trim|required');
		//$this->form_validation->set_rules('', 'Name', 'trim|required');
		//$this->form_validation->set_rules('show_home', 'Show home', '');
		
		$data['title'] = $this->input->post('title');
		//$data['active'] = $this->input->post('active');
		$data['image'] = $this->input->post('image');
		$data['modified'] = $this->input->post('modified');
        $data['brief'] = $this->input->post('brief');
		$data['content'] = $this->input->post('detail');
        	$data['ord'] = $this->input->post('ord');
        $data['cat_new_id'] = $this->input->post('cat_new_id');
		$data['active'] = ($this->input->post('active') == 'on') ? 1 : 0;
 	    $data['home'] = ($this->input->post('home') == 'on') ? 1 : 0;
        $data['tin_box_chinh'] = ($this->input->post('tin_box_chinh') == 'on') ? 1 : 0;	
        $data['type'] = ($this->input->post('tin_tuyen_dung') == 'on') ? 2 : 0;	
       		
		$id = (int)$this->input->post('id');
		$oldImage = $this->input->post('oldImage');
		if($this->form_validation->run() == TRUE) {
			
			$config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath(APPPATH . '../images/tintuc'),
							'max_size' => 2000
						);
						$this->load->library('upload', $config);
						$this->upload->do_upload();
						$image_data = $this->upload->data();
						//$avatar ='images/tintuc/'.$image_data['file_name'];
						$config = array(
							'source_image' => $image_data['full_path'],
							'new_image' =>realpath(APPPATH . '../images/tintuc') . '/thumbs',
							'maintain_ration' => true,
							'width' => 155,
							'height' => 155
						);
						
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();


						
							
						
			
			if($image_data['file_name'] !='')
			{
						if($oldImage !='')
						{
							$this->deleteFile($oldImage);
							//$this->deleteFile($oldImageThumb);
						}
				$data['image'] = 'images/tintuc/'.$image_data['file_name'];
				
			} else {
				if($oldImage !='' ) {
					$data['image'] = $oldImage;
					
				} else {
					$data['image'] = '';
					//$data['image_thumb'] = '';
				}
			} // End upload file
			



			if($id && $id !='') {
			
				if($this->tintuc->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/tintuc/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/tintuc/add_edit');
				}
			} else {
				
					if($this->tintuc->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/tintuc');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/tintuc/add_edit');
					}
				
			}
			
		}
		
		if($_id !='') $data['article'] = $this->tintuc->get_by_id($_id);
		//$data['root'] = $this->tintuc->get_root_tintuc(0);
        $sql="select * from cat_new where type=3 and parent=3";	
         $data['cat']= $this->db->query($sql)->result();
		
		$this->render($this->load->view('admin/tintuc/tintuc_form', $data, TRUE));
		
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
				redirect('admin/tintuc');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/tintuc');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/tintuc.php */