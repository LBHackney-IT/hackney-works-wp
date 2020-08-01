<?php get_header(); 
$intake = new WP_Query($wp->query_vars);
$course = get_field("parent_course");

if($intake->have_posts()): while($intake->have_posts()): $intake->the_post(); ?>


    <section class="hero">
        <div class="hero__content">
            <h1 class="hero__title">Application complete</h1>
        </div>
    </section>

    <p><?php the_field("start_date") ?> — <?php the_field("end_date") ?></p>
    <p><?php the_field("days") ?></p>
    <p><?php the_field("start_time") ?> to <?php the_field("end_time") ?></p>


<?php 
endwhile; endif;
get_footer(); ?>