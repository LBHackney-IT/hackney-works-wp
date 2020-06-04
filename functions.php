<?php

function load_scripts_and_styles() {
    wp_enqueue_style("main", get_stylesheet_directory_uri()."/dist/css/main.css");
    wp_enqueue_style("fonts", "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700");
    wp_enqueue_script("main", get_stylesheet_directory_uri()."/dist/js/main.js");
}

add_action("wp_enqueue_scripts", "load_scripts_and_styles");


function load_block_scripts() {
    wp_enqueue_script("blocks", get_stylesheet_directory_uri()."/dist/js/blocks.js", array("wp-blocks", "wp-element"));
}

add_action("enqueue_block_editor_assets", "load_block_scripts");