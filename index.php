<?php get_header(); ?>

<?php get_template_part("announcement"); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>