<?php 
if(!defined('BASEPATH')) exit ('Woa...Not Find System Folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# Model Category
# Extends CI_Model
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 26/04/2011
------------------------------------------------*/
class Maillienhe_model extends CI_Model {

	var $table = 'lienhe';
	
	function __construct() {
		
		parent:: __construct();
		
	}
	
	
	
	function get_maillienhe_where($where = null, $order = null, $limit = null) {
		
		if($where !=null) {
			foreach($where as $key => $val) {
				if($key[0] =='?')
				{
					$this->db->where_in(substr($key, 1), $val);
				} elseif($key[0] =='!')
				{
					$this->db->where_not_in(substr($key, 1), $val);
				} else {
					$this->db->where($key, $val);
				}
			}
		}
		
		if($order != null) {
			foreach($order as $key => $val) {
				$this->db->order_by($key, $val);
			}
		}
		
		if($limit != null)
		{
			$this->db->limit($limit['max'], $limit['begin']);
		}
		
		$q = $this->db->get($this->table);
		
		return $q;
		
		$q->free_result();
		
	}
	
	function delete($id) {
		
		$this->db->where('id', $id);
		
		if($this->db->delete($this->table)) return TRUE; else return FALSE;
		
	}
}
// End file
// Local appllication/models/product/cateegory_model.php
