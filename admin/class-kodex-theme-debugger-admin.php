<?php

class Kodex_Theme_Debugger_Admin {

	private $plugin_title;
	private $plugin_name;
	private $version;
	private $message;
	private $tabs;
	private $tab;

	public function __construct( $plugin_title, $plugin_name, $version ) {
		$this->plugin_title = $plugin_title;
		$this->plugin_name  = $plugin_name;
		$this->version      = $version;
		$this->message      = '';

		$this->set_tabs();
	}

	public function debug($var, $info=''){
		echo '<div style="padding:5px 10px; margin-bottom:8px; font-size:13px; background:#FACFD3; color:#8E0E12; line-height:16px; border:1px solid #8E0E12; text-transform:none; overflow:auto;">';
			echo (!empty($info)) ? '<h3 style="color:#8E0E12; font-size:16px; padding:5px 0;">'.$info.'</h3>' : '';
			echo '<pre style="white-space:pre-wrap;">'.print_r($var,true).'</pre>
		</div>';
	}

	private function set_tabs(){
		$this->tabs = array(
			'rewriterules' => __("Rewrite rules", 'kodex'),
			'shortcodes'   => __("Shortcodes", 'kodex'),
			'posttypes'    => __("Post types & taxonomies", 'kodex'),
			'settings'     => __("Settings", 'kodex'),
		);
		$this->tab = (isset($_GET['tab']) && array_key_exists($_GET['tab'], $this->tabs)) ? $_GET['tab'] : key($this->tabs);
	}

	public function set_message($msg){
		$this->message = '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"><p><strong>'.$msg.'</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Ne pas tenir compte de ce message.</span></button></div>';
	}

	public function admin_menu(){
		add_management_page($this->plugin_title, $this->plugin_title, 'manage_options', $this->plugin_name, array($this, 'admin_page') );
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/kodex-theme-debugger-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/kodex-theme-debugger-admin.js', array( 'jquery' ), $this->version, false );
	}

	public function admin_url($tab=''){
		$url = add_query_arg('tab', $tab);
		$url = remove_query_arg('action', $url);
		return $url;
	}

	public function get_bool_icon($bool){
		if($bool){
			return '<span class="dashicons dashicons-yes"></span>';
		}else{
			return '<span class="dashicons dashicons-no-alt"></span>';
		}
	}

	public function admin_page_header(){
		?><div class="wrap">
			<h1><?php echo $this->plugin_title; ?></h1>
			<h2 class="nav-tab-wrapper">
			<?php foreach($this->tabs as $k=>$v): ?>
				<a href="<?php echo $this->admin_url($k); ?>" class="nav-tab <?php echo ($k==$this->tab) ? 'nav-tab-active' : ''; ?>"> <?php echo $v; ?></a>   
			<?php endforeach; ?>
			</h2><br><?php
		
		echo $this->message;
	}

	public function admin_page_footer(){
		echo '</div>';
	}

	public function admin_page(){
		if(file_exists(plugin_dir_path( __FILE__ ).'partials/part-'.$this->tab.'.php')){
			require(plugin_dir_path( __FILE__ ).'partials/part-'.$this->tab.'.php');
		}else{
			$this->admin_page_header();
			echo '<p>'.__("Page not found", 'kodex').'</p>';
			$this->admin_page_footer();
		}
	}

}
