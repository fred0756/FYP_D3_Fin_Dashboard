<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function update_profile($email,$profile){
		$this->load->model('model_users');
		$this->model_users->update_profile($email,$profile);
	}
	
}