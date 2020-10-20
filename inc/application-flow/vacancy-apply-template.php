<?php
$vacancy = new WP_Query($wp->query_vars);
if($vacancy->have_posts()): while($vacancy->have_posts()): $vacancy->the_post();

// handle external applications
if(get_field("management") === "external"):
    wp_redirect(get_field("external_application_url"));
endif;

get_header(); 

?>

<section class="hero hero--with-breadcrumbs">
    <div class="container">
        <div class="hero__content">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__crumb"><a href="/">Home</a></li>
                <li class="breadcrumbs__crumb"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></li>
                <li class="breadcrumbs__crumb">Apply</li>
            </ul>
            <h1 class="hero__title">Apply</h1>
        </div>
    </div>
</section>

<article class="page-content">
    <div class="container with-sidebar">
        <main class="panel panel--more-padding" data-vacancy-form>
            <!-- React app mounts here -->
            <img class="spinner" src="<?php echo get_stylesheet_directory_uri() . "/assets/spinner.svg" ?>" alt="" />
            <p class="visually-hidden">Loading...</p>
        </main>
        <aside class="layout-sidebar-right__sidebar">
            <div class="panel">
                <h2 class="panel__title">Your chosen vacancy</h2>

                <a class="panel__name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                <?php if(get_field("employer")){ ?>    
                    <p><?php the_field("employer") ?></p>
                <?php } ?>

            </div>
        </aside>
    </div>
</article>

<script>
    __VACANCY_ID__=<?php echo get_the_ID() ?>
</script>

<?php endwhile; endif;
get_footer(); ?>

