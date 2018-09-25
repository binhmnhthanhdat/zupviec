<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dichvu extends CI_Controller {
    function Dichvu() {
        parent::__construct();
       //$this->output->cache(5) ;
        $this->load->library('session');
        $this->load->model('Dichvu_model');
        $this->load->model('Trangchu_model');
        $this->load->library('pagination');
        $this->load->library('util');
        $this->load->helper(array('form', 'url', 'date'));
        $this->session->unset_userdata('anh');
        $this->session->set_userdata('anh', 'dich-vu');
        $this->load->library('form_validation');
     }

    function index($id = null) {
        $data['title'] = "Giải pháp thi công tại MAC";
        $sql = "select * from cat_new where type='2'";
        $laytitle = $this->db->query($sql);
        $kqlaytitle = $laytitle->row();
        $data['title'] = $kqlaytitle->title;
        $data['description'] = $kqlaytitle->metadescription;
        $data['keywords'] = $kqlaytitle->metakeyword;
        $data['laygroupproject'] = $this->Dichvu_model->laygroupproject_trangchu();
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'dichvu/index';
        $this->load->view('layout/template', $data);
    }

    function chitiet($alias = null) {
        $data['title'] = "Giải pháp thi công tại MAC";
        if ($alias != null) {
            $data['laytinproject'] = $this->Dichvu_model->laytinproject($alias);
            $data['laychitietproject'] = $this->Dichvu_model->laychitietproject($alias);
            $data['layproject'] = $this->Dichvu_model->layproject($alias);
            $data['laygroupproject'] = $this->Dichvu_model->laygroupproject_index($alias);
        }
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'dichvu/listdichvu';
        $this->load->view('layout/template', $data);
    }

    function chitietthicongnoithat($alias = null) {
        $sql = "select * from group_project where alias=\"" . $alias . "\"";
        $laytitle = $this->db->query($sql);
        $kqlaytitle = $laytitle->row();
        $data['title'] = $kqlaytitle->title;
        $data['description'] = $kqlaytitle->metadescription;
        $data['keywords'] = $kqlaytitle->metakeyword;
        if ($this->uri->segment(3) != "" && !is_numeric($this->uri->segment(3))) {
            $url = $this->uri->segment(3);
        } else if ($this->uri->segment(2) != "" && !is_numeric($this->uri->segment(2))) {
            $url = $this->uri->segment(2);
        } else if ($this->uri->segment(1) != "" && !is_numeric($this->uri->segment(1))) {
            $url = $this->uri->segment(1);
        }
        if ($url) {
            $sql = "select * from group_project where alias=\"" . $url . "\"";
            $laytengroup = $this->db->query($sql);
            $kqlaytengroup = $laytengroup->row();
            $group_name = $kqlaytengroup->name;
            if ($laytengroup->num_rows != 1) {
                $this->output->set_status_header('404');
                show_404();
            }
        }
        if ($alias != null) {
            if (is_numeric($alias)) {
                $config['base_url'] = base_url($url); // xác đ?nh trang phân trang
                $config['total_rows'] = 100; // xác đ?nh t?ng s? record
                $config['per_page'] = 6; // xác đ?nh s? record ? m?i trang
                $config['uri_segment'] = 3; // xác đ?nh segment ch?a page number
                $config['full_tag_open'] = '<li>';
                $config['full_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                if ($page == null || $page == 0)
                    $page = 0;
                $data['page'] = $page;
                $data['sobanghi'] = 6;
            }
            $data['url'] = $url;
            $data['group_name'] = $group_name;
            $data['laytinproject'] = $this->Dichvu_model->laytinproject($alias);
            $data['laychitietproject'] = $this->Dichvu_model->laychitietproject($alias);
            $data['layproject'] = $this->Dichvu_model->layproject($alias);
            $data['laygroupproject'] = $this->Dichvu_model->laygroupproject_index($alias);
        }
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'dichvu/listdichvu';
        $this->load->view('layout/template', $data);
    }

    function chitietduan($alias = null) {
        $laytitle = $this->Dichvu_model->laychitietproject($alias);
        if ($laytitle->num_rows != 1) {
            $this->output->set_status_header('404');
            show_404();
        }
        $kqlaytitle = $laytitle->row();
        $data['title'] = $kqlaytitle->title;
        $data['description'] = $kqlaytitle->metadescription;
        $data['keywords'] = $kqlaytitle->metakeyword;
        $data['laychitietproject'] = $this->Dichvu_model->laychitietproject($alias);
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'dichvu/chitietdichvu';
        $this->load->view('layout/template', $data);
    }

    function duan($alias = null) {
        $sql = "select * from group_project where alias=\"" . $alias . "\"";
        $laytitle = $this->db->query($sql);
        $kqlaytitle = $laytitle->row();
        $data['title'] = "Dự án " . $kqlaytitle->title;
        $data['description'] = $kqlaytitle->title . " Liên hệ dịch vụ giúp việc: 09.6996.3553";
        $data['keywords'] = $kqlaytitle->title . ", giúp việc, giúp việc nhà, tạp vụ văn phòng, tạp vụ";
        $data['laypartner'] = $this->Trangchu_model->laypartner();
        $data['content'] = 'dichvu/listduan';
        $this->load->view('layout/template', $data);
    }
}
