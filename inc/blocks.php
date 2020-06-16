<?php

add_theme_support( 'align-wide' );
add_theme_support('editor-styles');
add_editor_style( "/dist/css/editor.css" );

// Add editor blocks
function lbh_load_block_scripts() {
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

// Render a dynamic block
function lbh_register_blocks() {
    register_block_type("lbh/opportunities-teaser", array(
        "render_callback" => "lbh_render_oppportunities_block"
    ));
    register_block_type("lbh/hero", array(
        "render_callback" => "lbh_render_hero_block"
    ));
}
add_action("init", "lbh_register_blocks");

function lbh_render_oppportunities_block($attributes) {
    $opportunities = array_slice(fetch_opportunities(), 0, 3);
    ob_start();
    ?>
        <div id="featured_opps">
            <h2><?php echo $attributes['title']; ?></h2>
            <p class="large"><?php echo $attributes['content']; ?></p>
            <br/>
            <div class="container">
                <div class="opportunity_list columns">
                    <?php 
                        if($opportunities): 
                        $i = 0;
                        while($i < count($opportunities)):

                    ?>
                        <div class="single_opportunity column is-one-third">
                            <div class="box">
                                <div class="opportunity_tags">
                                    <div class="tag">
                                        <?php echo $opportunities[$i]->actable_type ?>
                                    </div>
                                </div>
                                <div class="opportunity_title"><?php echo $opportunities[$i]->actable->title ?></div>
                                <p class="opportunity_description"><?php echo $opportunities[$i]->actable->short_description ?></p>
                            </div>
                        </div>
                    <?php 
                        $i++;
                        endwhile; 
                        endif;
                    ?>
                </div>
            </div>
            <br/>
            <br/>
            <a class="button is-primary" href="/opportunities">View all opportunities</a>
        </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function lbh_render_hero_block($attributes) {
    ob_start();
    ?>
        <div class="full-width hero">
            <div class="bg_img">
                <img class="parralax_me" id="parralax_me" src="<?php echo $attributes['background']; ?>" alt="" aria-hidden="true">
            </div>
            <div class="container columns main">
                <div class="column is-one-thrid" id="logo">
                    <img alt="Hackney Works" src="<?php echo get_stylesheet_directory_uri() ?>/assets/hackney-works-white.svg">
                </div>
                <div class="column is-two-thirds">
                    <h1><?php echo $attributes['title']; ?></h1>
                    <p><?php echo $attributes['content']; ?></p>
                </div>
            </div>
            <div class="lines"></div>
        </div>
        <?php if(is_page_template("page-blank.php")): ?>
            <?php get_template_part("announcement"); ?>
        <? endif; ?>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}