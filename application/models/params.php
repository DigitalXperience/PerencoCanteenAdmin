<?php
Class Params extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
	}
	
	public function getParams()
	{
		$query = $this->db->query("SELECT * FROM `parametres` ");
		
		$parametres = array();
		
		if (!empty($query->result()))
		{
			foreach($query->result() as $param) {
				$parametres[$param->param_name] = $param->param_value;
			}
			return $parametres;
		}
		
		return false;
	}
	
	public function update($values)
	{
		$query = $this->db->query("UPDATE `parametres` SET `param_value` = '".$values['starter_price']."' WHERE `param_name` = 'starter_price' ");
		$query = $this->db->query("UPDATE `parametres` SET `param_value` = '".$values['meal_price']."' WHERE `param_name` = 'meal_price' ");
		$query = $this->db->query("UPDATE `parametres` SET `param_value` = '".$values['dessert_price']."' WHERE `param_name` = 'dessert_price' ");
		$query = $this->db->query("UPDATE `parametres` SET `param_value` = '".$values['meal_to_add']."' WHERE `param_name` = 'meal_to_add' ");
		if($values['password'] != '')
			$query = $this->db->query("UPDATE `users` SET `pass` = '".md5($values['password'])."' WHERE `user` = 'admin' ");
		
		return $query;
	}
}
?>
