<?php

add_action( 'init', 'lbh_rewrite_urls' );
function lbh_rewrite_urls() {
    add_rewrite_rule( 'apply/?$', 'index.php?apply=1', 'top' );
}

add_filter( 'query_vars', 'lbh_add_query_vars' );
function lbh_add_query_vars( $query_vars ) {
    $query_vars[] = 'apply';
    $query_vars[] = 'course';
    $query_vars[] = 'intake';
    return $query_vars;
}

add_action( 'parse_request', 'lbh_parse_request' );
function lbh_parse_request( &$wp ) {
    if ( array_key_exists( 'apply', $wp->query_vars ) ) {
        include 'apply-template.php';
        exit();
    }
    return;
}