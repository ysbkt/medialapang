<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Home extends CI_controller{
	function __Construct(){
		parent ::__Construct();
		$this->load->library('csvimport');
		$this->load->model('Home_models');

	}

	public function Index(){
		$content = array (	'title'     => 'Admin | Permata Indonesia',
          							'content'   => 'pages/Home',
                        'penyedia'  => $this->Home_models->CountPenyedia(),
                        'penyewa'   => $this->Home_models->CountPenyewa(),
                        'lapangan'  => $this->Home_models->CountLapangan(),
                        'jadwal'    => $this->Home_models->CountJadwal(),
          						);
		$this->load->view('layout/Wrapper',$content);
	}

  public function ListPenyedia(){
    $content = array (  'title'     => 'Admin | Media Lapang',
                        'content'   => 'pages/Penyedia',
                        'penyedia'  => $this->Home_models->Penyedia(),
                      );
    $this->load->view('layout/Wrapper',$content);
  }

  public function ListPenyewa(){
    $content = array (  'title'   => 'Admin | Media Lapang',
                        'content' => 'pages/Penyewa',
                        'penyewa' => $this->Home_models->Penyewa(),
                      );
    $this->load->view('layout/Wrapper',$content);
  }

  public function Pembayaran(){
    $content = array (  'title'     => 'Admin | Media Lapang',
                        'content'   => 'pages/Pembayaran',
                        'pembayaran'=> $this->Home_models->Pembayaran(),
                      );
    $this->load->view('layout/Wrapper',$content);
  }

  public function Jadwal(){
    $content = array (  'title'   => 'Admin | Media Lapang',
                        'content' => 'pages/Jadwal',
                        'jadwal'  => $this->Home_models->Jadwal(),
                      );
    $this->load->view('layout/Wrapper',$content);
  }

  public function Gallery(){
    $content  = array ( 'title'   => 'Admin | Permata Indonesia',
                        'content' => 'pages/Gallery',

                      );
    $this->load->view('layout/Wrapper',$content);
  }

  public function InputGallery(){
    $title  = $this->input->post('title');
    $gambar = $this->input->post('image');

    if (!$_FILES['image']['name'] == 0) {
        $filePath = './assets/img/';
        $new_photo = $gambar;
        $config ['file_name'] = $new_photo;
        $config ['overwrite'] = TRUE; 
        $config['upload_path'] = $filePath;
        $config ['allowed_types'] = 'jpg|png|jpeg|gif|JPG|PNG|JPEG|GIF';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        $this->upload->do_upload('image');
        $data_upload_files = $this->upload->data();
        $image = $data_upload_files['file_name'];
        $error_photo= $this->upload->display_errors();
        echo $error_photo;
        $gambar = $image;
        }

        $data = array('title'   => $title,
                      'image'   => $gambar,

              );
        $this->Home_models->Insert('gallery',$data);
        $this->session->set_flashdata('status','<div class="alert alert-success alert-dismissable text-center"><a href="#" data-dismiss="alert" aria-label="close"></a>Anda berhasil upload gambar lapangan</div>');
      redirect('Home/Gallery','refresh');
  }

  public function ViewPDF(){
    $this->load->view('pages/payslip');
  }

	public function Upload(){
		$content = array (	'title'		=> 'Admin | Permata Indonesia',
							'content'	=> 'pages/Upload',
							'data_csv'	=> $this->Home_models->Get('testing')
						);
		$this->load->view('layout/Wrapper',$content);
	}


	public function importcsv(){
    if(isset($_POST["import_csv"]))
    {
        $filename=$_FILES["csv_file"]["tmp_name"];
        if($_FILES["csv_file"]["size"] > 0)
        {
             $file = fopen($filename, "r");
             $baris = 0;
             while (($importdata = fgetcsv($file, 10000, ";")) !== FALSE)
             {
                $data = array(
                   'employee_id' 	=> $importdata[2],
                   'employee_name'  => $importdata[1],
                   'join_date'		=> $importdata[3],
                   'nik'			=> $importdata[4],
                   'npwp'			=> $importdata[5],
                   'division'		=> $importdata[6],
                   'email'			=> $importdata[7]
                );
                if($baris > 0){  //jika dimulai dari baris kedua
                   $insert = $this->Home_models->insert('testing',$data);
                }
                $baris++;
             }                    
             fclose($file);
             $this->session->set_flashdata('message', 'Import berhasil !');
             redirect('Home/Upload');
        }else{
             $this->session->set_flashdata('message', 'Import gagal !');
             redirect('Home/Upload');
        }
     }
  }

  function mypdf(){
    $this->load->library('pdfgenerator');
    $html = $this->load->view('pages/payslip', '', true);
      
      $this->pdfgenerator->generate($html,'contoh');
   }

  public function sendEmail(){
  		session_start(); 
  		$arr_content = array(); 
  		$success = 0;
  		$failed = 0;
  		$no = 1;
  		$total = $this->Home_models->getTotalEmail();

  		$data = $this->Home_models->getData();
  		// print_r($data);

  		$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "09febrian@gmail.com";
        $config['smtp_pass'] = "09febrian";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->email->initialize($config);

  		foreach ($data as $item) {
	        $this->email->clear();
	        $this->email->from('09febrian@gmail.com', 'EMAIL TEST');
	        $this->email->to($item->email);   
	        $this->email->subject('EMAIL TEST');
	        $Message =  '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
    <!--[if gte mso 9]><xml>
     <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
     </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <title></title>
    
    
    <style type="text/css" id="media-query">
      body {
  margin: 0;
  padding: 0; }

table, tr, td {
  vertical-align: top;
  border-collapse: collapse; }

.ie-browser table, .mso-container table {
  table-layout: fixed; }

* {
  line-height: inherit; }

a[x-apple-data-detectors=true] {
  color: inherit !important;
  text-decoration: none !important; }

[owa] .img-container div, [owa] .img-container button {
  display: block !important; }

[owa] .fullwidth button {
  width: 100% !important; }

[owa] .block-grid .col {
  display: table-cell;
  float: none !important;
  vertical-align: top; }

.ie-browser .num12, .ie-browser .block-grid, [owa] .num12, [owa] .block-grid {
  width: 720px !important; }

.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
  line-height: 100%; }

.ie-browser .mixed-two-up .num4, [owa] .mixed-two-up .num4 {
  width: 240px !important; }

.ie-browser .mixed-two-up .num8, [owa] .mixed-two-up .num8 {
  width: 480px !important; }

.ie-browser .block-grid.two-up .col, [owa] .block-grid.two-up .col {
  width: 360px !important; }

.ie-browser .block-grid.three-up .col, [owa] .block-grid.three-up .col {
  width: 240px !important; }

.ie-browser .block-grid.four-up .col, [owa] .block-grid.four-up .col {
  width: 180px !important; }

.ie-browser .block-grid.five-up .col, [owa] .block-grid.five-up .col {
  width: 144px !important; }

.ie-browser .block-grid.six-up .col, [owa] .block-grid.six-up .col {
  width: 120px !important; }

.ie-browser .block-grid.seven-up .col, [owa] .block-grid.seven-up .col {
  width: 102px !important; }

.ie-browser .block-grid.eight-up .col, [owa] .block-grid.eight-up .col {
  width: 90px !important; }

.ie-browser .block-grid.nine-up .col, [owa] .block-grid.nine-up .col {
  width: 80px !important; }

.ie-browser .block-grid.ten-up .col, [owa] .block-grid.ten-up .col {
  width: 72px !important; }

.ie-browser .block-grid.eleven-up .col, [owa] .block-grid.eleven-up .col {
  width: 65px !important; }

.ie-browser .block-grid.twelve-up .col, [owa] .block-grid.twelve-up .col {
  width: 60px !important; }

@media only screen and (min-width: 740px) {
  .block-grid {
    width: 720px !important; }
  .block-grid .col {
    vertical-align: top; }
    .block-grid .col.num12 {
      width: 720px !important; }
  .block-grid.mixed-two-up .col.num4 {
    width: 240px !important; }
  .block-grid.mixed-two-up .col.num8 {
    width: 480px !important; }
  .block-grid.two-up .col {
    width: 360px !important; }
  .block-grid.three-up .col {
    width: 240px !important; }
  .block-grid.four-up .col {
    width: 180px !important; }
  .block-grid.five-up .col {
    width: 144px !important; }
  .block-grid.six-up .col {
    width: 120px !important; }
  .block-grid.seven-up .col {
    width: 102px !important; }
  .block-grid.eight-up .col {
    width: 90px !important; }
  .block-grid.nine-up .col {
    width: 80px !important; }
  .block-grid.ten-up .col {
    width: 72px !important; }
  .block-grid.eleven-up .col {
    width: 65px !important; }
  .block-grid.twelve-up .col {
    width: 60px !important; } }

@media (max-width: 740px) {
  .block-grid, .col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important; }
  .block-grid {
    width: calc(100% - 40px) !important; }
  .col {
    width: 100% !important; }
    .col > div {
      margin: 0 auto; }
  img.fullwidth, img.fullwidthOnMobile {
    max-width: 100% !important; }
  .no-stack .col {
    min-width: 0 !important;
    display: table-cell !important; }
  .no-stack.two-up .col {
    width: 50% !important; }
  .no-stack.mixed-two-up .col.num4 {
    width: 33% !important; }
  .no-stack.mixed-two-up .col.num8 {
    width: 66% !important; }
  .no-stack.three-up .col.num4 {
    width: 33% !important; }
  .no-stack.four-up .col.num3 {
    width: 25% !important; }
  .mobile_hide {
    min-height: 0px;
    max-height: 0px;
    max-width: 0px;
    display: none;
    overflow: hidden;
    font-size: 0px; } }

    </style>
</head>
<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #FFFFFF">
  <style type="text/css" id="media-query-bodytag">
    @media (max-width: 520px) {
      .block-grid {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }

      .col {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }

        .col > div {
          margin: 0 auto;
        }

      img.fullwidth {
        max-width: 100%!important;
      }
			img.fullwidthOnMobile {
        max-width: 100%!important;
      }
      .no-stack .col {
				min-width: 0!important;
				display: table-cell!important;
			}
			.no-stack.two-up .col {
				width: 50%!important;
			}
			.no-stack.mixed-two-up .col.num4 {
				width: 33%!important;
			}
			.no-stack.mixed-two-up .col.num8 {
				width: 66%!important;
			}
			.no-stack.three-up .col.num4 {
				width: 33%!important;
			}
			.no-stack.four-up .col.num3 {
				width: 25%!important;
			}
      .mobile_hide {
        min-height: 0px!important;
        max-height: 0px!important;
        max-width: 0px!important;
        display: none!important;
        overflow: hidden!important;
        font-size: 0px!important;
      }
    }
  </style>
  <!--[if IE]><div class="ie-browser"><![endif]-->
  <!--[if mso]><div class="mso-container"><![endif]-->
  <table class="nl-container" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #FFFFFF;width: 100%" cellpadding="0" cellspacing="0">
	<tbody>
	<tr style="vertical-align: top">
		<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #FFFFFF;"><![endif]-->

    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="720" style=" width:720px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num12" style="min-width: 320px;max-width: 720px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:120%; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
		<div style="font-size:12px;line-height:14px;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;color:#555555;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 17px;text-align: center"><span style="font-size: 18px; line-height: 21px;"><strong>Employee Tax Calculation Report</strong></span><br></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid mixed-two-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="480" style=" width:480px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num8" style="display: table-cell;vertical-align: top;min-width: 320px;max-width: 480px;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:120%; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
		<div style="font-size:12px;line-height:14px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 14px"><br data-mce-bogus="1"></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="240" style=" width:240px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num4" style="display: table-cell;vertical-align: top;max-width: 320px;min-width: 240px;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 45px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:120%; padding-right: 45px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
		<div style="font-size:12px;line-height:14px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 17px;text-align: right">Gross</p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid three-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="240" style=" width:240px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num4" style="max-width: 320px;min-width: 240px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Name of Employee :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Department :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Position :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">NIK :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">NPWP :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Tax Status :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Date of Hire :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Month of :</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="240" style=" width:240px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num4" style="max-width: 320px;min-width: 240px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 50px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 50px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 21px">'.$item->employee_name.'</p><p style="margin: 0;font-size: 14px;line-height: 21px">'.$item->division.'</p><p style="margin: 0;font-size: 14px;line-height: 21px">'.$item->division.'</p><p style="margin: 0;font-size: 14px;line-height: 21px">'.$item->nik.'</p><p style="margin: 0;font-size: 14px;line-height: 21px">'.$item->npwp.'</p><p style="margin: 0;font-size: 14px;line-height: 21px">S/0</p><p style="margin: 0;font-size: 14px;line-height: 21px">'.$item->join_date.'</p><p style="margin: 0;font-size: 14px;line-height: 21px">'.date("d F Y").'</p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="240" style=" width:240px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num4" style="max-width: 320px;min-width: 240px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 45px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:120%; padding-right: 45px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:14px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 17px;text-align: right"><strong>OMS003</strong></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="720" style=" width:720px; padding-right: 25px; padding-left: 25px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num12" style="min-width: 320px;max-width: 720px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 25px; padding-left: 25px;"><!--<![endif]-->

                  
                    
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="divider " style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
        <tr style="vertical-align: top">
            <td class="divider_inner" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-right: 10px;padding-left: 5px;padding-top: 10px;padding-bottom: 10px;min-width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <table class="divider_content" height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <tbody>
                        <tr style="vertical-align: top">
                            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                <span>&#160;</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid mixed-two-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="480" style=" width:480px; padding-right: 10px; padding-left: 10px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num8" style="display: table-cell;vertical-align: top;min-width: 320px;max-width: 480px;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 10px; padding-left: 10px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 20px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 0px; padding-left: 20px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Basic Salary :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Adj. Basic Salary :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">BPJS TK JKK Allowance :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">BPJS TK JKM Allowance :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">BPJS KS Allowance - by Company (for June and July) :</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="240" style=" width:240px; padding-right: 10px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num4" style="display: table-cell;vertical-align: top;max-width: 320px;min-width: 240px;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 10px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 40px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 40px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">test</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="720" style=" width:720px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num12" style="min-width: 320px;max-width: 720px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="divider " style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
        <tr style="vertical-align: top">
            <td class="divider_inner" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-right: 30px;padding-left: 30px;padding-top: 10px;padding-bottom: 10px;min-width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <table class="divider_content" height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <tbody>
                        <tr style="vertical-align: top">
                            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                <span>&#160;</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid four-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Monthly Income</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Up to current period</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Income per Year</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 10px; line-height: 15px;">Bonus/non reguler income</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Total</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Functional Cost</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Jamsostek</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Pension</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 10px; line-height: 15px;">Non Taxable Income (S/0)</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Taxable Income</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Pembulatan</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 10px; line-height: 15px;">Tax Calculation per Year</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">&#160;</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px">&#160;<br></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">test</span></p><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center">test</p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    &#160;
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid four-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">5% x</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">15% x</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">25% x</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">30% x</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">TEST&#160; =</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">TEST&#160; =</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">TEST&#160; =</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">TEST&#160; =</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">TEST</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">TEST</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">TEST</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">TEST</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    &#160;
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="720" style=" width:720px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num12" style="min-width: 320px;max-width: 720px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="divider " style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
        <tr style="vertical-align: top">
            <td class="divider_inner" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-right: 30px;padding-left: 30px;padding-top: 5px;padding-bottom: 5px;min-width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <table class="divider_content" height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <tbody>
                        <tr style="vertical-align: top">
                            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                <span>&#160;</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid four-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    &#160;
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">TEST</span><span style="font-size: 14px; line-height: 21px;"></span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: right">TEST</p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    &#160;
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid four-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    &#160;
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:120%; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
		<div style="font-size:12px;line-height:14px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 14px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 14px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 14px"><span style="font-size: 14px; line-height: 16px;">Tax due up to current period</span></p><p style="margin: 0;font-size: 12px;line-height: 14px"><span style="font-size: 14px; line-height: 16px;">Tax payment</span></p><p style="margin: 0;font-size: 12px;line-height: 14px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 14px"><span style="font-size: 14px; line-height: 16px;">Tax due on current period</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:120%; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
		<div style="font-size:12px;line-height:14px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 17px"><strong>Non Reguler</strong><br></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="180" style=" width:180px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num3" style="max-width: 320px;min-width: 180px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:120%; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
		<div style="font-size:12px;line-height:14px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 14px"><strong><span style="font-size: 14px; line-height: 16px;">Reguler</span></strong></p><p style="margin: 0;font-size: 12px;line-height: 14px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 14px"><span style="font-size: 14px; line-height: 16px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 14px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 14px"><span style="font-size: 14px; line-height: 16px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 14px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 14px"><span style="font-size: 14px; line-height: 16px;">Test</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="720" style=" width:720px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num12" style="min-width: 320px;max-width: 720px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="divider " style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
        <tr style="vertical-align: top">
            <td class="divider_inner" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-right: 30px;padding-left: 30px;padding-top: 5px;padding-bottom: 5px;min-width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <table class="divider_content" height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <tbody>
                        <tr style="vertical-align: top">
                            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                <span>&#160;</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid two-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="360" style=" width:360px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num6" style="min-width: 320px;max-width: 360px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 21px">Gross Salary<br></p><p style="margin: 0;font-size: 14px;line-height: 21px">TAX</p><p style="margin: 0;font-size: 14px;line-height: 21px">Net Salary</p><p style="margin: 0;font-size: 14px;line-height: 21px">&#160;<br></p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS TK JKM</p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS TK JKK</p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS TK JHT 3.7% - by Company</p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS TK JHT 2% - by Employee</p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS TK JHT 3.7% - by Company</p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS TK JP 2% - by Company</p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS TK JP 1% - by Company</p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS TK JP 2% - by Company</p><p style="margin: 0;font-size: 14px;line-height: 21px">BPJS KS</p><p style="margin: 0;font-size: 14px;line-height: 21px">&#160;<br></p><p style="margin: 0;font-size: 14px;line-height: 21px">Total Deduction</p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="360" style=" width:360px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num6" style="min-width: 320px;max-width: 360px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 45px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 45px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: right"><span style="font-size: 14px; line-height: 21px;">Test</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="720" style=" width:720px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num12" style="min-width: 320px;max-width: 720px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="divider " style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
        <tr style="vertical-align: top">
            <td class="divider_inner" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-right: 30px;padding-left: 30px;padding-top: 5px;padding-bottom: 5px;min-width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <table class="divider_content" height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                    <tbody>
                        <tr style="vertical-align: top">
                            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                <span>&#160;</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 720px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #F3F3F3;" class="block-grid three-up ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#F3F3F3;">
          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 720px;"><tr class="layout-full-width" style="background-color:#F3F3F3;"><![endif]-->

              <!--[if (mso)|(IE)]><td align="center" width="240" style=" width:240px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num4" style="max-width: 320px;min-width: 240px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 25px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 30px; padding-top: 0px; padding-bottom: 25px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Transfered to Bank</span></p><p style="margin: 0;font-size: 12px;line-height: 18px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Bank Name :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Account No. :</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Account Name :</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="240" style=" width:240px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num4" style="max-width: 320px;min-width: 240px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:150%; padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:18px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 18px">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Text</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Text</span></p><p style="margin: 0;font-size: 12px;line-height: 18px"><span style="font-size: 14px; line-height: 21px;">Text</span></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
              <!--[if (mso)|(IE)]></td><td align="center" width="240" style=" width:240px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
            <div class="col num4" style="max-width: 320px;min-width: 240px;display: table-cell;vertical-align: top;">
              <div style="background-color: transparent; width: 100% !important;">
              <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->

                  
                    <div class="">
	<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 35px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;"><![endif]-->
	<div style="color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;line-height:120%; padding-right: 35px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px;">	
		<div style="font-size:12px;line-height:14px;color:#555555;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 17px;text-align: right"><strong>TOTAL</strong></p></div>	
	</div>
	<!--[if mso]></td></tr></table><![endif]-->
</div>
                  
              <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
              </div>
            </div>
          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>   <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
		</td>
  </tr>
  </tbody>
  </table>
  <!--[if (mso)|(IE)]></div><![endif]-->


</body></html>';
	        $this->email->message($Message);
	        $this->email->send();
	        $percent = intval($i/$total * 100);

  
			// Put the progress percentage and message to array.
			  $arr_content['percent'] = $percent;
			  $arr_content['message'] = $i . " row(s) processed.";

			  
			// Write the progress into file and serialize the PHP array into JSON format.
			  // The file name is the session id.
			  file_put_contents("tmp/" . session_id() . ".txt", json_encode($arr_content));

			  
			// Sleep one second so we can see the delay
			  sleep(1);


  		}
	        // redirect(base_url('Home/Upload'))
  		echo 'Email Terkirim : '.$success.'<br>';
  		echo 'Email Gagal : '.$failed.'<br>';

  	

  }

  function Checker($id){
		// The file has JSON type.
		header('Content-Type: application/json');

		// Prepare the file name from the query string.
		// Don't use session_start here. Otherwise this file will be only executed after the process.php execution is done.
		$file = str_replace(".", "", $id);
		$file = "tmp/" . $file . ".txt";

		// Make sure the file is exist.
		if (file_exists($file)) {
		  // Get the content and echo it.
		  $text = file_get_contents($file);
		  echo $text;

		  
		// Convert to JSON to read the status.
		  $obj = json_decode($text);
		  // If the process is finished, delete the file.
		  if ($obj->percent == 100) {
		    unlink($file);
		  }
		}
		else {
		  echo json_encode(array("percent" => null, "message" => null));
		}

		  }

}
 ?>
