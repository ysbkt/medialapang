<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Home extends CI_controller{
	function __Construct(){
		parent ::__Construct();

	}

	public function Index(){
		$content = array (	'title'		=> 'Media Lapang',
							'content'	=> 'pages/Home',
						);
		$this->load->view('layout/Wrapper',$content);
	}

}
 ?>