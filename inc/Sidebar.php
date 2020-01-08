<?php


class Sidebar {

	// Identifier for this widget.
	private $sid;

	// Data from the option array.
	private $data;
	
	
	// Widgets
	private $widgets = array();
	

	public function __construct($sid) {
		$this->sid = $sid;
	}
	

	private function getWidgets() {
		$this->widgets = \get_option( 'sidebars_widgets' );			
	}
	
	
	public function save() {	
    #$demo_widget_content = 
    // $demo_widget_content[ $counter ] = array ( 'text' => 'The second instance of our amazing demo widget.' );
    $this->data = array('text' => 'Sample content for instance of widget.');

    \update_option($wid, $this->data );    
	}

}