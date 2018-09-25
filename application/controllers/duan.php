<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Duan extends CI_Controller {

    function Duan() {
        parent::__construct();
        $this->load->library('session');
        //$this->output->cache(5) ;
        $this->load->model('Trangchu_model');
        $this->load->model('Dichvu_model');
        $this->load->library('util');
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->session->unset_userdata('anh');
        $this->session->set_userdata('anh', 'du-an');
    }

    function index() {
        $data['title'] = "Dự án thi công nội thất - điện nước - mạng LAN";
        $sql = "select * from cat_new where type='3'";
        $laytitle = $this->db->query($sql);
        $kqlaytitle = $laytitle->row();
        $data['title'] = $kqlaytitle->title;
        $data['description'] = $kqlaytitle->metadescription;
        $data['keywords'] = $kqlaytitle->metakeyword;
        $data['layallproject'] = $this->Dichvu_model->layallproject();
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'duan/index';
        $this->load->view('layout/template', $data);
    }
}
?>