<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hitung extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("hitung_model");

        $this->load->library('form_validation');
        $this->load->helper('cpi_class');
        $this->load->library('pdf');
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
    }

    public function index()
    {
        $jumlahbobot = $this->hitung_model->getJumlahBobot();
        if($jumlahbobot->jumlah_bobot == 100){

            $data['nilai'] = $this->hitung_model->getNilai(); // untuk perhitungan
            $datatp['nilai_tren_positif'] = $this->hitung_model->getNilaiTrenPositif(); // untuk mendapatkan nilai dr nilai tbl dg tren positif
            $datatn['nilai_tren_negatif'] = $this->hitung_model->getNilaiTrenNegatif(); // untuk mendapatkan nilai dr nilai tbl dg tren positif
            $datamin['nilai_min'] = $this->hitung_model->getNilaiMinimum(); // datamin untuk perhitungan
            $data['nilai_min'] = $this->hitung_model->getNilaiMinimum(); //untuk menampilkan nilai min tiap kriteria tahap 1
            $data['tren'] = $this->hitung_model->getTren();   //untuk menampilkan tren tiap kriteria tahap 1 
            $data['kriteria'] = $this->hitung_model->getKriteriaHead(); //untuk header tahap 1
            $data['kriteriatn'] = $this->hitung_model->getKriteriaTN();  //untuk header tranformasi nilai kriteria negatif
            $data['kriteriatp'] = $this->hitung_model->getKriteriaTP(); //untuk header tranformasi nilai kriteria positif

            //menampilkan data alternatif
            $rows = $this->hitung_model->getAlternatif();
            foreach($rows as $row){
                $ALT[$row->alternatif_id] = $row->alternatif;
            } 
            $data['alt'] = $ALT;

            //untuk perhitungan nilai CPI
            $rows = $this->hitung_model->getKriteria()->result();
            foreach($rows as $row){
                $KRT[$row->kriteria_id] = array(
                    'kriteria'=>$row->kriteria,
                    'bobot'=>$row->bobot,
                    'tren'=>$row->tren
                );
            }
            $data['krt'] = $KRT;
            foreach($data['krt'] as $key => $val){
                $bobot[$key] = $val['bobot'];
            }
            
            $data['cpi'] = new Cpi($data['nilai'], $datamin['nilai_min'], $datatp['nilai_tren_positif'], $datatn['nilai_tren_negatif'],  $bobot);
            //var_dump($data['kriteriatp']);die;
            $this->load->view("perhitungan", $data);
        } else {
            //ini masih belum work
            $this->session->set_flashdata('message', '<div class="alert alert-danger fade show" role="alert">
            <i class="fa fa-info-circle mr-3"></i>
            <span>Halaman Perhitungan tidak dapat dibuka, sesuaikan bobot kriteria sampai jumlah bobot = 100!</span>
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
            </button>
            </div>');
            redirect('kriteria');
            //set flashdata jika ada nilai 0 disini
        }
    }

    public function peringkat()
    {
        $jumlahbobot = $this->hitung_model->getJumlahBobot();
        if($jumlahbobot->jumlah_bobot == 100){

            $data['nilai'] = $this->hitung_model->getNilai(); // untuk perhitungan
            $datatp['nilai_tren_positif'] = $this->hitung_model->getNilaiTrenPositif(); // untuk mendapatkan nilai dr nilai tbl dg tren positif
            $datatn['nilai_tren_negatif'] = $this->hitung_model->getNilaiTrenNegatif(); // untuk mendapatkan nilai dr nilai tbl dg tren positif
            $datamin['nilai_min'] = $this->hitung_model->getNilaiMinimum(); // datamin untuk perhitungan
            
            //menampilkan data alternatif
            $rows = $this->hitung_model->getAlternatif();
            foreach($rows as $row){
                $ALT[$row->alternatif_id] = $row->alternatif;
            } 
            $data['alt'] = $ALT;

            //untuk perhitungan nilai CPI
            $rows = $this->hitung_model->getKriteria()->result();
            foreach($rows as $row){
                $KRT[$row->kriteria_id] = array(
                    'kriteria'=>$row->kriteria,
                    'bobot'=>$row->bobot,
                    'tren'=>$row->tren
                );
            }
            $data['krt'] = $KRT;
            foreach($data['krt'] as $key => $val){
                $bobot[$key] = $val['bobot'];
            }
            
            $data['cpi'] = new Cpi($data['nilai'], $datamin['nilai_min'], $datatp['nilai_tren_positif'], $datatn['nilai_tren_negatif'],  $bobot);

            //var_dump($data['cpi']);die;
            $data['rank'] = $this->get_rank($data['cpi']->nilaicpi);
            $this->load->view("peringkat", $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger fade show" role="alert">
            <i class="fa fa-info-circle mr-3"></i>
            <span>Halaman Hasil Peringkat tidak dapat dibuka, sesuaikan bobot kriteria sampai jumlah bobot = 100!</span>
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
            </button>
            </div>');
            redirect('kriteria');
            //set flashdata jika ada nilai 0 disini
        }
    }

    function get_rank($array){
        $data = $array;
        arsort($data);
        $no=0;
        $peringkat = array();
        // foreach($data as $key => $value){
        //     $peringkat[$key] = $no++;
        // var_dump($key); die;
        // }
        
        $prevKey = null;
        foreach($data as $key => $value){
            if ($prevKey != null && $data[$prevKey] == $value){
                $peringkat[$key] = $no;
            } else { 
                $peringkat[$key] = ++$no; 
            }
            $prevKey = $key;
        }
         //var_dump($peringkat); die;
        return $peringkat;
    }

    function print(){
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','I',8);
        $NOW = date("Y-m-d h:i:sa");
        $User = $this->session->userdata('full_name');
        $pdf->Cell(230,8,$NOW,0,0,'L');
        $pdf->Cell(0,8,"Dicetak Oleh : ".$User,0,1,'L');
        // mencetak string 
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(280,8,'Hasil Perhitungan',0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(280,6,'Sistem Pendukung Keputusan',0,1,'C');
        $pdf->Cell(280,6,'Penentuan Prioritas Lokasi Pembangunan Embung',0,1,'C');
        $pdf->Cell(280,6,'di Kabupaten Semarang',0,1,'C');
        $pdf->Cell(280,6,'Menggunakan Metode Composite Performance Index',0,0,'C');

        

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,12,'',0,0,'R');
        $pdf->Cell(250,5,'Keterangan Kriteria :',0,1,'R');
        
        $pdf->SetFont('Arial','',10);
        $kriteria = $this->hitung_model->getKriteriaHead();
        
        foreach ($kriteria as $kriteria) :
        $pdf->Cell(15,12,'',0,0,'R');
        $pdf->Cell(180,5,"K".$kriteria->kriteria_id."  =>  ",0,0,'R');
        $pdf->Cell(70,5,$kriteria->kriteria,0,1,'R');
        
        endforeach; 

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        $pdf->Cell(170,8,'1. Identifikasi nilai minimum dan tren tiap kriteria',0,1,'L');
        // $pdf->Cell(10,4,'',0,1);

        $data['nilai'] = $this->hitung_model->getNilai(); // untuk perhitungan
        $datatp['nilai_tren_positif'] = $this->hitung_model->getNilaiTrenPositif(); // untuk mendapatkan nilai dr nilai tbl dg tren positif
        $datatn['nilai_tren_negatif'] = $this->hitung_model->getNilaiTrenNegatif(); // untuk mendapatkan nilai dr nilai tbl dg tren positif
        $datamin['nilai_min'] = $this->hitung_model->getNilaiMinimum(); // datamin untuk perhitungan
        $nilai_min = $this->hitung_model->getNilaiMinimum(); //untuk menampilkan nilai min tiap kriteria tahap 1
        $tren = $this->hitung_model->getTren();   //untuk menampilkan tren tiap kriteria tahap 1 
        //$kriteria = $this->hitung_model->getKriteriaHead(); //untuk header tahap 1
        $kriteriahead = $this->hitung_model->getKriteriaHead(); //untuk header tahap 1
        $kriteriatn = $this->hitung_model->getKriteriaTN();  //untuk header tranformasi nilai kriteria negatif
        $kriteriatp = $this->hitung_model->getKriteriaTP(); //untuk header tranformasi nilai kriteria positif

        //menampilkan data alternatif
        $rows = $this->hitung_model->getAlternatif();
        foreach($rows as $row){
            $ALT[$row->alternatif_id] = $row->alternatif;
        } 
        $data['alt'] = $ALT;
        $alt = $data['alt'];

        //untuk perhitungan nilai CPI
        $rows = $this->hitung_model->getKriteria()->result();
        foreach($rows as $row){
            $KRT[$row->kriteria_id] = array(
                'kriteria'=>$row->kriteria,
                'bobot'=>$row->bobot,
                'tren'=>$row->tren
            );
        }
        $data['krt'] = $KRT;
        foreach($data['krt'] as $key => $val){
            $bobot[$key] = $val['bobot'];
        }
        
        $data['cpi'] = new Cpi($data['nilai'], $datamin['nilai_min'], $datatp['nilai_tren_positif'], $datatn['nilai_tren_negatif'],  $bobot);

        $cpi = $data['cpi'];

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,2,'',0,1,'L');
        $pdf->Cell(15,8,'',0,0,'L');
        $pdf->Cell(30,10,'Data',1,0,'C');
        $i = 1;
        foreach ($kriteriahead as $kriteria) :
            $pdf->Cell(23,10,"K".$kriteria->kriteria_id,1,0,'C');   
            $i++;                                                             
        endforeach; 

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,10,'',0,1,'L');
        $pdf->Cell(15,10,'',0,0,'L');
        $pdf->Cell(30,10,'Nilai Min',1,0,'C');
        $pdf->SetFont('Arial','',10);
        
        foreach ($nilai_min as $min => $y) : 
            $pdf->Cell(23,10,$y,1,0,'C');   
        endforeach;

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,10,'',0,1,'L');
        $pdf->Cell(15,10,'',0,0,'L');
        $pdf->Cell(30,10,'Tren',1,0,'C');
        $pdf->SetFont('Arial','',10);
        
        foreach ($tren as $tren => $y) : 
            $pdf->Cell(23,10,$y,1,0,'C');   
        endforeach;

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(15,12,'',0,1,'L');
        $pdf->Cell(15,12,'',0,0,'L');
        $pdf->Cell(170,5,'- Data nilai minimum digunakan untuk transformasi nilai di tahap selanjutnya',0,1,'L');
        $pdf->Cell(15,12,'',0,0,'L');
        $pdf->Cell(170,5,'- Tren positif berarti semakin tinggi nilainya maka semakin baik',0,1,'L');
        $pdf->Cell(15,12,'',0,0,'L');
        $pdf->Cell(170,5,'- Tren negatif berati semakin rendah nilainya maka semakin baik',0,1,'L');
        
        $pdf->Cell(10,4,'',0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        $pdf->Cell(170,8,'2. Transformasi nilai untuk kriteria dengan tren positif',0,1,'L');
        
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(15,4,'',0,0,'L');
        $pdf->Cell(170,5,'Untuk kriteria tren positif, nilai minimum pada setiap kriteria ditransformasi ke seratus, sedangkan nilai lainnya ditransformasi secara proporsional lebih tinggi.',0,1,'L');
        
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        $pdf->Cell(10,4,'',0,1);
    
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,8,'',0,0,'L');
        $pdf->Cell(40,10,'Nama Alternatif',1,0,'C');
        foreach ($kriteriatp as $kriteria) : 
            $pdf->Cell(25,10,"K".$kriteria->kriteria_id,1,0,'C');
        endforeach;
        
        $pdf->Cell(15,10,'',0,1,'L');
        foreach ($cpi->transformasipositif as $key => $val) : 
            $pdf->SetFont('Arial','',10); 
            $pdf->Cell(15,8,'',0,0,'L');
            $pdf->Cell(40,10,$alt[$key],1,0,'C');
            foreach ($val as $k => $v) : 
                $pdf->SetFont('Arial','',10); 
                $pdf->Cell(25,10,number_format(($v),3,",","."),1,0,'C');
            endforeach;
            $pdf->Cell(15,10,'',0,1,'L');
        endforeach;
        
        $pdf->Cell(10,4,'',0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        $pdf->Cell(170,8,'3. Transformasi nilai untuk kriteria dengan tren negatif',0,1,'L');
        
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(15,4,'',0,0,'L');
        $pdf->Cell(170,5,'Untuk kriteria tren negatif, nilai minimum pada setiap kriteria ditransformasi ke seratus, sedangkan nilai lainnya ditransformasi secara proporsional lebih rendah.',0,1,'L');
        
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        // $pdf->Cell(170,8,'3. Data Nilai',0,1,'L');
        $pdf->Cell(10,4,'',0,1);
    
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,8,'',0,0,'L');
        $pdf->Cell(40,10,'Nama Alternatif',1,0,'C');
        foreach ($kriteriatn as $kriteria) : 
            $pdf->Cell(25,10,"K".$kriteria->kriteria_id,1,0,'C');
        endforeach;
        
        $pdf->Cell(15,10,'',0,1,'L');
        foreach ($cpi->transformasinegatif as $key => $val) : 
            $pdf->SetFont('Arial','',10); 
            $pdf->Cell(15,8,'',0,0,'L');
            $pdf->Cell(40,10,$alt[$key],1,0,'C');
            foreach ($val as $k => $v) :
                $pdf->SetFont('Arial','',10); 
                $pdf->Cell(25,10,number_format(($v),3,",","."),1,0,'C');
            endforeach;
            $pdf->Cell(15,10,'',0,1,'L');
        endforeach; 
       
        $pdf->SetFont('Arial','',12);
    
        $nilai = $this->hitung_model->getNilai();
    
        foreach ($alternatif as $item) :
            $pdf->Cell(15,8,'',0,0,'L');
            $pdf->Cell(40,10,$item->alternatif,1,0,'C');    
            if ($countkriteria > 0) :
                    foreach ($nilai[$item->alternatif_id] as $k => $v) : 
                        $pdf->Cell(30,10,$v,1,0,'C');
                    endforeach;       
                    $pdf->Cell(30,10,'',0,1);
                endif;
        endforeach; 

        $pdf->Cell(10,4,'',0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        $pdf->Cell(170,8,'4. Menghitung Nilai CPI',0,1,'L');
        
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(15,4,'',0,0,'L');
        $pdf->Cell(170,5,'Menghitung indeks gabungan kriteria pada alternatif ke-j. Perhitungan dilakukan dengan melakukan perkalian nilai yang sudah ditransformasikan dengan bobot kriteria.',0,1,'L');
        $pdf->Cell(15,12,'',0,0,'L');
        $pdf->Cell(170,5,'Kemudian menjumlahkan hasil perhitungan tiap alternatif.',0,1,'L');
        $pdf->Cell(15,12,'',0,0,'L');
        $pdf->Cell(170,5,'Alternatif dengan total nilai indeks gabungan tertinggi merupakan alternatif terbaik',0,1,'L');
        
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        // $pdf->Cell(170,8,'3. Data Nilai',0,1,'L');
        $pdf->Cell(10,4,'',0,1);
    
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,8,'',0,0,'L');
        $pdf->Cell(40,10,'Nama Alternatif',1,0,'C');
        $pdf->Cell(50,10,'Nilai CPI',1,0,'C');

        // foreach ($cpi->nilaicpi as $key => $val) : 
        //         $alt[$key] 
        //         round(($cpi->nilaicpi[$key]),4)
        // endforeach; 
        $pdf->SetFont('Arial','',10); 
        $pdf->Cell(15,10,'',0,1,'L');
        foreach ($cpi->nilaicpi as $key => $val) : 
            $pdf->Cell(15,8,'',0,0,'L');
            
            $pdf->Cell(40,10,$alt[$key],1,0,'C');
            $pdf->Cell(50,10,number_format(($cpi->nilaicpi[$key]),3,",","."),1,0,'C');

            
            $pdf->Cell(15,10,'',0,1,'L');
        endforeach; 
       
        $pdf->SetFont('Arial','',12);
    
        $nilai = $this->hitung_model->getNilai();
    
        foreach ($alternatif as $item) :
            $pdf->Cell(15,8,'',0,0,'L');
            $pdf->Cell(40,10,$item->alternatif,1,0,'C');    
            if ($countkriteria > 0) :
                    foreach ($nilai[$item->alternatif_id] as $k => $v) : 
                        $pdf->Cell(30,10,$v,1,0,'C');
                    endforeach;       
                    $pdf->Cell(30,10,'',0,1);
                endif;
        endforeach; 

        

        $pdf->Output();
    }

    function printperingkat(){
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
        $pdf->Cell(190,8,'Hasil Peringkat',0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(190,6,'Sistem Pendukung Keputusan',0,1,'C');
        $pdf->Cell(190,6,'Penentuan Prioritas Lokasi Pembangunan Embung',0,1,'C');
        $pdf->Cell(190,6,'di Kabupaten Semarang',0,1,'C');
        $pdf->Cell(190,6,'Menggunakan Metode Composite Performance Index',0,0,'C');



        $pdf->Cell(10,8,'',0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'',0,0,'L');
        $pdf->Cell(20,8,'',0,1,'J');
        $pdf->Cell(10,4,'',0,1);
        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,8,'',0,0,'L');
        $pdf->Cell(30,8,'Peringkat',1,0,'C');
        $pdf->Cell(80,8,'Nama Alternatif',1,0,'C');
        $pdf->Cell(45,8,'Nilai CPI',1,1,'C');
        $pdf->SetFont('Arial','',10);

        $data['nilai'] = $this->hitung_model->getNilai(); // untuk perhitungan
        $datatp['nilai_tren_positif'] = $this->hitung_model->getNilaiTrenPositif(); // untuk mendapatkan nilai dr nilai tbl dg tren positif
        $datatn['nilai_tren_negatif'] = $this->hitung_model->getNilaiTrenNegatif(); // untuk mendapatkan nilai dr nilai tbl dg tren positif
        $datamin['nilai_min'] = $this->hitung_model->getNilaiMinimum(); // datamin untuk perhitungan

        //menampilkan data alternatif
        $rows = $this->hitung_model->getAlternatif();
        foreach($rows as $row){
            $ALT[$row->alternatif_id] = $row->alternatif;
        } 
        $data['alt'] = $ALT;
        $alt = $data['alt'];

        //untuk perhitungan nilai CPI
        $rows = $this->hitung_model->getKriteria()->result();
        foreach($rows as $row){
            $KRT[$row->kriteria_id] = array(
                'kriteria'=>$row->kriteria,
                'bobot'=>$row->bobot,
                'tren'=>$row->tren
            );
        }
        $data['krt'] = $KRT;
        foreach($data['krt'] as $key => $val){
            $bobot[$key] = $val['bobot'];
        }
        
        $data['cpi'] = new Cpi($data['nilai'], $datamin['nilai_min'], $datatp['nilai_tren_positif'], $datatn['nilai_tren_negatif'],  $bobot);

        $cpi = $data['cpi'];

        $rank = $this->get_rank($data['cpi']->nilaicpi);

        $rank = $rank;

        foreach ($rank as $key => $val) :
            $pdf->Cell(15,8,'',0,0,'L');
            $pdf->Cell(30,8,$rank[$key],1,0,'C');
            $pdf->Cell(80,8,$alt[$key],1,0,'C');
            $pdf->Cell(45,8,number_format(($cpi->nilaicpi[$key]),3,",","."),1,1,'C');
            
            
        endforeach; 

        $pdf->Output();
    }
}