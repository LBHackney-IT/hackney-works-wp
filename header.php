<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta content='width=device-width, initial-scale=1.0' name='viewport'>
        <title><?php if(is_home()) echo get_bloginfo('name'); else echo get_the_title() . " | " . get_bloginfo('name'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(get_field("colour_scheme")); ?>

        <div id='main-site-wrapper'>

            <div class='site-header' role='banner'>
                <nav class='nav container'>
                    <div class='nav-left'>
                        <a class="nav-item is-brand bold" href="<?php echo get_bloginfo("url"); ?>"><?php echo get_bloginfo("name"); ?></a>
                    </div>

                    <span class='nav-toggle'>
                        <span></span>
                        <span></span>
                        <span></span>
                        <div class='txt'>
                            Menu
                        </div>
                    </span>
    
                    <?php 
                        wp_nav_menu( array( 
                            'container' => false,
                            'theme_location' => 'header-menu',
                            'menu_class' => 'nav-right nav-menu'
                        ));

                    ?>
                </nav>
                <?php if(!is_page_template("page-blank.php")): ?>
                    <div class='lines'></div>
                <? endif; ?>
            </div>

            <main class="main section" id="main" role="main">
                <div class="container content is-multiline">

                <?php if(!is_page_template("page-blank.php")): ?>
                    <?php get_template_part("announcement"); ?>
                <? endif; ?>