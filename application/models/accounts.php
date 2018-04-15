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
		$query = $this->db->query("SELECT ua.`PIN`, ua.`blocked`, ui.`firstname`, ui.`lastname`, ui.`status`, ub.`starter`, ub.`meal`, ub.`dessert`, ua.id_user, ub.balance   
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
		$query = $this->db->query("SELECT ua.`PIN`, ua.`blocked`, ui.`firstname`, ui.`lastname`, ui.`status`, ub.`starter`, ub.`meal`, ub.`dessert`, ua.id_user, ui.email, ub.balance 
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
	
	public function getBalance($id)
	{
		$query = $this->db->query("SELECT ub.`starter`, ub.`meal`, ub.`dessert`, ub.id_user , ub.balance 
									FROM `user_balance` AS ub  
									WHERE id_user = '$id';
								");
		
		$row = $query->row();
		if (isset($row)) {
			return $row;
		}
		
		return false;
	}
	
	// pour le solde monnaie uniquement
	public function getActualBalance($id)
	{
		$query = $this->db->query("SELECT ub.`meal`, ub.id_user , ub.balance 
									FROM `user_balance` AS ub  
									WHERE id_user = '$id';
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
									WHERE ua.PIN IS NULL ORDER BY ui.`lastname` 
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
		//var_dump($PINS); die;
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
	
	public function getUserPin($id)
	{
		$query = $this->db->query("SELECT `PIN` FROM `user_account` WHERE id_user = '$id'");
		
		$row = $query->row();
		if (isset($row)) {
			return $row;
		}
		
		return false;
	}
	
	public function newAccount($values)
	{
		if(array_key_exists('email', $values)) unset($values['email']);
		$this->db->insert('user_account', $values);
		return $this->db->insert('user_balance', array('starter' => 0, 'meal' => 0, 'dessert' => 0, 'balance' => 0, 'id_user' => $values['id_user']));
	}
	
	public function creditAccount($values)
	{
		//var_dump($values);
		$values['place'] = 'server';
		$values['starter'] = (int) $values['starter'];
		$values['meal'] = (int) $values['meal'];
		$values['dessert'] = (int) $values['dessert'];
		$values['balance'] = (int) $values['balance'];
		
		$balance['starter'] = $values['old_starter'] + $values['starter']; unset($values['old_starter']);
		$balance['meal'] = $values['old_meal'] + $values['meal']; unset($values['old_meal']);
		$balance['dessert'] = $values['old_dessert'] + $values['dessert']; unset($values['old_dessert']);
		$balance['balance'] = $values['old_balance'] + $values['balance']; unset($values['old_balance']);
		//var_dump($values); 
		//var_dump($balance); die;
		$this->db->where('id_user', $values['id_user']);
		$this->db->update('user_balance', $balance);
		$values['log_by'] = $this->session->userdata('logged_in')['id'];
		
		return $this->db->insert('logs', $values); // Mise en log		
	}
	
	public function blockAccount($iduser) {
		$this->db->where('id_user', $iduser);
		return $this->db->update('user_account', array('blocked' => '1'));
	}
	
	public function unblockAccount($iduser) {
		$this->db->where('id_user', $iduser);
		return $this->db->update('user_account', array('blocked' => '0'));
	}
	
	public function resetPin($values)
	{
		if(array_key_exists('email', $values))
			unset($values['email']);
		$this->db->where('id_user', $values['id_user']);
		return $this->db->update('user_account', $values);
	}

	public function updateBalanceFromClient($value)
	{
		$old_data = $this->getBalance($value['id_user']);
		//var_dump($old_data); die;
		$value['place'] = $value['place'];;
		$value['starter'] = (int) $value['starter'];
		$value['meal'] = (int) $value['meal'];
		$value['dessert'] = (int) $value['dessert'];
		
		$balance['starter'] = $old_data->starter + $value['starter'];
		$balance['meal'] = $old_data->meal + $value['meal'];
		$balance['dessert'] = $old_data->dessert + $value['dessert']; 
		
		$this->db->where('id_user', $value['id_user']);
		if($this->db->update('user_balance', $balance)) { //var_dump($balance); die('12');
			$value['log_by'] = $value['id_user'];
			$this->db->insert('logs', $value); // Mise en log
			return true;
		}
		return false;
	}
	
	public function updateBalanceFromTerminal($value)
	{
		$old_data = $this->getActualBalance($value['id_user']);
		//var_dump($old_data); die;
		$value['place'] = $value['place'];;
		$value['meal'] = (int) $value['meal'];
		$value['balance'] = (int) $value['balance'];
		
		$balance['meal'] = $old_data->meal + $value['meal'];
		$balance['balance'] = $old_data->balance - $value['balance']; 
		
		$this->db->where('id_user', $value['id_user']);
		//var_dump($this->checkIfAlreadyUpdated($value['id_user'], $value['place'], $value['date'])); die;
		if($this->checkIfAlreadyUpdated($value['id_user'], $value['place'], $value['date']))
			return true;
		
		if($this->db->update('user_balance', $balance)) { //var_dump($balance); die('12');
			$value['log_by'] = $value['id_user'];
			$this->db->insert('logs', $value); // Mise en log
			return true;
		}
		return false;
	}
	
	public function checkIfAlreadyUpdated($iduser, $place, $date) {
		$query = $this->db->query("SELECT * FROM `logs` l WHERE `id_user` = '$iduser' AND `date` = '$date' AND `place` = '$place'");
		if (!empty($query->result()))
		{
			return true;
		} else
			return false; 
	}
	
	public function newAccountsExternal()
	{
		$query = $this->db->query("SELECT ua.`PIN`, ua.`id_user`, ua.`date_exp`, ua.`created`, ua.`blocked`, ub.`starter`, ub.`meal`, ub.`dessert`, ub.balance  
									FROM `user_account` ua 
									LEFT JOIN  `user_balance` ub ON ub.`id_user` = ua.`id_user`
									WHERE `blocked` = '0'");
		
		if (!empty($query->result()))
		{
			
			return $query->result();
		
		} else
			return false; 	
	}
	
	public function AccountsExternal()
	{
		$query = $this->db->query("SELECT ua.`PIN`, ua.`id_user`, ua.`date_exp`, ua.`created`, ua.`blocked`, ub.`meal`, ub.`balance`, ui.`lastname`, ui.`firstname`, ui.`deleted`   
									FROM `user_account` ua 
									LEFT JOIN  `user_balance` ub ON ub.`id_user` = ua.`id_user` 
									LEFT JOIN  `user_info` ui ON ui.`id_user` = ua.`id_user` 
								");
		
		if (!empty($query->result()))
		{
			
			return $query->result();
		
		} else
			return false; 	
	}
	
	public function flagLastUpdates()
	{
		$query = $this->db->query("UPDATE `user_account` SET `flag` = '1' WHERE `flag` = '0' AND `blocked` = '0'");
	}
	
	public function getEmail($id)
	{
		$query = $this->db->query("SELECT `email` FROM `user_info` WHERE id_user = '$id';");
		
		$row = $query->row();
		if (isset($row)) {
			return $row->email;
		}
		
		return '';
	}
	
	public function getWorkingDays()
	{
		$m = date('m');
		$y = date('y');
		$lastday = date("t",mktime(0,0,0,$m,1,$y));
		$weekdays=0;
		for($d=29;$d<=$lastday;$d++) {
			$wd = date("w",mktime(0,0,0,$m,$d,$y));
			if($wd > 0 && $wd < 6) $weekdays++;
		}
		return $weekdays+20;
	}
	
	public function resetAllMeals()
	{
		if(date('d') == "01") { // Si nous sommes le 1er jour du mois, alors on execute
			$wd = $this->getWorkingDays();
			$this->db->set('meal', "$wd");
			$this->db->update('user_balance');
		}
	}
}
?>
