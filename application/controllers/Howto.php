<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Howto extends CI_controller{
	function __Construct(){
		parent ::__Construct();

	}

	public function Index(){
		$content = array (	'title'		=> 'Media Lapang',
							'content'	=> 'pages/How-to',
						);
		$this->load->view('layout/Wrapper',$content);
	}

}
 ?>