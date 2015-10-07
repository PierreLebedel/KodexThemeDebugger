<?php

class Kodex_Theme_Debugger_Public {

	private $plugin_title;
	private $plugin_name;
	private $version;

	public function __construct( $plugin_title, $plugin_name, $version ) {

		$this->plugin_title = $plugin_title;
		$this->plugin_name  = $plugin_name;
		$this->version      = $version;

	}

	public function enqueue_styles() {
		
		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/kodex-theme-debugger-public.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/kodex-theme-debugger-public.js', array( 'jquery' ), $this->version, false );

	}

}
