<?php

class Dichvu_model extends CI_Model {

    function laygroupproject($id) {

        $sql = "select * from group_project where id=\"" . $id . "\"";
        return $this->db->query($sql);
    }

    function layproject($alias) {
        $sql = "select * from group_project where alias=\"" . $alias . "\"   limit 0,1";
        $layid_project = $this->db->query($sql);
        $id_project = "";
        if ($layid_project->num_rows() > 0) {
            $kqlayid_project = $layid_project->row();
            $id_project = $kqlayid_project->id;
        }
        $sql = "select * from project where id_group_project=\"" . $id_project . "\"";
        return $this->db->query($sql);
    }

    function laytinproject($alias) {
        $sql = "select * from group_project where alias=\"" . $alias . "\"   limit 0,1";
        $id_project = "";
        $layid_project = $this->db->query($sql);
        if ($layid_project->num_rows() > 0) {
            $kqlayid_project = $layid_project->row();
            $id_project = $kqlayid_project->id;
        }
        $sql = "select * from news where id_group_project=\"" . $id_project . "\" limit 0,30";
        return $this->db->query($sql);
    }

    function laygroupproject_trangchu() {
        $sql = "select * from group_project";
        return $this->db->query($sql);
    }

    function laygroupproject_index($alias) {
        $sql = "select * from group_project where alias='$alias'";
        return $this->db->query($sql);
    }

    function laychitietproject($alias) {
        $sql = "select * from project  where alias=\"" . $alias . "\" limit 0,1";
        return $this->db->query($sql);
    }

    function layallproject() {

        $sql = "select * from project ";
        return $this->db->query($sql);
    }

}

?>