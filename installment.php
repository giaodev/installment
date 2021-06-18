<?php
/**
 * @package installment
 */
/*
Plugin Name: Installment
Plugin URI: https://giaodev.com/
Description: Used by millions, installment is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: activate the installment plugin and then go to your installment Settings page to set up your API key.
Version: 4.1.9
Author: Giao Vu
Author URI: https://giaodev.com/
License: GPLv2 or later
Text Domain: installment
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Giao Vu, Inc.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'INSTALLMENT_VERSION', '1.0.0' );
define( 'INSTALLMENT__MINIMUM_WP_VERSION', '4.0' );
define( 'INSTALLMENT__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'INSTALLMENT_DELETE_LIMIT', 100000 );

register_activation_hook( __FILE__, array( 'Installment', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( '(Installment', 'plugin_deactivation' ) );

require_once( INSTALLMENT__PLUGIN_DIR . 'class.installment.php' );
require_once( INSTALLMENT__PLUGIN_DIR . 'class.installment-widget.php' );
// require_once( INSTALLMENT__PLUGIN_DIR . 'class.installment-rest-api.php' );

add_action( 'init', array( 'Installment', 'init' ) );

add_action( 'rest_api_init', array( 'Installment_REST_API', 'init' ) );

if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( INSTALLMENT__PLUGIN_DIR . 'class.installment-admin.php' );
	add_action( 'init', array( 'Installment_Admin', 'init' ) );
}

//add wrapper class around deprecated installment functions that are referenced elsewhere
// require_once( INSTALLMENT__PLUGIN_DIR . 'wrapper.php' );

// if ( defined( 'WP_CLI' ) && WP_CLI ) {
// 	require_once( INSTALLMENT__PLUGIN_DIR . 'class.installment-cli.php' );
// }
