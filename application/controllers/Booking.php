<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Booking extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->model('Lapangan_model');

	}

	public function Index(){
		$content = array (	'title'		=> 'Media Lapang',
							'content'	=> 'pages/Booking',
							'kecamatan'	=> $this->Lapangan_model->Kecamatan(),
							'lapangan'	=> $this->Lapangan_model->Lapangan(),
						);
		$this->load->view('layout/Wrapper',$content);
	}

	public function Payment(){
		$content	= array (	'title'		=> 'Payment',
								'content'	=> 'pages/Payment'
							);
		$this->load->array('layout/Wrapper',$content);
	}

}
 ?>