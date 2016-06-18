<?php

class Log_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getLogs($clause=null)
	{ 	
		//var_dump($clause); 
		//var_dump($clause); //die;
		$where = '';
		if(!is_null($clause) && !empty($clause)) {
			$where = "WHERE ";
			
			if(array_key_exists('poste', $clause) && $clause['poste'] !== '') {
				$where .= " `place` = '" . $clause['poste'] . "' ";
			}
			if(array_key_exists('dates', $clause)) { 
				if(strlen($where) > 6) 
					$where .= " AND ";
				$dates = explode("-", $clause['dates']);
				$date1 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[0]));
				$date2 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[1]));
				if($date1 == $date2)
					$where .= " DATE_FORMAT(`date`, '%Y-%m-%d') = '$date2' ";
				else
					$where .= " DATE_FORMAT(`date`, '%Y-%m-%d') BETWEEN '$date1' AND '$date2' ";
			}
		}
		$sql = "SELECT logs.*, user_info.firstname, user_info.lastname 
				FROM logs 
				LEFT JOIN user_info ON user_info.id_user = logs.id_user 
				$where 
				ORDER BY id DESC ;";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;
	}
	
	public function getDaysReport($clause)
	{
		$where = '';
		if(!is_null($clause) && !empty($clause)) {
			$where = "WHERE ";
			
			if(array_key_exists('poste', $clause) && $clause['poste'] !== '') {
				$where .= " `place` = '" . $clause['poste'] . "' ";
			}
			if(array_key_exists('dates', $clause)) {
				if(strlen($where) > 6) $where .= " AND ";
				$dates = explode("-", $clause['dates']);
				$date1 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[0]));
				$date2 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[1]));
				$where .= " `date` BETWEEN '$date1' AND '$date2' ";
			}
		}
		$sql = "SELECT `id`, SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts, `date`, `place`, DATE_FORMAT(date, '%d %M') AS dat
				FROM `logs` 
				WHERE `place` = 'client1' 
				GROUP BY DATE_FORMAT(date, '%d-%m')
				ORDER BY id DESC ;";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;
	}
	
	public function getMealsOfTheDay()
	{
		$sql = "SELECT SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts, `date`, `place`, DATE_FORMAT(date, '%d %M') AS dat
				FROM `logs` 
				WHERE `place` = 'client1' AND DATE_FORMAT(date, '%d %M') = DATE_FORMAT(NOW(), '%d %M') 
				GROUP BY DATE_FORMAT(NOW(), '%d-%m-%Y');";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			if(count($row) > 0) 
				return abs($row[0]->meals);
			else
				return 0; 	
		}
		return false;
	}
	
}

?>