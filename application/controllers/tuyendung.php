<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tuyendung extends CI_Controller {

    function Tuyendung() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Gioithieu_model');
        $this->load->model('Trangchu_model');
        $this->load->model('Tintuc_model');
        $this->load->library('util');
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->session->unset_userdata('anh');
        $this->session->set_userdata('anh', 'tuyen-dung');
     }

    function index($page = null) {

        $data['title'] = "Tuyển dụng";
        $sql = "select * from cat_new where type='5'";
        $laytitle = $this->db->query($sql);
        $kqlaytitle = $laytitle->row();
        $data['title'] = $kqlaytitle->title;
        $data['description'] = $kqlaytitle->metadescription;
        $data['keywords'] = $kqlaytitle->metakeyword;
        $data['laytintuyendung'] = $this->Tintuc_model->laytintuyendung();
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'tuyendung/index';
        $this->load->view('layout/template', $data);
    }

    function chitiettuyendung($alias) {

        $data['title'] = "Tuyển dụng";
        $data['chitiettintuc'] = $this->Tintuc_model->chitiettintuc($alias);
        if ($data['chitiettintuc']->num_rows != 1) {
            $this->output->set_status_header('404');
            show_404();
        }
        $kqlaytitle = $data['chitiettintuc']->row();
        $data['title'] = $kqlaytitle->title;
        $data['description'] = $kqlaytitle->metadescription;
        $data['keywords'] = $kqlaytitle->metakeyword;
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'tuyendung/chitiettuyendung';
        $this->load->view('layout/template', $data);
    }

}
