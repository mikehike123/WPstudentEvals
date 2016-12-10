<?php
if ( ! class_exists( 'WP_List_table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/**
 * Swimmers_List_Table class
 */
class Swimmers_List_Table extends WP_List_Table {
    /**
     * Constructor.
     *
     * @param void
     */
    public function __construct() {
        parent::__construct( array(
            'singular' => __( 'Swimmer', 'mdccoder' ),
            'plural'   => __( 'Swimmers', 'mdccoder' ),
            'ajax'     => false
        ) );
    }

    /**
     * Message to be displayed when there are no items.
     *
     * @return void
     */
    public function no_items() {
        _e( 'No swimmers avaliable.', 'mdccoder' );
    }

    /**
     * Render a column when no column specific method exist.
     *
     * @param array  $item
     * @param string $column_name
     *
     * @return void
     */
    public function column_default( $item, $column_name ) {
        switch ( $column_name ) {
                
            case 'first_name':
                
case 'last_name':

                return $item->{$column_name};
            default:
                return print_r( $item, true );
        }
    }

    /**
     * Render the bulk edit checkbox.
     *
     * @param array $item
     *
     * @return string
     */
    function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item->id
        );
    }

    /**
     * Generates the columns for a single row of the table.
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_first_name( $item ) {
        
        $delete_nonce = wp_create_nonce( 'mc_delete_swimmer' );

        $title = '<strong>' . $item->first_name . '</strong>';

        $actions = [
            'edit'   => sprintf( '<a href="?page=%s&action=%s&id=%d">Edit</a>',  esc_attr( $_REQUEST['page'] ), 'edit', absint( $item->id ) ),
            'delete' => sprintf( '<a href="?page=%s&action=%s&id=%d&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item->id ), $delete_nonce )
        ];

        return sprintf( '<a href="?page=%s&action=%s&id=%d">%s</a>',  esc_attr( $_REQUEST['page'] ), 'view', absint( $item->id ), $title ) . $this->row_actions( $actions );
    }

    /**
     *  Get a list of columns.
     *
     * @return array
     */
    function get_columns() {
        $columns = [
            'cb' => '<input type="checkbox" />',
            'first_name' => __( 'First Name', 'mdccoder' ),
'last_name' => __( 'Last Name', 'mdccoder' ),

        ];

        return $columns;
    }

    /**
     * Get a list of sortable columns.
     *
     * @return array
     */
    public function get_sortable_columns() {
        $sortable_columns = array(
            'first_name' => array( 'first_name', true ),
'last_name' => array( 'last_name', true ),

        );

        return $sortable_columns;
    }

    /**
     * Returns an associative array containing the bulk action.
     *
     * @return array
     */
    public function get_bulk_actions() {
        $actions = [
            'bulk-delete' => 'Delete'
        ];

        return $actions;
    }

    /**
     * Prepares the list of items for displaying.
     *
     * @return void
     */
    public function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array( $columns, $hidden, $sortable );

        // Query parameters
        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $orderby      = ( ! empty( $_REQUEST['orderby'] ) ) ? $_REQUEST['orderby'] : 'id';
        $order        = ( ! empty( $_REQUEST['order'] ) ) ? $_REQUEST['order'] : 'DESC';
        $s            = ( ! empty( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : '';
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number'  => $per_page,
            'offset'  => $offset,
            'orderby' => $orderby,
            'order'   => $order,
            'count'   => true,
            's'       => $s,
        ];

        $total_items  = mc_get_swimmers( $args );

        $this->set_pagination_args( [
            'total_items' => $total_items,
            'per_page'    => $per_page
        ] );

        unset( $args['count'] );

        $this->items = mc_get_swimmers( $args );
    }
}