<?php

class Model_stockprice extends CI_Model{

	public function storeStockPrice($data){
		$this->db->insert_batch('stock_price', $data); 
	}
		
	public function getStockPrice($symbol){
		$this->db->select("DATE_FORMAT(date, '%e-%b-%y') AS date",FALSE);
		$this->db->select("UNIX_TIMESTAMP(date) AS sort",FALSE);
		$this->db->select("open,high,low,close,volume");
		$this->db->where('symbol',$symbol);
	//	$this->db->order_by('sort', 'DESC');
	//	$this->db->limit('500');
		$query=$this->db->get('stock_price')->result_array();
		return $query;
	}
	
		public function getStockPriceCSV($symbol){
		$this->db->select("DATE_FORMAT(date, '%e-%b-%y') AS date",FALSE);
	//	$this->db->select("UNIX_TIMESTAMP(date) AS sort",FALSE);
		$this->db->select("open,high,low,close,adjusted_close,volume");
		$this->db->where('symbol',$symbol);
	//	$this->db->order_by('sort', 'DESC');
	//	$this->db->limit('500');
		$query=$this->db->get('stock_price');
		$this->load->dbutil();
		$delimiter = ",";
		$newline = "\r\n";
		return  $this->dbutil->csv_from_result($query, $delimiter, $newline);
	}
	
}
