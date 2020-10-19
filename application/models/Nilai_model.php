<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Nilai_model extends CI_Model{
  public function __construct(){
      $this->load->database();
  }


  public function getAlternatif(){
    $this->db->order_by("alternatif_id", "ASC");
    $query = $this->db->get("alternatif");

    return $query->result();
  }

  public function getCountKriteria(){
    $query = $this->db->query("SELECT COUNT(*) as jumlah FROM kriteria k ");
    return $query->row();
  }

  public function getCountKriteriawp(){
    $query = $this->db->query("SELECT COUNT(*) as jumlah FROM kriteria k WHERE k.is_para = '1' ");
    return $query->row();
  }

  // public function getKriteria()
  // {
  //   $query = $this->db->query("SELECT kriteria
  //       FROM kriteria k");
  //   return $query->result();
  // }

  // public function getKriteria()
  // {
  //   $this->db->order_by("kriteria_id", "ASC");
  //   $query = $this->db->get("kriteria");

  //   return $query->result();
  //   // $query = json_decode($query,true);
  // }

  public function getKriteria()
  {
    $this->db->order_by("kriteria_id", "ASC");
    $query = $this->db->query("SELECT * FROM kriteria");

    return $query->result_object();
  }

  public function getKriteriaHead()
  {
    $this->db->order_by("kriteria_id", "ASC");
    $query = $this->db->query("SELECT * FROM kriteria");

    return $query->result_object();
  }

  // public function getKriteriawp()
  // {
  //   $query = $this->db->query("SELECT kriteria
  //       FROM kriteria k
  //       WHERE k.is_para = '1'");
  //   return $query->result();
  // }

  public function updateNilai($id, $kriteria, $value)
  {
    //var_dump($id.' == '.$kriteria.'===='.$value);die;
    $where = array('nilai_alternatif_id' => $id, 'nilai_kriteria_id' => $kriteria );
    $data = array(
        'nilai' => $value,
    );
    $this->db->where($where);
    $this->db->update('nilai_tbl',$data);
    $this->session->set_flashdata('message', '<div class="alert alert-success fade show" role="alert">
            <i class="fa fa-check-circle mr-3"></i>
            <span>Data nilai berhasil diedit!</span>
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
			<span aria-hidden="true">×</span>
            </button> </div>');
	
  }

  public function getNilai(){
    $query = $this->db->query("SELECT a.alternatif_id, k.kriteria_id, n.nilai
        FROM nilai_tbl n
        INNER JOIN alternatif a
          ON n.nilai_alternatif_id=a.alternatif_id
        INNER JOIN kriteria k
          ON k.kriteria_id=n.nilai_kriteria_id
          
        ORDER BY a.alternatif_id, k.kriteria_id");
    $rows = $query->result();
    
    $data = array();
    foreach($rows as $row){
        $data[$row->alternatif_id][$row->kriteria_id] = $row->nilai;
//        $data[$row->kriteria_id][$row->alternatif_id] = $row->nilai;
    }

    return $data;
}

public function getNilaiwp(){
  $query = $this->db->query("SELECT a.alternatif_id, k.kriteria_id, n.nilai
      FROM nilai_tbl n
      INNER JOIN alternatif a
        ON n.nilai_alternatif_id=a.alternatif_id
      INNER JOIN kriteria k
        ON k.kriteria_id=n.nilai_kriteria_id
        WHERE k.is_para = '1'
      ORDER BY a.alternatif_id, k.kriteria_id");
  $rows = $query->result();
  
  $data = array();
  foreach($rows as $row){
      $data[$row->alternatif_id][$row->kriteria_id] = $row->nilai;
//        $data[$row->kriteria_id][$row->alternatif_id] = $row->nilai;
  }

  return $data;
}

// public function getNilaifull(){
//   $query = $this->db->query("SELECT a.alternatif_id, k.kriteria_id, n.nilai
//       FROM nilai_tbl n
//       INNER JOIN alternatif a
//         ON n.nilai_alternatif_id=a.alternatif_id
//       INNER JOIN kriteria k
//         ON k.kriteria_id=n.nilai_kriteria_id
//       ORDER BY a.alternatif_id, k.kriteria_id");
//   $rows = $query->result();
  
//   $data = array();
//   foreach($rows as $row){
//       $data[$row->alternatif_id][$row->kriteria_id] = $row->nilai;
//       // $data[$row->kriteria_id][$row->alternatif_id] = $row->nilai;

//   }

//   return $data;
// }




// public function getTransform()
// {
//   $query = $this->db->query("SELECT a.alternatif_id, k.kriteria_id, n.nilai
//   FROM nilai_tbl n
//   INNER JOIN alternatif a
//     ON n.nilai_alternatif_id=a.alternatif_id
//   INNER JOIN kriteria k
//     ON k.kriteria_id=n.nilai_kriteria_id
//   ORDER BY a.alternatif_id, k.kriteria_id
//   ");
//   $rows = $query->result();

//   $data = array();
//   foreach($rows as $row){
//     $data[$row->alternatif_id][$row->kriteria_id] = $row->nilai;
//   }
//   return $data;
// }

// public function getTransformnegatif()
// {
//   $query = $this->db->query("SELECT a.alternatif_id, k.tren, k.kriteria_id, n.nilai
//   FROM nilai_tbl n
//   INNER JOIN alternatif a
//     ON n.nilai_alternatif_id=a.alternatif_id
//   INNER JOIN kriteria k
//     ON k.kriteria_id=n.nilai_kriteria_id
//   WHERE k.tren='negatif'
//   ORDER BY a.alternatif_id, k.kriteria_id
//   ");
//   $rows = $query->result();

//   $data = array();
//   foreach($rows as $row){
//     $data[$row->alternatif_id][$row->kriteria_id] = $row->nilai;
//   }
//   return $data;
// }


    public function getListForm($id){        
      $query = $this->db->query("SELECT a.nilai_id, a.nilai_kriteria_id, a.nilai_alternatif_id, a.nilai, c.kriteria, c.kriteria_id
      FROM nilai_tbl as a 
      INNER JOIN kriteria as c  
        ON a.nilai_kriteria_id=c.kriteria_id 
      WHERE nilai_alternatif_id= '$id' and c.is_para = '0' 
      ORDER BY nilai_kriteria_id");
      return $query->result();
    }

    public function getListFormwp($id){
        return $this->db->query('SELECT a.nilai_id, a.nilai_kriteria_id, a.nilai, b.nama_parameter, c.kriteria, c.kriteria_id
        FROM nilai_tbl as a 
        INNER JOIN parameter as b 
          on (a.nilai_kriteria_id = b.kriteria_id and a.nilai = b.nilai_parameter), kriteria as c 
        WHERE a.nilai_alternatif_id = "'.$id.'" and c.kriteria_id = a.nilai_kriteria_id ORDER BY a.nilai_kriteria_id')->result();
        //return $query2->result(); 
    }

    public function getSelectedAlternatif($id)
    {
      $query = $this->db->query("SELECT * FROM alternatif WHERE alternatif_id='$id'");
      return $query->row();
    }

    public function getNilaialternatif($id)
    {
      $query = $this->db->query("SELECT * FROM nilai_tbl n 
      INNER JOIN kriteria k
        ON k.kriteria_id=n.nilai_kriteria_id
      WHERE n.nilai_alternatif_id='$id' and k.is_para='0'");
      return $query->result();
    }

    public function getNilaialternatifwp($id)
    {
      $query = $this->db->query("SELECT * FROM nilai_tbl n 
      INNER JOIN kriteria k
        ON k.kriteria_id=n.nilai_kriteria_id
      WHERE n.nilai_alternatif_id='$id' and k.is_para='1'");
      return $query->result();
    }

  //   public function getNilaitabel()
  // {
  //   return $this->db->get('nilai_tbl')->result();
  // }

  public function getParameter()
  {
    return $this->db->get('parameter')->result();
  }
  
  

}

