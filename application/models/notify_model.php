<?php

class Notify_model extends CI_Model {
	
	private $username;
	private $password;
	private $host;
	private $from;
	private $from_name;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('user_model', 'user');
		$this->load->model('log_model', 'log');
		$this->load->model('saison_model', 'saison');
		$this->username = "-adm-delta@cm.perenco.com";
		$this->password = "+perenco2013";
		$this->host = "10.52.64.60";
		$this->from = "cm_baseloisirs@cm.perenco.com";
		$this->from_name = "CAMEROON-COMMUNICATION";
		$this->load->library ( 'phpmailer' );
		$this->load->library ( 'smtp' );
	}
	
	public function alerte_new_pin($iduser, $pin)
	{		
		$Titre = "[Cantine] Votre nouveau mot de passe";
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->IsSMTP();                 	
		$mail->Host     = $this->host; 
		$mail->SMTPAuth = true;     		
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		//var_dump($text_case); die;
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		foreach($ayants_droits as $ad) {
			$mail->AddAddress($ad->email , $ad->nom);
		}
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		 
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							.bleu
							{
								color: #3A5795;
							}
							</style>	
							Cher (e) utilisateur, <br />
							$text_case <br />
							Votre nouveau mot de passe est : $pin.<br />
							<br /><strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
	
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}	
}
?>