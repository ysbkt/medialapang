

	/**
	* 
	*/
	class Jadwal_model extends CI_model
	{
		
		function Jam()
		{
			$this->db->from('jam');
			return $this->db->get();
		}

		function getJadwal($id)
		{
			$this->db->select('*');
			$this->db->from('jadwal jd');
			$this->db->join('penyewa py','jd.id_penyewa = py.id_penyewa','left');
			$this->db->where('id_data_lapangan',$id);
			return $this->db->get();
		}

		function getGallery($where){
			$this->db->select('*');
			$this->db->from('data_lapangan dp');
			$this->db->join('gambar_lapangan gl','gl.id_data_lapangan = dp.id_data_lapangan','left');
			$this->db->where('dp.id_data_lapangan',$where);
			return $this->db->get();
		}

		function Booking($data){
			return $this->db->insert('jadwal',$data);
		}

		function Transfer($data){
			$this->db->insert('bukti_pembayaran',$data);
		}
}
 ?>
