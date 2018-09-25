<?php  if(!defined('BASEPATH')) exit ('Woa...Not Find System Folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# Model Setting
# Extends CI_Model
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 26/04/2011
------------------------------------------------*/

class Setting_model extends CI_Model {

	var $table = 'setting';

	function __construct() {
		parent:: __construct();
	}
	
	
	function update($data) {
		
		$this->db->where('id', 1);
		$this->db->set('site_name', $data['site_name']);
		$this->db->set('meta_key', $data['meta_key']);
		$this->db->set('meta_desc', $data['meta_desc']);
		$this->db->set('site_status', $data['site_status']);
		$this->db->set('google_analytics', $data['google_analytic']);
		$this->db->set('per_page', $data['product_perpage']);
		$this->db->set('address', $data['address']);
		$this->db->set('phone', $data['phone']);
		
		if($this->db->update($this->table)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	
	function get() {
		$q = $this->db->get($this->table);
		return $q->row();
		
		$q->free_result();
	}

}

/* End file province_model */
/* Local file application/models/other/setting_model.php */