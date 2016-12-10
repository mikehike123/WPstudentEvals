<?php
// Exit if not defined uninstall
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

function uninstall_skillcardcrud() {
    global $wpdb;

    $table_name = $wpdb->prefix . "skill_cards";
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

uninstall_skillcardcrud();

function uninstall_swimmerscrud() {
    global $wpdb;

    $table_name = $wpdb->prefix . "swimmers";
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

uninstall_swimmerscrud();