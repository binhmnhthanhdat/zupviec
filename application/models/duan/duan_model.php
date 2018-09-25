<?php 
if(!defined('BASEPATH')) exit ('Woa...Not Find System Folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# Model Category
# Extends CI_Model
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 26/04/2011
------------------------------------------------*/
class duan_model extends CI_Model {

	var $table = 'project';
	
	function __construct() {
		
		parent:: __construct();
		
	}
	
	
	function add($data) {
		
		$this->db->set('title', $data['name']);
		$this->db->set('customer', $data['customer']);
		$this->db->set('introduction', $data['introduction']);
		$this->db->set('display', $data['active']);
        $this->db->set('metakeyword', $data['metakeyword']);
		$this->db->set('metadescription', $data['metadescription']);
        $this->db->set('alias', $data['alias']);
        $this->db->set('img', $data['images']);
       // $this->db->set('thanhpho', $data['thanhpho']);
       // $this->db->set('images', $data['images']);
        $this->db->set('id_group_project', $data['id_group_project']);
		if($this->db->insert($this->table)) return TRUE; else return FALSE;
		
	}
	
	
	function update($id, $data) {
		
		$this->db->where('id', $id);
		$this->db->set('title', $data['name']);
		$this->db->set('customer', $data['customer']);
		$this->db->set('introduction', $data['introduction']);
		$this->db->set('display', $data['active']);
        $this->db->set('id_group_project', $data['id_group_project']);
        $this->db->set('metakeyword', $data['metakeyword']);
		$this->db->set('metadescription', $data['metadescription']);
        $this->db->set('alias', $data['alias']);
        $this->db->set('img', $data['images']);
		
		if($this->db->update($this->table)) return TRUE; else return FALSE;
		
	}
	
	
	function get_by_id($id) {
		
		$q = $this->db->get_where($this->table, array('id' => $id));
		
		return $q->row();
		
		$q->free_result();
	}
	
	
	function get_root_category($parent) {
		
		$q = $this->db->get_where($this->table, array('parent' => $parent));
		
		return $q;
		
		$q->free_result();
		
	}
	
	
	function delete($id) {
		
		$this->db->where('id', $id);
		
		if($this->db->delete($this->table)) return TRUE; else return FALSE;
		
	}
	
	
	function get_duan_where($where = null, $order = null, $limit = null) {
		
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
	
	public function totals()
	{
		return $this->db->count_all_results($this->table);
	}
	function get_parent_name($idparent) {
		
		$this->db->select('name');
		$q = $this->db->get_where($this->table, array('id' => $idparent));
		if($q->num_rows>0)
		{
		$result = $q->row();
		
		return $result->name;
		}
		else
		{

			return "---------";
		}
	}
	function get_all($root) {
		
		$cat = array();
		
		$q = $this->db->query("SELECT * FROM category WHERE parent = ".$root);
		
		foreach($q->result() as $row) {
			$cat[] = array(
				'cat_id' 		=> $row->id,
				'cat_name' 		=> $this->getPath($row->id),
				'cat_show'		=> $row->show_home,
				'cat_active'	=> $row->active
			);
			
			$cat = array_merge($cat, $this->get_all($row->id));
		}
		
		return $cat;
	}
	
	function getPath($id) {
		
		$query = $this->db->query("SELECT * FROM category WHERE id=".$id);
		
		$category = $query->row();
		if($category->parent) {
			return $this->getPath($category->parent). '&nbsp;>&nbsp;'.$category->category_name;
		} else  {
			return $category->category_name;
		}
		
	}
	
	
	function get_name($id) {
		
		$this->db->select('name');
		$q = $this->db->get_where($this->table, array('id' => $id));
		if($q->num_rows>0)
		{
		$result = $q->row();
		
		return $result->name;
		}
		else
		{
			return "-------";
		}
	}
	
	function get_name_alias($id) {
		
		$this->db->select('alias');
		$q = $this->db->get_where($this->table, array('catid' => $id));
		
		$result = $q->row();
		
		return $result->alias;
		
	}

}
// End file
// Local appllication/models/product/cateegory_model.php
