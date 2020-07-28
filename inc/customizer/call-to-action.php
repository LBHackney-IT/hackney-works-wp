<?php 

// Add customiser controls
function lbh_add_customizer_cta( $wp_customize ) {
    $wp_customize->add_section("cta", array(
        "title" => "Call to action",
        "description" => "The call to action at the bottom of most pages."
    ));

    $wp_customize->add_setting("show_cta", array(
        "type" => "option"
    ));
    $wp_customize->add_setting("cta_title", array(
        "type" => "option"
    ));
    $wp_customize->add_setting("cta_content", array(
        "type" => "option"
    ));
    $wp_customize->add_setting("cta_link_label", array(
        "type" => "option"
    ));
    $wp_customize->add_setting("cta_link", array(
        "type" => "option"
    ));
    
    $wp_customize->add_control("show_cta", array(
        "type" => "checkbox",
        "section" => "cta",
        "label" => "Show call to action?"
    ));
    $wp_customize->add_control("cta_title", array(
        "type" => "text",
        "section" => "cta",
        "label" => "Title"
    ));
    $wp_customize->add_control("cta_content", array(
        "type" => "textarea",
        "section" => "cta",
        "label" => "Body"
    ));
    $wp_customize->add_control("cta_link_label", array(
        "type" => "text",
        "section" => "cta",
        "label" => "Link text"
    ));
    $wp_customize->add_control("cta_link", array(
        "section" => "cta",
        'type' => 'text',
        "label" => "Link"
    ));
}
add_action( "customize_register", "lbh_add_customizer_cta" );