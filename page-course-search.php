<?php
/* Template Name: Course search */

$topics = get_terms(array(
    "taxonomy" => "curriculum_areas",
    "meta_key" => "show_as_filter",
    "meta_value" => "topic"
));

$custom_only_filters = array(
    "Courses with spaces"
);

$only_filters = get_terms(array(
    "taxonomy" => "curriculum_areas",
    "meta_key" => "show_as_filter",
    "meta_value" => "only"
));

$tax_query = null;
if(get_query_var("topic")){
    $tax_query = array(
        array(
            "taxonomy" => "curriculum_areas",
            "field"    => "slug",
            "terms"    => get_query_var("topic"),
        ),
    );
}

$meta_query = null;
if(get_query_var("only") && in_array("courses-with-spaces", get_query_var("only"))){
    $meta_query = array(
        array(
            "key" => "intake_count",
            "value" => 0,
            "compare" => ">"
        )
    );
}

$search = new WP_Query();
$search->parse_query(array(
    "posts_per_page" => -1,
    "post_type" => "course",
    "s" => get_query_var("keywords"),
    "tax_query" => $tax_query,
    "meta_query" => $meta_query
));
relevanssi_do_query( $search );


get_header();

if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-image hero--course-search" id="main-content">
    <div class="hero__background" style="background-image: url('<?php echo get_the_post_thumbnail_url( null, "full" ); ?>')"></div>
    <img class="hero__lines" src="<?php echo get_template_directory_uri(); ?>/assets/lines-inverted.svg" alt=""/>
    <div class="hero__content">
        <h1 class="hero__title"><?php the_title(); ?></h1>
    </div>

    <nav class="course-search container container--mid">
        <form method="get" action="#" class="course-search__form">
            <div class="course-search__field">
                <label for="query" class="course-search__label">Search by keyword</label>
                <input id="query" placeholder="eg. improve IT skills" type="search" name="keywords" class="course-search__input" value="<?php echo stripslashes(esc_attr(get_query_var("keywords"))) ?>"/>
                <?php if(get_query_var("keywords")): ?>
                    <a class="course-search__clear" href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . "/assets/cross.svg" ?>" alt="Clear search"/></a>
                <?php endif; ?>
            </div>
            <button class="course-search__button">Search</button>
        </form>

        <div class="course-search__popular">
            <h2 class="course-search__popular-title">Browse</h2>
            <?php wp_nav_menu(array(
                "theme_location" => "popular-courses-menu",
                "menu_class" => "course-search__menu",
                "container" => false,
                "fallback_cb" => false
            )); ?>
        </div>
    </nav>

</section>

<article class="page-content" id="results">
    <div class="container container--mid with-sidebar with-sidebar--reversed">
        <aside class="">
            <form method="get" action="#results">

                <input name="keywords" type="hidden" value="<?php echo get_query_var("keywords"); ?>"/>

                <fieldset class="course-filter" data-togglable>
                    <button class="course-filter__toggle" aria-expanded="true">
                        <legend class="course-filter__legend">Topic</legend>
                    </button>
                    <div class="course-filter__body">
                        <?php foreach($topics as $topic): ?>
                            <div class="course-filter__field">
                                <input 
                                    onchange="this.form.submit()" 
                                    type="checkbox" 
                                    name="topic[]" 
                                    value="<?php echo $topic->slug ?>" 
                                    id="<?php echo $topic->term_id ?>"
                                    <?php if( get_query_var("topic") && in_array($topic->slug, get_query_var("topic")) ){ 
                                        echo "checked";
                                     } ?>
                                />
                                <label for="<?php echo $topic->term_id ?>"><?php echo $topic->name ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>

                <?php if(isset($only_filters)): ?>
                    <fieldset class="course-filter" data-togglable>
                        <button class="course-filter__toggle" aria-expanded="true">
                            <legend class="course-filter__legend">Only show</legend>
                        </button>
                        <div class="course-filter__body">
                            <?php foreach($custom_only_filters as $option): ?>
                                <div class="course-filter__field">
                                    <input 
                                        onchange="this.form.submit()" 
                                        type="checkbox" 
                                        name="only[]" 
                                        value="<?php echo sanitize_title($option); ?>" 
                                        id="<?php echo sanitize_title($option); ?>"
                                        <?php if( get_query_var("only") && in_array(sanitize_title($option), get_query_var("only")) ){ 
                                            echo "checked";
                                        } ?>
                                    />
                                    <label for="<?php echo sanitize_title($option); ?>"><?php echo $option; ?></label>
                                </div>
                            <?php endforeach; ?>

                            <?php foreach($only_filters as $option): ?>
                                <div class="course-filter__field">
                                    <input 
                                        onchange="this.form.submit()" 
                                        type="checkbox" 
                                        name="topic[]" 
                                        value="<?php echo $option->slug ?>" 
                                        id="<?php echo $option->term_id ?>"
                                        <?php if( get_query_var("topic") && in_array($option->slug, get_query_var("topic")) ){ 
                                            echo "checked";
                                        } ?>
                                    />
                                    <label for="<?php echo $option->term_id ?>"><?php echo $option->name ?></label>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </fieldset>
                <?php endif; ?>

            </form>
        </aside>
        <main class="">
            <?php if($search->have_posts()): ?>

                <?php get_template_part("announcement"); ?>

                <p class="results-count">
                    <?php if($search->found_posts == 1): ?>
                        1 matching course
                    <?php else: ?>
                        <?php echo $search->found_posts; ?> matching courses
                    <?php endif; ?>
                </p>

                <ol class="card-list">
                    <?php while($search->have_posts()): $search->the_post(); ?>
                    <li class="card-list__card">
                        <ul class="card-list__tags card-list__tags--with-bottom-margin">
                            <?php if(get_field("intake_count")): ?>
                                <li class="card-list__tag card-list__tag--filled">Has spaces</li>
                            <?php endif; ?>
                            <?php if(get_the_terms(null, "curriculum_areas")): foreach(get_the_terms(null, "curriculum_areas") as $term): ?>
                                <li class="card-list__tag"><?php echo $term->name ?></li>
                            <?php endforeach; endif; ?>
                        </ul>
                        <h2 class="card-list__title"><a class="card-list__link card-list__link--grey" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="card-list__description"><?php echo truncate(strip_tags(get_field("description")), 130); ?></p>
                    </li>

                    <?php endwhile; ?>
                </ol>
            <?php else: ?>
                <p class="no-results">No matching courses. Try widening your search.</p>
            <?php endif; ?>
        </main>
    </div>

</article>

<?php endwhile; endif;

get_template_part("call-to-action");

get_footer();