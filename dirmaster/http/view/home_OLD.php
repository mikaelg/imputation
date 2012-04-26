<?php namespace be\imputation;

class Home_view{


	private $regions = array();
	
	//public function __construct($args = NULL){
	public function __construct(){

			$this->regions['header'] = 'templates/header.php';
			$this->regions['footer'] = 'templates/footer.php';

	}
	
	
	public function returnView(){
		$r_header = $this->regions['header'];
		$r_footer = $this->regions['footer'];
		
		
		include 'templates/page--home.php';

		//include $this->regions['header'];
		//include $this->regions['footer'];
		//return "header";
	}
	
	private function content(){
		
		
	}

	
	

}