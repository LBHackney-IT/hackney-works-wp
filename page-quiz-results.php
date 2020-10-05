<?php
/* Template Name: Quiz results */

if(get_query_var("type") && in_array("course", get_query_var("type"))){
    $courses = new WP_Query(array(
        "posts_per_page" => -1,
        "post_type" => "course",
        "tax_query" => array(
            array(
                "taxonomy" => "curriculum_areas",
                "field"    => "slug",
                "terms"    => get_query_var("curriculum_areas"),
            ),
        )
    ));
}

if(get_query_var("type") && in_array("vacancy", get_query_var("type"))){
    $vacancies = new WP_Query(array(
        "posts_per_page" => -1,
        "post_type" => "vacancy",
        "tax_query" => array(
            array(
                "taxonomy" => "sectors",
                "field"    => "slug",
                "terms"    => get_query_var("sectors"),
            ),
        )
    ));
}

if(get_query_var("type") && in_array("event", get_query_var("type"))){
    $events = new WP_Query(array(
        "posts_per_page" => -1,
        "post_type" => "event",
        "tax_query" => array(
            array(
                "taxonomy" => "sectors",
                "field"    => "slug",
                "terms"    => get_query_var("sectors"),
            ),
        )
    ));
}

get_header();

if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-breadcrumbs">
    <div class="container">
        <div class="hero__content">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__crumb"><a href="/">Home</a></li>
                <li class="breadcrumbs__crumb"><a href="/quiz">Quiz</a></li>
                <li class="breadcrumbs__crumb">Results</li>
            </ul>
            <h1 class="hero__title"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<div class="page-content">
    <div class="container with-sidebar">

        <article class="panel panel--more-padding content-area">

            <?php if(isset($courses) && $courses->have_posts()): ?>
                <h2>Courses</h2>
                <ol>
                    <?php while($courses->have_posts()): $courses->the_post(); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                </ol>
            <?php endif; ?>
 
            <?php if(isset($vacancies) && $vacancies->have_posts()): ?>
                <h2>Vacancies</h2>
                <ol>
                    <?php while($vacancies->have_posts()): $vacancies->the_post(); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                </ol>
            <?php endif; ?>

            <?php if(isset($events) && $events->have_posts()): ?>
                <h2>Events</h2>
                <ol>
                    <?php while($events->have_posts()): $events->the_post(); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                </ol>
            <?php endif; ?>

        </article>


    </div>
</div>

<?php endwhile; else: ?>

<p>Nothing to show</p>

<?php endif;
get_footer(); ?>