<?php

require "inc/blocks.php";
require "inc/customizer.php";

function load_scripts_and_styles() {
    wp_enqueue_style("main", get_stylesheet_directory_uri()."/dist/css/main.css");
    wp_enqueue_style("fonts", "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700");
    wp_enqueue_script("main", get_stylesheet_directory_uri()."/dist/js/main.js");
}
add_action("wp_enqueue_scripts", "load_scripts_and_styles");

function register_menus() {
    register_nav_menus(
        array(
            "header-menu" => __( "Header area" ),
            "footer-left-menu" => __( "Left footer area" ),
            "footer-right-menu" => __( "Right footer area" )
        )
    );
}
add_action( "init", "register_menus" );

function custom_post_types_init() {
    register_post_type("hub", array(
        "label" => __("Hubs"),
        "public" => true,
        "menu_icon" => "dashicons-location",
        "show_in_nav_menus"     => true,
        "supports" => array("title")
    ));
}
add_action("init", "custom_post_types_init");