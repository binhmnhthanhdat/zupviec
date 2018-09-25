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
	    $this->load->helper(array('form','url','date'));
		$this->load->library('form_validation');
        $this->load->library('pagination'); 
        $this->load->helper('url'); 
	}
	
	public function index() {
	 
		$data = array();
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh mục tin tuc' => base_url().'admin/tintuc-ad/home');
		$data['heading_title'] = 'Quản lý tin tuc';
		$data['url_create'] = base_url().'admin/tintuc-ad/add_edit';
		$data['action'] = base_url().'admin/tintuc-ad/add_edit';
		
		$del = $this->input->post('selected');
		
		$page 	= (int)$this->input->get('page');
		$title 	=  $this->input->get('title') ?  $this->input->get('title') : NULL;
        $des 	= $this->input->get('des') ;
		$tag 	= $this->input->get('tag');
		$news_group	=  $this->input->get('news_group');
		$project_group	=  $this->input->get('project_group');
        $status	=  $this->input->get('status') ;
		$data['_title'] = $title;
		$data['_des'] = $des;
		$data['_tag'] = $tag;
        $data['_news_group'] = $news_group;
        $data['_project_group'] = $project_group;
        $data['_status']=$status;
		
		
		

	   if($this->input->post('act_del') == 'act_del') {
			
			if($del) {
			
				if(gettype($del) == 'array' && count($del) > 0) {
				
					foreach($del as $id) {
						
						if($this->tintuc->delete($id)) {
							$this->session->set_flashdata('warning', 'Xóa danh mục thành công');
							
						} else {
							$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
							redirect('admin/tintuc-ad/home');
						}
						
					} //End foreach
				redirect('admin/tintuc-ad/home');
				} // End if
			
			} else {
				$this->session->set_flashdata('warning', 'Cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/tintuc-ad/home');
			}
			
		}
		
		
		
		// Config pagination
		$config['base_url'] = base_url().'admin/tintuc-ad/home/?title='.$title.'&des='.$des.'&tag='.$tag.'&news_group='.$news_group.'&project_group='.$project_group.'&status='.$status;
		$config['total_rows'] = $this->tintuc->total_news($title, $des, $tag,$news_group,$project_group,$status);
		$config['per_page'] = 20;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['num_links'] = 10;
		$this->pagination->initialize($config);
		$data['page'] = $this->pagination->create_links();
		
		$data['article'] = $this->tintuc->get_all_news(array('id', 'title', 'img', 'img_big', 'description', 'content', 'tag', 'id_group_new', 'hot', 'display', 'id_group_project', 'alias', 'type', 'metakeyword', 'metadescription', 'ord', 'modified', 'active', 'tin_box_chinh', 'post_date'),$title, $des, $tag,$news_group,$project_group,$status,null, array('id' => 'asc'), array('max' => $config['per_page'], 'begin' => $page));
		
		
		
         // $config['base_url'] = base_url('admin/tintuc-ad/home/'); // xác đ?nh trang phân trang 
       
        // $config['per_page'] = 10; // xác đ?nh s? record ? m?i trang 
        // $config['uri_segment'] = 4; // xác đ?nh segment ch?a page number 
       // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		// if(isset($_POST["boloc"]) or isset($_POST["boloc_project"]) )
        // {
             
                // $article = $this->tintuc->get_tintuc_where(null, array('id' => 'asc'), array('max' => $config['per_page'], 'begin' => $page));
                // $config['total_rows'] =$this->tintuc->get_tintuc_where(null, array('id' => 'asc'),null)->num_rows(); 
            
           
       
        // }else
        // {
            // $article = $this->tintuc->get_tintuc_where(null, array('id' => 'asc'), array('max' => $config['per_page'], 'begin' => $page));
            // $config['total_rows'] =$this->tintuc->get_tintuc_where(null, array('id' => 'asc'),null)->num_rows(); 
           
        // }
		$data['sobanghi']=$config['total_rows'];
        // $this->pagination->initialize($config); 
        
			foreach($data['article']->result() as $result) {			
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
                    'metakeyword' 		=> $result->metakeyword,
                    'metadescription' 		=> $result->metadescription,
                    'type' => $result->type,
                    'alias' 		=> $result->alias,
                   'post_date'=> $result->post_date,
                   'modified'=> $result->modified,
                   'display'=> $result->display,
					'url_edit'	=> base_url().'admin/tintuc-ad/add_edit/'.$result->id,
					'url_del'	=> base_url().'admin/tintuc-ad/delete/'.$result->id
				);
			}
		// echo "<pre>";
		// print_r($data['article']);
		// echo "</pre>";
		// exit;
		$sql="select * from group_new where type=1";	
         $data['news_group']= $this->db->query($sql)->result();
         
          $sql="select * from group_project";	
         $data['project_group']= $this->db->query($sql)->result();
		
		$this->render($this->load->view('admin/tintuc/index', $data, TRUE));
	
	}
	
	
	public function add_edit() {
		
		
		$_id = $this->uri->segment(4);
		$data['render_path'] = array('Admin' => base_url().'admin/trangchu/home', 'Danh sách tin tức' => base_url().'admin/tintuc-ad/home');
		$data['heading_title'] = 'Tạo - Cập nhật danh mục';
		$data['action'] = base_url().'admin/tintuc-ad/add_edit';
		
		
		$this->form_validation->set_rules('title', 'Name', 'trim|required');
	
		$data['title'] = $this->input->post('title');
        $data['alias'] = $this->util->alias($data['title']);
		$data['description'] = $this->input->post('description');
		$data['post_date'] = $this->input->post('post_date');
        $data['modified'] = $this->input->post('modified');
        $data['content'] = $this->input->post('detail');
 	    $data['ord'] = $this->input->post('ord');
        $data['tag'] = $this->input->post('tag');
        $data['id_group_new'] = $this->input->post('id_group_new');//id_group_project
        $data['id_group_project'] = $this->input->post('id_group_project');
	    $data['tin_box_chinh'] = ($this->input->post('tin_box_chinh') == 'on') ? 1 : 0;	
        $data['metakeyword'] =trim($this->input->post('metakeyword'));
        $data['metadescription'] = trim($this->input->post('metadescription'));
        $data['display'] = ($this->input->post('display') == 'on') ? 1 : 0;	
        $data['type'] = ($this->input->post('tin_tuyen_dung') == 'on') ? 2 : 0;	
			
		$id = (int)$this->input->post('id');
		$oldImage = $this->input->post('oldImage');
		if($this->form_validation->run() == TRUE) {
			

			
            $config = array(
							'allowed_types' => 'jpg|jpeg|gif|png',
							'upload_path' => realpath(APPPATH . '../images/news'),
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
				$data['image'] = 'images/news/'.$image_data['file_name'];
				
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
					redirect('admin/tintuc-ad/add_edit/'.$id);
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi rồi');
					redirect('admin/tintuc-ad/add_edit');
				}
			} else {
				
					if($this->tintuc->add($data)) {
						$this->session->set_flashdata('warning', 'Thêm mới Danh mục thành công');
                        //echo $data['content'];exit;
						redirect('admin/tintuc-ad/home');
					} else {
						$this->session->set_flashdata('warning', 'Có lỗi rồi');
						redirect('admin/tintuc-ad/add_edit');
					}
				
			}
			
		}
		
		if($_id !='') $data['article'] = $this->tintuc->get_by_id($_id);
		//$data['root'] = $this->tintuc->get_root_tintuc(0);
        $sql="select * from group_new where type=1";	
         $data['cat']= $this->db->query($sql)->result();
         
          $sql="select * from group_project";	
         $data['project']= $this->db->query($sql)->result();
		
		$this->render($this->load->view('admin/tintuc/tintuc_form', $data, TRUE));
		
	}
	
	
	function delete(){
			$id = $this->uri->segment(4);
			if($this->tintuc->delete($id)) {
				$this->session->set_flashdata('warning', 'Xóa danh mục thành công!');
				redirect('admin/tintuc-ad/home');
			} else {
				$this->session->set_flashdata('warning', 'Xóa danh mục Thất bại!');
				redirect('admin/tintuc-ad/home');
			}
		//}
	
	}
	

}
/* End file */
/* Local application/controllers/admin/tintuc.php */