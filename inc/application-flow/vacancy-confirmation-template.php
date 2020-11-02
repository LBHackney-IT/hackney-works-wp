<?php get_header(); 
$intake = new WP_Query($wp->query_vars);
if($intake->have_posts()): while($intake->have_posts()): $intake->the_post();
$course = get_field("parent_course");
?>

<article class="page-content">
    <div class="container container--narrow">
        <div class="confirmation-panel">
        <img class="confirmation-panel__icon" src="<?php echo get_stylesheet_directory_uri() . "/assets/tick-circle.svg" ?>" alt=""/>
        <div>
            <h1 class="confirmation-panel__title">Your application is complete</h1>
            <p>You've applied for:</p>
            <p>
                <a class="confirmation-panel__course-name" href="<?php the_permalink($course); ?>"><?php echo get_the_title($course); ?></a><br/>
            </p>

            <?php if(isset($_GET["recipient"])): ?>
                <p>We've sent an email to <?php echo $_GET["recipient"] ?> with these details.</p>
            <?php endif; ?>

            <h2>What happens next?</h2>
            <p>After the closing date, we'll review applications for this vacancy with the employer.</p>
            <p>We aim to be in touch with shortlisted candidates a few days after the closing date, but at busy times this can take longer.</p>
            <p>If you have questions, <a href="mailto:opportunities@hackney.gov.uk">contact us</a>.</p>
        </div>
        </div>
    </div>
</article>

<?php 
endwhile; endif; 
get_footer(); ?>


