<?php
/* Template Name: Course search */

get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-image hero--course-search">
    <div class="hero__background" style="background-image: url('<?php echo get_the_post_thumbnail_url( null, "full" ); ?>')"></div>
    <div class="hero__content">
        <h1 class="hero__title"><?php the_title(); ?></h1>
    </div>
</section>

<article class="page-content">
    <div class="container">

    Testing.

    </div>
</article>

<?php endwhile; endif; ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>