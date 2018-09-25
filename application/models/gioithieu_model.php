<?php

class Gioithieu_model extends CI_Model {

    function laygioithieu($id) {
        $sql = "select * from group_new where alias=\"" . $id . "\" limit 0,1";
        return $this->db->query($sql);
    }

    function laygioithieu_dau() {
        $sql = "select * from group_new where type=2 limit 0,1";
        return $this->db->query($sql);
    }

    function laybaogia() {
        $sql = "select * from group_new where type=5 limit 0,1";
        return $this->db->query($sql);
    }

    function laygrouptintuc() {
        $sql = "select * from group_new where type=2 and id != (select min(id) from group_new where type=2 limit 0,1) ";
        return $this->db->query($sql);
    }
}

?>