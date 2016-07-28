<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Account extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->model('accounts','', TRUE);
	}
	
	public function index()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['comptes'] = $this->accounts->getAccounts();
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Liste des comptes";
			$data['menu'] = $this->load->view('inc/menu', NULL, TRUE);
			$this->load->view('account_list', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function newaccount()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			if((!empty($this->input->post('id_user')))) {
				$result = $this->accounts->newAccount($this->input->post()); 
			
				if($result){
					$this->load->model('notify_model', 'notify');
					$this->notify->compte_cree($this->input->post('id_user'), $this->input->post('PIN'));
					$data['alert'] = '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>	<i class="icon fa fa-check"></i> Bravo!</h4>
							Nouveau compte a été crée.
						  </div>';
				} else {
				   $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-       dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Erreur !</h4> Problème survenu lors de l\'insertion des données. </div>'; 
				}
			}
			
			$data['users'] = $this->accounts->getUserWithoutAccount();
			$data['pin'] = $this->accounts->generateNewPin();
			$data['title'] = "Ajouter un compte";
			$data['menu'] = $this->load->view('inc/menu', NULL, TRUE);
			$this->load->view('account_new', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function credit($iduser)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['pers'] = $this->user->getInfo($iduser);
			if((!empty($this->input->post('id_user')))) {
				$result = $this->accounts->creditAccount($this->input->post()); 
			
				if($result){
					$data['alert'] = '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>	<i class="icon fa fa-check"></i> Bravo!</h4>
							Le compte a été crédité.
						  </div>';
				} else {
				   $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Erreur !</h4> Problème survenu lors de la mise à jour. </div>'; 
				}
			}
			
			$data['user'] = $this->accounts->getAccount($iduser);
			$data['title'] = "Créditer un compte";
			$data['menu'] = $this->load->view('inc/menu', NULL, TRUE);
			$this->load->view('account_credit', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function block($iduser)
	{
		if($this->session->userdata('logged_in'))
		{
			$user_id = $this->uri->segment(3, 0);
			
			if($this->accounts->blockAccount($iduser)) {
				redirect('/account/');
			}
			else {
				
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function unblock()
	{
		if($this->session->userdata('logged_in'))
		{
			$user_id = $this->uri->segment(3, 0);
			
			if($this->accounts->unblockAccount($user_id)) {
				redirect('/account/');
			}
			else {
				
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function getPinFirstUse()
	{
		
		if(($this->uri->segment(3, 0))) { //die('ret');
			$sess_array = array(
				'userid' => $this->uri->segment(3, 0)
			);
			$this->session->set_userdata('logged_in', $sess_array);
			redirect('/account/getPinFirstUse');
		}
		
		if($this->session->userdata('logged_in')['userid']) {
			$data['newpin'] = $this->accounts->getUserPin($this->session->userdata('logged_in')['userid'])->PIN;
			if($this->input->post('iduser')) {
				$data['newpin'] = $this->accounts->generateNewPin();
				$this->accounts->resetPin(array('PIN' => $data['newpin'], 'id_user' => $this->input->post('iduser')));
				//$this->load->model('notify_model','notify');
				//$this->notify();
			}
			$this->load->view('balance_pin', $data);
		}

	}
	
	public function resetPin($iduser)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			if((!empty($this->input->post('id_user')))) {
				$result = $this->accounts->resetPin($this->input->post()); 
			
				if($result){
					$this->load->model('notify_model', 'notify');
					$this->notify->pin_recree($this->input->post('id_user'), $this->input->post('PIN'));
					$data['alert'] = '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>	<i class="icon fa fa-check"></i> Bravo!</h4>
							Le PIN a été reinitialisé.
						  </div>';
				} else {
				   $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Erreur !</h4> Problème survenu lors de la mise à jour. </div>'; 
				}
			}
			
			$data['user'] = $this->accounts->getAccount($iduser);
			$data['newpin'] = $this->accounts->generateNewPin();
			$data['title'] = "Changer un PIN";
			$data['menu'] = $this->load->view('inc/menu', NULL, TRUE);
			$this->load->view('account_reset_pin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}

	public function updateExternal()
	{
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: GET, POST');
		
		if($this->accounts->updateBalanceFromClient($this->input->post())) {
			echo json_encode($this->accounts->getBalance($this->input->post('id_user')));
		}
		else
			echo "NO";
	}
	
	public function newAccountsExternal()
	{
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: GET, POST');
		
		if($this->accounts->newAccountsExternal()) {
			echo json_encode($this->accounts->newAccountsExternal());
			$this->accounts->flagLastUpdates();
		}
		else
			echo "NO";
	}
	
	public function AccountsExternal()
	{
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: GET, POST');
		
		if($this->accounts->AccountsExternal()) {
			echo json_encode($this->accounts->AccountsExternal());
			//$this->accounts->flagLastUpdates();
		}
		else
			echo "NO";
	}
	
	public function get_email($iduser)
	{ 
		echo $this->accounts->getEmail($iduser);
	}

}