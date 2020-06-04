<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta content='width=device-width, initial-scale=1.0' name='viewport'>
        <title><?php if(is_home()) echo get_bloginfo('name'); else echo get_the_title() . " | " . get_bloginfo('name'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body class='<?php body_class(); ?>'>

        <div id='main-site-wrapper'>

            <div class='site-header' role='banner'>
                <nav class='nav container'>
                    <div class='nav-left'>
                        <a class="nav-item is-brand bold" href="/hackney_works">Hackney Works</a>
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
                            'theme_location' => 'header-menu',
                            'menu_class' => 'nav-right nav-menu',
                            'container' => ''
                        ) ); 
                    ?>
                </nav>
                <div class='lines'></div>
            </div>