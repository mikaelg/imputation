<?php namespace be\imputation;
//require_once 'view/home.php';

class Home_controller{
	
	private $regionHead;
	private $regions = array();
	
	/**
	 * consturctor initieert alle regions
	 * TODO : verplaatsen naar abstract class
	 */
	//public function __construct($args = NULL){
	public function __construct($_controller){
	
		$this->regionHead = 'templates/head.php';
		
		$this->regions['header'] = 'templates/header.php';	
		$this->regions['content'] = 'view/'.$_controller.'.php';
		$this->regions['footer'] = 'templates/footer.php';
		
	
	}
	
	public function assembleView(){
		$r_head = $this->regionHead;
		$r_regions = $this->regions;
		
		/**
		 * Hier dienen we de data uit het model nog op te roepen en door te geven aan de view.
		 *
		 */
		$dynamicContent = 'INSERTED FROM CONTROLLER<br><ul><li><a href="?rt=login">login</a></li></ul>';
	
		include 'templates/page--home.php';
	
	}
	
	public function getView(){
		
		//$r = new Home_view();
		//print($r->returnView());
		$this->assembleView();

	}
}