<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Pembayaran extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->model('Jadwal_model');
		$this->load->model('Lapangan_model');

	}

	public function Detail_pemesanan(){
		if (empty($this->session->userdata('nama'))) {
			$this->session->set_flashdata('status', '<div class="alert-danger text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>Maaf, anda harus login atau register terlebih dahulu.</div>');
			redirect(base_url('Account/Penyewa'));
		}else{

		$content = array (	'title'				=> 'Media Lapang',
							'content'			=> 'pages/Detail_pemesanan',
							'datalapangan'		=> $this->Lapangan_model->getLapangan($this->input->get('id_data_lapangan')),
							'dataharga'			=> $this->Lapangan_model->getHarga($this->input->get('id_data_lapangan')),
							'id_data_lapangan' 	=> $this->input->get('id_data_lapangan'),
							'tanggal_book' 		=> $this->input->get('tanggal_book'),
							'jam_mulai' 		=> $this->input->get('jam_mulai'),
							'jam_finish' 		=> $this->input->get('jam_finish'),
							'duration'			=> $this->get_time_difference($this->input->get('jam_mulai'),$this->input->get('jam_finish')),
							'total' 			=> $this->input->get('total'),
						);
		$this->load->view('layout/Wrapper',$content);
	}
	}

	public function Konfirmasi_pemesanan(){
		$content = array (	'title'				=> 'Media Lapang',
							'content'			=> 'pages/Konfirmasi_pemesanan',
							'id_data_lapangan' 	=> $this->input->get('id_data_lapangan'),
							'nama_tempat' 		=> $this->input->get('nama_tempat'),
							'nama_lapangan' 	=> $this->input->get('nama_lapangan'),
							'tanggal_book' 		=> $this->input->get('tanggal_book'),
							'jam_mulai' 		=> $this->input->get('jam_mulai'),
							'jam_finish' 		=> $this->input->get('jam_finish'),
							'skema' 			=> $this->input->get('skema'),
							'total' 			=> $this->input->get('total'),
							'duration' 			=> $this->input->get('duration')
						);
		$this->load->view('layout/Wrapper',$content);
	}

	public function Konfirmasi(){
		$content = array (	'title'		=> 'Media Lapang Konfirmasi',
							'content'	=> 'pages/Konfirmasi',
							'nama_tempat' 		=> $this->input->get('nama_tempat'),
							'nama_lapangan' 	=> $this->input->get('nama_lapangan'),
							'id_data_lapangan' 	=> $this->input->get('id_data_lapangan'),
							'tanggal_book' 		=> $this->input->get('tanggal_book'),
							'jam_mulai' 		=> $this->input->get('jam_mulai'),
							'jam_finish' 		=> $this->input->get('jam_finish'),
							'skema' 			=> $this->input->get('skema'),
							'total' 			=> $this->input->get('total'),
							'duration' 			=> $this->input->get('duration'),
							'kode'				=> $this->Kode(),
							'unik'				=> $this->unik(url_title($this->input->get('nama_tempat'),'dash', TRUE))
						);
		$this->load->view('layout/Wrapper',$content);
	}

	public function Booking(){
		$data = array(	'kode_jadwal' 		=> $this->input->get('kode'),
						'id_penyewa'		=> $this->input->get('id_penyewa'),
						'id_data_lapangan'	=> $this->input->get('id_data_lapangan'),
						'hari_main'			=> $this->input->get('hari_main'),
						'jam_main'			=> $this->input->get('jam_main'),
						'jam_selesai'		=> $this->input->get('jam_selesai'),
						'dp'				=> $this->input->get('depe'),
						'total_pemesanan'	=> $this->input->get('total'),
						'tanggal_booking'	=> date('Y-m-d'));

		$res = $this->Jadwal_model->Booking($data);
		if($res){

		$this->session->set_flashdata('status', '<div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                        Anda berhasil melakukan pemesanan lapangan.</div>');
                        redirect(base_url('Profile'));
		
		}

	}

	function get_time_difference($time1, $time2)
	{
		$time1 = strtotime("1/1/1980 $time1");
		$time2 = strtotime("1/1/1980 $time2");

	if ($time2 < $time1)
	{
		$time2 = $time2 + 86400;
	}

	return ($time2 - $time1) / 3600;

	}

	public function unik($str) {
    $ret = '';
    foreach (explode('-', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
}

	public function Kode() {
	    $kode = '';
	    $kode = mt_rand(10000, 99999);
	    return $kode;
	}

}
 ?>