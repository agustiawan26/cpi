<?php
class Cpi{

	public $data;
	public $datamin;
	public $bobot;
	public $datatren;
	public $kriteria;
	public $transformasi;
	public $transformasipositif;
	public $transformasinegatif;
	public $minval;
	public $terbobot;
	public $terbobottp;
	public $nilaicpi;

	function __construct($data, $datamin, $datatp, $datatn, $bobot){
		error_reporting(0);
		$this->data = $data;
		$this->datamin = $datamin;
		$this->datatn = $datatn;
		$this->datatp = $datatp;
		$this->bobot = $bobot;

		$this->transformasinegatif();
		$this->transformasipositif();
		$this->terbobottp();
		$this->terbobottn();
		$this->nilaicpitp();
		$this->nilaicpitn();
		$this->nilaicpi();
	}	
	
	function transformasipositif(){		
		foreach($this->datatp as $key => $val){
			foreach($val as $k => $v){
				$this->transformasipositif[$key][$k] = $v / $this->datamin[$k] * 100;
			}
		}			
	}
	
	function transformasinegatif(){		
		foreach($this->datatn as $key => $val){
			foreach($val as $k => $v){
				$this->transformasinegatif[$key][$k] = $this->datamin[$k] / $v * 100;
			}
		}
	}

	function terbobottp(){		
		foreach($this->transformasipositif as $key => $val){
			foreach($val as $k => $v){				
				$this->terbobottp[$key][$k] = $v * $this->bobot[$k];
			}
		}		
	}

	function terbobottn(){		
		foreach($this->transformasinegatif as $key => $val){
			foreach($val as $k => $v){				
				$this->terbobottn[$key][$k] = $v * $this->bobot[$k];
			}
		}		
	}

	function nilaicpitp(){		
		foreach($this->terbobottp as $key => $val){
			$this->nilaicpitp[$key] = array_sum($val);
		}
	}

	function nilaicpitn(){		
		foreach($this->terbobottn as $key => $val){
			$this->nilaicpitn[$key] = array_sum($val);
		}
	}

	function nilaicpi(){		
		foreach($this->data as $key => $val){
			$this->nilaicpi[$key] = $this->nilaicpitn[$key] + $this->nilaicpitp[$key];
		}
	}
	
}