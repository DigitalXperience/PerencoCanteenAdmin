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
			$data['title'] = "Liste des utilisateurs";
            $data['liste'] = $this->user->getList();
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
            if ($this->input->post('email')){
                if(!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
                    $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Erreur !</h4> Veuillez entrer une nouvelle adresse email. Celle renseignée n\'est pas correcte. </div>';
                } else {
                    $s=$this->user->getUserByEmail($this->input->post('email'));
                    if($s){
                        $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Erreur !</h4> Veuillez entrer une nouvelle adresse email. Celle renseignée est déjà utilisée. </div>';
                    }else { 
                        if(empty($this->input->post('firstname')) or empty($this->input->post('status'))){
                            $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-       dismiss="alert" aria-hidden="true">×</button>
                             <h4><i class="icon fa fa-ban"></i> Erreur !</h4> Veuillez entrer les informations obligatoires </div>';
                        }else {
                            $s=$this->user->newUser($this->input->post());
                            if($s){
                                $data['alert'] = '<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4>	<i class="icon fa fa-check"></i> Bravo!</h4>
                                        Enregistrement effectué avec succès.
                                      </div>';
                            } else {
                               $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-       dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Erreur !</h4> Problème survenu lors de l\'insertion des données. </div>'; 
                            }
                        }
                    }
                }
                
            }
            $session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Ajouter un utilisateur";
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