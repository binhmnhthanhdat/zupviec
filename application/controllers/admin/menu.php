<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# menu controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class Menu extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('danhmucdichvu/menu_model', 'menu');
			$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục menu' => base_url().'admin/menu-ad/home');
		$data['heading_title'] = 'Quản lý danh mục';
		$data['url_create'] = base_url().'admin/menu-ad/add_edit';
		$data['action'] = base_url().'admin/menu-ad/add_edit';
		
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
						
						if($this->menu->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/menu-ad/home');
						}
						
					} //End foreach
				    redirect('admin/menu-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/menu-ad/home');
			}
			
		}
		
			
		
		$article = $this->menu->get_menu_where(null, array('id' => 'asc'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'ord' 		=> $result->ord,
					'name'		=> $result->name,
                    'title'		=> $result->title,
					'active' 		=> $result->active,
					'image' 		=> $result->image,
                    'type' 		=> $result->type,
                    'metakeyword' 		=> $result->metakeyword,
                    'metadescription' 		=> $result->metadescription,
					'url_edit'	=> base_url().'admin/menu-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/menu-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/menu/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin', 'Danh mục sản phẩm' => base_url().'admin/menu-ad/home');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/menu-ad/add_edit';
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		
		$data['name'] = $this->input->post('name');
	   $data['title'] = $this->input->post('title');
		$data['ord'] = $this->input->post('ord');
        
        $data['metakeyword'] =trim($this->input->post('metakeyword'));
        $data['metadescription'] = trim($this->input->post('metadescription'));
 	    $data['type'] = $this->input->post('type');
		$data['active'] = ($this->input->post('active') == 'on') ? 1 : 0;		
		$id = (int)$this->input->post('id');
		$oldImage = $this->input->post('oldImage');
		if($this->form_validation->run() == TRUE) {
		  $config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath(APPPATH . '../images/menu'),
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
				$data['image'] = 'images/menu/'.$image_data['file_name'];
				
			} else {
				if($oldImage !='' ) {
					$data['image'] = $oldImage;
					
				} else {
					$data['image'] = '';
					//$data['image_thumb'] = '';
				}
			} // End upload file
            
            
		//	echo $data['image']; exit;
			if($id && $id !='') {
			
				if($this->menu->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/menu-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/menu-ad/add_edit');
				}
			} else {
				
					if($this->menu->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/menu-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/menu-ad/add_edit');
					}
				
			}
			
		}
	//	$data['cat'] = $this->menu->get_menu_where(array('parent'=>'0'), array('id' => 'DESC'), null);
		if($_id !='') $data['article'] = $this->menu->get_by_id($_id);
		//$data['root'] = $this->menu->get_root_menu(0);
		
		$this->render($this->load->view('admin/menu/menu_form', $data, TRUE));
		
	}
	
	
	function delete(){
		$id = $this->uri->segment(4);
			if($this->menu->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/menu-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/menu-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/menu.php */