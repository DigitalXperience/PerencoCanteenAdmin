<?php

class Log_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getLogs($clause=null)
	{ 	
		//var_dump($clause); 
		//var_dump($clause); die;
		$where = '';
		$limit = ' LIMIT 4000 ';
		if(!is_null($clause) && !empty($clause)) {
			$where = "WHERE ";
			
			if(array_key_exists('poste', $clause) && $clause['poste'] === 'client') {
				$where .= " `place` IN ('client1', 'client2') ";
				$limit = '';
			}
			if(array_key_exists('poste', $clause) && $clause['poste'] === 'server') {
				$where .= " `place` IN ('server') ";
				$limit = '';
			}
			if(array_key_exists('dates', $clause) && $clause['dates'] === '')
				$limit = ' LIMIT 1600 ';
			
			if(array_key_exists('dates', $clause) && $clause['dates'] !== '') { 
				if(strlen($where) > 6) 
					$where .= " AND ";
				$dates = explode("-", $clause['dates']);
				$date1 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[0]));
				$date2 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[1]));
				if($date1 == $date2)
					$where .= " DATE_FORMAT(`date`, '%Y-%m-%d') = '$date2' ";
				else
					$where .= " DATE_FORMAT(`date`, '%Y-%m-%d') BETWEEN '$date1' AND '$date2' ";
				$limit = '';
			}
		}
		if(strlen($where) == 6) $where = "";
		$sql = "SELECT logs.*, user_info.firstname, user_info.lastname 
				FROM logs 
				LEFT JOIN user_info ON user_info.id_user = logs.id_user 
				$where 
				ORDER BY id DESC 
				$limit;";
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
			
			$where .= " `place` <> 'server' AND ";
			
			if(array_key_exists('dates', $clause)) {
				
				if($clause['dates'] !== '') {
					if(strlen($where) > 6) $where .= " ";
					$dates = explode("-", $clause['dates']);
					$date1 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[0]));
					$date2 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[1]));
					$where .= " `date` BETWEEN '$date1 00:00:00' AND '$date2 23:59:59' ";
				}
				else {
					$where .= " `date` BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(CURDATE()) ";
				}
			}
		}
		$sql = "SELECT SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts, SUM(`balance`) as balance, `date`, `place`, DATE_FORMAT(date, '%d %M') AS dat
				FROM `logs` 
				 $where 
				GROUP BY DATE_FORMAT(date, '%d-%m')
				ORDER BY date ASC ;";
		//var_dump($sql); die;
		$query = $this->db->query("SET lc_time_names = 'fr_FR'");
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;
	}
	
	public function getWeekReport()
	{
		$sql = "SELECT SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts, DATE_FORMAT(date, '%Y-%m-%d') AS fdate, `date`, DATE_FORMAT(date, '%d %M') AS dat
				FROM `logs` 
				WHERE `date` BETWEEN adddate(curdate(), INTERVAL 2-DAYOFWEEK(curdate()) DAY) AND adddate(curdate(), INTERVAL 8-DAYOFWEEK(curdate()) DAY) AND  `place` <> 'server' 
				GROUP BY DATE_FORMAT(date, '%d-%m')
				ORDER BY dat DESC ;";
		//var_dump($sql); die;
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
		$sql = "SELECT *, SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts  FROM 
				(SELECT SUM(`starter`) AS starter, `meal` AS meal, SUM(`dessert`) AS dessert, `date`, `place`, DATE_FORMAT(date, '%d %M') AS dat
								FROM `logs` 
								WHERE `place` <> 'server' AND DATE_FORMAT(date, '%d %M %Y') = DATE_FORMAT(NOW(), '%d %M %Y') 
								GROUP BY DATE_FORMAT(date, '%H-%i-%s'), DATE_FORMAT(NOW(), '%d-%m-%Y')) tmp 
				GROUP BY dat";
		
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
	
	public function getConsumptionOfTheWeek()
	{
		$sql = "SELECT *, SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts  FROM 
				(SELECT SUM(`starter`) AS starter, -1 AS meal, SUM(`dessert`) AS dessert, week(DATE_FORMAT(date, '%Y-%m-%d')) as semaine    
								FROM `logs` 
								WHERE `place` <> 'server' AND week(DATE_FORMAT(date, '%Y-%m-%d')) = week(curdate(),1) 
								AND YEAR(DATE_FORMAT(date, '%Y-%m-%d')) = YEAR(curdate()) 
								GROUP BY DATE_FORMAT(date, '%H-%i-%s'), DATE_FORMAT(NOW(), '%d-%m-%Y')) tmp 
				GROUP BY semaine";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			if(count($row) > 0) 
				return $row[0];
			else
				return false; 	
		}
		return false;	
	}
	
	public function getConsumptionOfTheMonth()
	{
		$sql = "SELECT SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts 
				FROM `logs` 
				WHERE `place` <> 'server' AND DATE_FORMAT(date, '%m-%Y') = DATE_FORMAT(curdate(), '%m-%Y') 
				GROUP BY DATE_FORMAT(date, '%m-%Y');";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			if(count($row) > 0) 
				return $row[0];
			else
				return false; 	
		}
		return false;	
	}
	
	public function getConsumptionOfTheMonthWeekByWeek()
	{
		$sql = "SELECT SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts 
				FROM `logs` 
				WHERE `place` <> 'server' AND DATE_FORMAT(date, '%m-%Y') = DATE_FORMAT(curdate(), '%m-%Y') 
				GROUP BY week(date,1);";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;	
	}
	
	public function getConsumptionOfTheWeekDayByDay()
	{
		$sql = "SELECT SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts, DAYOFWEEK(date) as daynum

				FROM `logs` 

				WHERE `place` <> 'server' /*AND week(DATE_FORMAT(date, '%Y-%m-%d')) = week(curdate(),1) 

				AND YEAR(DATE_FORMAT(date, '%Y-%m-%d')) = YEAR(curdate()) */
                
                AND YEARWEEK(`date`, 1) = YEARWEEK(NOW(), 1)

				GROUP BY DATE_FORMAT(date, '%d-%m-%Y');";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			$i = 0; $day = array(0 => 2, 1 => 3, 2 => 4, 3 => 5, 4 => 6);
			
			for($i = 0; $i <= 4; $i++)
			{
				if(isset($row[$i]) ) {
					$row[$i]->daynum = (int) $row[$i]->daynum;
					$key = array_search($row[$i]->daynum, $day);
					unset($day[$key]);
					$conso[$i] = $row[$i];
				} 
				else {
					$d = new stdClass();
					$d->starters = '0';
					$d->meals = '0';
					$d->desserts = '0';
					$d->daynum = array_shift($day);
					$conso[$i] = $d;
				}
			}
			 
			usort($conso, function($first, $second) {
				return $first->daynum > $second->daynum;
			}); 
			
			return $conso;
		}
		return false;	
	}
	
	public function getConsumptionOfTheYear()
	{
		$sql = "SELECT SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts 
				FROM `logs` 
				WHERE `place` IN ('client1', 'client2') AND DATE_FORMAT(date, '%Y') = DATE_FORMAT(curdate(), '%Y') 
				GROUP BY DATE_FORMAT(date, '%Y');";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			if(count($row) > 0) 
				return $row[0];
			else
				return false; 	
		}
		return false;	
	}
	
	public function getConsumptionOfTheYearMonthByMonth()
	{
		$sql = "SELECT SUM(`starter`) AS starters, SUM(`meal`) AS meals, SUM(`dessert`) AS desserts, DATE_FORMAT(date, '%m') as month  
				FROM `logs` 
				WHERE `place` IN ('client1', 'client2') AND DATE_FORMAT(date, '%Y') = DATE_FORMAT(curdate(), '%Y') 
				GROUP BY month(date);";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;	
	}
	
	public function hasEatenToday($iduser)
	{		
		$query = $this->db->query("SELECT `meal` AS meals FROM `logs` WHERE `id_user` = '".$iduser."' AND meal = -1 AND DATE_FORMAT(date, '%d %M') = DATE_FORMAT(NOW(), '%d %M')  LIMIT 1");
		//var_dump("SELECT `meal` AS meals FROM `logs` WHERE `id_user` = '".$iduser."' AND meal = -1 AND DATE_FORMAT(date, '%d %M') = DATE_FORMAT(NOW(), '%d %M')  LIMIT 1"); die;
		$row = $query->result();
		if (!empty($row))
		{
			if($row[0]->meals === "-1")
				return true;
			return false;
		}
		return false;
	}
	
	public function getLogsJuices($clause=null)
	{ 	
		 
		//var_dump($clause); die;
		$where = '';
		$limit = '';
		if(!is_null($clause) && !empty($clause)) {
			$where = "WHERE ";
			
			if(array_key_exists('dates', $clause) && $clause['dates'] === '') {
				$limit = ' LIMIT 1600 ';
				$where .= " DATE_FORMAT(date, '%m-%Y') = DATE_FORMAT(curdate(), '%m-%Y') ";
			}
		
			
			if(array_key_exists('dates', $clause) && $clause['dates'] !== '') { 
				if(strlen($where) > 6) 
					$where .= " AND ";
				else
					$where .= " ";
				$dates = explode("-", $clause['dates']);
				$date1 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[0]));
				$date2 = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$1-$2', trim($dates[1]));
				if($date1 == $date2)
					$where .= " DATE_FORMAT(`date`, '%Y-%m-%d') = '$date2' ";
				else
					$where .= " DATE_FORMAT(`date`, '%Y-%m-%d') BETWEEN '$date1' AND '$date2' ";
			}
		}
		
		if(strlen($where) == 0) 
			$where .= "WHERE  logs.boissons <> '' AND logs.boissons <> '[]'";
		else
			$where .= " AND  logs.boissons <> ''  AND logs.boissons <> '[]'";
		$sql = "SELECT logs.id, logs.id_user, logs.date, logs.boissons, user_info.firstname, user_info.lastname 
				FROM logs 
				LEFT JOIN user_info ON user_info.id_user = logs.id_user 
				$where 
				ORDER BY id DESC 
				$limit;";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;
	}
	
	public function resetLogs()
	{
		$this->db->truncate('log_check_day');
	}
}

?>