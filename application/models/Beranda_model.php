<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model
{
    public function getCountAlternatif()
	{
        $query = $this->db->query("SELECT COUNT(*) as jumlah_alternatif FROM alternatif");
        return $query->row();
    }

    //count kriteria untuk beranda
    public function getCountKriteria(){
        $query = $this->db->query("SELECT COUNT(*) as jumlah_kriteria FROM kriteria");
        return $query->row();
    }

    public function getCountUser(){
        $query = $this->db->query("SELECT COUNT(*) as jumlah_user FROM user");
        return $query->row();
    }

}