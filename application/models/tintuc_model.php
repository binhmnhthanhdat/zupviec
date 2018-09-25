<?php

class Tintuc_model extends CI_Model {

    function laytinmoi() {
        $sql = "select * from news where type!=2  order by id desc ";
        return $this->db->query($sql);
    }

    function laytinmoi_index() {
        $sql = "select * from news where type!=2 and id_group_project=0 order by id desc limit 0,7 ";
        return $this->db->query($sql);
    }

    function laytinmoi_pt($page, $limit) {
        $sql = "select * from news where type!=2 order by id desc  limit $page,$limit ";
        return $this->db->query($sql);
    }

    function laytinmoi_alias($alias) {
        $sql = "select * from group_new where type=1 and alias=\"" . $alias . "\"  ";
        $id = $this->db->query($sql)->row()->id;
        if ($id > 0) {
            $sql = "select * from news where type!=2 and id_group_new=$id order by id desc ";
            return $this->db->query($sql);
        } else {
            show_404();
        }
    }

    function laytinmoi_alias_pt($alias, $page, $limit) {
        $sql = "select * from group_new where type=1 and alias=\"" . $alias . "\"  ";
        $id = $this->db->query($sql)->row()->id;
        if ($id > 0) {
            $sql = "select * from news where type!=2 and id_group_new=$id order by id desc limit $page,$limit ";
            return $this->db->query($sql);
        } else {
            show_404();
        }
    }

    function chitiettintuc($alias) {
        $sql = "select * from news where alias=\"" . $alias . "\"";
        return $this->db->query($sql);
    }

    function tagtin($alias) {
        $sql = "select * from news where type!=2 and alias like \"%" . $alias . "%\" or description like \"%" . $alias . "%\" or content like \"%" . $alias . "%\""; 
        return $this->db->query($sql);
    }

    function tagtin_pt($alias, $page, $limit) {
        $sql = "select * from news where type!=2 and alias like \"%" . $alias . "%\" or description like \"%" . $alias . "%\" or content like \"%" . $alias . "%\"  limit $page,$limit ";
        return $this->db->query($sql);
    }

    function laytintuyendung() {
        $sql = "select * from news where type=2";
        return $this->db->query($sql);
    }
}

?>