<?php

class Model_stocklist extends CI_Model{

	public function ini_stocklist($stocks){
		foreach ($stocks as $stock){
			$data = array(
				'symbol' =>$stock[0],
                'name' => $stock[1],
                'exchange' => $stock[9],
                'ipo_year' =>$stock[5],
                'sector' => $stock[6],
                'industry' =>$stock[7],
                'last_sale' =>$stock[2],
                'market_cap' =>$stock[3],
                'summary_link' =>$stock[8],
			);
			$query=$this->db->insert('stock_list',$data);
		}
	}
	
	public function getValidStocks()
    {
			$this->db->select('symbol');
            $this->db->not_like('symbol',  '%^%'); // some stocks have ^ in them (not doing these now)
            $this->db->or_not_like('symbol', '%/%'); // some stocks have / in them (not doing these now)
            $this->db->or_not_like('symbol', '%~%'); // some bad data from CSV has stocks with ~ in them
			$query = $this->db->get('stock_list');
			return $query->result_array();
    }
	
		public function get_symbol($symbol)
    {
			$this->db->select('symbol');
			$this->db->like('symbol',  $symbol); 
            $this->db->not_like('symbol',  '%^%'); // some stocks have ^ in them (not doing these now)
            $this->db->or_not_like('symbol', '%/%'); // some stocks have / in them (not doing these now)
            $this->db->or_not_like('symbol', '%~%'); // some bad data from CSV has stocks with ~ in them
			$this->db->order_by("symbol", "asc");
			$this->db->limit(10);			
			$query = $this->db->get('stock_list');
			return $query->result_array();
    }
	
}

?>