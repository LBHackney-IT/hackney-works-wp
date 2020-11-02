<?php get_header();
/* Template Name: Promotional (centred) page */

$featured_opps = new WP_Query(array(
    "post_type" => array("course", "vacancy", "event"),
    "posts_per_page" => 3,
    "meta_query" => array(
        array(
            "key" => "featured",
            "value" => true
        )
    )
));

if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero <?php if(has_post_thumbnail()){ echo "hero--with-image"; } ?>">
    
    <?php if(has_post_thumbnail()): ?>
        <div class="hero__background" style="background-image: url('<?php echo get_the_post_thumbnail_url( null, "full" ); ?>')"></div>
        <img class="hero__lines" src="<?php echo get_template_directory_uri(); ?>/assets/lines-inverted.svg" alt=""/>
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

<article class="page-content page-content--deeper-padding">
    <?php get_template_part("announcement"); ?>



<?php if(is_front_page() && $featured_opps->have_posts()): ?>
    <section class="similar-courses similar-courses--padding-top">
        <div class="container container--mid">
            <h2 class="similar-courses__title">Featured opportunities</h2>
            
            <?php foreach($featured_opps->get_posts() as $opp): ?>
                
                <article class="similar-courses__course">
                    <ul class="similar-courses__tags">
                        <li class="card-list__tag card-list__tag--filled"><?php echo ucfirst(get_post_type($opp)); ?></li>

                        <?php if(get_the_terms($opp, "curriculum_areas")): foreach(get_the_terms($opp, "curriculum_areas") as $term): ?>
                            <li class="similar-courses__tag"><?php echo $term->name ?></li>
                        <?php endforeach; endif; ?>

                        <?php if(get_the_terms($opp, "sectors")): foreach(get_the_terms($opp, "sectors") as $term): ?>
                            <li class="similar-courses__tag"><?php echo $term->name ?></li>
                        <?php endforeach; endif; ?>
                    </ul>
                    <h3 class="similar-courses__course-name">
                        <a class="similar-courses__link" href="<?php echo get_the_permalink($opp); ?>"><?php echo get_the_title($opp); ?></a>
                    </h3>
                    <p><?php echo truncate(strip_tags(get_field("description", $opp)), 90); ?></p>
                </article>

            <?php endforeach; ?>

            <a class="similar-courses__button" href="/opportunities">See all opportunities</a>

        </div>

    </section>
<?php endif; ?>


    <div class="content-area container container--narrow">
        <?php the_content(); ?>
    </div>
</article>

<?php endwhile; else: ?>

<p>Nothing to show</p>

<?php endif; ?>

<?php get_template_part("testimonials"); ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>