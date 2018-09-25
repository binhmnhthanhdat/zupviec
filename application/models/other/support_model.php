<?php  if(!defined('BASEPATH')) exit ('Woa...Not Find System Folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# Model Support Nickname
# Extends CI_Model
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 28/04/2011
------------------------------------------------*/

class Support_model extends CI_Model {

	var $table = 'support';

	function __construct() {
	
		parent:: __construct();
	
	}
	
	
	function add($data) {
		
		$this->db->set('s_nickname', $data['nickname']);
		$this->db->set('s_desc', $data['s_desc']);
		if($this->db->insert($this->table)) return TRUE; else return FALSE;
		
	}
	
	
	function update($id, $data) {
	
		$this->db->where('s_id', $id);
		$this->db->set('s_nickname', $data['nickname']);
		$this->db->set('s_desc', $data['s_desc']);
		if($this->db->update($this->table)) return TRUE; else return FALSE;
	
	}
	
	
	function get_by_id($id) {
		
		$q = $this->db->get_where($this->table, array('s_id' => $id));
		
		return $q->row();
	
	}
	
	
	function get_name($id) {
		
		$q = $this->db->select('s_nickname')->get_where($this->table, array('s_id' => $id))->row();
		return $q->s_nickname;
		
	}
	
	
	function get_all($order) {
	
		$this->db->order_by('s_id', $order);
		$q = $this->db->get($this->table);
		return $q;
		
		$q->free_result();
		
	}
	
	
	function delete($id) {
	
		$this->db->where('s_id', $id);
		if($this->db->delete($this->table)) return TRUE; else return FALSE;
	
	}

}

/* End file support_model */
/* Local file application/models/other/support_model.php */