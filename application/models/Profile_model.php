<?php 
	
	/**
	* 
	*/
	class Profile_model extends CI_model
	{
		
		function Penyewa($id){
			$this->db->from('penyewa');
			$this->db->where('id_penyewa',$id);
			return $this->db->get()->result();
		}

		function Penyedia($id){
			$this->db->from('penyedia');
			$this->db->where('id_penyedia',$id);
			return $this->db->get()->result();
		}

		function Lapangan($id){
			$this->db->select('*');
			$this->db->from('data_lapangan dl');
			$this->db->join('penyedia pd','pd.id_penyedia = dl.id_penyedia','right');
			$this->db->join('gambar_lapangan gl','gl.id_data_lapangan = dl.id_data_lapangan','left');
			$this->db->join('lapangan lp','lp.id_lapangan = dl.id_lapangan','left');
			$this->db->where('pd.id_penyedia',$id);
			return $this->db->get()->result();
		}

		function Jadwal($id){
			$this->db->select('*');
			$this->db->from('data_lapangan dl');
			$this->db->join('jadwal j','j.id_data_lapangan = dl.id_data_lapangan','right');
			$this->db->join('penyewa py','py.id_penyewa = j.id_penyewa','left');
			$this->db->join('penyedia pd','pd.id_penyedia = dl.id_penyedia','left');
			$this->db->where('pd.id_penyedia',$id);
			return $this->db->get()->result();
		}

		function JadwalPenyewa($id){
			$this->db->select('*');
			$this->db->from('data_lapangan dl');
			$this->db->join('jadwal j','j.id_data_lapangan = dl.id_data_lapangan','right');
			$this->db->join('penyewa py','py.id_penyewa = j.id_penyewa','left');
			$this->db->join('penyedia pd','pd.id_penyedia = dl.id_penyedia','left');
			$this->db->where('py.id_penyewa',$id);
			return $this->db->get()->result();
		}

	}

 ?>