<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Report extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->model('log_model','logs');
		$this->load->model('params','',TRUE);
	}
	
	public function index()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Dashboard";
			$this->load->view('report', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function filter()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Rapports et Filtres";
			// Traitement
			$data['liste'] = $this->logs->getDaysReport($this->input->get());
			$data['params'] = $this->params->getParams();
			$this->load->view('report_filter', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}	
	}
	
	public function logs()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Logs sur les postes";
			//var_dump($this->input->get());
            $data['liste'] = $this->logs->getLogs($this->input->get());
			// Traitement
			$this->load->view('report_logs', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function stats()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Statistiques";
			// Traitement
			$data['liste'] = $this->logs->getDaysReport($this->input->get());
			$data['params'] = $this->params->getParams();
			$this->load->view('report', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}	
	}
}