<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends CI_Controller{
	
	public function index()
	{	if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$this->load->view('dashboard', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('dashboard', 'refresh');
	}
}