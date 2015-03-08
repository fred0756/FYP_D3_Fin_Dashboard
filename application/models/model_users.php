<?php

class Model_users extends CI_Model{

	public function can_log_in(){
		
		$this->db->where('email',$this->input->post('email'));
		$this->db->where('password',md5($this->input->post('password')));
		$this->db->where('validated',"1");
		
		$query = $this->db->get('users');
		
		if($query->num_rows()== 1){
			return $query->row()->profile;
		}else{
			return false;
		}
		
	}
	
	public function add_temp_users($key){
	
		$data = array(
			'email' =>$this->input->post('email'),
			'password'=>md5($this->input->post('password')),
			'key' => $key,
			'profile'=>"user",
			'validated'=>"0"
		);
	
	
		$query=$this->db->insert('users',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	
	public function is_key_valid($key){
		$this->db->where('key',$key);
		$query = $this->db->get('users');
		
		if($query->num_rows() == 1){
			return true;
		}else return false;
	}
	
	public function add_user($key){
		$this->db->where('key',$key);
		$temp_user=$this->db->get('users');
		
		if($temp_user){
			$row = $temp_user->row();
			$data =array(
				'email'=>$row->email,
				'password'=>$row->password,
				'validated'=>"1",
			);
			$this->db->where('email',$row->email);
			$did_add_user= $this->db->update('users',$data);
		}
		
		if($did_add_user){
			return $data['email'];
		}return false;
	}
	
	public function existed_user($email){
		$this->db->where('email',$email);
		$query = $this->db->get('users');
		
		if($query->num_rows() == 1){
			return true;
		}else return false;
	}
	
	public function list_all_user(){
		return $this->db->get('users')->result_array();
	}
	
	public function update_profile($email,$profile){
	$this->db->where('email',$email);
	$data = array(
               'profile' => $profile
            );

	if($this->db->update('users',$data)){
		return true;
	}
	else return false;
	}
}

?>