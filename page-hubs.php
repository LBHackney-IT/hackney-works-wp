<?php 
/* Template Name: Hubs */
$query = new WP_Query( array('post_type' => 'hub' ) );
?>

<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <br/>

    <div id="hubs">
        <?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
            <div class="box hub">
                <h2><?php the_title(); ?></h2>
                <p><?php echo get_field('location')["address"]; ?></p>
                <div class="map-holder" data-latitude="<?php echo get_field('location')["lat"]; ?>" data-longitude="<?php echo get_field('location')["lng"]; ?>" data-zoom="15">Loading map...</div>
                <?php edit_post_link(); ?>
            </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>

    <div class="box top hubs">
        <?php the_content(); ?>
    </div

<?php endwhile; endif; ?>

<?php get_footer(); ?>