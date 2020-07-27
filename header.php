<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title("|", true, "right"); ?><?php echo get_bloginfo("name"); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>

<section class="beta-banner">
    <div class="container">
        <strong>Beta</strong> 
        <p>This is a brand new service — <a href="#">your feedback</a> helps us improve it.
    </div>    
</section>

<header class="site-header">
    <div class="site-header__masthead">
        <div class="container">
            <?php the_custom_logo(); ?>

            <nav class="site-header__top-navigation">
                <?php get_search_form(); ?>
                <?php wp_nav_menu(array(
                    "theme_location" => "top-header-menu",
                    "menu_class" => "site-header__top-menu",
                    "container" => false,
                    "fallback_cb" => false
                )); ?>
            </nav>
        </div>
    </div>

    <nav class="site-header__navigation">
        <div class="container">
            <?php wp_nav_menu(array(
                "theme_location" => "header-menu",
                "menu_class" => "site-header__main-menu",
                "container" => false,
                "fallback_cb" => false
            )); ?>
        </div>
    </nav>
</header>