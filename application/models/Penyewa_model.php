<?php 
	
	/**
	* 
	*/
	class Penyewa_model extends CI_model
	{
		function LoginCheck($email,$password){
		$sql = "SELECT * FROM penyewa where email = ? and password = ?";
    	$data = $this->db->query($sql, array($email,$password));
        return ($data->result_array()) ;
	}

	function Register($data, $table){
  	return $this->db->insert('penyewa',$data);
  }

	function Check($email){
  	$sql	= "SELECT * FROM penyewa where email = ?";
  	$data	= $this->db->query($sql, array($email));
  	return ($data->result_array());
  }

	function Pertanyaan($data,$table){
		$this->db->insert('pesan',$data);
	}

}

 ?>