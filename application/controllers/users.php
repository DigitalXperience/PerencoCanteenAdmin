<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
	}
	
	public function index()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Dashboard";
			$data['menu'] = $this->load->view('menu', NULL, TRUE);
			$data['menu'] = $this->load->view('menu', NULL, TRUE);
			$this->load->view('user', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function newuser()
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