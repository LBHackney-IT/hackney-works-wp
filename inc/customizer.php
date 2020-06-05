<?php

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
add_action( "customize_register", "add_customizer_stuff" );