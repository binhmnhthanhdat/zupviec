<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*-----------------------------------------------
# Rao_vat version 1.0
# Model User
# Extends CI_Model
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 28/04/2011
------------------------------------------------*/


class User_model extends CI_Model {

	var $table = 'user_user';

	function __construct() {
		parent::__construct();
	}

	/*
	function reset() {
		$this->table_name = 'user_user';
		$this->table_id = 'user_id';
	}
	*/
	
	function create($_data)
	{
		$this->db->set('user_name', $_data['user_name']);
		$this->db->set('user_password', $_data['user_password']);
		$this->db->set('user_email', $_data['user_email']);
		$this->db->set('user_fullname', $_data['user_fullname']);
		$this->db->set('user_active', $_data['user_active']);
		
				
		if($this->db->insert($this->table)) return TRUE; else return FALSE;
	}
	
	
	function update($id, $_data) {
		$this->db->where('user_id',$id);
		$this->db->set('user_email', $_data['user_email']);
		$this->db->set('user_fullname', $_data['user_fullname']);
		
		if($this->db->update($this->table)) return TRUE; else return FALSE;
		
	}
	
	
	function change_pass($id, $oldpass, $newpass) {
		
		$q = $this->db->get_where($this->table, array('user_id' => $id));
		if($q->num_rows() > 0) {
			
			$result = $q->row();
			
			if($result->user_password !== $oldpass) {
				return FALSE;
			} else {
				
				$this->db->where('user_id', $id);
				$this->db->set('user_password', $newpass);
				$this->db->update($this->table);
				
				return TRUE;			
			}
			
		}
		
	}
	
	
	function read($id) {
		$this->db->where('user_id', $id);
		$this->db->select('user_fullname,user_email');
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function selectAll($active = null, $group = null, $limit, $offset) {
	
		$this->db->where('user_name !=', 'admin');
		if($active !=null) $this->db->where('user_active', $active);
		if($group != null) $this->db->where('user_group_id', $group);
		$this->db->limit($offset, $limit);
		
		$q = $this->db->get($this->table);
		if($q->num_rows() > 0) {
			return $q;
		} else {
			return FALSE;
		}
		
		$q->free_result();
	}
	
	
	function total($active = null, $group = null) {
	
		$this->db->where('user_name !=', 'admin');
		if($active !=null) $this->db->where('user_active', $active);
		if($group != null) $this->db->where('user_group_id', $group);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	
	function change_group($userid, $group) {
		$this->db->where('user_id', $userid);
		$this->db->set('user_group_id', $group);
		
		if($this->db->update($this->table)) return TRUE; else return FALSE;
	}
	
	
	function delete($id)
	{
		$this->db->where('user_id', $id);
		if($this->db->delete($this->table)) return TRUE; else return FALSE;
	}
	
	
	
	function check_username($username) {
		$q = $this->db->get_where($this->table, array('user_name' => $username));
		if($q->num_rows > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}	
	
	
	function check_email($email) {
		$q = $this->db->get_where($this->table, array('user_email' => $email));
		if($q->num_rows() > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	
	function login($username) {
	
		$q = $this->db->get_where($this->table, array('user_name' => $username));
		if($q->num_rows() > 0 ) {
			return $q->row();
		} else {
			return FALSE;
		}
	
	}
	
	
}
/* End file user_model */
/* Local file application/models/user/user_model.php */