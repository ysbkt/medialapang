<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Contact extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->model('Penyewa_model');

	}

	public function Index(){
		$content = array (	'title'		=> 'Media Lapang',
							'content'	=> 'pages/Contact_us',
						);
		$this->load->view('layout/Wrapper',$content);
	}

	function Ask(){
		$nama		= $this->input->post('nama');
		$email		= $this->input->post('email');
		$subject	= $this->input->post('subject');
		$pesan		= $this->input->post('pesan');

		$data		= array( 'nama'		=> $nama,
							 'email'	=> $email,
							 'subject'	=> $subject,
							 'isi_pesan'=> $pesan
							);
		$this->Penyewa_model->Pertanyaan($data,'pesan');
		$this->session->set_flashdata('status','<div class="alert alert-success alert-dismissable text-center"><a href="#" data-dismiss="alert" aria-label="close"></a>Pesan Anda Berhasil Dikirim</div>');
		redirect('Contact');
	}

}
 ?>