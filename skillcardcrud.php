<?php
/*
Plugin Name: Skillcardcrud
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



class Skillcardcrud {
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
            include dirname( __FILE__ ) . '/includes/skill_cards-functions.php';
            

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
        //echo "<h1 style='margin-left:200px'>Create Skill Card Table</h1>";
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'skill_cards';

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            name varchar(255) DEFAULT '' NOT NULL,
shortName varchar(255) DEFAULT '' NOT NULL,

            date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY id (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

}

class Swimmerscrud {
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
            //include dirname( __FILE__ ) . '/includes/swimmers-functions.php';
              include dirname( __FILE__ ) . '/includes/swimmers-functions.php';

            //new Admin_Menu();
        }
        //echo "<h1 style='margin-left:200px'>Create Swimmer Table</h1>";
        register_activation_hook( __FILE__, array( $this, 'create_swim_table' ) );
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
    public function create_swim_table() {
        
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'swimmers';

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            first_name varchar(255) DEFAULT '' NOT NULL,
last_name varchar(255) DEFAULT '' NOT NULL,

            date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY id (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

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

            //new Admin_Menu();
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
            //include dirname( __FILE__ ) . '/includes/admin/class-admin-menu.php';
            include dirname( __FILE__ ) . '/includes/skill_levels-functions.php';

            //new Admin_Menu();
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





Skillcardcrud::get_instance();

Skillscrud::get_instance();

Swimmerscrud::get_instance();

Skilllevelscrud::get_instance();