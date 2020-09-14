<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Lapangan extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->model('Jadwal_model');
		$this->load->model('Lapangan_model');

	}

	public function Jenis($id){
		$content = array (	'title'			=> 'Media Lapang',
							'content'		=> 'pages/Lapangan',
							'kecamatan'		=> $this->Lapangan_model->Kecamatan(),
							'lapangan'		=> $this->Lapangan_model->Lapangan(),
							'datalapangan'	=> $this->Lapangan_model->DataLapangan($id),
						);
		$this->load->view('layout/Wrapper',$content);
	}

	// public function Futsal(){
	// 	$content = array (	'title'		=> 'Media Lapang',
	// 						'content'	=> 'pages/Futsal',
	// 						'kecamatan'		=> $this->Lapangan_model->Kecamatan(),
	// 						'lapangan'		=> $this->Lapangan_model->Lapangan(),
	// 						'datalapangan'	=> $this->Lapangan_model->DataLapangan($id),
	// 					);
	// 	$this->load->view('layout/Wrapper',$content);
	// }

	// public function Badminton(){
	// 	$content = array (	'title'		=> 'Media Lapang',
	// 						'content'	=> 'pages/Badminton',
	// 						'kecamatan'		=> $this->Lapangan_model->Kecamatan(),
	// 						'lapangan'		=> $this->Lapangan_model->Lapangan(),
	// 						'datalapangan'	=> $this->Lapangan_model->DataLapangan($id),
	// 					);
	// 	$this->load->view('layout/Wrapper',$content);
	// }

	public function Overview($id){
		$content = array (	'title'				=> 'Media Lapang',
							'content'			=> 'pages/Overview',
							'jam'				=> $this->Jadwal_model->Jam()->result(),
							'getJadwal'			=> $this->Jadwal_model->getJadwal($id)->result(),
							'bannerlapangan'	=> $this->Lapangan_model->BannerLapangan($id),
							'lapangan'			=> $this->Lapangan_model->getLapangan($id),
							'gallery'			=> $this->Jadwal_model->getGallery($id)->result(),
							'id_data_lapangan'	=> $id
						);
		$this->load->view('layout/Wrapper',$content);
	}

	function TambahLapangan(){
		$nama_lapangan	= $this->input->post('nama_lapangan');
		$jenis_lapangan	= $this->input->post('jenis_lapangan');
		$deskripsi		= $this->input->post('deskripsi');
		$id_penyedia	= $this->session->userdata('id');

		$skema_1		= $this->input->post('skema_1');
		$skema_2		= $this->input->post('skema_2');
		$skema_3		= $this->input->post('skema_3');
		$skema_4		= $this->input->post('skema_4');
		$skema_5		= $this->input->post('skema_5');
		$skema_6		= $this->input->post('skema_6');

		$data	= array( 'nama_lapangan'	=> $nama_lapangan,
						 'id_lapangan'		=> $jenis_lapangan,
						 'deskripsi'		=> $deskripsi,
						 'id_penyedia'		=> $id_penyedia
						);
		$id_data_lapangan = $this->Lapangan_model->TambahLapangan($data,'data_lapangan');

		$harga	= array('id_data_lapangan'	=> $id_data_lapangan,
						'skema_1'			=> $skema_1,
						'skema_2'			=> $skema_2,
						'skema_3'			=> $skema_3,
						'skema_4'			=> $skema_4,
						'skema_5'			=> $skema_5,
						'skema_6'			=> $skema_6,
						);
		$this->Lapangan_model->TambahHarga($harga,'harga');
		$this->session->set_flashdata('status','<div class="alert alert-success alert-dismissable text-center"><a href="#" data-dismiss="alert" aria-label="close"></a>Anda berhasil menambahkan lapangan baru.</div>');
		redirect('Profile','refresh');
	}

	function UploadGambar(){
		$nama_lapangan	= $this->input->post('nama_lapangan');
		$gambar			= $this->input->post('image');
		$nama_tempat	= $this->session->userdata('nama_tempat');

		if (!$_FILES['image']['name'] == 0) {
		    $filePath = './assets/gambar_lapangan/';
		    $new_photo = $nama_tempat." - ".$gambar;
		    $config ['file_name'] = $new_photo;
		    $config ['overwrite'] = TRUE; 
		    $config['upload_path'] = $filePath;
		    $config ['allowed_types'] = 'jpg|png|jpeg|gif|JPG|PNG|JPEG|GIF';
		    $config['max_size'] = '10240';
		    $this->load->library('upload', $config);
		    $this->upload->initialize($config); 
		    $this->upload->do_upload('image');
		    $data_upload_files = $this->upload->data();
		    $image = $data_upload_files['file_name'];
		    $error_photo= $this->upload->display_errors();
		    echo $error_photo;
		    $gambar = $image;
		    }

		    $data	= array('id_data_lapangan'	=> $nama_lapangan,
		    				'gambar'			=> $gambar,

							);
		    $this->Lapangan_model->GambarLapangan($data,'gambar_lapangan');
		    $this->session->set_flashdata('status','<div class="alert alert-success alert-dismissable text-center"><a href="#" data-dismiss="alert" aria-label="close"></a>Anda berhasil upload gambar lapangan</div>');
			redirect('Profile','refresh');
	}

	function Search(){
	  	$area			= $this->input->GET('area');
	  	$id_lapangan	= $this->input->GET('jenislapangan');

		$content	= array('title'			=> 'Hasil Pencarian',
							'content'		=> 'pages/Hasil',
							'kecamatan'		=> $this->Lapangan_model->SearchKecamatan(),
							'lapangan'		=> $this->Lapangan_model->SearchLapangan(),
							'datalapangan'	=> $this->Lapangan_model->SearchDataLapangan(),
							'cari'			=> $this->Lapangan_model->Search($area,$id_lapangan)
							);
		$this->load->view('layout/Wrapper',$content);
	}

}
 ?>