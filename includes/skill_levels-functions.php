<?php
/**
 * Retrieve skill_level data from the database.
 *
 * @param int $id
 *
 * @return object
 */
function mc_get_skill_level( $id = 0 ) {
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}skill_levels WHERE id = %d", $id ) );
}

/**
 * Retrieve skill_levels data from the database.
 *
 * @param int $per_page
 * @param int $page_number
 *
 * @return array
 */
function mc_get_skill_levels( $args = null ) {
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC',
        'count'   => false,
    ];

    $args = wp_parse_args( $args, $defaults );

    if ( $args['count'] ) {
        $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}skill_levels";
    } else {
        $sql = "SELECT * FROM {$wpdb->prefix}skill_levels";
    }

    if ( ! empty( $args['s'] ) ) {
        $sql .= ' WHERE name LIKE "%' . esc_sql( $args['s'] ) . '%"' ;
    }

    if ( ! empty( $args['orderby'] ) ) {
        $sql .= ' ORDER BY ' . esc_sql( $args['orderby'] );
        $sql .= ! empty( $args['order'] ) ? ' ' . esc_sql( $args['order'] ) : ' ASC';
    }

    if ( $args['number'] != '-1' && ! $args['count'] ) {
        $sql .= ' LIMIT ' . $args['number'];
        $sql .= ' OFFSET ' . $args['offset'];
    }

    if ( $args['count'] ) {
        $result = $wpdb->get_var( $sql );
    } else {
        $result = $wpdb->get_results( $sql);
    }

    return $result;
}

/**
 * Delete a skill_level record.
 *
 * @param  int $id skill_level id
 *
 * @return boolean
 */
function mc_delete_skill_level( $id ) {
    global $wpdb;

    return $wpdb->delete(
        "{$wpdb->prefix}skill_levels",
        [ 'id' => $id ],
        [ '%d' ]
    );
}

/**
 * Insert a new skill_levels.
 *
 * @param boolean
 */
function mc_insert_skill_level( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id' => null,
        'name' => '',
'short_name' => '',

    );

    $args       = wp_parse_args( $args, $defaults );
    $table_name = $wpdb->prefix . 'skill_levels';

    // remove row id to determine if new or update
    $row_id = (int) $args['id'];
    unset( $args['id'] );

    if ( ! $row_id ) {
        $args['date'] = current_time( 'mysql' );

        // insert a new
        if ( $wpdb->insert( $table_name, $args ) ) {
            return $wpdb->insert_id;
        }
    } else {
        // do update method here
        if ( $wpdb->update( $table_name, $args, array( 'id' => $row_id ) ) ) {
            return $row_id;
        }
    }

    return false;
}