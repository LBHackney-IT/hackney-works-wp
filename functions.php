<?php

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
        'show_in_nav_menus'     => true,
        "supports" => array("title")
    ));
}
add_action("init", "custom_post_types_init");

// Add editor blocks
function load_block_scripts() {
    wp_enqueue_script(
        "blocks", 
        get_stylesheet_directory_uri()."/dist/js/blocks.js", 
        array("wp-blocks", "wp-element", "wp-block-editor", "wp-components")
    );
}
add_action("enqueue_block_editor_assets", "load_block_scripts");

// Add customiser controls
function add_customizer_stuff( $wp_customize ) {
    $wp_customize->add_section("announcement", array(
        "title" => "Announcement",
        "description" => "Alert users to important, time-sensitive information."
    ));

    $wp_customize->add_setting("show_announcement", array(
        "default" => false,
        "type" => "option"
    ));
    $wp_customize->add_setting("announcement_title", array(
        "type" => "option"
    ));
    $wp_customize->add_setting("announcement_content", array(
        "type" => "option"
    ));
    
    $wp_customize->add_control("show_announcement", array(
        "type" => "checkbox",
        "section" => "announcement",
        "label" => "Show announcement?"
    ));
    $wp_customize->add_control("announcement_title", array(
        "type" => "text",
        "section" => "announcement",
        "label" => "Title"
    ));
    $wp_customize->add_control("announcement_content", array(
        "type" => "textarea",
        "section" => "announcement",
        "label" => "Body"
    ));
}

add_action( 'customize_register', 'add_customizer_stuff' );