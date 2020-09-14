<?php 
	
	/**
	* 
	*/
	class Lapangan_model extends CI_model
	{
		function Kecamatan(){
			$this->db->select('*');
			$this->db->from('kecamatan');
			return $this->db->get()->result();
		}

		function Lapangan(){
			$this->db->select('*');
			$this->db->from('lapangan');
			return $this->db->get()->result();
		}

		function BannerLapangan($id){
			$this->db->select('*');
			$this->db->from('data_lapangan a');
			$this->db->join('penyedia b','b.id_penyedia = a.id_penyedia','left');
			$this->db->join('harga h','h.id_data_lapangan = a.id_data_lapangan','left');
			$this->db->join('gambar_lapangan g','g.id_data_lapangan = a.id_data_lapangan','left');
			$this->db->limit(1);
			$this->db->where('b.id_penyedia',$id);
			return $this->db->get()->result();
		}

		function getLapangan($id){
			$this->db->select('*');
			$this->db->from('data_lapangan a');
			$this->db->join('penyedia b','b.id_penyedia = a.id_penyedia','left');
			$this->db->join('harga h','h.id_data_lapangan = a.id_data_lapangan','left');
			$this->db->join('gambar_lapangan g','g.id_data_lapangan = a.id_data_lapangan','left');
			$this->db->where('a.id_data_lapangan',$id);
			$this->db->group_by('a.id_data_lapangan');
			return $this->db->get()->result();
		}

		function getHarga($id){
			$this->db->select('*');
			$this->db->from('data_lapangan a');
			$this->db->join('harga b','b.id_data_lapangan = a.id_data_lapangan','left');
			$this->db->where('a.id_data_lapangan',$id);
			return $this->db->get()->result();
		}

		function DataLapangan($id){
			$this->db->select('	pd.id_penyedia AS pd_id_penyedia,
								pd.nama_pemilik,
								pd.nama_tempat,
								pd.jam_buka,
								pd.jam_tutup,
								pd.email,
								pd.alamat,
								pd.kelurahan,
								pd.kecamatan,
								pd.kotamadya,
								pd.kodepos,

								dp.id_data_lapangan AS dp_id_data_lapangan,
								dp.id_penyedia AS dp_id_penyedia,
								dp.id_lapangan,
								dp.nama_lapangan,
								dp.deskripsi,

								hr.id_harga AS hr_id_harga,
								hr.id_harga AS hr_id_data_lapangan,
								hr.skema_1,
								hr.skema_2,
								hr.skema_3,
								hr.skema_4,
								hr.skema_5,
								hr.skema_6,

								gl.id_gambar_lapangan,
								gl.id_data_lapangan AS gl_id_data_lapangan,
								gl.gambar
								');
			$this->db->from('penyedia pd');
			$this->db->join('data_lapangan dp','pd.id_penyedia = dp.id_penyedia','left');
			$this->db->join('harga hr','hr.id_data_lapangan = dp.id_data_lapangan','left');
			$this->db->join('gambar_lapangan gl','gl.id_data_lapangan = dp.id_data_lapangan','left');
			$this->db->where('dp.id_lapangan',$id);
			return $this->db->get()->result();
		}

		function TambahLapangan($data,$table){
			$this->db->insert('data_lapangan',$data);
			return $this->db->insert_id();
		}

		function TambahHarga($harga,$table){
			$this->db->insert('harga',$harga);
		}

		function GambarLapangan($data,$table){
			$this->db->insert('gambar_lapangan',$data);
		}

		function ListLapangan(){
			$this->db->from('lapangan');
			return $this->db->get()->result();
		}

		function JenisLapangan($id){
			$this->db->select('DISTINCT(dl.nama_lapangan),dl.id_data_lapangan');
			$this->db->from('penyedia pd');
			$this->db->join('data_lapangan dl','pd.id_penyedia = pd.id_penyedia','left');
			$this->db->join('lapangan lp','lp.id_lapangan = dl.id_lapangan','left');
			$this->db->where('dl.id_penyedia',$id);
			return $this->db->get()->result();
		}

		function Search($cari,$where){
	  		// $cari	= $this->input->GET('area', TRUE);
	  		// $cari	= $this->input->GET('area', TRUE);
	  		// $data	= $this->db->query("select * from penyedia where kecamatan like '%$cari%' ");
	  		// return	$data->result();
	  		$this->db->select('pd.id_penyedia AS pd_id_penyedia,
								pd.nama_pemilik,
								pd.nama_tempat,
								pd.jam_buka,
								pd.jam_tutup,
								pd.email,
								pd.alamat,
								pd.kelurahan,
								pd.kecamatan,
								pd.kotamadya,
								pd.kodepos,

								dl.id_data_lapangan AS dp_id_data_lapangan,
								dl.id_penyedia AS dp_id_penyedia,
								dl.id_lapangan,
								dl.nama_lapangan,
								dl.deskripsi,

								hr.id_harga AS hr_id_harga,
								hr.id_data_lapangan AS hr_id_data_lapangan,
								hr.skema_1,
								hr.skema_2,
								hr.skema_3,
								hr.skema_4,
								hr.skema_5,
								hr.skema_6,

								gl.id_gambar_lapangan,
								gl.id_data_lapangan AS gl_id_data_lapangan,
								gl.gambar');
	  		$this->db->from('data_lapangan dl');
	  		$this->db->join('penyedia pd','pd.id_penyedia = dl.id_penyedia','left');
	  		$this->db->join('gambar_lapangan gl','gl.id_data_lapangan = dl.id_data_lapangan','left');
	  		$this->db->join('harga hr','hr.id_data_lapangan = dl.id_data_lapangan','left');
	  		// $this->db->like('kecamatan',$cari);
	  		$this->db->where('pd.kecamatan',$cari);
	  		$this->db->where('dl.id_lapangan',$where);
	  		$query = $this->db->get();
	  		return $query->result();
  		}

  		function SearchKecamatan(){
			$this->db->select('*');
			$this->db->from('kecamatan');
			return $this->db->get()->result();
		}

		function SearchLapangan(){
			$this->db->select('*');
			$this->db->from('lapangan');
			return $this->db->get()->result();
		}

		function SearchDataLapangan(){
			$this->db->select('	pd.id_penyedia AS pd_id_penyedia,
								pd.nama_pemilik,
								pd.nama_tempat,
								pd.jam_buka,
								pd.jam_tutup,
								pd.email,
								pd.alamat,
								pd.kelurahan,
								pd.kecamatan,
								pd.kotamadya,
								pd.kodepos,

								dp.id_data_lapangan AS dp_id_data_lapangan,
								dp.id_penyedia AS dp_id_penyedia,
								dp.id_lapangan,
								dp.nama_lapangan,
								dp.deskripsi,

								hr.id_harga AS hr_id_harga,
								hr.id_harga AS hr_id_data_lapangan,
								hr.skema_1,
								hr.skema_2,
								hr.skema_3,
								hr.skema_4,
								hr.skema_5,
								hr.skema_6,

								gl.id_gambar_lapangan,
								gl.id_data_lapangan AS gl_id_data_lapangan,
								gl.gambar
								');
			$this->db->from('penyedia pd');
			$this->db->join('data_lapangan dp','pd.id_penyedia = dp.id_penyedia','left');
			$this->db->join('harga hr','hr.id_data_lapangan = dp.id_data_lapangan','left');
			$this->db->join('gambar_lapangan gl','gl.id_data_lapangan = dp.id_data_lapangan','left');
			// $this->db->where('dp.id_lapangan',$id);
			return $this->db->get()->result();
		}


	}

 ?>