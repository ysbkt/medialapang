<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_models extends CI_Model{

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

		function Jadwal(){
			$this->db->select('*');
			$this->db->from('jadwal jd');
			$this->db->join('penyewa py','py.id_penyewa = jd.id_penyewa','left');
			$this->db->join('data_lapangan dl','dl.id_data_lapangan = jd.id_data_lapangan','left');
			$this->db->join('penyedia pd','pd.id_penyedia = dl.id_penyedia','left');
			$this->db->join('lapangan lp','lp.id_lapangan = dl.id_lapangan','left');
			return $this->db->get()->result();
		}


	function Get($table){		

		return $this->db->get($table)->result();

	}

	function Delete($colomn ,$table, $id){

		$this->db->where($colomn,$id);
		return $this->db->delete($table);
		
	}

	function Insert($table,$data){

		$this->db->insert($table,$data);
		
	}

	function Insert_Batch($table,$data){

	  return $this->db->insert_batch($table, $data);

	}

	function Update($table, $where, $data){

		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();

	}

	function GetById($table, $colomn, $id){

		$this->db->from($table);
		$this->db->where($colomn,$id);
		$query = $this->db->get();
		return $query->row();

	}

	function getData(){
		return $this->db->get('testing')->result();
	}

	function getTotalEmail(){
		$query = $this->db->get('testing');
		return $query->num_rows();
	}

	function getEmailAddress(){
		$sql = "SELECT email FROM testing";
		$query = $this->db->query($sql);
		$array1=$query->result_array();
		return $arr = array_map (function($value){
		    return $value['email'];
		} , $array1);

		}

}
