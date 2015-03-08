<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->home();
	}

	public function home(){
	
		$this->load->view('index');
		
	}
	
	public function signup(){
		$this->load->view('signup');
	}
	
	public function restricted(){
		$this->load->view('restricted');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('main/index');
	}
	
	public function stockVolumePage(){
		$this->load->view('user_volume');
	}
	public function MACDPage(){
		$this->load->view('user_macd');
	}
	public function RSIPage(){
		$this->load->view('user_rsi');
	}
	public function dashboard($id){
		$data['id']=$id;
		$this->load->view('dashboard',$data);
	}
	

	public function login_validation(){
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean');
		$this->form_validation->set_rules('password','Password','required|md5|callback_validate_credentials');
	
		if($this->form_validation->run()){
			$data= array(
			'email'=>$this->input->post('email'),
			'profile'=>$this->input->post('password'),
			'is_logged_in' =>1
			);
		
			$this->session->set_userdata($data);
			redirect('main/main_content');
			
		
		}else{
			$this->load->view('index');
		}
	}
	
	public function signup_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
		
		
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('password_confirm','Confirm Password','required|trim|matches[password]');
		
		$this->form_validation->set_message('is_unique','That email address already exists!');
		
		if($this->form_validation->run()){
			//phplogintut@gmail.com

			//generate a random key
			$key = md5(uniqid());
			
			$this->load->library('email');
			$this->load->model('model_users');
			$this->email->from('fyp_ecm@163.com',"ECM");
			$this->email->to($this->input->post('email'));
			$this->email->subject("Confirm your account");
			$message = "<p>Thank you for signing up!</p>";
			$message .= "<p><a href='".base_url()."main/register_user/$key'>Click here</a> to confirm your account</p>";
			
			$this->email->message($message);
			
			//send email to user
			if($this->model_users->add_temp_users($key)){
				if($this->email->send()){
					$this->load->view('index');
					$msg = "Please go to your email to validate your account!";
					echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
					echo "this email is sent";
				}else	echo "this email failed";
			}else echo "problem adding to database.";
			//add them to the temp_user db

			
		}else {
			$this->load->view('index');
		}
	}
	
	public function members(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('members');
		}else{
			redirect('main/restricted');
		}
	}
	
	public function main_content(){
		if($this->session->userdata('is_logged_in')){
			if($this->session->userdata('profile')=="user"){
				$this->load->view('user_test_brush.php');
			}
			if($this->session->userdata('profile')=="admin"){
			//	$this->load->view('admin.php');
			redirect('main/admin_list_all_users');
			}
			if($this->session->userdata('profile')=="manager"){
				$this->load->view('manager.php');
			}
		}else{
			redirect('main/restricted');
		}
	}
	

	

	public function validate_credentials(){
		
		$this->load->model('model_users');
		
		if($profile=$this->model_users->can_log_in()){
			return $profile;
		}else{
			$this->form_validation->set_message('validate_credentials','Incorrect username/password.');
			return false;
		}
		
		
	}

	
	public function get_stock_list(){
		redirect('datatable/getTable');
	}
	
	public function add_portfolio(){
		$this->load->model('model_portfolio');
		$this->model_portfolio->insert_new_portfolio();
		$this->load->view('manager.php');
	}
	
	public function load_modify_portfolio(){
		$this->load->model('model_portfolio');
		$data['list']=$this->model_portfolio->get_portfolio();
		$this->load->view('manager_modify_portfolio',$data);
	}
	
	public function register_user($key){
		$this->load->model('model_users');
		
		if($this->model_users->is_key_valid($key)){
			if($newemail = $this->model_users->add_user($key)){
				$data =array(
					'email'=>$newemail,
					'profile'=>"user",
					'is_logged_in'=>1,
				);
				
				$this->session->set_userdata($data);
				redirect('main/main_content');
			} else echo "failed to add, try again.";
		}else echo "invalid key";
	
	}
	
	public function admin_list_all_users(){
		$this->load->model('model_users');
		$data['user']=$this->model_users->list_all_user();
		$this->load->view('admin',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */