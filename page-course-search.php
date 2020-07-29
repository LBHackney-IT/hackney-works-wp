<?php
/* Template Name: Course search */

$search = new WP_Query(array(
    "s" => get_query_var("keywords"),
    "post_type" => "course"
));

get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-image hero--course-search">
    <div class="hero__background" style="background-image: url('<?php echo get_the_post_thumbnail_url( null, "full" ); ?>')"></div>
    <div class="hero__content">
        <h1 class="hero__title"><?php the_title(); ?></h1>
    </div>

    <nav class="course-search container container--mid">
        <form method="get" class="course-search__form">
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

<article class="page-content">
    <div class="container container--mid layout-sidebar-left">
        <aside class="layout-sidebar-left__sidebar">
            Sidebar
        </aside>
        <main class="layout-sidebar-left__main">

        <?php if($search->have_posts()): ?>
            <p class="results-count"><?php echo $search->found_posts; ?> results found</p>
            <ol class="course-results">
                <?php while($search->have_posts()): $search->the_post(); ?>
                <li class="course-results__card">
                    <h2 class="course-results__title"><a class="course-results__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo truncate(get_field("description"), 150); ?></p>
                    <div class="course-results__tags">
                        <?php the_terms(null, "curriculum_areas", null, false); ?>
                    </div>
                </li>
                <?php endwhile; ?>
            </ol>
        <?php else: ?>
            <p>No courses match. Try widening your search.</p>
        <?php endif; ?>

        </main>
    </div>

</article>

<?php endwhile; endif; ?>

<?php get_template_part("call-to-action"); ?>

<?php get_footer(); ?>