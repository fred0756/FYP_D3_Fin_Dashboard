<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function update_profile($email,$profile){
		$this->load->model('model_users');
		$this->model_users->update_profile($email,$profile);
	}
	
	
	public function admin_add_user(){
		$this->load->model('model_users');
		$this->model_users->admin_add_user();
		redirect('main/main_content');
	}
	
		public function admin_delete_user(){
		$this->load->model('model_users');
		$this->model_users->admin_delete_user();
		redirect('main/main_content');
	}
	
}