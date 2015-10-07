<?php

/**
 * Plugin Name:       Kodex Theme debugger
 * Plugin URI:        http://kodex.pierros.fr/
 * Description:       A WordPress plugin to debug your theme during the development
 * Version:           1.0.0
 * Author:            Pierre Lebedel
 * Author URI:        http://www.pierros.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kodex
 * Domain Path:       /languages
 */

if(!defined('WPINC')) die;

register_activation_hook( __FILE__, 'activate_kodex_theme_debugger' );
function activate_kodex_theme_debugger() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kodex-theme-debugger-activator.php';
	Kodex_Theme_Debugger_Activator::activate();
}

register_deactivation_hook( __FILE__, 'deactivate_kodex_theme_debugger' );
function deactivate_kodex_theme_debugger() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kodex-theme-debugger-deactivator.php';
	Kodex_Theme_Debugger_Deactivator::deactivate();
}

require plugin_dir_path( __FILE__ ) . 'includes/class-kodex-theme-debugger.php';
$plugin = new Kodex_Theme_Debugger();
