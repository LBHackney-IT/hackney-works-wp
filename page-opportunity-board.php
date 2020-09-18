<?php
/* Template Name: Opportunities board */

$search = new WP_Query();
$search->parse_query(array(
    "posts_per_page" => -1,
    "post_type" => array("course", "event", "vacancy"),
    "s" => get_query_var("keywords")
));
relevanssi_do_query( $search );

get_header();

if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero">
    <div class="hero__content">
        <h1 class="hero__title"><?php the_title(); ?></h1>
    </div>
</section>

<article class="page-content">
    <div class="container">

            <?php if($search->have_posts()): ?>

                <p class="results-count">
                    <?php if($search->found_posts == 1): ?>
                        1 matching opportunity
                    <?php else: ?>
                        <?php echo $search->found_posts; ?> matching opportunities
                    <?php endif; ?>
                </p>

                <ol class="card-list card-list--grid">
                    <?php while($search->have_posts()): $search->the_post(); ?>
                    <li class="card-list__card">
                        <p class="card-list__tag"><?php echo ucfirst(get_post_type()); ?></p>
                        <h2 class="card-list__title"><a class="card-list__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php echo truncate(get_field("description"), 130); ?>
                    </li>

                    <?php endwhile; ?>
                </ol>
            <?php else: ?>
                <p class="no-results">No matching courses. Try widening your search.</p>
            <?php endif; ?>
    </div>

</article>

<?php endwhile; endif;

get_template_part("call-to-action");

get_footer();