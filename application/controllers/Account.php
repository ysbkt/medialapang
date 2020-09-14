<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Account extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->model('Jadwal_model');
		$this->load->model('Penyewa_model');
		$this->load->model('Penyedia_model');
		$this->load->model('Lapangan_model');
		require_once APPPATH.'third_party/src/Google_Client.php';
    	require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';

	}

	public function Penyewa(){
		$data = array(	'title'		=> 'Login as Penyewa',
						'content'	=> 'pages/Penyewa/Login',

					);
		$this->load->view('layout/Wrapper',$data);
	}

	public function PenyewaLogin(){
		$email		= $this->input->post('email_login_sewa');
		$password	= md5($this->input->post('pass_login_sewa'));
		{
			$res	= $this->Penyewa_model->LoginCheck($email,$password);
			if(!empty($res))
			{
				$data_session	= array( 'id'			=> $res[0]['id_penyewa'],
										 'as_penyewa'	=> 1,
										 'login'		=> 1,
										 'nama'			=> $res[0]['nama'],
										 'email'		=> $res[0]['email'],
										 'telepon'		=> $res[0]['telepon'],
										);
				$this->session->set_userdata($data_session);
				redirect(base_url().'Home');
			}else{
				$this->session->set_flashdata('status', '<div class="alert-danger text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>Email atau Password yang anda masukkan salah</div>');
			redirect(base_url('Account/Penyewa'));
			}
		}
	}

	public function PenyewaRegister(){
		$data = array(	'title'		=> 'Register as Penyewa',
						'content'	=> 'pages/Penyewa/Register',

					);
		$this->load->view('layout/Wrapper',$data);
	}

	function ProsesPenyewaRegister(){
			$nama		= $this->input->post('nama');
			$email		= $this->input->post('email');
			$telepon	= $this->input->post('telepon');
			$password	= $this->input->post('password');
			$hash		= md5($password);

			$this->input->post('nama','required');
			$this->input->post('email','required');
			$this->input->post('telepon','required');
			$this->input->post('password','required|min_length[6]');
			$this->input->post('confirm','required|matches[password]');
			if ($this->input->post() == FALSE)
			{
				$this->load->view('Account/Penyewa');
			}
		else
		{
			$nama		= $_POST['nama'];
			$email		= $_POST['email'];
			$telepon	= $_POST['telepon'];
			$password	= $_POST['password'];
			$hash		= hash('md5',$password);

			$data		= array('nama'		=> $nama,
								'email'		=> $email,
								'telepon'	=> $telepon,
								'password'	=> $hash,
								);
			$usercheck	= $this->Penyewa_model->Check($email);
			if (!empty($usercheck)) {
				$this->session->set_flashdata('status', '<div class="alert-danger text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>Email sudah digunakan. Silahkan gunakan yang lain.</div>');
				redirect(base_url('Account/PenyewaRegister'));
			}else{
				if ($this->Penyewa_model->Register($data,'penyewa')){
					$this->session->set_flashdata('status', '<div class="alert-success text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>Anda Berhasil Registrasi, silahkan login untuk dapat melakukan booking.</div>');
				redirect(base_url('Account/Penyewa'));
				}
			}
		}
	}

	public function Penyedia(){
		$data = array(	'title'		=> 'Login as Penyedia',
						'content'	=> 'pages/Penyedia/Login',

					);
		$this->load->view('layout/Wrapper',$data);
	}

	public function PenyediaLogin(){
		$email		= $this->input->post('email_login_penyedia');
		$password	= md5($this->input->post('pass_login_penyedia'));
		{
			$res	= $this->Penyedia_model->LoginCheck($email,$password);
			if(!empty($res))
			{
				$data_session	= array( 'id'			=> $res[0]['id_penyedia'],
										 'as_penyedia'	=> 1,
										 'login'		=> 1,
										 'nama'			=> $res[0]['nama_pemilik'],
										 'nama_tempat'	=> $res[0]['nama_tempat'],
										 'email'		=> $res[0]['email'],
										 'telepon'		=> $res[0]['telepon'],
										);
				$this->session->set_userdata($data_session);
				redirect(base_url().'Home');
			}else{
				$this->session->set_flashdata('status', '<div class="alert-danger text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>Email atau Password yang anda masukkan salah</div>');
			redirect(base_url('Account/Penyedia'));
			}
		}
	}

	public function PenyediaRegister(){
		$data = array(	'title'		=> 'Register as Penyedia',
						'content'	=> 'pages/Penyedia/Register',
						'jam'		=> $this->Penyedia_model->Jam(),
						'kecamatan'	=> $this->Lapangan_model->Kecamatan(),

					);
		$this->load->view('layout/Wrapper',$data);
	}

	function ProsesPenyediaRegister(){
			$nama_pemilik	= $this->input->post('nama_pemilik');
			$nama_tempat	= $this->input->post('nama_tempat');
			$email			= $this->input->post('email');
			$telepon		= $this->input->post('telepon');
			$jam_buka		= $this->input->post('jam_buka');
			$jam_tutup		= $this->input->post('jam_tutup');
			$alamat			= $this->input->post('alamat');
			$kelurahan		= $this->input->post('kelurahan');
			$kecamatan		= $this->input->post('kecamatan');
			$kotamadya		= $this->input->post('kotamadya');
			$kodepos		= $this->input->post('kodepos');
			$password		= $this->input->post('password');
			$hash			= md5($password);

			$this->input->post('nama_pemilik','required');
			$this->input->post('nama_tempat','required');
			$this->input->post('email','required');
			$this->input->post('telepon','required');
			$this->input->post('jam_buka','required');
			$this->input->post('jam_tutup','required');
			$this->input->post('alamat','required');
			$this->input->post('kelurahan','required');
			$this->input->post('kecamatan','required');
			$this->input->post('kotamadya','required');
			$this->input->post('kodepos','required');
			$this->input->post('password','required|min_length[6]');
			$this->input->post('confirm','required|matches[password]');
			if ($this->input->post() == FALSE)
			{
				$this->load->view('User');
			}
		else
		{
			$nama_pemilik	= $_POST['nama_pemilik'];
			$nama_tempat	= $_POST['nama_tempat'];
			$email			= $_POST['email'];
			$telepon		= $_POST['telepon'];
			$jam_buka		= $_POST['jam_buka'];
			$jam_tutup		= $_POST['jam_tutup'];
			$alamat			= $_POST['alamat'];
			$kelurahan		= $_POST['kelurahan'];
			$kecamatan		= $_POST['kecamatan'];
			$kotamadya		= $_POST['kotamadya'];
			$kodepos		= $_POST['kodepos'];
			$password		= $_POST['password'];
			$hash			= hash('md5',$password);

			$data		= array('nama_pemilik'	=> $nama_pemilik,
								'nama_tempat'	=> $nama_tempat,
								'email'			=> $email,
								'telepon'		=> $telepon,
								'jam_buka'		=> $jam_buka,
								'jam_tutup'		=> $jam_tutup,
								'alamat'		=> $alamat,
								'kelurahan'		=> $kelurahan,
								'kecamatan'		=> $kecamatan,
								'kotamadya'		=> $kotamadya,
								'kodepos'		=> $kodepos,
								'password'	=> $hash,
								);
			$usercheck	= $this->Penyedia_model->Check($email);
			if (!empty($usercheck)) {
				$this->session->set_flashdata('status', '<div class="alert-danger text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>Email sudah digunakan. Silahkan gunakan yang lain.</div>');
				redirect(base_url('Account/PenyediaRegister'));
			}else{
				if ($this->Penyedia_model->Register($data,'penyedia')){
					$this->session->set_flashdata('status', '<div class="alert-success text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close"></a>Anda berhasil melakukan registrasi, silahkan login terlebih dahulu untuk mendaftarkan lapangan</div>');
				redirect(base_url('Account/Penyedia'));
				}
			}
		}
	}

	public function LoginGooglePenyewa() {

        $clientId = '554135994910-uua30n1u7go6llveos6dr6odp3blgl50.apps.googleusercontent.com'; //Google client ID
        $clientSecret = 'KQ3C24s8sibIWa8-_APyEWn6'; //Google client secret
        $redirectURL = base_url() . 'Account/LoginGooglePenyewa';
        
        //Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        
        if(isset($_GET['code']))
        {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['token'])) 
        {
            $gClient->setAccessToken($_SESSION['token']);
        }
        
        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            // echo "<pre>";
            // print_r($userProfile);
                
                $data = array(
                    'email'     => $userProfile['email'],
                    'nama'		=> $userProfile['name'],
                );

                $res = $this->Penyewa_model->Check($userProfile['email']);

                if(!empty($res))
                {
                    
                        $data_session = array(
                            'id'         => $res[0]['id_penyewa'],
                            'email'      => $res[0]['email'],
                            'nama'       => $res[0]['nama'],
                            'as_penyewa' => $res[0]['as_penyewa'],
                            'login'	     => 1,
                        );              
                        $this->session->set_userdata($data_session);
                        redirect(base_url().'Profile');
                    
                }
                else
                {   
                    $data_session = array(
                            'email'     => $userProfile['email'],
                            'nama'      => $userProfile['name'],
                            'status'    => "login",
                            ); 
                            $this->session->set_userdata($data_session);
                            $this->Penyewa_model->Register($data,'penyewa');
                            redirect('Home');
                }
                // print_r($this->session->userdata); 

            die;
        } 
        else 
        {
            $url = $gClient->createAuthUrl();
            header("Location: $url");
            exit;
        }

    }

    public function LoginGooglePenyedia() {

        $clientId = '554135994910-uua30n1u7go6llveos6dr6odp3blgl50.apps.googleusercontent.com'; //Google client ID
        $clientSecret = 'KQ3C24s8sibIWa8-_APyEWn6'; //Google client secret
        $redirectURL = base_url() . 'Account/LoginGooglePenyedia';
        
        //Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        
        if(isset($_GET['code']))
        {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['token'])) 
        {
            $gClient->setAccessToken($_SESSION['token']);
        }
        
        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            // echo "<pre>";
            // print_r($userProfile);
                
                $data = array(
                    'email'     => $userProfile['email'],
                    'nama_pemilik'		=> $userProfile['name'],
                );

                $res = $this->Penyedia_model->Check($userProfile['email']);

                if(!empty($res))
                {
                    
                        $data_session = array(
                            'id'         => $res[0]['id_penyedia'],
                            'email'      => $res[0]['email'],
                            'nama'       => $res[0]['nama'],
                            'as_penyedia' => $res[0]['as_penyedia'],
                            'login'	     => 1,
                        );              
                        $this->session->set_userdata($data_session);
                        redirect(base_url().'Profile');
                    
                }
                else
                {   
                    $data_session = array(
                            'email'     => $userProfile['email'],
                            'nama'      => $userProfile['name'],
                            'status'    => "login",
                            ); 
                            $this->session->set_userdata($data_session);
                            $this->Penyedia_model->Register($data,'penyedia');
                            redirect('Home');
                }
                // print_r($this->session->userdata); 

            die;
        } 
        else 
        {
            $url = $gClient->createAuthUrl();
            header("Location: $url");
            exit;
        }

    }

	function Logout(){
		session_destroy();
		redirect(base_url());
	}

}
 ?>