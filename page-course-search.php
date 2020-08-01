<?php
/* Template Name: Course search */

$only_filters = array(
    "Courses with spaces"
);

$topics = get_terms(array(
    "taxonomy" => "curriculum_areas"
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

<section class="hero hero--with-image hero--course-search">
    <div class="hero__background" style="background-image: url('<?php echo get_the_post_thumbnail_url( null, "full" ); ?>')"></div>
    <div class="hero__content">
        <h1 class="hero__title"><?php the_title(); ?></h1>
    </div>

    <nav class="course-search container container--mid">
        <form method="get" action="#" class="course-search__form">
            <div class="course-search__field">
                <label for="query" class="course-search__label">Search by keyword</label>
                <input id="query" placeholder="eg. improve IT skills" type="search" name="keywords" class="course-search__input" value="<?php echo get_query_var("keywords"); ?>"/>
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
    <div class="container container--mid layout-sidebar-left">
        <aside class="layout-sidebar-left__sidebar">
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
                            <?php foreach($only_filters as $option): ?>
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
                        </div>
                    </fieldset>
                <?php endif; ?>

            </form>
        </aside>
        <main class="layout-sidebar-left__main">
            <?php if($search->have_posts()): ?>
                <p class="results-count">
                    <?php if($search->found_posts == 1): ?>
                        1 matching course
                    <?php else: ?>
                        <?php echo $search->found_posts; ?> matching courses
                    <?php endif; ?>
                </p>

                <ol class="course-results">
                    <?php while($search->have_posts()): $search->the_post(); ?>
                    <li class="course-results__card">
                        <h2 class="course-results__title"><a class="course-results__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php echo truncate(get_field("description"), 130); ?>
                        <ul class="course-results__tags">
                            <?php if(get_field("intake_count")): ?>
                                <li class="course-results__tag course-results__tag--filled">Has spaces</li>
                            <?php endif; ?>
                            <?php if(get_the_terms(null, "curriculum_areas")): foreach(get_the_terms(null, "curriculum_areas") as $term): ?>
                                <li class="course-results__tag"><?php echo $term->name ?></li>
                            <?php endforeach; endif; ?>
                        </ul>
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