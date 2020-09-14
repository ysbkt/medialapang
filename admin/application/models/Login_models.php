<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_models extends CI_Model{

function Check($table,$where){		

	return $this->db->get_where($table,$where);

}	

}