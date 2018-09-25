<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lienhe extends CI_Controller {

    function lienhe() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('lienhe_model');
        $this->load->model('Trangchu_model');
        // $this->output->cache(5) ;
        $this->load->library('util');
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->session->unset_userdata('anh');
        $this->session->set_userdata('anh', 'lien-he');
    }

    function index() {
        $data['title'] = "Liên hệ";
        $sql = "select * from cat_new where type='6'";
        $laytitle = $this->db->query($sql);
        $kqlaytitle = $laytitle->row();
        $data['title'] = $kqlaytitle->title;
        $data['description'] = $kqlaytitle->metadescription;
        $data['keywords'] = $kqlaytitle->metakeyword;
        $md5_hash = md5(rand(0, 999));
        $security_code = substr($md5_hash, 15, 5);
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $this->session->set_userdata('security_code', $security_code);
        $data['content'] = 'lienhe/lienhe';
        $this->load->view('layout/template', $data);
    }

    function sendthanhcong() {
        $data['title'] = "Liên hệ";
        $this->load->view('lienhe/sendthanhcong', $data);
    }

    function guilienhe() {
        $data['title'] = "Gửi liên hệ";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('hoten', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('tieude', 'Title', 'required');
        $this->form_validation->set_rules('noidung', 'Content', 'trim|required');
        $this->form_validation->set_rules('capcha', 'Mã xác nhận', 'trim|required');
        if ($this->form_validation->run() == False) {
            $data['tieude'] = 'Liên hệ';
            $data['content'] = 'lienhe/lienhe';
            $this->load->view('layout/template', $data);
        } else {
            $maxacnhan = $this->input->post('capcha');
            if ($maxacnhan == $this->session->userdata('security_code')) {
                $this->lienhe_model->lienhe();
                redirect('../send-thanh-cong');
            } else {
                $data['tieude'] = 'Liên hệ';
                $data['content'] = 'lienhe/lienhe';
                $this->load->view('layout/template', $data);
            }
        }
    }
}
