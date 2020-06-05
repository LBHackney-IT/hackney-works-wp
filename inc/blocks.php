<?php

// Add editor blocks
function load_block_scripts() {
    wp_enqueue_script(
        "blocks", 
        get_stylesheet_directory_uri()."/dist/js/blocks.js", 
        array("wp-blocks", "wp-element", "wp-block-editor", "wp-components")
    );
}
add_action("enqueue_block_editor_assets", "load_block_scripts");

// Add custom block category
function lbh_block_category( $categories, $post ) {
    return array_merge(
        array(
            array(
                "slug" => "hackney",
                "title" => "Hackney",
                // "icon"  => "wordpress",
            ),
        ),
        $categories
    );
}
add_filter( "block_categories", "lbh_block_category", 1, 2 );

// Render a dynamic block
function register_opportuntunities_block() {
    register_block_type("lbh/opportunities-teaser", array(
        "render_callback" => "render_oppportunities_block"
    ));
}
add_action("init", "register_opportuntunities_block");

function render_oppportunities_block($attributes) {
    ob_start();
    ?>
        <div>
            <h2><?php echo $attributes['title']; ?></h2>
            <div><?php echo $attributes['content']; ?></div>
            <p>Loading opportunities...</p>
        </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}