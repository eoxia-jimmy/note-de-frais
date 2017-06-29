<?php
/**
 * Initialise les fichiers .config.json
 *
 * @package Eoxia\Plugin
 *
 * @since 1.0.0.0
 * @version 1.0.0.0
 */

namespace note_de_frais;

if ( ! defined( 'ABSPATH' ) ) {	exit; }

/**
 * Initialise les scripts JS et CSS du Plugin
 * Ainsi que le fichier MO
 */
class Note_De_Frais_Action {

	/**
	 * Le constructeur ajoutes les actions WordPress suivantes:
	 * admin_enqueue_scripts (Pour appeller les scripts JS et CSS dans l'admin)
	 * admin_print_scripts (Pour appeler les scripts JS en bas du footer)
	 * plugins_loaded (Pour appeler le domaine de traduction)
	 */
	public function __construct() {
		// Initialises ses actions que si nous sommes sur une des pages réglés dans le fichier digirisk.config.json dans la clé "insert_scripts_pages".
		$page = ( ! empty( $_REQUEST['page'] ) ) ? sanitize_text_field( $_REQUEST['page'] ) : '';

		if ( in_array( $page, \eoxia\Config_Util::$init['note-de-frais']->insert_scripts_pages_css, true ) ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'callback_before_admin_enqueue_scripts_css' ), 10 );
			add_action( 'admin_enqueue_scripts', array( $this, 'callback_admin_enqueue_scripts_css' ), 11 );
			add_action( 'admin_print_scripts', array( $this, 'callback_admin_print_scripts_css' ) );
		}

		if ( in_array( $page, \eoxia\Config_Util::$init['note-de-frais']->insert_scripts_pages_js, true ) ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'callback_before_admin_enqueue_scripts_js' ), 10 );
			add_action( 'admin_enqueue_scripts', array( $this, 'callback_admin_enqueue_scripts_js' ), 11 );
			add_action( 'admin_print_scripts', array( $this, 'callback_admin_print_scripts_js' ) );
		}

		add_action( 'init', array( $this, 'callback_plugins_loaded' ) );
		add_action( 'admin_menu', array( $this, 'callback_admin_menu' ), 12 );
	}

	/**
	 * Initialise les fichiers JS inclus dans WordPress (jQuery, wp.media et thickbox)
	 *
	 * @return void nothing
	 *
	 * @since 1.0
	 * @version 6.2.5.0
	 */
	public function callback_before_admin_enqueue_scripts_js() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-form' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_media();
		add_thickbox();
	}

	/**
	 * Initialise le fichier style.min.css et backend.min.js du plugin DigiRisk.
	 *
	 * @return void nothing
	 *
	 * @since 1.0
	 * @version 6.2.7.0
	 */
	public function callback_admin_enqueue_scripts_js() {
		// wp_enqueue_script( 'digi-script', PLUGIN_DIGIRISK_URL . 'core/assets/js/backend.min.js', array(), \eoxia\Config_Util::$init['digirisk']->version, false );
		// wp_enqueue_script( 'digi-script-owl-carousel', PLUGIN_DIGIRISK_URL . 'core/assets/js/owl.carousel.min.js', array(), \eoxia\Config_Util::$init['digirisk']->version, false );
		// wp_enqueue_script( 'digi-script-datetimepicker-script', PLUGIN_DIGIRISK_URL . 'core/assets/js/jquery.datetimepicker.full.js', array(), \eoxia\Config_Util::$init['digirisk']->version );
	}

	/**
	 * Initialise en php le fichier permettant la traduction des variables string JavaScript.
	 *
	 * @return void nothing
	 *
	 * @since 1.0
	 * @version 6.2.5.0
	 */
	public function callback_admin_print_scripts_js() {
		require( PLUGIN_DIGIRISK_PATH . '/core/assets/js/define-string.js.php' );
	}

	/**
	 * Initialise les fichiers JS inclus dans WordPress (jQuery, wp.media et thickbox)
	 *
	 * @return void nothing
	 *
	 * @since 1.0
	 * @version 6.2.5.0
	 */
	public function callback_before_admin_enqueue_scripts_css() {
	}

	/**
	 * Initialise le fichier style.min.css et backend.min.js du plugin DigiRisk.
	 *
	 * @return void nothing
	 *
	 * @since 1.0
	 * @version 6.2.7.0
	 */
	public function callback_admin_enqueue_scripts_css() {
		// wp_register_style( 'digi-style', PLUGIN_DIGIRISK_URL . 'core/assets/css/style.min.css', array(), \eoxia\Config_Util::$init['digirisk']->version );
		// wp_enqueue_style( 'digi-style' );
		//
		// wp_enqueue_style( 'digi-datepicker', PLUGIN_DIGIRISK_URL . 'core/assets/css/jquery.datetimepicker.css', array(), \eoxia\Config_Util::$init['digirisk']->version );
		// wp_enqueue_style( 'digi-owl-carousel', PLUGIN_DIGIRISK_URL . 'core/assets/css/owl.carousel.min.css', array(), \eoxia\Config_Util::$init['digirisk']->version );
	}

	/**
	 * Initialise en php le fichier permettant la traduction des variables string JavaScript.
	 *
	 * @return void nothing
	 *
	 * @since 1.0
	 * @version 6.2.5.0
	 */
	public function callback_admin_print_scripts_css() {
	}

	/**
	 * Initialise le fichier MO
	 *
	 * @since 1.0
	 * @version 6.2.5.0
	 */
	public function callback_plugins_loaded() {
	}

	/**
	 * Définition du menu dans l'administration de wordpress pour Digirisk / Define the menu for wordpress administration
	 *
	 * @since 1.0.0.0
	 * @version 1.0.0.0
	 */
	public function callback_admin_menu() {
		add_menu_page( __( 'Note de frais', 'note-de-frais' ), __( 'Note de frais', 'note-de-frais' ), 'manage_options', 'note-de-frais', array( Note_De_Frais_Class::g(), 'display' ) );
	}

}

new Note_De_Frais_Action();
