<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Home extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->model('User_model');

	}

	public function Index(){
		$content = array (	'title'		=> 'Admin | Media Lapang',
							'content'	=> 'pages/Home',
							'penyedia'	=> $this->User_model->CountPenyedia(),
							'penyewa'	=> $this->User_model->CountPenyewa(),
							'lapangan'	=> $this->User_model->CountLapangan(),
							'jadwal'	=> $this->User_model->CountJadwal(),
						);
		$this->load->view('layout/Wrapper',$content);
	}

}
 ?>