<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Report extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
	}
	
	public function index()
	{	if($this->session->userdata('logged_in'))
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
			redirect('login', 'refresh');
		}
		
	}
}