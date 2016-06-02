<?php
Class Accounts extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
	}
	
	public function getTotal()
	{
		return $this->db->count_all('user_account');
	}
	
	public function getAccounts()
	{
		$query = $this->db->query("SELECT ua.`PIN`, ua.`blocked`, ui.`firstname`, ui.`lastname`, ui.`status`, ub.`starter`, ub.`meal`, ub.`dessert`, ua.id_user  
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
	
	public function getAccount($id)
	{
		$query = $this->db->query("SELECT ua.`PIN`, ua.`blocked`, ui.`firstname`, ui.`lastname`, ui.`status`, ub.`starter`, ub.`meal`, ub.`dessert`, ua.id_user, ui.email 
									FROM `user_account` AS ua 
									LEFT JOIN `user_info` AS ui ON ua.`id_user` = ui.`id_user` 
									LEFT JOIN `user_balance` AS ub ON ub.`id_user` = ua.`id_user` 
									WHERE ua.id_user = '$id';
								");
		
		$row = $query->row();
		if (isset($row)) {
			return $row;
		}
		
		return false;
	}
	
	public function getUserWithoutAccount()
	{
		$query = $this->db->query("SELECT ui.`firstname`, ui.`lastname`, ua.PIN, ui.`id_user`   
									FROM `user_info` AS ui 
									LEFT JOIN `user_account` AS ua ON ua.`id_user` = ui.`id_user` 
									WHERE ua.PIN IS NULL 
								");
		
		if (!empty($query->result()))
		{
			return $query->result();
		}
		
		return false;
	}
	
	public function generateNewPin()
	{
		$pins = $this->getAllPins();
		$PINS = array();
		if(count($pins)>0)
			foreach($pins as $pin)
				$PINS[] = $pin->PIN;
		
		$newpin = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
		while(in_array($newpin, $PINS)) {
			$newpin = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
		}
		
		return $newpin;
	}
	
	public function getAllPins()
	{
		$query = $this->db->query("SELECT `PIN` FROM `user_account` WHERE 1");
		
		if (!empty($query->result()))
		{
			return $query->result();
		}
	}
	
	public function newAccount($values)
	{
		$this->db->insert('user_account', $values);
		return $this->db->insert('user_balance', array('starter' => 0, 'meal' => 0, 'dessert' => 0, 'id_user' => $values['id_user']));
	}
	
	public function creditAccount($values)
	{
		$values['place'] = 'server';
		$values['starter'] = (int) $values['starter'];
		$values['meal'] = (int) $values['meal'];
		$values['dessert'] = (int) $values['dessert'];
		
		$balance['starter'] = $values['old_starter'] + $values['starter']; unset($values['old_starter']);
		$balance['meal'] = $values['old_meal'] + $values['meal']; unset($values['old_meal']);
		$balance['dessert'] = $values['old_dessert'] + $values['dessert']; unset($values['old_dessert']);
		$this->db->where('id_user', $values['id_user']);
		$this->db->update('user_balance', $balance);
		$values['log_by'] = $this->session->userdata('logged_in')['id'];
		
		
		return $this->db->insert('logs', $values); // Mise en log		
	}
	
	public function resetPin($values)
	{
		$this->db->where('id_user', $values['id_user']);
		return $this->db->update('user_account', $values);
	}
}
?>
