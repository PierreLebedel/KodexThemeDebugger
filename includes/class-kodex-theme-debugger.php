<?php

class Kodex_Theme_Debugger {

	protected $loader;
	protected $plugin_title;
	protected $plugin_name;
	protected $domain;
	protected $version;

	public function __construct() {
		$this->plugin_title = 'Kodex Theme debugger';
		$this->plugin_name  = 'kodex-theme-debugger';
		$this->version      = '1.0.0';
		$this->domain       = 'kodex';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		$this->run();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-kodex-theme-debugger-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-kodex-theme-debugger-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-kodex-theme-debugger-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-kodex-theme-debugger-public.php';

		$this->loader = new Kodex_Theme_Debugger_Loader();
	}

	private function set_locale() {
		$plugin_i18n = new Kodex_Theme_Debugger_i18n();
		$plugin_i18n->set_domain( $this->get_domain() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_admin_hooks() {
		$plugin_admin = new Kodex_Theme_Debugger_Admin( $this->get_plugin_title(), $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
	}

	private function define_public_hooks() {
		$plugin_public = new Kodex_Theme_Debugger_Public( $this->get_plugin_title(), $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_title() {
		return $this->plugin_title;
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

	public function get_domain() {
		return $this->domain;
	}

}
