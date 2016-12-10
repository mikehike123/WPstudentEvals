<?php

/**
 * Admin Form Handler.
 *
 * Handle all form's submissions
 */
class Swimmers_Form_Handler {
    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'admin_init', [ $this, 'handle_swimmers_form_submit' ] );
        add_action( 'admin_init', [ $this, 'handle_swimmers_bulk_action' ] );
        
    }

    /**
     * Handles form data when submitted.
     *
     * @return void
     */
    public function handle_swimmers_form_submit() {
        
        if ( ! isset( $_POST['submit_swimmer'] ) ) {
            
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'mc_new_swimmer' ) ) {
            wp_die( __( 'Go get a life script kiddies', 'mdccoder' ) );
        }

        if ( ! current_user_can( 'read' ) ) {
            wp_die( __( 'Permission Denied!', 'mdccoder' ) );
        }

        $errors   = array();
        $page_url = menu_page_url( 'swimmercrud', false );
        //echo "<h1 style='margin-left:200px'>$page_url</h1>";
        //die();
        $field_id = isset( $_POST['field_id'] ) ? absint( $_POST['field_id'] ) : 0;

        $first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
$last_name = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';


        $fields = array(
            'first_name' => $first_name,
'last_name' => $last_name,

        );

        // New or edit?
        if ( ! $field_id ) {
            $insert_id = mc_insert_swimmer( $fields );
        } else {
            $fields['id'] = $field_id;

            $insert_id = mc_insert_swimmer( $fields );
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
    public function handle_swimmers_bulk_action() {
        $page_url = menu_page_url( 'swimmerscrud', false );

        // Detect when a bulk action is being triggered...
        if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'delete' ) {
            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr( $_REQUEST['_wpnonce'] );

            if ( ! wp_verify_nonce( $nonce, 'mc_delete_swimmer' ) ) {
                die( 'Go get a life script kiddies' );
            } else {
                mc_delete_swimmer( absint( $_REQUEST['id'] ) );

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
                mc_delete_swimmer( $id );
            }

            // Redirect
            $query = array( 'message' => 'deleted');
            $redirect_to = add_query_arg( $query, $page_url );
            wp_redirect( $redirect_to );
            exit;
        }
    }
}