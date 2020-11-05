<?php get_header();
if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-breadcrumbs" id="main-content">
    <div class="container">
        <div class="hero__content">
            <?php the_breadcrumbs(); ?>
            <h1 class="hero__title"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<div class="page-content">
    <div class="container with-sidebar">

    <div>
        <?php get_template_part("announcement"); ?>
        <article class="panel panel--more-padding content-area">
            <?php the_content(); ?>
            <p class="last-reviewed">Page last reviewed: <?php echo get_the_modified_date(); ?></p>
        </article>
    </div>

        <aside>
            <?php the_children(); ?>
            <?php $related = get_field('related');
            if ( $related ): ?>
                <div class="panel panel--sticky">
                    <h2 class="panel__title">Related content</h2>
                    <ul class='related-content-list'>
                        <?php foreach($related as $post):
                            echo "<li>";
                            echo "<a href='" . get_the_permalink($post) . "'>" . get_the_title($post) . "</a>";
                            echo "</li>";
                        endforeach; 
                        wp_reset_postdata(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </aside>

    </div>
</div>

<?php endwhile; else: ?>

<p>Nothing to show</p>

<?php endif; ?>

<?php get_template_part("testimonials"); ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>



