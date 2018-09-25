<?php 
if(!defined('BASEPATH')) exit ('Woa...Not Find System Folder');

/*-----------------------------------------------
# Rao_vat version 1.0
# Model Category
# Extends CI_Model
# Author: Nguyen Duc Hung - http://tinagroup.net
# Create date: 26/04/2011
------------------------------------------------*/
class Tintuc_model extends CI_Model {

	var $table = 'news';
	
	function __construct() {
		
		parent:: __construct();
		
	}
	
	
	function add($data) {
		
         $now = getdate(); 
             if($now["mon"]<10)
                $now["mon"]="0".$now["mon"];
             if($now["mday"]<10)
                $now["mday"]="0".$now["mday"];
        $currentDate =  $now["mday"]."/". $now["mon"]."/" .$now["year"]; 
		$this->db->set('title', $data['title']);
        $this->db->set('alias', $data['alias']);
		$this->db->set('content', $data['content']);
        $this->db->set('id_group_new', $data['id_group_new']);
        $this->db->set('id_group_project', $data['id_group_project']);
        $this->db->set('metakeyword', $data['metakeyword']);
		$this->db->set('metadescription', $data['metadescription']);
		$this->db->set('img', $data['image']);
        $this->db->set('ord', $data['ord']);//
        $this->db->set('tag', $data['tag']);
        $this->db->set('type', $data['type']);
        $this->db->set('modified', $data['modified']);
        $this->db->set('tin_box_chinh', $data['tin_box_chinh']);
		$this->db->set('display', $data['display']);
        $this->db->set('description', $data['description']);
		$this->db->set('post_date', $currentDate);
		if($this->db->insert($this->table)) return TRUE; else return FALSE;
		
	}
	
	
	function update($id, $data) {
		
		$this->db->where('id', $id);
	   $now = getdate(); 
             if($now["mon"]<10)
                $now["mon"]="0".$now["mon"];
             if($now["mday"]<10)
                $now["mday"]="0".$now["mday"];
             $currentDate =  $now["mday"]."/". $now["mon"]."/" .$now["year"]; 
		$this->db->set('title', $data['title']);
        $this->db->set('alias', $data['alias']);
		$this->db->set('content', $data['content']);
        $this->db->set('id_group_new', $data['id_group_new']);
        $this->db->set('id_group_project', $data['id_group_project']);
        $this->db->set('metakeyword', $data['metakeyword']);
		$this->db->set('metadescription', $data['metadescription']);
		$this->db->set('img', $data['image']);
        $this->db->set('ord', $data['ord']);
        $this->db->set('tag', $data['tag']);
        $this->db->set('type', $data['type']);
        $this->db->set('modified', $data['modified']);
        $this->db->set('tin_box_chinh', $data['tin_box_chinh']);
		$this->db->set('display', $data['display']);
        $this->db->set('description', $data['description']);
		$this->db->set('post_date', $currentDate);
		
		if($this->db->update($this->table)) return TRUE; else return FALSE;
		
	}
	function update_gioithieu($id, $data) {
		
		$this->db->where('id', $id);
		
		$this->db->set('content', $data['content']);
		
		
		if($this->db->update($this->table)) return TRUE; else return FALSE;
		
	}//tinhienthi
	function tinhienthi($id, $data) {
		
	
		
        $this->db->set('title', $data['title']);
		$this->db->set('content', $data['content']);
		
		
		if($this->db->update("box_text")) return TRUE; else return FALSE;
		
	}
    function laytinhienthi() {
			
		$sql="select * from box_text order by id asc limit 0,1";	
        return $this->db->query($sql);
		
	}
	function get_by_id($id) {
		
		$q = $this->db->get_where($this->table, array('id' => $id));
		
		return $q->row();
		
		$q->free_result();
	}
	function gioithieu() {
		
		$q = $this->db->get_where($this->table, array('type' => 1));
		
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
	
	
	function get_tintuc_where($where = null, $order = null, $limit = null) {
		
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
		
		$result = $q->row();
		
		return $result->name;
		
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
		
		$result = $q->row();
		
		return $result->name;
		
	}
	
	function get_name_alias($id) {
		
		$this->db->select('alias');
		$q = $this->db->get_where($this->table, array('catid' => $id));
		
		$result = $q->row();
		
		return $result->alias;
		
	}
	//$title, $des, $tag,$news_group,$project_group,$status
	function get_all_news($select = null, $title = null, $des = null, $tag = null, $news_group = null, $project_group = null,$status = null, $where = null, $order = null, $limit = null) {
		
		if($title != null) $this->db->like('title', $title);
    	if($des != null)    $this->db->like('description', $des);
        if($tag != null)    $this->db->like('tag', $tag);      
        if($news_group != null)    $this->db->where('id_group_new', $news_group);      
        if($project_group != null)    $this->db->where('id_group_project', $project_group);      
        if($status != null)    $this->db->where('active', $status);      
             
		 
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
		
		if($limit != null) {
			$this->db->limit($limit['max'], $limit['begin']);
		}
		
		if($select !=null) 
		{
			foreach($select as $key)
			{
				$this->db->select($key);
			}
		}
		
		
		$q = $this->db->get($this->table);
		
		return $q;
		
		$q->free_result();
	}
	
	function total_news($title = null, $des = null, $tag = null, $news_group = null, $project_group = null,$status = null) {
		
		if($title != null) $this->db->like('title', $title);
    	if($des != null)    $this->db->like('description', $des);
        if($tag != null)    $this->db->like('tag', $tag);      
        if($news_group != null)    $this->db->where('id_group_new', $news_group);      
        if($project_group != null)    $this->db->where('id_group_project', $project_group);      
        if($status != null)    $this->db->where('active', $status);  
		return $this->db->count_all_results($this->table);
		
	}

}
// End file
// Local appllication/models/product/cateegory_model.php
