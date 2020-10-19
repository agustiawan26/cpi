<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Hitung_model extends CI_Model{
  // public function __construct(){
  //     $this->load->database();
  // }

  public function getAlternatif(){
    $this->db->order_by("alternatif_id", "ASC");
    $query = $this->db->get("alternatif");

    return $query->result();
  }

  public function getKriteria()
  {
    $this->db->order_by("kriteria_id", "ASC");
    $query = $this->db->get("kriteria");

    return $query;
  }  

  public function getKriteriaHead()
  {
    $this->db->order_by("kriteria_id", "ASC");
    $query = $this->db->get("kriteria");

    return $query->result_object();
  }

  public function getKriteriaTP()
  {
    $this->db->order_by("kriteria_id", "ASC");
    $query = $this->db->get_where("kriteria","tren='positif'");

    return $query->result_object();
  }

  public function getKriteriaTN()
  {
    $this->db->order_by("kriteria_id", "ASC");
    $query = $this->db->query("SELECT * FROM kriteria WHERE tren='negatif'");

    return $query->result_object();
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
    }
    return $data;
  }

  public function getNilaiTrenPositif(){
    $query = $this->db->query("SELECT a.alternatif_id, k.kriteria_id, k.kriteria, n.nilai
        FROM nilai_tbl n
        INNER JOIN alternatif a
          ON n.nilai_alternatif_id=a.alternatif_id
        INNER JOIN kriteria k
          ON k.kriteria_id=n.nilai_kriteria_id
        WHERE k.tren = 'positif'
        ORDER BY a.alternatif_id, k.kriteria_id");
    $rows = $query->result();
    
    $data = array();
    foreach($rows as $row){
        $data[$row->alternatif_id][$row->kriteria_id] = $row->nilai;
    }
    return $data;
  }

  public function getNilaiTrenNegatif(){
    $query = $this->db->query("SELECT a.alternatif_id, k.kriteria_id, n.nilai
        FROM nilai_tbl n
        INNER JOIN alternatif a
          ON n.nilai_alternatif_id=a.alternatif_id
        INNER JOIN kriteria k
          ON k.kriteria_id=n.nilai_kriteria_id
        WHERE k.tren = 'negatif'
        ORDER BY a.alternatif_id, k.kriteria_id");
    $rows = $query->result();
    
    $data = array();
    foreach($rows as $row){
        $data[$row->alternatif_id][$row->kriteria_id] = $row->nilai;
    }
    return $data;
  }

  public function getNilaiMinimum()
  {
      $query = $this->db->query("SELECT DISTINCT a.nilai, a.nilai_kriteria_id  FROM nilai_tbl a
        INNER JOIN(
          SELECT DISTINCT b.nilai_kriteria_id, MIN(b.nilai) MinNilai
          FROM nilai_tbl b
            GROUP BY b.nilai_kriteria_id
          ) NewT   
          ON a.nilai_kriteria_id = NewT.nilai_kriteria_id AND a.nilai = NewT.MinNilai
        ORDER BY a.nilai_kriteria_id;");

          $datamin = $query->result();

          $data=array();
          foreach($datamin as $row){
            $data[$row->nilai_kriteria_id] = $row->nilai;
          }
      return $data;
  }
  // public function getNilaiMinimum()
  // {

  //     $query = $this->db->query("SELECT DISTINCT a.nilai, a.nilai_alternatif_id, a.nilai_kriteria_id  FROM nilai_tbl a
  //       INNER JOIN(
  //         SELECT DISTINCT b.nilai_kriteria_id, MIN(b.nilai) MinNilai
  //         FROM nilai_tbl b
  //           GROUP BY b.nilai_kriteria_id
  //         ) NewT   
  //         ON a.nilai_kriteria_id = NewT.nilai_kriteria_id AND a.nilai = NewT.MinNilai
  //       ORDER BY a.nilai_kriteria_id;");

  //         $datamin = $query->result();

  //         $data=array();
  //         foreach($datamin as $row){
  //           $data[$row->nilai_kriteria_id] = $row->nilai;
  //         }

  //     return $data;
  // }

  public function getTren()
  {

      $query = $this->db->query("SELECT k.tren, a.nilai_kriteria_id  FROM kriteria k
        INNER JOIN nilai_tbl a   
          ON k.kriteria_id = a.nilai_kriteria_id
        ORDER BY a.nilai_kriteria_id;");

      $tren = $query->result();

      $data=array();
      foreach($tren as $row){
        $data[$row->nilai_kriteria_id] = $row->tren;
      }
      return $data;
  }
//   public function getTren()
// {

//     $query = $this->db->query("SELECT k.tren, a.nilai_kriteria_id  FROM kriteria k
//       INNER JOIN nilai_tbl a   
//         ON k.kriteria_id = a.nilai_kriteria_id
//       ORDER BY a.nilai_kriteria_id;");

//         $tren = $query->result();

//         $data=array();
//         foreach($tren as $row){
//           $data[$row->nilai_kriteria_id] = $row->tren;
//         }

//     return $data;
// }

  

  public function getJumlahBobot()
    {
      $query = $this->db->query("SELECT SUM(bobot) as jumlah_bobot FROM kriteria");
      return $query->row();
    }

  

}

