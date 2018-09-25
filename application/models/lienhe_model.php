<?php

class Lienhe_model extends CI_Model {

    function lienhe() {
        $hoten = $this->input->post('hoten');
        $email = $this->input->post('email');
        $tieude = $this->input->post('tieude');
        $noidung = $this->input->post('noidung');
        $now = getdate();
        $currentDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];
        $chuoithempostmoi = array(
            'hoten' => $hoten,
            'email' => $email,
            'tieude' => $tieude,
            'noidung' => $noidung,
            'thoigian' => $currentDate,
        );
        $insert = $this->db->insert('lienhe', $chuoithempostmoi);
        return $insert;
    }
}

?>