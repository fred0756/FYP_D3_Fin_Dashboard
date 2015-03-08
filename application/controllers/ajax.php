<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	public function duplicate_email(){
		$email=$this->input->post('email');
		$this->load->model('model_users');
		echo $this->model_users->existed_user($email);
	}
	
	public function getStockPrice($symbol){
		$this->load->model('model_stockprice');
		$data=json_encode($this->model_stockprice->getStockPrice($symbol));
		echo $data;
	}
	
	public function get_portfolio($id){
		$this->load->model('model_portfolio_stocks');
		$data=json_encode($this->model_portfolio_stocks->get_portfolio_stocks($id));
		echo $data;
	}
	public function get_portfolio_id(){
		$this->load->model('model_portfolio');
		$data=json_encode($this->model_portfolio->get_portfolio_id());
		echo $data;
	}
	
	public function get_symbol(){
		$this->load->model('model_stocklist');
		$data=$this->model_stocklist->getValidStocks();
		$data=json_encode($data);
		echo $data;
	}
	
	
	
	public function get_symbol_from_portfolio($id){
		$this->load->model('model_portfolio_stocks');
		echo json_encode($this->model_portfolio_stocks->get_symbol_from_portfolio($id));
	}
	
	public function store_portfolio(){
		$result= $this->input->post('result');
		$id=$result['id'];
		$manager=$result["manager"];
		$name=$result['name'];
		$description=$result['description'];
		
		$symbol_quantity=$result['symbol_quantity'];
		print_r($symbol_quantity);
		$this->load->model('model_portfolio');
		$this->model_portfolio->update_portfolio($id,$manager,$name,$description);
		$this->load->model('model_portfolio_stocks');
		$this->model_portfolio_stocks->edit_portfolio_stock($id,$symbol_quantity);
	}
	
	public function get_portfolio_stock_price($id){
		$this->load->model('model_portfolio_stocks');
		$data= $this->model_portfolio_stocks->get_portfolio_stock_price($id);
		echo json_encode($data);
	}
	
	
	public function get_table()
		{
			$this->datatables->select('id,symbol,name,exchange,sector')
			->from('stock_list');

			echo $this->datatables->generate();
		}
	
	public function generateCSV($symbol){
		$this->load->model('model_stockprice');
		
		$data=$this->model_stockprice->getStockPriceCSV($symbol);
		$this->load->helper('download');
		 $name = 'data.csv';
		force_download($name, $data);
		
		//header("Content-type: text/csv");
	//	header("Content-Disposition: attachment; filename=file.csv");
	//	header("Pragma: no-cache");
	//	header("Expires: 0");
	//	echo $data;
		
	}
}
