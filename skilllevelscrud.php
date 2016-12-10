<?php
/*
Plugin Name: Skilllevelscrud
Plugin URI: http://www.appzcoder.com
Description: A sample plugin.
Version: 0.1
Author: Sohel Amin
Author URI: http://www.sohelamin.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Skilllevelscrud {
    /**
     * Instance of this class.
     *
     * @var static
     */
    protected static $instance;

    /**
     * Constructor.
     *
     * @param mixed
     */
    public function __construct() {
        if ( is_admin() ) {
            include dirname( __FILE__ ) . '/includes/admin/class-admin-menu.php';
            include dirname( __FILE__ ) . '/includes/skill_levels-functions.php';

            new Admin_Menu();
        }

        register_activation_hook( __FILE__, array( $this, 'create_table' ) );
    }

    /**
     * Singleton instance.
     *
     * @return object
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Create relevant table.
     *
     * @return mixed
     */
    public function create_table() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'skill_levels';

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            name varchar(255) DEFAULT '' NOT NULL,
short_name varchar(255) DEFAULT '' NOT NULL,

            date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY id (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

}

Skilllevelscrud::get_instance();