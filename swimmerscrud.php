<?php


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
              include dirname( __FILE__ ) . '/skill_card_includes/swimmers-functions.php';

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
        echo "<h1 style='margin-left:200px'>Create Swimmer Table</h1>";
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

