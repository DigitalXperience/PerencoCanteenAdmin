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
		$this->load->helper('url');
		$this->username = "-adm-delta@cm.perenco.com";
		$this->password = "+perenco2013";
		$this->host = "10.52.64.60";
		$this->from = "cm_canteenstaff@cm.perenco.com";
		$this->from_name = "CAMEROON-COMMUNICATION";
		$this->load->library ( 'phpmailer' );
		$this->load->library ( 'smtp' );
	}
	
	public function compte_cree($id_user, $PIN, $email = null)
	{
		// On selectionne la derniere reservation effectuée par l'utilisateur
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT ui.firstname, ui.`email`, ua.PIN FROM user_info AS ui 
									LEFT JOIN user_account AS ua ON ui.id_user = ua.id_user  
									WHERE ui.id_user = '".$id_user."' LIMIT 1;");
		$row = $query->row_array();
		$trans = get_html_translation_table(HTML_ENTITIES);
		$message = "<p><strong>Votre compte pour acc&eacute;der &agrave; la cantine a &eacute;t&eacute; cr&eacute;&eacute;. <br />Votre code d'acc&egrave;s est le suivant : <div class='blue'>".$row['PIN']."</div></strong></p>";
		
			
		$Titre = "[Staff Canteen] Votre compte a été créé";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->Host     = $this->host; 
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->IsSMTP();                 	
		$mail->SMTPAuth = true;     		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		$To = $row['email'];
		if($email)
			$To = $email;
		$ToName = strtr($row['firstname'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddBCC('testcanteen@cm.perenco.com', 'Patient Assontia');	
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							div.red, div.orange, div.green, div.blue
							{
								font-weight: bold;
							}
							div.red
							{
								color: #cc0000;
							}
							.bleu
							{
								color: #3A5795;
							}
							div.orange
							{
								color: #dd4411;
							}
							div.green
							{
								color: #006600;
							}
							div.blue
							{
								color: #003399;
							}
							table.project_info
							{
								width: 90%;
								border: 0;
								margin: auto;
								border-top: 1px solid #bbbbbb !important;
								border-bottom: 1px solid #bbbbbb !important;
								border-collapse: collapse;
							}
							table.project_info th
							{
								width: 220px;
								background-color: #e9eeee;
								color: #666;
								text-align: right;
								font-weight: bold;
								padding: 5px;
								vertical-align: top;
							}
							table.project_info td
							{
								text-align: left;
								background-color: #fcffff;
								font-weight: normal;
								padding: 5px;
								vertical-align: top;
							}
							</style>
							Bonjour $ToName, <br />
							<div class='blue'>Cr&eacute;ation de compte termin&eacute;e </div> 
							<br />
							
							$message							
							<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}

	public function pin_recree($id_user, $PIN, $email = null)
	{
		// On selectionne la derniere reservation effectuée par l'utilisateur
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query(" SELECT ui.firstname, ui.`email`, ua.PIN FROM user_info AS ui 
									LEFT JOIN user_account AS ua ON ui.id_user = ua.id_user  
									WHERE ui.id_user = '".$id_user."' LIMIT 1;");
		$row = $query->row_array();
		//var_dump($row); die;
		$trans = get_html_translation_table(HTML_ENTITIES);
		$message = "<p><strong>Votre code d'acc&egrave;s &agrave; la cantine a &eacute;t&eacute; reinitialis&eacute;. <br />Votre nouveau code d'acc&egrave;s est le suivant : <div class='blue'>".$row['PIN']."</div></strong></p>";
		
			
		$Titre = "[Staff Canteen] Votre code PIN a été reinitialisé";
		
		$mail = new PHPMailer();
		iconv_set_encoding("internal_encoding", "ISO-8859-1");
		iconv_set_encoding("output_encoding", "ISO-8859-1");
		$mail->Host     = $this->host; 
		$mail->Username = $this->username;  
		$mail->Password = $this->password; 
		$mail->IsSMTP();                 	
		$mail->SMTPAuth = true;     		
		$mail->WordWrap = 50;			
		$mail->Priority = 1; 
		$mail->IsHTML(true);  
		
		$To = $row['email'];
		if($email)
			$To = $email;
		$ToName = strtr($row['firstname'], $trans);
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		
		$mail->AddAddress($To , $ToName);
		$mail->AddBCC('testcanteen@cm.perenco.com', 'Patient Assontia');	
		
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		
		$mail->Body     =  "
							<style type='text/css'>
							*
							{
								font-family: Tahoma, Arial, Helvetica, sans-serif;
								font-size: 12px;
							}
							div.red, div.orange, div.green, div.blue
							{
								font-weight: bold;
							}
							div.red
							{
								color: #cc0000;
							}
							.bleu
							{
								color: #3A5795;
							}
							div.orange
							{
								color: #dd4411;
							}
							div.green
							{
								color: #006600;
							}
							div.blue
							{
								color: #003399;
							}
							table.project_info
							{
								width: 90%;
								border: 0;
								margin: auto;
								border-top: 1px solid #bbbbbb !important;
								border-bottom: 1px solid #bbbbbb !important;
								border-collapse: collapse;
							}
							table.project_info th
							{
								width: 220px;
								background-color: #e9eeee;
								color: #666;
								text-align: right;
								font-weight: bold;
								padding: 5px;
								vertical-align: top;
							}
							table.project_info td
							{
								text-align: left;
								background-color: #fcffff;
								font-weight: normal;
								padding: 5px;
								vertical-align: top;
							}
							</style>
							Bonjour $ToName, <br />
							<div class='blue'>R&eacute;initialisation de code PIN termin&eacute;e </div> 
							<br />
							
							$message							
							<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
	
	public function saison_ouverte($saison, $ayants_droits)
	{
		$Titre = "[Base Loisirs] Ouverture saison ".$saison['mois1']."/".$saison['mois2']." ".$saison['annee'];
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
		
		//$To = $donnees_pers['Professional E-mail'];
		//$ToName = 'Assontia';
		$mail->From     = $this->from;
		$mail->FromName = $this->from_name;
		// echo "<pre>";
		// var_dump($ayants_droits);
		// die;
		foreach($ayants_droits as $ad) {
			$mail->AddAddress($ad->email , $ad->nom);
			//$mail->AddAddress('passontia@cm.perenco.com', 'Patient Assontia');
		}
		
		$mail->AddCC('passontia@cm.perenco.com', 'Patient Assontia');
		//$mail->AddBCC('ggwanen@cm.perenco.com', 'Gael Gwanen');
		
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
							Bonjour ayant-droits, <br />
							Les r&eacute;servations pour le compte de la saison ".utf8_decode($saison['mois1'])."/".utf8_decode($saison['mois2'])." ".$saison['annee']." sont ouvertes.<br />
							Le calendrier de cette saison sera donc ouvert du <b>".utf8_decode($saison['jour1'])." ".utf8_decode($saison['moisreel1'])." au ".$saison['jour2']." ".utf8_decode($saison['moisreel2'])."</b> ".$saison['annee']." <br />
							Faite votre r&eacute;servation ou consulter le planning en cliquant sur les liens suivants : <br /><a href='".base_url()."base_loisirs.php/demande/'>Formulaire de r&eacute;servation</a> ou <a href='".base_url()."base_loisirs.php/attendance/'>Planning des cases</a>.<br /><br />
							<strong><u>NB</u></strong> : Ouverture des liens possible uniquement &agrave; partir de votre poste de travail dans le r&eacute;seau de l'entreprise.<br /><br />
							<hr size=100% class='bleu' />
							Cet e-mail a &eacute;t&eacute; envoy&eacute; automatiquement, merci de NE PAS REPONDRE.";
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
		
	}
	
	public function communique($ayants_droits)
	{
		$Titre = "COS - Section Kribi";
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
		
		$mail->From     = 'djongo@cm.perenco.com';
		$mail->FromName = 'Dora JONGO';
		$mail->Subject  =  '=?UTF-8?B?'.base64_encode("$Titre").'?=';
		
		foreach($ayants_droits as $ad) {
			$mail->AddAddress($ad->email , $ad->nom);
		}
		
		$mail->AddCC('cm.it.development@cm.perenco.com', 'Cameroon IT Development');
		
		$mail->Body     =  $this->load->view('communique', '' , TRUE); 
		
		if(!$mail->Send())
		{
			$param['err_mess'] = "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
}
?>