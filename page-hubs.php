<?php
/* Template Name: Hubs/meet the team */

$query = new WP_Query( array('post_type' => 'hub' ) );

get_header();
if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-breadcrumbs">
    <div class="container">
        <div class="hero__content">
            <?php the_breadcrumbs(); ?>
            <h1 class="hero__title"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<div class="page-content">
    <div class="container hubs">

        <?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
            <div class="hubs__hub">
                <div class="hubs__inner">
                    <h2><?php the_title(); ?></h2>
                    <p><?php echo get_field('location')["address"]; ?></p>
                </div>
                <div class="hubs__map" data-latitude="<?php echo get_field('location')["lat"]; ?>" data-longitude="<?php echo get_field('location')["lng"]; ?>" data-zoom="15">Loading map...</div>
            </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>

    </div>
</div>

<?php endwhile; else: ?>


<?php endif;

get_template_part("call-to-action");

get_footer(); ?>