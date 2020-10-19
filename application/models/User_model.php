<?php

class User_model extends CI_Model
{
    private $_table = "user";


    public function getUser()
    {
        $query = $this->db->get('user');
		return $query;
    }

	private function _deletePhoto($id)
	{
		$user = $this->getselecteduser($id);
		if ($user->photo != "user.png") {
			$filename = explode(".", $user->photo)[0];
			return array_map('unlink', glob(FCPATH."upload/user/$filename.*"));
		}
    }

    public function _updateLastLogin($user_id){
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }

    public function _updateIsActive($user_id){
        $sql = "UPDATE {$this->_table} SET is_active='1' WHERE user_id={$user_id}";
        $this->db->query($sql);
    }

    // public function getProfile($user_id){
    //     $sql = "UPDATE {$this->_table} SET is_active='1' WHERE user_id={$user_id}";
    //     $this->db->query($sql);
    // }

    public function _updateIsNonActive($user_id){
        $sql = "UPDATE {$this->_table} SET is_active='0' WHERE user_id={$user_id}";
        $this->db->query($sql);
    }

    public function delete_user($id)
    {
        $this->_deletePhoto($id);
        $this->db->delete('user', array("user_id" => $id));
    }

    public function getselecteduser($id)
    {
        $where = array(
            'user_id' => $id
        );

        $query = $this->db->get_where('user',$where);
        return $query->row();
    }

    public function createuser()
    {
        $this->user_id = $this->input->post('user_id');
        $photo = $this->_uploadPhoto();

        $data = array(
            'user_id' => $this->input->post('user_id'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => $this->input->post('email'),
            'full_name' => $this->input->post('full_name'),
            'phone' => $this->input->post('phone'),
            'role' => $this->input->post('role'),
            'photo' => $photo,
        );
        $this->db->insert('user',$data);
        $this->session->set_flashdata('message', '<div class="alert alert-success fade show" role="alert">
            <i class="fa fa-check-circle mr-3"></i>
            <span>Data pengguna berhasil ditambahkan!</span>
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
			<span aria-hidden="true">×</span>
            </button> </div>');
	
        redirect('user');
    }

    public function updateuser($id)
	  {
        $where = array('user_id' => $id );
        // $photo = $this->_uploadPhoto();
        $this->user_id = $this->input->post("user_id");

        if (!empty($_FILES["photo"]["name"])) {
            $photo = $this->_uploadPhoto();
        } else {
            $photo = $this->input->post("old_photo");
        }

        if (!empty($_POST["password"])) {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        } else {
            $password = $this->input->post('old_password');
        }
        
        //  $photo = $this->_uploadPhoto();


		$data = array(
            'user_id' => $this->input->post('user_id'),
            'username' => $this->input->post('username'),
            'password' => $password,
            'email' => $this->input->post('email'),
            'full_name' => $this->input->post('full_name'),
            'phone' => $this->input->post('phone'),
            'role' => $this->input->post('role'),
            'photo' => $photo,
        );
        
        $this->db->where($where);
        //var_dump($data);die;
        $this->db->update('user',$data);
        $this->session->set_flashdata('message', '<div class="alert alert-success fade show" role="alert">
            <i class="fa fa-check-circle mr-3"></i>
            <span>Data pengguna berhasil diedit!</span>
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
			<span aria-hidden="true">×</span>
            </button> </div>');
	  }

    private function _uploadPhoto()
	{
		$config['upload_path']          = './upload/user/';
		$config['allowed_types']        = 'jpeg|jpg|png';
		$config['file_name']            = $this->user_id;
		$config['overwrite']			= true;
		$config['max_size']             = 1024; // 1MB
		

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('photo')) {
			return $this->upload->data('file_name');
		}
        //print_r($this->upload->display_errors());
		return "user.png";
    }

    public function updateprofile()
	  {
        $where = array('user_id' => $this->input->post('user_id') );
        $this->user_id = $this->input->post("user_id");

        if (!empty($_FILES["photo"]["name"])) {
            $photo = $this->_uploadPhoto();
        } else {
            $photo = $this->input->post("old_photo");
        }
        
		$data = array(
            'user_id' => $this->input->post('user_id'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'full_name' => $this->input->post('full_name'),
            'phone' => $this->input->post('phone'),
            'photo' => $photo,
        );
        
        $this->db->where($where);
        //var_dump($data);die;
        $this->db->update('user',$data);
        $this->session->set_flashdata('message', '<div class="alert alert-success fade show" role="alert">
            <i class="fa fa-check-circle mr-3"></i>
            <span>Data profil berhasil diedit! Silakan logout dan login kembali untuk melihat perubahan</span>
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
			<span aria-hidden="true">×</span>
            </button> </div>');
      }
      
      public function changepassword()
	  {
        //$where = array('user_id' => $this->input->post('user_id') );
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $photo = $this->_uploadPhoto();
        //$this->user_id = $this->input->post("user_id");
        $password = $this->input->post('password');
        $password_new = $this->input->post('password_new');
        $password_new_confirm = $this->input->post('password_new_confirm');

        //var_dump($password,$password_new,$password_new_confirm);die;

        
        if (!password_verify($password, $data['user']['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger fade show" role="alert">
                <i class="fa fa-info-circle mr-3"></i>
                <span>Password lama yang Anda masukkan tidak sesuai!</span>
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                </button> </div>');
            redirect('profile/changePassword/');
        } elseif ($password == $password_new) {
            
            $this->session->set_flashdata('message', '<div class="alert alert-danger fade show" role="alert">
                <i class="fa fa-info-circle mr-3"></i>
                <span>Password baru tidak boleh sama dengan password lama!</span>
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                </button> </div>');
            redirect('profile/changePassword/');
        } elseif ($password_new != $password_new_confirm) {
                
            $this->session->set_flashdata('message', '<div class="alert alert-danger fade show" role="alert">
                <i class="fa fa-info-circle mr-3"></i>
                <span>Konfirmasi password baru Anda tidak sama!</span>
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                </button> </div>');
            redirect('profile/changePassword/');
        } else {
            $password_hash = password_hash($password_new, PASSWORD_DEFAULT);


            $this->db->set('password', $password_hash);
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success fade show" role="alert">
                <i class="fa fa-check-circle mr-3"></i>
                <span>Password berhasil diubah!</span>
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                </button> </div>');
            redirect('profile/');
        }
    }
    
    public function getMaxKode(){
		$query = $this->db->query("SELECT (MAX(user_id))+1 as max_id FROM user");
		return $query->row();
	  }

}
