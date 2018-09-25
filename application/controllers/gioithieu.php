<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gioithieu extends CI_Controller {

    function Gioithieu() {
        parent::__construct();
        $this->load->model('Gioithieu_model');
        $this->load->model('Trangchu_model');
        $this->load->library('util');
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->session->unset_userdata('anh');
        $this->session->set_userdata('anh', 'gioi-thieu');
        $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));
    }

    function index($id = null) {
        $data['laygrouptintuc'] = $this->Gioithieu_model->laygrouptintuc();
        if ($id == null) {
            $data['title'] = "Giới thiệu";
            $data['laygioithieu'] = $this->Gioithieu_model->laygioithieu_dau();
            $kqlaytitle = $data['laygioithieu']->row();
            $data['title'] = $kqlaytitle->title;
            $data['description'] = $kqlaytitle->metadescription;
            $data['keywords'] = $kqlaytitle->metakeyword;
        } else {
            $data['laygioithieu'] = $this->Gioithieu_model->laygioithieu($id);
            if ($data['laygioithieu']->num_rows != 1) {
                $this->output->set_status_header('404');
                show_404();
            }
            $kqlaytitle = $data['laygioithieu']->row();
            $data['title'] = $kqlaytitle->title;
            $data['description'] = $kqlaytitle->metadescription;
            $data['keywords'] = $kqlaytitle->metakeyword;
        }
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'tintuc/gioithieu';
        $this->load->view('layout/template', $data);
    }

    function banggia() {
        $data['laygrouptintuc'] = $this->Gioithieu_model->laygrouptintuc();
        $data['laygioithieu'] = $this->Gioithieu_model->laybaogia();
        $kqlaytitle = $data['laygioithieu']->row();
        $data['title'] = $kqlaytitle->title;
        $data['description'] = $kqlaytitle->metadescription;
        $data['keywords'] = $kqlaytitle->metakeyword;
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'tintuc/gioithieu';
        $this->load->view('layout/template', $data);
    }
}
