<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remote extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('user'); 
        $this->load->model('log_model', 'logs'); 
		//$this->load->library('input');
        $this->load->database(); 
		
    }
	
	public function hasEaten() // Check s'il a mangé
	{
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: GET, POST');
		if($this->user->isUserByPin($this->input->get('pin'))) {
			if($this->user->alreadyLogged($this->input->get('pin')))
				echo "YES";
			else {
				$this->user->log($this->input->get('pin'));
				echo "NO";
			}
		}
		else {
			echo 'NO ACCESS';
		}
	}
	
}