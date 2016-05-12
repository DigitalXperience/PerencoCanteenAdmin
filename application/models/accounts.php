<?php
Class Accounts extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
	}
	
	public function getAccounts()
	{
		$query = $this->db->query("SELECT ua.`PIN`, ua.`blocked`, ui.`firstname`, ui.`lastname`, ui.`status`, ub.`starter`, ub.`meal`, ub.`dessert` 
									FROM `user_account` AS ua 
									LEFT JOIN `user_info` AS ui ON ua.`id_user` = ui.`id_user` 
									LEFT JOIN `user_balance` AS ub ON ub.`id_user` = ua.`id_user` 
									
								");
		
		if (!empty($query->result()))
		{
			return $query->result();
		}
		
		return false;
	}
}
?>
