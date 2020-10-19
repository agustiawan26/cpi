<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landingpage extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("alternatif_model");
        $this->load->model("kriteria_model");
        $this->load->model("nilai_model");
		$this->load->model("hitung_model");
		
        $this->load->library('form_validation');
        $this->load->helper('cpi_class');
	}
	
	public function index()
	{
		$data['count'] = $this->nilai_model->getCountKriteria()->jumlah;
        $data['alternatiff'] = $this->nilai_model->getAlternatif(); // show in Nilai
        $data['alternatif'] = $this->nilai_model->getAlternatif(); // show in Alternatif and Hitung
        $data['kriteria'] = $this->hitung_model->getKriteria();
        $data['kriteriahead'] = $this->hitung_model->getKriteriaHead();
        $data['nilai'] = $this->nilai_model->getNilai();
        $datatp['nilai_tren_positif'] = $this->hitung_model->getNilaiTrenPositif();
        $datatn['nilai_tren_negatif'] = $this->hitung_model->getNilaiTrenNegatif();
        $datamin['nilai_min'] = $this->hitung_model->getNilaiMinimum();
        $datatren['tren'] = $this->hitung_model->getTren();

        $rows = $this->nilai_model->getAlternatif();
        foreach($rows as $row){
            $ALT[$row->alternatif_id] = $row->alternatif;
        } 
        $data['alt'] = $ALT;

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

		$data['rank'] = $this->get_rank($data['cpi']->nilaicpi);

        //var_dump($data['nilai']);die;
		$this->load->view("landingpage", $data);
    }

    function get_rank($array){
        $data = $array;
        arsort($data);
        $no=0;
        $peringkat = array();
        
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
		
}
