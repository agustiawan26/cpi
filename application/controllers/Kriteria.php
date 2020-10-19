<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("kriteria_model");
        $this->load->library('form_validation');
        $this->load->library('pdf');
        if (!$this->session->userdata('email')) {
          redirect('login');
        }
    }

    public function index()
    {
      if ($this->input->post('addkriteriapara')) {
          $jumlahpara = $this->input->post('jumlahpara');
          redirect(base_url('kriteria/createKriteriaWP/' . $this->input->post('jumlahpara')));
        } elseif ($this->input->post('addkriteria')) {
          redirect(base_url('kriteria/createKriteria/'));
        } else {
          //$data['alternatif'] = $this->kriteria_model->get_alternatifs();
          $data['kriteria'] = $this->kriteria_model->get_kriterias();
          $data['kriteriawp'] = $this->kriteria_model->get_kriteriaswp();
          $data['jumlah_bobot'] = $this->kriteria_model->getJumlahBobot();
          
          //$data['message'] = $this->session->flashdata('msg');
          $this->load->view("kriteria/kriteria", $data);
        }
           
    }

    public function createKriteriaWP($id)
    {
      if ($this->input->post('tambahkriteria')) {
        if (!is_numeric($this->input->post('bobot'))) {
          //notify('Gagal Memasukan Data, Bobot Harus Angka', 'error', 'kriteria/listKriteria');
        } else {
          $this->kriteria_model->createkriteriawp($id);
          redirect(base_url('kriteria'));
          
          //notify('Berhasil Menambah Kriteria', 'success', 'kriteria');
        }
      } elseif ($this->input->post('back')) {
        redirect(base_url('kriteria'));
      } else {
        
        $data['gen'] = $this->kriteria_model->getMaxKode();

        //var_dump($data['gen']); die;

        $data['jumlahpara'] = $id;
        $this->load->view('kriteria/kriteria_new_wp', $data);
      }
    }

    public function createKriteria()
    {
      
      if ($this->input->post('tambahkriteria')) {
        
          $this->kriteria_model->createkriteria();
          redirect(base_url('kriteria'));
        
      } else {

        $data['gen'] = $this->kriteria_model->getMaxKode();
        
        $this->load->view('kriteria/kriteria_new', $data);
      }
    }

    public function updateKriteriaWP($id)
    {
      if ($this->input->post('updatekriteriawp')) {
        if (!is_numeric($this->input->post('bobot'))) {
          //notify('Gagal Memasukan Data, Bobot Harus Angka', 'error', 'kriteria/listKriteria');
        } else {
          $this->kriteria_model->updatekriteriawp($id);
          redirect(base_url('kriteria'));
          //notify('Berhasil Menambah Kriteria', 'success', 'kriteria');
        }
      } elseif ($this->input->post('back')) {
        redirect(base_url('kriteria'));
      } else {
        
        $data['jumlahpara'] = $id;
        $data['select'] = $this->kriteria_model->getselectedkriteria($id);
        $data['parameter'] = $this->kriteria_model->getselectedParameter($id);
        $data['jumlahpara'] = $this->kriteria_model->countParameter($id);
        $this->load->view('kriteria/kriteria_edit_wp', $data);
      }
    }

    public function updateKriteria($id)
    {
      if ($this->input->post('updatekriteria')) {
        $this->kriteria_model->updatekriteria($id);
          redirect(base_url('kriteria'));
      } elseif ($this->input->post('back')) {
        redirect(base_url('kriteria'));
      } else {
        $data['select'] = $this->kriteria_model->getselectedkriteria($id);
        $this->load->view('kriteria/kriteria_edit', $data);
      }
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
      
        $this->kriteria_model->delete_kriteria($id);
        redirect(base_url('kriteria'));
    }

    function print(){
      $pdf = new FPDF('p','mm','A4');
      // membuat halaman baru
      $pdf->AddPage();

      $pdf->SetFont('Arial','I',8);
      $NOW = date("Y-m-d h:i:sa");
      $User = $this->session->userdata('full_name');
      $pdf->Cell(150,8,$NOW,0,0,'L');
      $pdf->Cell(0,8,"Dicetak Oleh : ".$User,0,1,'L');
      // setting jenis font yang akan digunakan
      $pdf->SetFont('Arial','B',16);
      // mencetak string 
      $pdf->Cell(10,8,'',0,1);
      $pdf->Cell(190,8,'Daftar Kriteria',0,1,'C');
      $pdf->SetFont('Arial','',12);
      $pdf->Cell(190,8,'Sistem Pendukung Keputusan',0,1,'C');
      $pdf->Cell(190,8,'Penentuan Prioritas Lokasi Pembangunan Embung',0,1,'C');
      $pdf->Cell(190,8,'di Kabupaten Semarang',0,1,'C');

      // Memberikan space kebawah agar tidak terlalu rapat
      $pdf->Cell(10,8,'',0,1);
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(10,8,'',0,0,'L');
      // $pdf->Cell(170,8,'1. Data Kriteria',0,1,'L');
      $pdf->Cell(10,4,'',0,1);

      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(15,8,'',0,0,'L');
      $pdf->Cell(20,8,'- Kriteria Tanpa Parameter',0,1,'L');
      $pdf->Cell(15,8,'',0,0,'L');
      $pdf->Cell(20,8,'ID Kriteria',1,0,'C');
      $pdf->Cell(75,8,'Nama Kriteria',1,0,'C');
      $pdf->Cell(45,8,'Bobot',1,0,'C');
      $pdf->Cell(25,8,'Tren',1,1,'C');
      $pdf->SetFont('Arial','',10);

      // $kriteria = $this->hitung_model->getKriteria()->result();
      $kriteria = $this->kriteria_model->get_kriterias();
      foreach($kriteria as $row):
      // $count++;
          $pdf->Cell(15,8,'',0,0,'L');
          $pdf->Cell(20,8,"K".$row->kriteria_id,1,0,'C');
          $pdf->Cell(75,8,$row->kriteria,1,0,'C');
          $pdf->Cell(45,8,$row->bobot,1,0,'C');
          $pdf->Cell(25,8,$row->tren,1,1,'C');
          // $ALT[$row->alternatif_id] = $row->alternatif;
      endforeach;

      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(15,8,'',0,1,'L');
      $pdf->Cell(15,8,'',0,0,'L');
      $pdf->Cell(20,8,'- Kriteria Dengan Parameter',0,1,'L');
      $pdf->Cell(15,8,'',0,0,'L');
      $pdf->Cell(20,8,'ID Kriteria',1,0,'C');
      $pdf->Cell(75,8,'Nama Kriteria',1,0,'C');
      $pdf->Cell(45,8,'Bobot',1,0,'C');
      $pdf->Cell(25,8,'Tren',1,1,'C');
      $pdf->SetFont('Arial','',10);

      // $kriteria = $this->hitung_model->getKriteria()->result();
      $kriteria = $this->kriteria_model->get_kriteriaswp();
      foreach($kriteria as $row):
      // $count++;
          $pdf->Cell(15,8,'',0,0,'L');
          $pdf->Cell(20,8,"K".$row->kriteria_id,1,0,'C');
          $pdf->Cell(75,8,$row->kriteria,1,0,'C');
          $pdf->Cell(45,8,$row->bobot,1,0,'C');
          $pdf->Cell(25,8,$row->tren,1,1,'C');
          // $ALT[$row->alternatif_id] = $row->alternatif;
      endforeach;

      $jumlah_bobot = $this->kriteria_model->getJumlahBobot();
      // <?php echo $jumlah_bobot->jumlah_bobot;
      $pdf->Cell(15,8,'',0,1,'L');
      $pdf->Cell(15,8,'',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(20,8,"Jumlah Bobot Keseluruhan = ".$jumlah_bobot->jumlah_bobot,0,1,'L');
      
      $pdf->Output();
    }

}