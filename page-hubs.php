<?php 
/* Template Name: Hubs */
$query = new WP_Query( array('post_type' => 'hub' ) );
?>

<?php get_header(); ?>

<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>

    <?php the_title(); ?>
    <?php the_content(); ?>

<?php endwhile; endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>