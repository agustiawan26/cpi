<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("alternatif_model");
        $this->load->library('form_validation');
        $this->load->library('pdf');
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
    }

    public function index()
    {       
        if ($this->input->post('addalternatif')) {
            redirect(base_url('createAlternatif/'));
        } else {
            $data['alternatif'] = $this->alternatif_model->getAll();
            //$data['kriteria'] = $this->alternatif_model->get_kriterias();
            $this->load->view("alternatif/alternatif", $data);
        }
    }

    public function createAlternatif()
    {
      
        if ($this->input->post('tambahalternatif')) {
            
            $this->alternatif_model->createalternatif();
            redirect(base_url('alternatif'));
        } else {
            $data['gen'] = $this->alternatif_model->getMaxKode();
        
            $this->load->view('alternatif/alternatif_new', $data);
        }
    }

    public function updateAlternatif($id)
    {
        if ($this->input->post('updatealternatif')) {
    
            $this->alternatif_model->updatealternatif($id);
            redirect(base_url('alternatif'));
            //notify('Berhasil Menambah Kriteria', 'success', 'kriteria');
        
        } elseif ($this->input->post('back')) {
            redirect(base_url('alternatif'));
        } else {
            $data['select'] = $this->alternatif_model->getselectedalternatif($id);
            $this->load->view('alternatif/alternatif_edit', $data);
        }
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        $this->alternatif_model->delete_alternatif($id);
        redirect(base_url('alternatif'));
        
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
        $pdf->Cell(190,8,'Daftar Alternatif',0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(190,8,'Sistem Pendukung Keputusan',0,1,'C');
        $pdf->Cell(190,8,'Penentuan Prioritas Lokasi Pembangunan Embung',0,1,'C');
        $pdf->Cell(190,8,'di Kabupaten Semarang',0,1,'C');

        // Memberikan space kebawah agar tidak terlalu rapat

        $pdf->Cell(10,8,'',0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        // $pdf->Cell(20,8,'2. Data Alternatif',0,1,'J');
        $pdf->Cell(10,4,'',0,1);
        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(25,8,'',0,0,'L');
        $pdf->Cell(10,8,'No',1,0,'C');
        $pdf->Cell(80,8,'Nama Alternatif',1,0,'C');
        $pdf->Cell(45,8,'Kecamatan',1,1,'C');
        $pdf->SetFont('Arial','',10);

        $alternatif = $this->alternatif_model->getAll()->result(); // show in Alternatif and Hitung
        $count = 0;
        foreach($alternatif as $row):
        $count++;
            $pdf->Cell(25,8,'',0,0,'L');
            $pdf->Cell(10,8,$count,1,0,'C');
            $pdf->Cell(80,8,$row->alternatif,1,0,'C');
            $pdf->Cell(45,8,$row->kecamatan,1,1,'C');
            // $ALT[$row->alternatif_id] = $row->alternatif;
        endforeach;

        

        $pdf->Output();
    }
 
}