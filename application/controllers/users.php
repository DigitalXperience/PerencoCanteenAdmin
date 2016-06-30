<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends CI_Controller{
	
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
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Liste des utilisateurs";
            $data['liste'] = $this->user->getList();
			$this->load->view('user', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function newuser()
	{
		if($this->session->userdata('logged_in'))
		{
            $error=false;
            if ($this->input->post()){
                if(!empty($this->input->post('email'))){
                    if(!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
                        $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Erreur !</h4> Veuillez entrer une nouvelle adresse email. Celle renseignée n\'est pas correcte. </div>';
                        $error=true;
                    } else {
                        $s=$this->user->getUserByEmail($this->input->post('email'));
                        if(!empty($this->input->post('id_user'))) $s=0;
                        if($s){
                            $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Erreur !</h4> Veuillez entrer une nouvelle adresse email. Celle renseignée est déjà utilisée. </div>';
                            $error=true;
                        }
                    }
                }
                
                if(empty($this->input->post('status'))){
                    $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-       dismiss="alert" aria-hidden="true">×</button>
                     <h4><i class="icon fa fa-ban"></i> Erreur !</h4> Veuillez entrer les informations obligatoires </div>';
                    $error=true;
                }
                
                if(!$error){
                    if(empty($this->input->post('id_user'))) $s=$this->user->newUser($this->input->post()); 
                    else $s=$this->user->updateUser($this->input->post()); 
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
            $session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Ajouter un utilisateur";
			$this->load->view('user_new', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function updateuser($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Modification d'un utilisateur";
            $data['current'] = $this->user->getInfo($id);
			$this->load->view('user_new', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
    public function deleteuser()
	{
		if($this->session->userdata('logged_in'))
		{
         if(empty($this->input->post('id_user'))) echo 'Id inexistant';
         else {
             $save=array();
             $save['id_user']=$this->input->post('id_user');
             $save['deleted']=date('Y-m-d h:i:s');
             $s=$this->user->updateUser($save);
             $this->accounts->blockAccount($save['id_user']); // bloquer un compte aussitôt que l'utilisateur est supprimé
             if($s) echo 'true';
             else echo 'Problème lors de l\'enregistrement';
         }
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
}