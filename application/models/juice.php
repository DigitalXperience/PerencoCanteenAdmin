<?php
Class Juice extends CI_Model
{
	public function getTotal()
	{
		return $this->db->count_all('juice_info');
	}
	
	public function getInfo($id)
	{
		$query = $this->db->query("SELECT * FROM juice_info WHERE id = '$id' LIMIT 1;");
		$row = $query->row();
		if (isset($row)) {
			return $row;
		}
		return false;
	}
    public function getList($clause=null)
	{
		$query = $this->db->query('SELECT juice_info.id, juice_info.name, juice_info.status, juice_info.price FROM juice_info;');
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;
	}
	public function getActiveList($clause=null)
	{
		$query = $this->db->query("SELECT juice_info.id, juice_info.name, juice_info.status, juice_info.price FROM juice_info WHERE juice_info.status <> 'non-actif';");
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;
	}
    public function getJuiceById($id)
	{
		$query = $this->db->query("SELECT * FROM juice_info WHERE id = '".$id."' LIMIT 1;");
		$row = $query->row();
		if (isset($row)) {
			return $row;
		}
		return false;
	}
	public function getJuiceByName($name)
	{
		$query = $this->db->query("SELECT * FROM juice_info WHERE name = '".$name."' LIMIT 1;");
		$row = $query->row();
		if (isset($row)) {
			return $row;
		}
		return false;
	}
    public function newJuice($tab)
	{
		return $this->db->insert('juice_info', $tab);
	}
    
    function updateJuice($tab){
        $this->load->database();
        $this->db->where('id', $tab['id']);
        return $this->db->update('juice_info', $tab);
    }
	
	public function deleteJuice($tab)
	{
		$this->load->database();
        $this->db->where('id', $tab['id']);
        return $this->db->delete('juice_info', $tab);
	}
	
	public function JuicesExternal()
	{
		$query = $this->db->query("SELECT juice_info.id, juice_info.name, juice_info.price FROM juice_info WHERE status='actif' ;");
		
		if (!empty($query->result()))
		{
			
			return $query->result();
		
		} else
			return false; 	
	}
	
}
?>
