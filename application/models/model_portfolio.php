<?php

class Model_portfolio extends CI_Model{

	public function insert_new_portfolio(){
			$data = array(
                'name' =>$this->input->post('name'),
                'manager' =>$this->input->post('manager'),
                'description' => $this->input->post('description'),
			);
			$query=$this->db->insert('portfolio',$data);
	}
	
	public function get_portfolio()
    {
					$this->db->where('manager',$this->session->userdata('email'));
			$query = $this->db->get('portfolio');
			
			return $query->result_array();
    }
	
	public function update_portfolio($id,$manager,$name,$description){
			$data = array(
                'name' =>$name,
                'manager' =>$manager,
                'description' => $description,
			);
			$this->db->where('id',$id);
			$this->db->update('portfolio',$data);
	}
	
	public function get_portfolio_id(){
		$this->db->select('id');
		return $this->db->get('portfolio')->result_array();
	}
	
}

?>