<?php

// add_theme_support( 'editor-style' );
// // add_theme_support( 'wp-block-styles' );
// add_editor_style( "/dist/css/editor.css" );


// add_theme_support( 'disable-custom-colors' );
// add_theme_support( 'disable-custom-font-sizes' );

// Add editor blocks
function lbh_load_block_scripts() {

    wp_enqueue_style("main", get_stylesheet_directory_uri()."/dist/css/editor.css");
    wp_enqueue_style("fonts", "https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap");
    
    wp_enqueue_script(
        "blocks", 
        get_stylesheet_directory_uri()."/dist/js/blocks/index.js", 
        array("wp-blocks", "wp-element", "wp-block-editor", "wp-components")
    );
}
add_action("enqueue_block_editor_assets", "lbh_load_block_scripts");

// Add custom block category
function lbh_block_category( $categories, $post ) {
    return array_merge(
        array(
            array(
                "slug" => "hackney",
                "title" => "Hackney"
            ),
        ),
        $categories
    );
}
add_filter( "block_categories", "lbh_block_category", 1, 2 );