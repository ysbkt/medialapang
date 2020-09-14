<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Profile extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->model('Profile_model');
		$this->load->model('Lapangan_model');
		$this->load->model('Jadwal_model');

	}

	public function Index(){
		$content = array (	'title'			=> 'Media Lapang',
							'content'		=> 'pages/Penyedia/Profile',
							'penyedia'		=> $this->Profile_model->Penyedia($this->session->userdata('id')),
							'penyewa'		=> $this->Profile_model->Penyewa($this->session->userdata('id')),
							'lapangan'		=> $this->Profile_model->Lapangan($this->session->userdata('id')),
							'jadwal'		=> $this->Profile_model->Jadwal($this->session->userdata('id')),
							'jadwalPenyewa'	=> $this->Profile_model->JadwalPenyewa($this->session->userdata('id')),
							'listlapangan'	=> $this->Lapangan_model->ListLapangan(),
							'jenislapangan'	=> $this->Lapangan_model->JenisLapangan($this->session->userdata('id')),
						);
		$this->load->view('layout/Wrapper',$content);
	}

	public function UploadTf(){
		$id_jadwal	= $this->input->post('id_jadwal');
		$gambar		= $this->input->post('image_Tf');

		if (!$_FILES['image_Tf']['name'] == 0) {
		    $filePath = './admin/assets/img/bukti_transfer/';
		    $new_photo = $gambar;
		    $config ['file_name'] = $new_photo;
		    $config ['overwrite'] = TRUE; 
		    $config['upload_path'] = $filePath;
		    $config ['allowed_types'] = 'jpg|png|jpeg|gif|JPG|PNG|JPEG|GIF';
		    $config['max_size'] = '10240';
		    $this->load->library('upload', $config);
		    $this->upload->initialize($config); 
		    $this->upload->do_upload('image_Tf');
		    $data_upload_files = $this->upload->data();
		    $image = $data_upload_files['file_name'];
		    $error_photo= $this->upload->display_errors();
		    echo $error_photo;
		    $gambar = $image;
		    }

		    $data	= array('id_jadwal'	=> $id_jadwal,
		    				'image'	=> $gambar,

							);
		    $this->Jadwal_model->Transfer($data);
		    $this->session->set_flashdata('status','<div class="alert alert-success alert-dismissable text-center"><a href="#" data-dismiss="alert" aria-label="close"></a>Anda berhasil upload gambar lapangan</div>');
			// redirect('Profile','refresh');
	}

}
 ?>