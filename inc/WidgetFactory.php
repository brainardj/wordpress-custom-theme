<?php


class WidgetFactory extends Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct($name = null) {
		$widget_ops = array( 
			'classname' => 'widgetfactory',
			'description' => 'My Widget is awesome',
		);
		parent::__construct( 'widgetfactory', 'Default Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args = array(), $instance = null) {
		// outputs the content of the widget
		echo "<h3>Wireframe generic widget</h3>";
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance = null ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance = null, $old_instance = null ) {
		// processes widget options to be saved
	}
}