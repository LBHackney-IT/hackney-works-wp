<?php get_header();

if(have_posts()): while(have_posts()): the_post(); 

$intakes = new WP_Query(array(
    "post_type" => "intake",
    "meta_key" => "start_date",
    "orderby" => "meta_value_num",
    "order" => "ASC",
    "meta_query" => array(
        array(
            "key" => "parent_course",
            "value" => get_the_id()
        )                   
    ),
))

?>

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
                <?php foreach($intakes->get_posts() as $intake): ?>
                    <option value="<?php echo $intake->ID ?>">
                        <?php the_field("start_date", $intake) ?> — <?php the_field("end_date", $intake) ?>
                    </option>
                <?php endforeach; ?>
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

        <h2>Entry requirements</h2>
        <?php the_field("entry_requirements") ?>

        <?php if(get_field("show_tutor") && get_field("tutor_name")): ?>
            <h2>Who you'll learn with</h2>
            <section class="media-card">
                <?php if(get_field("tutor_headshot")):
                    echo wp_get_attachment_image( get_field("tutor_headshot"), "medium" );
                endif; ?>
                <div class="media-card__inner">
                    <h3><?php the_field("tutor_name") ?></h3>
                    <?php the_field("tutor_biography") ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_the_terms(null, "providers")): ?>
            <h2>Who provides this course?</h2>
            <?php foreach(get_the_terms(null, "providers") as $term): ?>
                <section class="media-card">
                    <div class="media-card__inner">
                        <?php if(get_field("website_url", $term)): ?>
                            <h3>
                                <a href="<?php the_field("website_url", $term) ?>"><?php echo $term->name ?></a>
                            </h3>
                        <?php else: ?>
                            <h3><?php echo $term->name; ?></h3>
                        <?php endif; ?>
                        <?php echo $term->description ?>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</article>

<?php endwhile; endif; ?>

<?php get_template_part("testimonials"); ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>