<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# danhmucdichvu controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 02/05/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class duan extends Admin_controller {

	public function __construct() {
		
		parent:: __construct();
		
		// Check login
		$this->check_login();
		
		// Load model
		$this->load->model('duan/duan_model', 'duan');
			$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1','basePath' => base_url()."ckeditor/", 'outPut' => true)); 
	 
	}
	
	public function index() {
	
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục dự án' => base_url().'admin/duan-ad/home');
		$data['heading_title'] = 'Quản lý danh mục';
		$data['url_create'] = base_url().'admin/duan-ad/add_edit';
		$data['action'] = base_url().'admin/duan-ad/add_edit';
		
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
						
						if($this->duan->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/duan-ad/home');
						}
						
					} //End foreach
				redirect('admin/duan-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/duan-ad/home');
			}
			
		}
		
			
		
		$article = $this->duan->get_duan_where(null, array('id' => 'asc'), null);
			foreach($article->result() as $result) {			
				$data['lists'][] = array(
					'id' 		=> $result->id,
					'id_group_project' 		=> $result->id_group_project,
					'domain'		=> $result->domain,
					'customer' 		=> $result->customer,
					'title' 		=> $result->title,
                    'introduction' 		=> $result->introduction,
                    'img' 		=> $result->img,
                    'img_big' 		=> $result->img_big,
                    'hot' 		=> $result->hot,
                    'metakeyword' 		=> $result->metakeyword,
                    'metadescription' 		=> $result->metadescription,
                    'display' 		=> $result->display,
					'url_edit'	=> base_url().'admin/duan-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/duan-ad/delete/'.$result->id
				);
			}
		
		
		$this->render($this->load->view('admin/duan/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin/home', 'Danh mục dự án' => base_url().'admin/duan-ad/home');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/duan-ad/add_edit';
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		//$this->form_validation->set_rules('ord', 'Sap xep', 'trim|required');
		//$this->form_validation->set_rules('', 'Name', 'trim|required');
		//$this->form_validation->set_rules('show_home', 'Show home', '');
		
		$data['customer'] = $this->input->post('customer');
        $data['name'] = $this->input->post('name');
         $data['alias'] = $this->util->alias($data['name']);
        $data['introduction'] = $this->input->post('detail');
       $data['id_group_project'] = $this->input->post('id_group_project');
        $data['metakeyword'] =trim($this->input->post('metakeyword'));
        $data['metadescription'] = trim($this->input->post('metadescription'));
		//$data['active'] = $this->input->post('active');
	//	$data['ord'] = $this->input->post('ord');
		$data['active'] = ($this->input->post('active') == 'on') ? 1 : 0;		
		$id = (int)$this->input->post('id');
			$oldImage = $this->input->post('oldImage');
		if($this->form_validation->run() == TRUE) {
			
            	$config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath(APPPATH . '../images/project'),
							'max_size' => 20000
						);
						$this->load->library('upload', $config);
						$this->upload->do_upload();
						$image_data = $this->upload->data();
					
						
							
						
			
			if($image_data['file_name'] !='')
			{
						if($oldImage !='')
						{
							$this->deleteFile($oldImage);
							//$this->deleteFile($oldImageThumb);
						}
				$data['images'] = 'images/project/'.$image_data['file_name'];
				
			} else {
				if($oldImage !='' ) {
					$data['images'] = $oldImage;
					
				} else {
					$data['images'] = '';
					//$data['image_thumb'] = '';
				}

			} // End upload file
            
            
			if($id && $id !='') {
			
				if($this->duan->update($id,$data)) {
					$this->session->set_flashdata('warning', 'Cập nhật Danh mục thành công');
					redirect('admin/duan-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/duan-ad/add_edit');
				}
			} else {
				
					if($this->duan->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
						redirect('admin/duan-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/duan-ad/add_edit');
					}
				
			}
			
		}
	//	$data['cat'] = $this->duan->get_duan_where(array('parent'=>'0'), array('id' => 'DESC'), null);
		if($_id !='') $data['article'] = $this->duan->get_by_id($_id);
        $sql="select * from group_project";	
         $data['cat']= $this->db->query($sql)->result();
		//$data['root'] = $this->duan->get_root_duan(0);
		
		$this->render($this->load->view('admin/duan/duan_form', $data, TRUE));
		
	}
	
	
	function delete(){
		
		//$this->permission_edit_del();
		
		$id = $this->uri->segment(4);
		/*if($this->duan->parent_exists($id)) {
			$this->session->set_flashdata('message', 'Bạn cần xóa danh mục con trước khi xóa!');
			redirect('admin/duan');
		} else {
		*/
			if($this->duan->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/duan-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/duan-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/duan.php */