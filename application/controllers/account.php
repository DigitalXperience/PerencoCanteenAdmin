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
			redirect('login', 'refresh');
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
			redirect('login', 'refresh');
		}
	}
	
	public function updateuser()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Dashboard";
			$data['menu'] = $this->load->view('inc/menu', NULL, TRUE);
			$this->load->view('user_new', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
}