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
));
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

<article class="page-content page-content--deeper-padding">
    <?php if($intakes->have_posts()): ?>
        <?php if($intakes->found_posts > 1): ?>
            <form method="get" action="/" class="mini-apply-form">
                <div class="mini-apply-form__field">
                    <label class="mini-apply-form__label" for="intake">When would you like to study?</label>
                    <select id="intake" class="mini-apply-form__select" name="p">
                        <?php foreach($intakes->get_posts() as $intake): ?>
                            <option value="<?php echo $intake->ID ?>">
                                <?php echo get_the_title($intake); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="mini-apply-form__button">
                    Apply
                    <img src="<?php echo get_stylesheet_directory_uri() . "/assets/right-arrow.svg" ?>" alt="" aria-hidden="true"/>
                </button>
            </form>
        <?php else: 
        $intake = $intakes->get_posts()[0] ?>
            <form method="get" action="/" class="mini-apply-form mini-apply-form--single">
                <input name="p" type="hidden" value="<?php echo $intake->ID ?>"/>
                <div class="mini-apply-form__details">
                    <p>This course runs:</p>
                    <p><?php echo get_the_title($intake); ?></p>
                </div>
                <button class="mini-apply-form__button">
                    Apply
                    <img src="<?php echo get_stylesheet_directory_uri() . "/assets/right-arrow.svg" ?>" alt="" aria-hidden="true"/>
                </button>
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <ul class="key-stats container">
        <li class="key-stats__stat">
            <?php if(get_field("delivered_online")): ?>
                <p>Online</p>
            <?php else: ?>
                <p>In person</p>
            <?php endif; ?>
            <p>Teaching method</p>
        </li>
        <li class="key-stats__stat">
            <p><?php the_field("level"); ?></p>
            <p>Skill level</p>
        </li>
        <li class="key-stats__stat">
            <p>Free</p>
            <p>For Hackney residents</p>
        </li>
    </ul>

    <div class="content-area container container--narrow">
        
        <h2 class="centred">What you'll learn</h2>
        <?php the_field("description") ?>

        <?php if(get_field("entry_requirements")): ?>
            <h2 class="centred">Entry requirements</h2>
            <?php the_field("entry_requirements") ?>
        <?php endif; ?>

        <?php if(get_field("accreditation_details")): ?>
            <h2 class="centred">Accreditation</h2>
            <?php the_field("accreditation_details") ?>
        <?php endif; ?>

        <?php if(get_field("delivery") === "online"): ?>
    </div>
</article>

<section class="online-course-warning">
    <div class="container container--narrow online-course-warning__inner">
        <img class="online-course-warning__icon" src="<?php echo get_stylesheet_directory_uri() . "/assets/video-call.svg" ?>" alt="" aria-hidden="true"/>
        <div class="online-course-warning__content">
            <h2 class="online-course-warning__title">This online course is taught using <strong><?php the_field("online_tool") ?></strong></h2>
            <details>
                <summary>What does this mean for me?</summary>
                <p>Our courses are normally taught in person. To keep people safe during the coronavirus pandemic, we're doing all our teaching online instead.</p>
                <p>You'll need a computer or smartphone with a good internet connection.</p>
                <p>Your tutor will send you detailed instructions before lessons start.</p>
                <p>New to video calls? <a href="/learning-online">See our guide</a></p>
            </details>
        </div>
    </div>
</section>

<article class="page-content page-content--deeper-padding">
    <div class="content-area container container--narrow">
        <?php endif;?>

        <h2 class="centred">Apply for this course</h2>
        <?php if($intakes->have_posts()): ?>
            <div class="intake-tabs" data-tabs>
                <ul class="intake-tabs__tablist" role="tablist">
                    <?php $i = 0; ?>
                    <?php foreach($intakes->get_posts() as $intake): 
                    $datestring = get_field("start_date", $intake);
                    $date = DateTime::createFromFormat("M j, Y", $datestring); ?>
                        <li class="intake-tabs__tab" role="presentation">
                            <a 
                                class="intake-tabs__link" 
                                role="tab" 
                                href="#section-<?php echo $intake->ID ?>" 
                                id="tab-<?php echo $intake->ID ?>"
                                aria-selected="<?php if($i !== 0){ echo "false"; } else { echo "true"; } ?>"
                            >
                                <?php print_r($date->format("M Y"));  ?> 
                            </a>
                        </li>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </ul>
                <?php $i = 0; ?>
                <?php foreach($intakes->get_posts() as $intake): ?>
                    <section 
                        class="intake-tabs__tabpanel" 
                        role="presentation" 
                        role="tabpanel" 
                        id="section-<?php echo $intake->ID ?>" 
                        aria-labelledby="tab-<?php echo $intake->ID ?>" 
                        <?php if($i !== 0){ echo "hidden"; } ?>
                    >
                        <h3 class="intake-tabs__title"><?php echo get_the_title($intake); ?></h3>
                        
                        <p><?php the_field("days", $intake) ?></p>
                        
                        <?php if(get_field("start_time", $intake) && get_field("start_time", $intake)): ?>
                            <p><?php the_field("start_time", $intake) ?> to <?php the_field("end_time", $intake) ?></p>
                        <?php else: ?>
                            <p>From <?php the_field("start_time", $intake) ?></p>
                        <?php endif; ?>

                        <p><?php the_field("description", $intake) ?></p>

                        <a class="intake-tabs__button" href="<?php echo get_the_permalink($intake); ?>">
                            <?php if(get_field("external_application_url", $intake)): ?>
                                Apply on external website
                            <?php else: ?>
                                Apply for these dates
                            <?php endif; ?>
                            <img src="<?php echo get_stylesheet_directory_uri() . "/assets/right-arrow.svg" ?>" alt="" aria-hidden="true"/>
                        </a>
        
                    </section>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>We don't have times and dates for this course yet, but you can still <a href="mailto:sai.wong@hackney.gov.uk">email us to register your interest</a>.</p>
        <?php endif; ?>

        <?php if(get_field("delivery") === "person"): ?>
            <h2 class="centred">Location</h2>
            <section class="media-card media-card--location">
                <img class="dialog__map" src="https://maps.googleapis.com/maps/api/staticmap?key=<?php echo GOOGLE_CLIENT_KEY; ?>&size=500x300&markers=<?php echo get_field('venue')["location"]["lat"] ?>,<?php echo get_field('venue')["location"]["lng"] ?>" alt=""/>
                <div class="media-card__inner">
                    <p class="media-card__address"><?php echo get_field('venue')["location"]["address"]; ?></p>
                    <p><a href="https://www.google.co.uk/maps/search/<?php echo get_field('venue')["location"]["address"]; ?>">Get directions</a>
                    <p><?php echo get_field('venue')["venue_details"]; ?></p>
                </div>
            </section>
        <?php endif; ?>


        <?php if(get_field("show_tutor") && get_field("tutor_name")): ?>
            <h2 class="centred">Who you'll learn with</h2>
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
            <h2 class="centred">Who provides this course?</h2>
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
                        <p><?php echo $term->description ?></p>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</article>

<?php endwhile; endif; ?>

<?php get_template_part("testimonials"); ?>

<?php get_template_part("similar-courses"); ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>