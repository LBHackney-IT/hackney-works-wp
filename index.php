<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero <?php if(has_post_thumbnail()){ echo "hero--with-image"; } ?>">
    <?php if(has_post_thumbnail()): ?>
        <div class="hero__background" style="background-image: url('<?php echo get_the_post_thumbnail_url( null, "full" ); ?>')"></div>
    <?php endif; ?>
    <div class="hero__content">
        <h1 class="hero__title"><?php the_title(); ?></h1>
        <?php if(has_excerpt()): ?>
            <p class="hero__excerpt"><?php echo get_the_excerpt(); ?></p>
        <?php endif; ?>

        <a href="#" class="button hero__call-to-action">Find a course</a>

    </div>
</section>

<article class="page-content">
    <div class="container container--narrow">
        <?php the_content(); ?>
    </div>
</article>

<?php endwhile; else: ?>

<p>Nothing to show</p>

<?php endif; ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>