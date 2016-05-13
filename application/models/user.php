<?php
Class User extends CI_Model
{
	public function login($username, $password)
	{
		$this -> db -> select('id, user, pass');
		$this -> db -> from('users');
		$this -> db -> where('user', $username);
		$this -> db -> where('pass', MD5($password));
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	public function getInfo($id)
	{
		$query = $this->db->query("SELECT * FROM user_info WHERE id_user = '$id' LIMIT 1;");
		$row = $query->row();
		if (isset($row)) {
			return $row;
		}
		return false;
	}
    public function getList($clause=null)
	{
		$query = $this->db->query('SELECT * FROM user_info LEFT JOIN user_account ON user_info.id_user = user_account.id_user WHERE user_info.deleted IS NULL '.$clause.';');
		$row = $query->result();
		if (isset($row))
		{
			return $row;
		}
		return false;
	}
    public function getUserByEmail($email)
	{
		$query = $this->db->query("SELECT * FROM user_info WHERE email = '".$email."' and deleted IS NULL  LIMIT 1;");
		$row = $query->row();
		if (isset($row)) {
			return $row;
		}
		return false;
	}
    public function newUser($tab)
	{
		return $this->db->insert('user_info', $tab);
	}
    
    function updateUser($tab){
        $this->load->database();
        $this->db->where('id_user', $tab['id_user']);
        $this->db->update('user_info', $tab);
    }
}
?>
