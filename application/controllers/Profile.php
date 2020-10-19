<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct() {
		parent::__construct();
    $this->load->model('user_model');
    if (!$this->session->userdata('email')) {
      redirect('login');
    }
	}

  public function index() 
  {
    $id = $this->session->userdata("user_id");
    $data['profile'] = $this->user_model->getselecteduser($id);
    //var_dump($data["profile"]); die;
		$this->load->view("profile/profile", $data);
  }

  public function updateProfile()
    {
      if ($this->input->post('updateprofile')) { 
          $this->user_model->updateprofile();
          redirect(base_url('profile'));
          //notify('Berhasil Menambah Kriteria', 'success', 'kriteria')
      } elseif ($this->input->post('back')) {
        redirect(base_url('profile'));
      } else {
        $id = $this->session->userdata("user_id");

        $data['profile'] = $this->user_model->getselecteduser($id);

        $this->load->view('profile/profile_edit',$data);
      }
    }

    public function changePassword()
    {
      if ($this->input->post('changepassword')) { 
          $this->user_model->changepassword();
          redirect(base_url('profile'));
          //notify('Berhasil Menambah Kriteria', 'success', 'kriteria')
      } elseif ($this->input->post('back')) {
        redirect(base_url('profile'));
      } else {
        $id = $this->session->userdata("user_id");

        $data['profile'] = $this->user_model->getselecteduser($id);
        
        $this->load->view('profile/profile_edit_password', $data);
      }
    }
}