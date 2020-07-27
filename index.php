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

        <?php if(get_field("call_to_action")): ?>
            <a href="<?php echo get_the_permalink(get_field("call_to_action")) ?>" class="button hero__call-to-action">
                <?php if(get_field("call_to_action_text")){
                    echo get_field("call_to_action_text");
                } else {
                    echo get_the_title(get_field("call_to_action"));
                } ?>
            </a>
        <?php endif; ?>
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