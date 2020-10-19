<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("beranda_model");
        $this->load->library('form_validation');
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data["jml_alternatif"] = $this->beranda_model->getCountAlternatif();
        $data["jml_kriteria"] = $this->beranda_model->getCountKriteria();
        $data["jml_user"] = $this->beranda_model->getCountUser();

        $this->load->view("beranda", $data);
    }
}