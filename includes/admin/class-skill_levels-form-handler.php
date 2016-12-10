<?php

/**
 * Admin Form Handler.
 *
 * Handle all form's submissions
 */
class Skill_Levels_Form_Handler {
    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'admin_init', [ $this, 'handle_skill_levels_form_submit' ] );
        add_action( 'admin_init', [ $this, 'handle_skill_levels_bulk_action' ] );
    }

    /**
     * Handles form data when submitted.
     *
     * @return void
     */
    public function handle_skill_levels_form_submit() {
        if ( ! isset( $_POST['submit_skill_level'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'mc_new_skill_level' ) ) {
            wp_die( __( 'Go get a life script kiddies', 'mdccoder' ) );
        }

        if ( ! current_user_can( 'read' ) ) {
            wp_die( __( 'Permission Denied!', 'mdccoder' ) );
        }

        $errors   = array();
        $page_url = menu_page_url( 'skilllevelscrud', false );
        $field_id = isset( $_POST['field_id'] ) ? absint( $_POST['field_id'] ) : 0;

        $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
$short_name = isset( $_POST['short_name'] ) ? sanitize_text_field( $_POST['short_name'] ) : '';


        $fields = array(
            'name' => $name,
'short_name' => $short_name,

        );

        // New or edit?
        if ( ! $field_id ) {
            $insert_id = mc_insert_skill_level( $fields );
        } else {
            $fields['id'] = $field_id;

            $insert_id = mc_insert_skill_level( $fields );
        }

        if ( is_wp_error( $insert_id ) ) {
            $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
        } else {
            $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
        }

        // Redirect
        wp_redirect( $redirect_to );
        exit;
    }

    /**
     * Handles bulk action and delete.
     *
     * @return void
     */
    public function handle_skill_levels_bulk_action() {
        $page_url = menu_page_url( 'skilllevelscrud', false );

        // Detect when a bulk action is being triggered...
        if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'delete' ) {
            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr( $_REQUEST['_wpnonce'] );

            if ( ! wp_verify_nonce( $nonce, 'mc_delete_skill_level' ) ) {
                die( 'Go get a life script kiddies' );
            } else {
                mc_delete_skill_level( absint( $_REQUEST['id'] ) );

                // Redirect
                $query = array( 'message' => 'deleted');
                $redirect_to = add_query_arg( $query, $page_url );
                wp_redirect( $redirect_to );
                exit;
            }
        }

        // If the delete bulk action is triggered
        if ( ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'bulk-delete' )
             || ( isset( $_REQUEST['action2'] ) && $_REQUEST['action2'] == 'bulk-delete' )
        ) {
            $delete_ids = esc_sql( $_REQUEST['bulk-delete'] );

            // loop over the array of record ids and delete them
            foreach ( $delete_ids as $id ) {
                mc_delete_skill_level( $id );
            }

            // Redirect
            $query = array( 'message' => 'deleted');
            $redirect_to = add_query_arg( $query, $page_url );
            wp_redirect( $redirect_to );
            exit;
        }
    }
}