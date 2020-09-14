<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Login extends CI_controller{

function __Construct(){
	parent ::__Construct();
    $this->load->model('Login_models');

}

public function Index(){
	$content = array (	'title'		=> 'Admin | Permata Indonesia',
						'content'	=> 'pages/Login',
					);
	$this->load->view('pages/Login');
}

public function LoginCheck(){

$username = $this->input->post('username');
$password = $this->input->post('password');       
$where = array(
    'username' => $username,           
    );
$check1 = $this->Login_models->Check("user",$where)->num_rows();
if ($check1 > 0 ) {
    $data = $this->Login_models->Check("user",$where)->row();
    if (password_verify($password, $data->password)) {
                $data_session = array(
                                'nama' 		=>$data->nama,
                                'status'	=>$data->status,
                                'level'		=>$data->level,
                                'username'	=>$data->username 
                            );
                $this->session->set_userdata($data_session);
                // date_default_timezone_set('Asia/Jakarta');
                // $date = array('log_in'=>date('m/d/Y h:i:s a', time()));
                // $where= array('nrk'=>$username);
                // $this->Login_models->inputtime($where,$date);
                redirect('Home');
            } else {
                $this->session->set_flashdata('error_msg','<div class="alert alert-danger text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Password Salah !</div>');
                redirect('Login');
            }
}else{
    $this->session->set_flashdata('error_msg','<div class="alert alert-danger text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Akun tidak terdaftar !</div>');
    redirect('Login');
}

}

function Logout(){
    $this->session->sess_destroy();
    redirect('Login');
}

}

?>