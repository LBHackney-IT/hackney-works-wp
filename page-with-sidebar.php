<?php
/* Template Name: Page with sidebar */

get_header(); ?>

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

<div class="page-content">
    <div class="container container--mid with-sidebar">

        <article class="content-area">
            <?php the_content(); ?>

            <p class="last-reviewed">Page last reviewed: <?php echo get_the_modified_date(); ?><p>
        </article>

        <aside class="with-sidebar__sidebar">
            <h2>Related content</h2>
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
        </aside>

    </div>
</div>

<?php endwhile; else: ?>

<p>Nothing to show</p>

<?php endif; ?>

<?php get_template_part("testimonials"); ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>