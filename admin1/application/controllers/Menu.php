<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Menu extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->model('User_model');

	}

	public function ListPenyedia(){
		$content = array (	'title'		=> 'Admin | Media Lapang',
							'content'	=> 'pages/Penyedia',
							'penyedia'	=> $this->User_model->Penyedia(),
						);
		$this->load->view('layout/Wrapper',$content);
	}

	public function ListPenyewa(){
		$content = array (	'title'		=> 'Admin | Media Lapang',
							'content'	=> 'pages/Penyewa',
							'penyewa'	=> $this->User_model->Penyewa(),
						);
		$this->load->view('layout/Wrapper',$content);
	}

	public function Pembayaran(){
		$content = array (	'title'		=> 'Admin | Media Lapang',
							'content'	=> 'pages/Pembayaran',
							'pembayaran'=> $this->User_model->Pembayaran(),
						);
		$this->load->view('layout/Wrapper',$content);
	}

}
 ?>