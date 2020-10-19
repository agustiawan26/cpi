<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('alternatif');
    }

    private function insertIntoNilai($id)
    {
    $this->db->query("INSERT INTO nilai_tbl(nilai_alternatif_id, nilai_kriteria_id) SELECT '$id', kriteria_id FROM kriteria");
        return;
    }

	public function createalternatif()
    {
      $alternatif_id = $this->input->post('alternatif_id');  
      $data = array(
            'alternatif_id' => $this->input->post('alternatif_id'),
            'alternatif' => $this->input->post('alternatif'),
            'kecamatan' => $this->input->post('kecamatan'),
        );
        
        $this->db->insert('alternatif',$data);
        //$this->db->query("INSERT INTO nilai_tbl(nilai_kriteria_id, nilai_alternatif_id) SELECT '$alternatif_id', kriteria_id FROM kriteria");
        $this->insertIntoNilai($this->input->post('alternatif_id'));
        $this->session->set_flashdata('message', '<div class="alert alert-success fade show" role="alert">
            <i class="fa fa-check-circle mr-3"></i>
            <span>Data alternatif berhasil ditambahkan!</span>
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
			<span aria-hidden="true">×</span>
            </button> </div>');
            
	}
	
	public function getMaxKode()
	{
	$query = $this->db->query("SELECT (MAX(alternatif_id))+1 as max_id FROM alternatif");
	return $query->row();
	}

	public function updatealternatif($id)
	{
        $where = array('alternatif_id' => $id );
        $data = array(
            'alternatif' => $this->input->post('alternatif'),
            'kecamatan' => $this->input->post('kecamatan'),
        );
        $this->db->where($where);
        $this->db->update('alternatif',$data);
        $this->session->set_flashdata('message', '<div class="alert alert-success fade show" role="alert">
                <i class="fa fa-check-circle mr-3"></i>
                <span>Data alternatif berhasil diedit!</span>
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                </button> </div>');
	}

	//DELETE
	public function delete_alternatif($id){
		$this->db->delete('nilai_tbl', array('nilai_alternatif_id' => $id));
        $this->db->delete('alternatif', array('alternatif_id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success fade show" role="alert">
            <i class="fa fa-check-circle mr-3"></i>
            <span>Data alternatif berhasil dihapus!</span>
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
			<span aria-hidden="true">×</span>
            </button> </div>');
	}

	public function getselectedalternatif($id)
	{
		$where = array(
			'alternatif_id' => $id
		);

		$query = $this->db->get_where('alternatif',$where);
		return $query->row();
	}
}