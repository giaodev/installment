<?php
class Installment_Admin {

	private static $initiated = false;
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
		self::$initiated = true;
		self::getSettings();
		/* dang ky menu */
		add_action( 'admin_menu', array('Installment_Admin','wpdocs_register_my_custom_menu_page'));
		/* dang ky setting */
		add_action('admin_init', array(__CLASS__,'add_settings'));
	}
	/* khoi tao menu */
	public static function wpdocs_register_my_custom_menu_page() {
	    add_menu_page(
	        __( 'Installment', 'installment' ),
	        'Installment',
	        'manage_options',
	        'custompage',
	        array('Installment_Admin','my_custom_menu_page'),
	        plugins_url( 'myplugin/images/icon.png' ),
	        65
	    );
	}
	/* custom menu page */
	public static function my_custom_menu_page(){
		esc_html_e( 'Admin Page Test', 'installment' ); 
		if ( is_file( plugin_dir_path( __FILE__ ) . 'includes/layout.php' ) ) {
		    include_once plugin_dir_path( __FILE__ ) . 'includes/layout.php';
		}
	}
	public static function getSettings() {
	    return get_option( 'wpdocs_ebtech_modules_option' );
	}
	public static function add_settings(){
		register_setting( 'mygroup', 'installment-id' );
		add_settings_field( 'installment-id',
		    'Installment Settings',
		    array(__CLASS__,'installment_setting_callback_function'),
		    'general',
		    'installment_settings-section-name',
		    array( 'label_for' => 'installment_setting-id' ) );
	}
	public static function installment_setting_callback_function(){

	}
	
}
