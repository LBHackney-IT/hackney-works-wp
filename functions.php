<?php

require "inc/opportunities.php";
require "inc/blocks.php";
require "inc/customizer.php";

function lbh_load_scripts_and_styles() {
    wp_enqueue_style("main", get_stylesheet_directory_uri()."/dist/css/main.css");
    wp_enqueue_style("fontawesome", get_stylesheet_directory_uri()."/assets/fontawesome/css/all.min.css");
    wp_enqueue_style("fonts", "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700");
    wp_enqueue_script("maps", "https://maps.googleapis.com/maps/api/js?key=" . GOOGLE_API_KEY);
    wp_enqueue_script("main", get_stylesheet_directory_uri()."/dist/js/main.js");
}
add_action("wp_enqueue_scripts", "lbh_load_scripts_and_styles");

function lbh_load_admin_scripts_and_styles() {
    wp_enqueue_style("fontawesome", get_stylesheet_directory_uri()."/assets/fontawesome/css/all.min.css");
}
add_action("admin_enqueue_scripts", "lbh_load_admin_scripts_and_styles");


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
}
add_action("init", "lbh_custom_post_types_init");

// Configure ACF Google Maps field
function lbh_acf_init() {
    acf_update_setting('google_api_key', GOOGLE_API_KEY);
}
add_action('acf/init', 'lbh_acf_init');