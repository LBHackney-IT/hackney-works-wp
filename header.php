<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
    <?php wp_title("|", true, "right"); ?>
    <?php echo get_bloginfo("name"); ?>
    <?php if(get_bloginfo("description")): ?>
        | <?php echo get_bloginfo("description"); ?>
    <?php endif; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>

<a href="#main-content" class="skip-link">Skip to main content</a>

<section class="beta-banner">
    <div class="container">
        <strong>Beta</strong> 
        <p>This is a brand new service — <a href="https://forms.gle/eGiiK9RPcvsiEtpr5">your feedback</a> helps us improve it.
    </div>    
</section>

<header class="site-header">
    <div class="container">
        <div class="site-header__left">
            <?php the_custom_logo(); ?>
            <?php wp_nav_menu(array(
                "theme_location" => "header-menu",
                "menu_class" => "site-header__main-menu",
                "container" => false,
                "fallback_cb" => false
            )); ?>
        </div>
        <nav class="site-header__right">
            <?php get_search_form(); ?>
            <?php wp_nav_menu(array(
                "theme_location" => "top-header-menu",
                "menu_class" => "site-header__top-menu",
                "container" => false,
                "fallback_cb" => false
            )); ?>
        </nav>
    </div>
</header>

<img class="lines" src="<?php echo get_template_directory_uri(); ?>/assets/lines.svg" alt=""/>