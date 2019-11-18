<?php

/**
 * Class User_model
 */
class User_model extends CI_Model{
	public function checkLogin($username, $password){
		$this->db->where('username', $username);
		$query = $this->db->get('users');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$decryptedPassword = $this->encryption->decrypt($row->password);
				if($decryptedPassword == $password){
					$this->session->set_userdata('username', $username);
					return;
				}
				else{
					return 'Invalid Password';
				}
			}
		}
		else
		{
			return 'Invalid Username';
		}
	}

	/**
	 * @param $data
	 * Temp function to save an admin user
	 */
public function save($data){
		$this->db->insert('users', $data);
}
}
?>
