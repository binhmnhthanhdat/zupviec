<?php  if(!defined('BASEPATH')) exit ('Woa...Not Find System Folder');
/*-----------------------------------------------
# Rao_vat version 1.0
# Model User_group_model
# Extends CI_Model
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 28/04/2011
------------------------------------------------*/
	
	class User_group_model extends CI_Model
	{
	
			var $table = 'user_group';
	
			function __construct()
			{
				parent:: __construct();
			}
			
			
			function create($data)
			{
				$arr = array('user_group_name' => $data['name'], 'permission_view' => $data['permis_view'], 'permission_edit_del' => $data['permis_edit_delete']);
				
				$this->db->set($arr);
				if($this->db->insert($this->table)) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
			
			
			function update($id,$data)
			{
				$this->db->where('user_group_id', $id);
				$arr = array('user_group_name' => $data['name'], 'permission_view' => $data['permis_view'], 'permission_edit_del' => $data['permis_edit_delete']);
				
				$this->db->set($arr);
								
				if($this->db->update($this->table)) return TRUE; else return FALSE;
			}
			
			
			function read($id) 
			{
				$this->db->where('user_group_id', $id);
				
				$query = $this->db->get($this->table);
				
				return $query->row();
			}
			
			
			function selectAll($where = null, $orderby = null, $limit = null)
			{
				if($where!=NULL) {
					foreach($where as $key => $value) {
						if($key[0] =='?') {
							$this->db->where(substr($key, 1), $value);
						} else if($key[0] =='!') {
							$this->db->where_not_in(substr($key, 1), $value);
						} else {
							$this->db->where($key, $value);
						}
					}
				}
				
				if($orderby !=NULL) {
					foreach($orderby as $key => $value) {
						$this->db->order_by($key, $value);
					}
				}
				
				if($limit !=NULL) {
					$this->db->limit($limit['max'], $limit['begin']);
				}
				
				$query = $this->db->get($this->table);
				
				
				return $query;
				
				$query->free_result();
				
			}
			
			function get() {
				$q = $this->db->get('user_group');
				return $q;
				$q->free_result();
			}
			
			
			function get_group_name($id) 
			{
				$this->db->where('user_group_id', $id);
				$this->db->select('user_group_name');
				$q = $this->db->get($this->table)->row();
				
				
				return $q->user_group_name;
			}
			
			function delete($id) {
				$this->db->where('user_group_id', $id);
				if($this->db->delete($this->table)) return TRUE; else FALSE;
			}
	
} // End class