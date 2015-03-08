<?php
class Clitools extends CI_Controller{

	function __construct()
	{
		parent::__construct();
	}


	public function storeCompanyList()
	{
		$this->load->helper('file');
		$files=get_filenames('assets/resources/company_list',true);
		$this->load->model('model_users');
		$stocks = [];

        foreach ($files as $file)
        {
            $handle = fopen($file, "r");

            while( ! feof($handle))
            {
                $stock = fgetcsv($handle);

                $stock[9] = basename($file, '.csv');

                if (count($stock) == 10)
                {
                    $stocks[] = $stock;
                }
            }

            fclose($handle);
        }
		echo count($stocks) . ' to create' . PHP_EOL;
		$this->load->model('model_stocklist');
		$this->model_stocklist->ini_stocklist($stocks);
	}
	
	    public function fetchStockHistory()
    {
		set_time_limit(0);
		$this->load->model('model_stocklist');
		$stocks = $this->model_stocklist->getValidStocks();
	//	print_r($stocks);
        $target_dir = 'assets/resources/stockprice';

        if ( ! is_dir($target_dir)) mkdir($target_dir,0777);

        foreach ($stocks as $stock)
        {
            $symbol = trim($stock['symbol']);
			//print_r($symbol."\n");
            $stock_data = file_get_contents('http://ichart.finance.yahoo.com/table.csv?s='.$symbol);
            $bytes = write_file($target_dir.'/'.$symbol.'.csv',$stock_data);
			print 'Stored csv for: ' . $symbol . ' (' . $bytes .  ' bytes)' . PHP_EOL;


        }
    }
	
	public function storeStockPrice()
		{
			set_time_limit(0);
			ini_set("memory_limit","100M");
			$this->load->helper('file');
			$this->load->library('csvreader');
			$files=get_filenames('assets/resources/stockprice',true);
			
			foreach ($files as $file)
			{
				$symbol = basename($file, '.csv');
				$data['csvData'] = $this->csvreader->parse_file($file);
				$output_result=null;
				foreach($data['csvData'] as $row){
						
					$output_line = array(
						'date' =>$row['Date'],
						'symbol'=>$symbol,
						'open' =>$row['Open'],
						'high'=>$row['High'],
						'low'=>$row['Low'],
						'close'=>$row['Close'],
						'adjusted_close'=>$row['Adj Close'],
						'volume'=>$row['Volume'],
					);
					$output_result[]= $output_line;
				}
				
				
				$this->load->model('model_stockprice');
				$this->model_stockprice->storeStockPrice($output_result);
				print "--------------------------------". PHP_EOL;
				print "Finished inserting for: " . $symbol . PHP_EOL;
				print "--------------------------------". PHP_EOL;
			}
				
		}
	
	
	
	
}
?>