<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero <?php if(has_post_thumbnail()){ echo "hero--with-image"; } ?>">
    
    <?php if(has_post_thumbnail()): ?>
        <div class="hero__background" style="background-image: url('<?php echo get_the_post_thumbnail_url( null, "full" ); ?>')"></div>
    <?php endif; ?>

    <div class="hero__content">
        <h1 class="hero__title"><?php the_title(); ?></h1>
        <p class="hero__excerpt">Part of <?php the_terms($post, "curriculum_areas"); ?></p>
    </div>
</section>

<article class="page-content">

    <form method="get" action="/apply" class="apply-form">
        <div class="apply-form__field">
            <label class="apply-form__label" for="intake">When would you like to study?</label>
            <select id="intake" class="apply-form__select" name="intake">
                <option value="1">January 2020 - August 2020</option>
                <option value="1">September 2020 - December 2020</option>
            </select>
        </div>
        <button class="apply-form__button">Apply</button>
    </form>

    <ul class="key-stats container">
        <li class="key-stats__stat">
            <p>Online</p>
            <p>Course format</p>
        </li>
        <li class="key-stats__stat">
            <p>Big number</p>
            <p>Caption</p>
        </li>
        <li class="key-stats__stat">
            <p>Big number</p>
            <p>Caption</p>
        </li>
    </ul>

    <div class="content-area container container--narrow">
        
        <h2>About the course</h2>
        <?php the_field("description") ?>

    </div>
</article>

<?php endwhile; endif; ?>

<?php get_template_part("testimonials"); ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>