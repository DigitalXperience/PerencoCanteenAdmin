<?php
Class Account extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
	}
	
	public function getAccountInfo($id)
	{
		$query = $this->db->query("SELECT * FROM info_user WHERE id_user = '$id' LIMIT 1;");
		
		$row = $query->row();

		if (isset($row))
		{
			return $row;
		}
		
		return false;
	}
}
?>
