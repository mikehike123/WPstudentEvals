<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Skillscrud {
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
            //include dirname( __FILE__ ) . '/includes/admin/class-admin-menu.php';
            include dirname( __FILE__ ) . '/includes/skills-functions.php';

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
        $table_name = $wpdb->prefix . 'skills';

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            skill_card_id varchar(255) DEFAULT '' NOT NULL,
name varchar(255) DEFAULT '' NOT NULL,
short_name varchar(255) DEFAULT '' NOT NULL,

            date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY id (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

}

//Skillscrud::get_instance();