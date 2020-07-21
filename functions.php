<?php

require "inc/customizer.php";
require "inc/custom-fields.php";

function lbh_load_scripts_and_styles() {
    wp_enqueue_style("main", get_stylesheet_directory_uri()."/dist/css/main.css");
    wp_enqueue_script("main", get_stylesheet_directory_uri()."/dist/js/main.js");
}
add_action("wp_enqueue_scripts", "lbh_load_scripts_and_styles");

function lbh_load_admin_scripts_and_styles() {
    wp_enqueue_style("fontawesome", get_stylesheet_directory_uri()."/assets/fontawesome/css/all.min.css");
}
add_action("admin_enqueue_scripts", "lbh_load_admin_scripts_and_styles");

add_theme_support( 'post-thumbnails' );

function lbh_register_menus() {
    register_nav_menus(
        array(
            "header-menu" => __( "Header area" ),
            "footer-left-menu" => __( "Left footer area" ),
            "footer-right-menu" => __( "Right footer area" )
        )
    );
}
add_action( "init", "lbh_register_menus" );

function lbh_custom_post_types_init() {
    register_post_type("hub", array(
        "label" => __("Hubs"),
        "public" => true,
        "menu_icon" => "dashicons-location",
        "show_in_nav_menus"     => true,
        "supports" => array("title")
    ));

    register_post_type("course", array(
        "label" => __("Courses"),
        "public" => true,
        "menu_icon" => "dashicons-welcome-learn-more",
        "show_in_nav_menus" => true,
        "show_in_rest" => true,
        "supports" => array("title", "thumbnail")
    ));

    register_post_type("intake", array(
        "label" => __("Intakes"),
        "public" => true,
        "menu_icon" => "dashicons-groups",
        "show_in_nav_menus" => true,
        "show_in_rest" => true,
        "supports" => array("title")
    ));

    register_post_type("testimonial", array(
        "label" => __("Testimonials"),
        "public" => true,
        "menu_icon" => "dashicons-format-quote",
        "show_in_nav_menus" => true,
        "show_in_rest" => true,
        "supports" => array("title", "editor", "thumbnail")
    ));
}
add_action("init", "lbh_custom_post_types_init");

 
function lbh_create_custom_taxonomies() { 
  register_taxonomy('curriculum_areas', 'course', array(
    "hierarchical" => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true
  ));

  register_taxonomy('providers', 'course', array(
    "labels" => array(
        "name" => "Providers",
        "singular_name" => "Provider",
        "add_new_item" => "Add New Course Provider",
        "separate_items_with_commas" => "Separate multiple providers with commas",
        "choose_from_most_used" => "Choose from the most used providers",
        "not_found" => "No providers found"
    ),
    "hierarchical" => false,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true
  ));
}
add_action('init', 'lbh_create_custom_taxonomies', 0 );

// Configure ACF Google Maps field
function lbh_acf_init() {
    acf_update_setting('google_api_key', GOOGLE_API_KEY);
}
add_action('acf/init', 'lbh_acf_init');

// Don't use the gutenberg editor for testimonials
function lbh_disable_gutenberg_posts( $current_status, $post_type ) {
    $disabled_post_types = array( 'testimonial' );
    if ( in_array( $post_type, $disabled_post_types, true ) ) {
        $current_status = false;
    }
    return $current_status;
}
add_filter( 'use_block_editor_for_post_type', 'lbh_disable_gutenberg_posts', 10, 2 );