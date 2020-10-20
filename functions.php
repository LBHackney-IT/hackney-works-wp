<?php

require "inc/customizer/announcement.php";
require "inc/customizer/call-to-action.php";

require "inc/application-flow/index.php";

require "inc/breadcrumbs.php";
require "inc/children.php";
require "inc/post-types.php";
require "inc/taxonomies.php";
require "inc/blocks.php";
require "inc/course-search.php";

require "inc/custom-fields.php";

add_editor_style( 'dist/css/editor.css' );

function lbh_load_scripts_and_styles() {
    wp_enqueue_style("main", get_stylesheet_directory_uri()."/dist/css/index.css");
    wp_enqueue_style("fonts", "https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap");
    // wp_enqueue_style("fontawesome", get_stylesheet_directory_uri()."/assets/fontawesome/css/all.min.css");
    wp_enqueue_script("main", get_stylesheet_directory_uri()."/dist/js/index.js");
}
add_action("wp_enqueue_scripts", "lbh_load_scripts_and_styles");


add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails' );

add_post_type_support( 'page', 'excerpt' );

function lbh_register_menus() {
    register_nav_menus(
        array(
            "header-menu" => __( "Header area" ),
            "top-header-menu" => __( "Top header area" ),
            "footer-left-menu" => __( "Left footer area" ),
            "footer-right-menu" => __( "Right footer area" ),
            "popular-courses-menu" => __( "Popular courses" )
        )
    );
}
add_action( "init", "lbh_register_menus" );

// Configure ACF Google Maps field
function lbh_acf_init() {
    acf_update_setting('google_api_key', GOOGLE_CLIENT_KEY);
}
add_action('acf/init', 'lbh_acf_init');


function lo_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'lo_custom_excerpt_length', 999 );

function lo_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'lo_excerpt_more');


// Add query vars for course search
function lbh_course_search_query_vars($qvars) {
    $qvars[] = 'keywords';
    $qvars[] = 'topic';
    $qvars[] = 'only';
    $qvars[] = 'type';
    // for quiz
    $qvars[] = 'sectors';
    $qvars[] = 'curriculum_areas';
    return $qvars;
}
add_filter( 'query_vars', 'lbh_course_search_query_vars' );


function truncate($text, $length){
    if ($length >= \strlen($text)) {
        return $text;
    }
    return preg_replace(
        "/^(.{1,$length})(\s.*|$)/s",
        '\\1...',
        $text
    );
}