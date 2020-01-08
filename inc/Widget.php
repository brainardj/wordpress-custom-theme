<?php


class Widget extends WP_Widget {

	// Identifier for this widget.
	private $wid;

	// Data from the option array.
	private $data;
	
	private $widget_ops;

	public function __construct($wid) {
		parent::__construct( 'widgetfactory', 'Default Widget', $this->widget_ops );
		$this->data = \get_option($wid, array() );
	}
	
	
	public function save() {	
    #$demo_widget_content = 
    // $demo_widget_content[ $counter ] = array ( 'text' => 'The second instance of our amazing demo widget.' );
    $this->data = array('text' => 'Sample content for instance of widget.');

    \update_option($wid, $this->data );    
	}

}