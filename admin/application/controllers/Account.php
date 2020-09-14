<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Account extends CI_controller{

function __Construct(){
	parent ::__Construct();
    $this->load->model('Account_models');
    if(empty($this->session->userdata('level'))){
        echo '<script language="javascript" type="text/javascript"> 
            alert("You must log in first");
            window.location.href="Login"
            </script>';
        // redirect(base_url("login"));
    }

}

public function Index(){
	$content = array (	'title'		=> 'Manage Account',
						'content'	=> 'pages/ManageAccount',
                        'account'   => $this->Account_models->Get()
					);
	$this->load->view('layout/Wrapper',$content);
}

public function Insert(){
    $data = array(
        'nama_user'         => $this->input->post('nama_user'),
        'username'          => $this->input->post('username'),
        'password'          => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
        'status_user'       => $this->input->post('status_user'),
        'level_user'        => $this->input->post('level_user')
    );

    $account = $this->Account_models->Insert($data);
    echo json_encode(array("status" => TRUE));
}

public function Update(){
$data = array(
        'nama_user'     => $this->input->post('nama_user'),
        'username'      => $this->input->post('username'),
        'password'      => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
        'status_user'   => $this->input->post('status_user'),
        'level_user'    => $this->input->post('level_user')

    );
    $this->Account_models->Update(array('id_user' => $this->input->post('id_user')), $data);
    echo json_encode(array("status" => TRUE));
}

public function Edit($id){
    $data = $this->Account_models->GetById($id);
    echo json_encode($data);
}

public function Acc($id){
    $data = $this->Account_models->GetById('penyedia','id_penyedia',$id);
    echo json_encode($data);
}

public function Delete($id){
    $this->Account_models->Delete($id);
    echo json_encode(array("status" => TRUE));
}


}

?>
