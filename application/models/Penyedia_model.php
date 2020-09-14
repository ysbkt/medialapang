<?php 
	
	/**
	* 
	*/
	class Penyedia_model extends CI_model
	{
		function LoginCheck($email,$password){
		$sql = "SELECT * FROM penyedia where email = ? and password = ?";
    	$data = $this->db->query($sql, array($email,$password));
        return ($data->result_array()) ;
	}

	function Register($data, $table){
  	return $this->db->insert('penyedia',$data);
  }

	function Check($email){
  	$sql	= "SELECT * FROM penyedia where email = ?";
  	$data	= $this->db->query($sql, array($email));
  	return ($data->result_array());
  }

  function Jam(){
  	$this->db->from('jam');
  	return $this->db->get()->result();
  }

}

 ?>

 <!-- 153133472562121484436 -->
