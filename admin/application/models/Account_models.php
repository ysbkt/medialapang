<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_models extends CI_Model{

var $table = 'user';

function Get(){		

	return $this->db->get($this->table)->result();

}

function Delete($id){

	$this->db->where('id_user',$id);
	return $this->db->delete($this->table);
	
}

function Insert($data){

	return $this->db->insert($this->table,$data);
	
}

function Update($where, $data){

	$this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();

}

function GetById($id){

	$this->db->from($this->table);
	$this->db->where('id_user',$id);
	$query = $this->db->get();
	return $query->row();

}

}