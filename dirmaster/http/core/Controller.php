<?php namespace be\imputation;
require_once 'core/DynamicContentRegistry.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
abstract class Controller{
	
	private $regionHead;
	private $regions = array();
	private $controller;
	protected $dcreg;
	protected $model;
	/**
	 * constructor initieert alle regions
	 * en kijkt of er een pagetemplate bestaat voor deze contoller.
	 * Zo niet wordt de default page template gebruikt.
	 * 
	 */
	public function __construct($_controller,$_args = array()){
		
		
		$this->dcreg = DynamicContentRegistry::instantiate();
		//$this->dcreg = new DynamicContentRegistry;
		
		$this->dcreg->args = $_args;
		
		
		
		$this->controller = $_controller;
		$this->regionHead = 'templates/head.php';
		
		$this->regions['header'] = 'templates/header.php';	
		$this->regions['content'] = 'view/'.$_controller.'.php';
		$this->regions['footer'] = 'templates/footer.php';
		
	}
	
	/**
	 * if you use a different head file it should be located in the templates directory.
	 * @param unknown_type $_headFileName
	 */
	protected function setHead($_headFileName){
		$this->regionHead = $_headFileName;
	}
	
	/**
	 * if you use a different header file it should be located in the templates directory.
	 * @param unknown_type $_headerFileName
	 */
	protected function setHeader($_headerFileName){
		$this->regions['header'] = 'templates/'.$_headerFileName.'.php';
	}
	
	/**
	 * if you use a different footer file it should be located in the templates directory.
	 * @param unknown_type $_footerFileName
	 */
	protected function setFooter($_footerFileName){
		$this->regions['footer'] = 'templates/'.$_footerFileName.'.php';
	}

	/**
	 * here's the place ta add other regions than: head, header, view and footer
	 */
	protected function setOtherRegions($_ohterRegioinsArray){
		foreach ($_ohterRegioinsArray as $k=>$v) {
			if($k != "header" && $k != "footer" && $k != "content") {
				if(file_exists('templates/'.$v.'.php'))
					$this->regions[$k] = 'templates/'.$v.'.php';
			}
		}
	}
	
	protected function setNewView($_ViewFileName){
		$this->regions['content'] = 'view/'.$_ViewFileName.'.php';
	}
	
	protected function getControllerName(){
		return $this->controller;
	}
	
	protected function getRegionHead(){
		return  $this->regionHead;
	}
	
	protected function getRegions(){
		return  $this->regions;
	}
	
	
	/**
	 * set the regions and make the registry accessible
	 */
	protected function assembleView(){
		
		$r_head = $this->getRegionHead();
		$r_regions = $this->getRegions();
		

		$xmlf = dirname($_SERVER["SCRIPT_FILENAME"])."/xml/core.xml";
		if(file_exists($xmlf)){
			//echo 'XML FILE EXISTS: '.$xmlf;
			$xml = simplexml_load_file($xmlf);
			//echo $xml->location->body;
			$this->dcreg->corexml = $xml;
		}
		
		
		$xmlf = dirname($_SERVER["SCRIPT_FILENAME"])."/xml/".$this->controller.'.xml';
		if(file_exists($xmlf)){
			//echo 'XML FILE EXISTS: '.$xmlf;
			$xml = simplexml_load_file($xmlf);
			//echo $xml->location->body;
			$this->dcreg->xml = $xml;
		}
		

		
		
		/**
		 * yep, pretty weird, but it's the only way to access the registry from within the view
		 */
		$dcreg = $this->dcreg;
		
		if(file_exists('templates/page--'.$this->controller.'.php'))
			include 'templates/page--'.$this->controller.'.php';
		else
			include 'templates/page.php';
	
	}
	
	/**
	 * you can define any dynamic data here but don't forget to call assembleView or you have to define everything yourself.
	 * Instantiate your model here to get proper data for your view.
	 */
	abstract public function getView();
}