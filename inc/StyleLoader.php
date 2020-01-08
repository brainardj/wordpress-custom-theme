<?php


class StyleLoader {

	// Identifier for this widget.
	private $wpStyles;

	// Data from the option array.
	private $data;



	public function __construct() {
		$this->wpStyles = \wp_styles();
	}
	
	
	public function getRegistered() {	
  	 return $this->wpStyles->registered;
	}

}



function debug_styles(){
	$loader = new StyleLoader();
	return "<pre>".print_r($loader->getRegistered(),true)."</pre>";
}