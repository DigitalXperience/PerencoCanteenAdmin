<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Parameters extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->model('params','',TRUE);
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
            if ($this->input->post('meal_price')){
				if($this->params->update($this->input->post())) {
					 $data['alert'] = '<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4>	<i class="icon fa fa-check"></i> Bravo!</h4>
                                        Enregistrement effectué avec succès.
                                      </div>';
				}
			}
            $session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['params'] = $this->params->getParams();
			$data['title'] = "Modifier les paramètres de l'application";
			$this->load->view('params', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
}