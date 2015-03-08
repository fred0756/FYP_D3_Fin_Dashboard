<?php

class Model_portfolio_stocks extends CI_Model{

	
	public function get_portfolio_stocks($id){
		$this->db->where('id',$id);
		$query = $this->db->get('portfolio_stocks');
		return $query->result_array();
    }
	
	public function edit_portfolio_stock($id,$symbol_quantity){
		$this->db->where('id',$id);
		$this->db->delete('portfolio_stocks');
		print_r($symbol_quantity);
		foreach ($symbol_quantity as $single_row){
			$data = array(
				'id'=>$id,
                'symbol' =>$single_row[0],
                'quantity' =>$single_row[1],
				'settle_date'=>$single_row[2]
			);
			$query=$this->db->insert('portfolio_stocks',$data);
		}
	}
	public function get_portfolio_stock_price($id){
			$this->db->select("DATE_FORMAT(date, '%e-%b-%y') AS date",FALSE);
			$this->db->select("UNIX_TIMESTAMP(date) AS sort",FALSE);
			$this->db->select("open,high,low,close,volume,quantity,adjusted_close,portfolio_stocks.symbol,portfolio_stocks.id");
			$this->db->where('id',$id);
			$this->db->from('portfolio_stocks');
			$this->db->join('stock_price', 'stock_price.symbol = portfolio_stocks.symbol');
			return $this->db->get()->result_array();
	}
	
	public function get_symbol_from_portfolio($id){
		$this->db->where('id',$id);
		$this->db->select('symbol');
		return  $this->db->get('portfolio_stocks')->result_array();
	}
	
	
}

?>