<?php 
	
	/**
	* 
	*/
	class User_model extends Ci_model
	{
		function CountPenyedia(){
			$this->db->from('penyedia');
			$this->db->order_by('id_penyedia','desc');
			return $this->db->get()->num_rows();
		}

		function CountPenyewa(){
			$this->db->from('penyewa');
			$this->db->order_by('id_penyewa','desc');
			return $this->db->get()->num_rows();
		}

		function CountLapangan(){
			$this->db->from('data_lapangan');
			$this->db->order_by('id_data_lapangan','desc');
			return $this->db->get()->num_rows();
		}

		function CountJadwal(){
			$this->db->from('jadwal');
			$this->db->order_by('id_jadwal','desc');
			return $this->db->get()->num_rows();
		}
		
		function Penyedia(){
			$this->db->select('*');
			$this->db->from('penyedia');
			return $this->db->get()->result();
		}

		function Penyewa(){
			$this->db->select('*');
			$this->db->from('penyewa');
			return $this->db->get()->result();
		}

		function Pembayaran(){
			$this->db->select('*');
			$this->db->from('jadwal jd');
			$this->db->join('penyewa py','py.id_penyewa = jd.id_penyewa','left');
			return $this->db->get()->result();
		}
	}

 ?>