<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
        if (!$this->session->userdata('email')) {
            redirect('login');
            
        }
    }

    public function index()
    {
        if($this->session->userdata('role')==='admin'){
            $data["user"] = $this->user_model->getUser();
            $this->load->view("user/user", $data);
        }else{
            show_404();
        }
    }

  public function createUser()
    {
        if($this->session->userdata('role')==='admin'){
            $this->form_validation->set_rules('username', 'Username', 'required|trim', [
                'required' => 'Masukan username'
            ]);
            
            $this->form_validation->set_rules('full_name', 'Full_name', 'required|trim', [
                'required' => 'Masukan nama lengkap'
            ]);

            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
                'valid_email' => 'Email tidak valid',
                'required' => 'Masukan Email',
                'is_unique' => 'Email sudah terdaftar'
            ]);

            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [
                'min_length' => 'password min 5 karakter',
                'required' => 'masukan password'
            ]);

            $this->form_validation->set_rules('phone', 'Phone', 'required|trim', [
                'required' => 'Masukan No Telepon'
            ]);

            if ($this->input->post('tambahuser')) {
                if ($this->form_validation->run() == true) {
                    $this->user_model->createuser();
                    redirect(base_url('user'));
                    // notify('Selamat Akun Berhasil Dibuat', 'success', 'createUser');
                } elseif ($this->form_validation->run() == false) {
                    $data['gen'] = $this->user_model->getMaxKode();
                    //var_dump($data['gen']);die;
                    $this->load->view('user/user_new', $data);
                }
            } else {
                $data['gen'] = $this->user_model->getMaxKode();
                //var_dump($data['gen']);die;
                $this->load->view('user/user_new', $data);
            }

            // if ($this->input->post('tambahuser')) {
            //     //var_dump($_POST);die;
            //     $this->user_model->createuser();
            //     //var_dump($_POST);die;
            //     redirect(base_url('user'));
            // } else {
            //     $data['gen'] = $this->user_model->getMaxKode();
            //     //var_dump($data['gen']);die;
            //     $this->load->view('user/user_new', $data);
            // }
        }else{
            show_404();
        }        
    }

    public function updateUser($id)
    {
        if($this->session->userdata('role')==='admin'){
            $this->form_validation->set_rules('username', 'Username', 'required|trim', [
                'required' => 'Masukan Username'
            ]);
            
            $this->form_validation->set_rules('full_name', 'Full_name', 'required|trim', [
                'required' => 'Masukan Nama Lengkap'
            ]);

            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
                'valid_email' => 'Email tidak valid',
                'required' => 'Masukan Email',
            ]);
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]', [
                'min_length' => 'password min 5 karakter',
            ]);

            $this->form_validation->set_rules('phone', 'Phone', 'required|trim', [
                'required' => 'Masukan No Telepon'
            ]);
            
            if ($this->input->post('updateuser')) {
                if ($this->form_validation->run() == true) {
                    $this->user_model->updateuser($id);
                    redirect(base_url('user'));
                    // notify('Selamat Akun Berhasil Dibuat', 'success', 'createUser');
                } elseif ($this->form_validation->run() == false) {
                    $data['select'] = $this->user_model->getselecteduser($id);
                
                    $this->load->view('user/user_edit', $data);
                }
            } else {
                $data['select'] = $this->user_model->getselecteduser($id);
                
                $this->load->view('user/user_edit', $data);
            }   
        }else{
            show_404();
        }   
    }

    public function delete($id=null)
    {
        if($this->session->userdata('role')==='admin'){
            if (!isset($id)) show_404();
        
            $this->user_model->delete_user($id);
            redirect(base_url('user'));
        }else{
            show_404();
        }   
    }
    
}