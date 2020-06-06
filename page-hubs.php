<?php 
/* Template Name: Hubs */
$query = new WP_Query( array('post_type' => 'hub' ) );
?>

<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
        <h2><?php the_title(); ?></h2>
        <p><?php echo get_field('location')["address"]; ?></p>
        <?php edit_post_link(); ?>
        <hr/>
    <?php endwhile; endif; wp_reset_postdata(); ?>

    <?php the_content(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>