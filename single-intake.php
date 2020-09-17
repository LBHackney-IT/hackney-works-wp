<?php get_header(); 

$course = get_field("parent_course");
if(have_posts()): while(have_posts()): the_post(); 
?>

<section class="hero">
    <div class="hero__content">
        <h1 class="hero__title">Apply</h1>
    </div>
</section>

<article class="page-content">
    <div class="container container--mid layout-sidebar-right">
        <main class="layout-sidebar-right__main" data-apply-form>
            <!-- React app mounts here -->
            <img class="spinner" src="<?php echo get_stylesheet_directory_uri() . "/assets/spinner.svg" ?>" alt="" />
            <p class="visually-hidden">Loading...</p>
        </main>
        <aside class="layout-sidebar-right__sidebar">
            <div class="course-summary">
                <h2 class="course-summary__title">Your chosen course</h2>

                <a class="course-summary__name" href="<?php the_permalink($course); ?>"><?php echo get_the_title($course); ?></a>

                <p><?php the_field("start_date") ?> — <?php the_field("end_date") ?></p>
                <p><?php the_field("days") ?></p>
                <p><?php the_field("start_time") ?> to <?php the_field("end_time") ?></p>


                <?php if(get_field("delivered_online", $course)): ?>
                    <p class="course-summary__important">This course is delivered online using <strong><?php the_field("online_tool", $course); ?></strong>.</p>
                <?php endif; ?>

            </div>
        </aside>
    </div>
</article>

<script>
    __INTAKE_ID__=<?php echo get_the_ID() ?>
</script>

<?php endwhile; endif;
get_footer(); ?>