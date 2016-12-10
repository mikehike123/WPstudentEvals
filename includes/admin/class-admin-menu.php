<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Admin Menu
 */
class Admin_Menu {
    /**
     * Constructor.
     *
     * @param void
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'plugin_menu' ) );

        include dirname( __FILE__ ) . '/../class-skill_cards-list-table.php';
        include dirname( __FILE__ ) . '/../class-skills-list-table.php';
        include dirname( __FILE__ ) . '/../class-skill_levels-list-table.php';
        include dirname( __FILE__ ) . '/../class-swimmers-list-table.php';
        
        
        include dirname( __FILE__ ) . '/class-skill_cards-form-handler.php';
        include dirname( __FILE__ ) . '/class-skill_levels-form-handler.php';
        include dirname( __FILE__ ) . '/class-skills-form-handler.php';
        include dirname( __FILE__ ) . '/class-swimmers-form-handler.php';
        
        new Skill_Cards_Form_Handler();
        new Skills_Form_Handler();
        new Swimmers_Form_Handler();
        new Skill_Levels_Form_Handler();

    }

    /**
     * Registering plugin menu.
     *
     * @return void
     */
    public function plugin_menu() {
        // Add to admin_menu function
        //add_menu_page(__('My Menu Page'), __('My Menu'), 'edit_themes', 'my_new_menu', 'my_menu_render', '', 7); 
        $hook = add_menu_page(
            'Swim Admin Page',
            'SwimAdmin',
            'manage_options',
            'swim_admin',
            array($this,'swim_admin_render'),
            '', null
        );
        
        add_submenu_page('swim_admin', __('Skill Cards Page'), __('Skill Cards Menu'), 'edit_themes', 'skillcardcrud', 
        array( $this, 'plugin_settings_skill_cards_page' ),
            'dashicons-groups', null
        );
        
        //hide the sub menu
        add_submenu_page(null, __('Skills Page'), __('Skills Menu'), 'edit_themes', 'skillcrud', 
        array( $this, 'plugin_settings_skills_page' ),
            'dashicons-groups', null
        );
        
        //hide the sub menu
        add_submenu_page('swim_admin', __('Skills Levels Page'), __('Skills Levels Menu'), 'edit_themes', 'skilllevelscrud', 
        array( $this, 'plugin_skill_levels_settings_page' ),
            'dashicons-groups', null
        );
        
        
        add_submenu_page('swim_admin', __('Swimmers Page'), __('Swimmers Menu'), 'edit_themes', 'swimmercrud', 
        array( $this, 'plugin_settings_swimmers_page' ),
            'dashicons-groups', null
        );
    }
    /**
    * Render Admin Menu
    *
    * @return html to render
    *
    */
    public function swim_admin_render()
    {
        echo "<h1>Swim Admin</h1>";
    }
    /**
     * Plugin settings for skill cards page.
     *
     * @return void
     */
    public function plugin_settings_skill_cards_page() {
        $action     = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id         = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        $template   = '';

        switch ($action) {
            case 'view':
                $template = dirname( __FILE__ ) . '/views_skill_cards/skill_card-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/views_skill_cards/skill_card-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/views_skill_cards/skill_card-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/views_skill_cards/skill_cards.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include( $template );
        }
    }
    /**
     * Plugin settings for swimmers page.
     *
     * @return void
     */
    public function plugin_settings_swimmers_page() {
        $action     = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id         = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        $template   = '';

        switch ($action) {
            case 'view':
                $template = dirname( __FILE__ ) . '/views_swimmers/swimmer-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/views_swimmers/swimmer-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/views_swimmers/swimmer-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/views_swimmers/swimmers.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include( $template );
        }
    }
    
    /**
     * Plugin settings for skills page.
     *
     * @return void
     */
    public function plugin_settings_skills_page() {
        $action     = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id         = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        $template   = '';

        switch ($action) {
            case 'view':
                $template = dirname( __FILE__ ) . '/views_skills/skill-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/views_skills/skill-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/views_skills/skill-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/views_skills/skills.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include( $template );
        }
    }
    
    /**
     * Plugin settings page.
     *
     * @return void
     */
    public function plugin_skill_levels_settings_page() {
        $action     = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id         = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        $template   = '';

        switch ($action) {
            case 'view':
                $template = dirname( __FILE__ ) . '/views/skill_level-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/views/skill_level-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/views/skill_level-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/views/skill_levels.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include( $template );
        }
    }
}