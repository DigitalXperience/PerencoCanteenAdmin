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
			$data['menu'] = $this->load->view('menu', NULL, TRUE);
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
			$data['title'] = "Ajouter un compte";
			$data['menu'] = $this->load->view('menu', NULL, TRUE);
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
			$data['menu'] = $this->load->view('menu', NULL, TRUE);
			$data['menu'] = $this->load->view('menu', NULL, TRUE);
			$this->load->view('user_new', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
}