<?php


class WidgetManager {

	
	

	public function __construct() {
		$this->getActiveWidgets();
	}



	private function getActiveWidgets() {
		$this->widgets = \get_option( 'sidebars_widgets' );			
	}


	public function getWidgets( $sid ) {
		return $this->activeWidgets[$sid];
	}


	public function hasWidgets( $sid ) {
		return !empty($this->activeWidgets);
	}
	
	
	public function addWidget($wid,$sid) {
    
    $widgets = $this->getWidgets($sid);
    
    // Add a widget to an existing sidebar.
    $widgets[] = $wid;
    
    $this->activeWidgets = $widgets;
	}




}