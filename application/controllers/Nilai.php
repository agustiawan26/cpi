<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('nilai_model');
    $this->load->helper('cpi_class');
    $this->load->library('pdf');

    if (!$this->session->userdata('email')) {
      redirect('login');
    }
  }

  public function index()
  {
    $data['count'] = $this->nilai_model->getCountKriteria()->jumlah;
    $data['alternatif'] = $this->nilai_model->getAlternatif();
    $data['kriteria'] = $this->nilai_model->getKriteria();
    $data['kriteriahead'] = $this->nilai_model->getKriteria();
    $data['nilai'] = $this->nilai_model->getNilai();
    
    $this->load->view("nilai/nilai", $data);
    
  }

  public function updateNilai($id)
  {
    $data["form"] = $this->nilai_model->getListForm($id);
    $data["formwp"] = $this->nilai_model->getListFormwp($id);
    if ($this->input->post('updatenilai')) {
      foreach ($data["form"] as $item) {
        $this->nilai_model->updateNilai($id, $item->nilai_kriteria_id, $this->input->post($item->nilai_kriteria_id));
      }
      foreach ($data["formwp"] as $item) {
         $this->nilai_model->updateNilai($id, $item->nilai_kriteria_id, $this->input->post($item->nilai_kriteria_id));
       }
      
      $this->session->set_flashdata('msg', '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="icofont icofont-close-line-circled"></i>
              </button>
              <strong>Berhasil mengedit nilai!</strong>
          </div>');
      redirect(base_url('nilai'));
    } elseif ($this->input->post('back')) {
      redirect(base_url('nilai'));
    } else {
      $data["selectalt"] = $this->nilai_model->getSelectedAlternatif($id);      

      //untuk value nilai di form edit
      $data['nilai_tbl'] = $this->nilai_model->getNilaialternatif($id);
      $data['nilai_tbl_wp'] = $this->nilai_model->getNilaialternatifwp($id);

      $data['parameter'] = $this->nilai_model->getParameter();
      //var_dump($data['parameter']); die;

      $this->load->view("nilai/nilai_edit", $data);
    }
  }

  function print(){
    $pdf = new FPDF('p','mm','A4');
    // membuat halaman baru
    $pdf->AddPage('l');

    $pdf->SetFont('Arial','I',8);
    $NOW = date("Y-m-d h:i:sa");
    $User = $this->session->userdata('full_name');
    $pdf->Cell(230,8,$NOW,0,0,'L');
    $pdf->Cell(0,8,"Dicetak Oleh : ".$User,0,1,'L');

    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial','B',16);
    // mencetak string 
    $pdf->Cell(280,8,'Nilai Kriteria',0,1,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(280,8,'Sistem Pendukung Keputusan',0,1,'C');
    $pdf->Cell(280,8,'Penentuan Prioritas Lokasi Pembangunan Embung',0,1,'C');
    $pdf->Cell(280,8,'di Kabupaten Semarang',0,1,'C');

    

    $count = $this->nilai_model->getCountKriteria()->jumlah;
    //$data['countwp'] = $this->nilai_model->getCountKriteriawp()->jumlah;
    $alternatif = $this->nilai_model->getAlternatif();
    $kriteria = $this->nilai_model->getKriteria();
    $nilai = $this->nilai_model->getNilai();
    $kriteriahead = $this->nilai_model->getKriteria();

    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(15,12,'',0,0,'L');
    $pdf->Cell(170,5,'Keterangan Kriteria :',0,1,'L');
    
    $pdf->SetFont('Arial','',8);
    
    foreach ($kriteria as $kriteria) :
      $pdf->Cell(15,12,'',0,0,'L');
      $pdf->Cell(170,5,"K".$kriteria->kriteria_id."  =>  ".$kriteria->kriteria,0,1,'L');
    endforeach; 

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10,8,'',0,0,'L');
    // $pdf->Cell(170,8,'3. Data Nilai',0,1,'L');
    $pdf->Cell(10,4,'',0,1);

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(15,8,'',0,0,'L');
    $pdf->Cell(35,10,'Nama Alternatif',1,0,'C');

    $countkriteria = $this->nilai_model->getCountKriteria()->jumlah;
    // if ($countkriteria > 0) :
    //     for ($a = 1; $a < $countkriteria; $a++) {
    //         $pdf->Cell(25,10,"K".$a,1,0,'C');
    //     }
    //     $pdf->Cell(25,10,"K".$countkriteria,1,1,'C');
    // endif;

    foreach ($kriteriahead as $kriteria) :
      $pdf->Cell(25,10,"K".$kriteria->kriteria_id,1,0,'C');
      // <th class="text-center">K<?php echo $kriteria->kriteria_id; 
    endforeach; 
    $pdf->Cell(10,10,'',0,1);

    $pdf->SetFont('Arial','',10);

    $nilai = $this->nilai_model->getNilai();

    foreach ($alternatif as $item) :
        $pdf->Cell(15,8,'',0,0,'L');
        $pdf->Cell(35,10,$item->alternatif,1,0,'C');    
        if ($countkriteria > 0) :
                foreach ($nilai[$item->alternatif_id] as $k => $v) : 
                    $pdf->Cell(25,10,$v,1,0,'C');
                endforeach;       
                $pdf->Cell(30,10,'',0,1);
            endif;
    endforeach; 

    $pdf->Output();
  }
}
