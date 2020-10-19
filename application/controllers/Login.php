<?php
class Login extends CI_Controller{
  function __construct(){
    parent::__construct();
    
    $this->load->model('user_model');
    $this->load->library('form_validation');
  }

  function index(){
    $this->load->view('login');
  }

  public function auth()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    # jika usernya ada
    if ($user) {
        # cek password
        if (password_verify($password, $user['password'])) {
            # kalo sama
            $data = [
                // 'login' => true,
                'user_id' => $user['user_id'],
                'email' => $user['email'],
                'role' => $user['role'],
                'photo' => $user['photo'],
                'username' => $user['username'],
                'phone' => $user['phone'],
                'full_name' => $user['full_name']
            ];
            # simpan ke session
            $this->session->set_userdata($data);

            //$this->session->set_userdata(['user_logged' => $user]);


            $this->user_model->_updateLastLogin($this->session->userdata("user_id"));
            $this->user_model->_updateIsActive($this->session->userdata("user_id"));

            # cek hak akses
            if ($user['role'] == "admin") {
              redirect('admin');
            } elseif ($user['role'] == "manager"){
              redirect('manager');
            }
            else {
                # arahkan ke view login
                redirect('login');
            }
        } else {
            # kalo gagal
            $this->session->set_flashdata('flash', '<div class="alert alert-danger">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">error_outline</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              Password yang kamu masukkan salah
            </div>
          </div>');
            redirect('login');
        }
    } else {
        # jika tidak ada, gagalkan loginnya
        $this->session->set_flashdata('flash', '<div class="alert alert-danger">
        <div class="container">
          <div class="alert-icon">
            <i class="material-icons">error_outline</i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="material-icons">clear</i></span>
          </button>
          Email yang kamu masukkan salah
        </div>
      </div>');
        redirect('login');
    }
}

function logout(){
    $this->session->sess_destroy();
    $this->user_model->_updateIsNonActive($this->session->userdata("user_id"));
    redirect('login');
}

}
