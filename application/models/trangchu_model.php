<?php 

    class Trangchu_model extends CI_Model {
      
       function laygroupproject(){
        		$sql="select * from group_project limit 0,9";	
        		return $this->db->query($sql);
        		
        	}
        function laygrouptintuc(){
        		$sql="select * from group_new where type=1";	
        		return $this->db->query($sql);
        		
        	} 
        function layboxtext(){
        		$sql="select * from box_text limit 0,1";	
        		return $this->db->query($sql);
        		
        	} 
         function laypartner(){
        		$sql="select * from parttent where active=1";	
        		return $this->db->query($sql);
        		
        	}
}
  ?>