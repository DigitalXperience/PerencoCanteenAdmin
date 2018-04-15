<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Juices extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->model('juice','',TRUE);
		$this->load->model('accounts','', TRUE);
		$this->load->model('log_model','logs');
	}
	
	public function index()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Liste des boissons";
            $data['liste'] = $this->juice->getList();
			$this->load->view('juice', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function newjuice()
	{
		if($this->session->userdata('logged_in'))
		{
            $error=false;
            if ($this->input->post()){
                if(!empty($this->input->post('name'))){
                    $s = $this->juice->getJuiceByName($this->input->post('name'));
                    if(!empty($this->input->post('id'))) $s=0;
                    if($s){
                        $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Erreur !</h4> Veuillez entrer une nouveau nom de boisson. Celle renseignée est déjà utilisée. </div>';
                        $error=true;
                    }
                }
            
				if(!$error){
					if(empty($this->input->post('id'))) $s = $this->juice->newJuice($this->input->post()); 
					else $s = $this->juice->updateJuice($this->input->post()); 
					if($s){
						if(empty($this->input->post('id')))
							$data['alert'] = '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>	<i class="icon fa fa-check"></i> Bravo!</h4>
								Nouvelle boisson ajouté avec succès.
							  </div>';
						else {
							$data['alert'] = '<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>	<i class="icon fa fa-check"></i> Bravo!</h4>
								Boisson mis à jour avec succès.
							  </div>';
							  redirect("juices/updatejuice/".$this->input->post('id'));
						}
					} else {
					   $data['alert']='<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-       dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Erreur !</h4> Problème survenu lors de l\'enregistrement de la nouvelle boisson. </div>'; 
					}
				}
			}
            $session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Ajouter une nouvelle boisson";
			$this->load->view('juice_new', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
	public function updatejuice($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Modification d'une boisson";
            $data['current'] = $this->juice->getInfo($id);
			$this->load->view('juice_new', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
    public function deletejuice()
	{
		if($this->session->userdata('logged_in'))
		{
         if(empty($this->input->post('id'))) echo 'Id inexistant';
         else {
             $save=array();
             $save['id']=$this->input->post('id');
             
             $s=$this->juice->deleteJuice($save);
             
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
	
	public function JuicesExternal()
	{
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: GET, POST');
		
		if($this->juice->JuicesExternal()) {
			echo json_encode($this->juice->JuicesExternal());
			//$this->accounts->flagLastUpdates();
		}
		else
			echo "NO";
	}
	
	public function report()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Logs sur les postes";
			$data['listeboissons'] = $this->juice->getActiveList();
			
            $data['liste'] = $this->logs->getLogsJuices($this->input->get());
			//echo "<pre>"; var_dump($data['liste']); die;
			$this->load->view('report_juices', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}
	}
	
}