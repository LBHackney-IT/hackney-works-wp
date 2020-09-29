<?php
/* Template Name: Page with sidebar */

get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-breadcrumbs">
    <div class="container">
        <div class="hero__content">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__crumb"><a href="/">Home</a></li>
                <li class="breadcrumbs__crumb"><?php the_title(); ?></li>
            </ul>
            <h1 class="hero__title"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<div class="page-content">
    <div class="container with-sidebar">

        <article class="panel content-area">
            <?php the_content(); ?>
            <p class="last-reviewed">Page last reviewed: <?php echo get_the_modified_date(); ?><p>
        </article>

        <aside>
            <div class="panel panel--sticky">
                    <h2 class="panel__title">Related content</h2>
                    <ul class='related-content-list'>
                    <?php $related = get_field('related');
                    if ( $related ):
                        foreach($related as $post):
                            echo "<li>";
                            echo "<a href='" . get_the_permalink($post) . "'>" . get_the_title($post) . "</a>";
                            echo "</li>";
                        endforeach;
                    endif; ?>
                </ul>
            </div>
        </aside>

    </div>
</div>

<?php endwhile; else: ?>

<p>Nothing to show</p>

<?php endif; ?>

<?php get_template_part("testimonials"); ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>