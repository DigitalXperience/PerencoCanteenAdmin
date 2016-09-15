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
			if($this->input->get('pdf')) {
				
				$this->load->library('Pdf');
				
				$data['liste'] = $this->logs->getDaysReport($this->input->get());
				$data['params'] = $this->params->getParams();
				
				$html = $this->load->view('reportfilter', $data);
				// $this->load->library('Pdf');
				// $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
				// $pdf->SetTitle('Pdf Example');
				// $pdf->SetHeaderMargin(30);
				// $pdf->SetTopMargin(20);
				// $pdf->setFooterMargin(20);
				// $pdf->SetAutoPageBreak(true);
				// $pdf->SetAuthor('Author');
				// $pdf->SetDisplayMode('real', 'default');
				// $pdf->Write(5, 'CodeIgniter TCPDF Integration');
				// $pdf->Output('pdfexample.pdf', 'I');
				
			} else {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['name'] = $this->user->getInfo($session_data['id']);
				$data['title'] = "Rapports et Filtres";
				// Traitement
				$data['liste'] = $this->logs->getDaysReport($this->input->get());
				$data['params'] = $this->params->getParams();
				$this->load->view('report_filter', $data);
			}
			
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
	
	public function weekstats()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['title'] = "Statistiques Hebdomadaire";
			// Traitement
			$data['liste'] = $this->logs->getWeekReport();
			$data['conso'] = $this->logs->getConsumptionOfTheWeek();
			$data['consoweek'] = $this->logs->getConsumptionOfTheWeekDayByDay();
			$data['params'] = $this->params->getParams();
			$this->load->view('report_week', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}	
	}
	
	public function monthstats()
	{	
		if($this->session->userdata('logged_in'))
		{
			// var_dump(date('d-m-Y',strtotime('first day of this month')));
			// var_dump(date('d-m-Y', strtotime('last day of this month')));
			// die;
			
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['conso'] = $this->logs->getConsumptionOfTheMonth();
			$data['consomonth'] = $this->logs->getConsumptionOfTheMonthWeekByWeek();
			$data['title'] = "Statistiques Mensuelle";
			// Traitement
			$data['liste'] = $this->logs->getWeekReport();
			$data['params'] = $this->params->getParams();
			$this->load->view('report_month', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}	
	}
	
	public function yearstats()
	{	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['name'] = $this->user->getInfo($session_data['id']);
			$data['conso'] = $this->logs->getConsumptionOfTheYear();
			$data['consoyear'] = $this->logs->getConsumptionOfTheYearMonthByMonth();
			//var_dump($data['consoyear']); die;
			$data['title'] = "Statistiques Mensuelle";
			// Traitement
			$data['liste'] = $this->logs->getWeekReport();
			$data['params'] = $this->params->getParams();
			$this->load->view('report_year', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/login/');
		}	
	}
}