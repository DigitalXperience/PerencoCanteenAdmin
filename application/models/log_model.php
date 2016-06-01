<?php

class Log_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function log($array)
	{
		if(isset($array['id_user']))
			$id_user = $array['id_user'];
		else if($this->session->userdata('iduser'))
			$id_user = $this->session->userdata('iduser');
		else	
			$id_user = 0;
		
		$actions = $array['actions'];
		$description = $array['description'];
		if($array['id_reservation'])
			$id_reservation = $array['id_reservation'];
		else	
			$id_reservation = '';
			
		$sql = "INSERT INTO `logs` (`id_reservation`, `date`, `id_user_staff`, `actions`, `description`) 
							VALUES ('$id_reservation', CURRENT_TIME(), '$id_user', '$actions', ".$this->db->escape($description).");";
		
		//var_dump($sql); die;
		
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	
	public function getLogs($clause=null)
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
			//var_dump($where); die;
		}
		$sql = "SELECT logs.*, user_info.firstname, user_info.lastname FROM logs LEFT JOIN user_info ON user_info.id_user = logs.id_user $where ;";
		//var_dump($sql); die;
		$query = $this->db->query($sql);
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;
	}
	
}

?>