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
                <?php the_field("start_date") ?>
                 <?php if(get_field("end_date")): ?>
                    — <?php the_field("end_date") ?>
                <?php endif; ?><br/>
                <?php the_field("days") ?><br/>
                <?php the_field("start_time") ?> 
                <?php if(get_field("end_time")): ?>
                    to <?php the_field("end_time") ?>
                <?php endif; ?>
            </p>
            <p>Your first session will be on <strong><?php the_field("start_date") ?><?php if(get_field("start_time")){ echo "at " . get_the_field("start_time"); } ?></strong>.</p>
            <?php if(isset($_GET["recipient"])): ?>
                <p>We've sent an email to <?php echo $_GET["recipient"] ?> with these details.</p>
            <?php endif; ?>
            <h2>What happens next?</h2>
            <p>A member of our team will be in touch to chat about your application, normally within 3-5 days.</p>
            <p>At busy times this can take longer.</p>
            <p>We’ll confirm some details and make sure the course is a good fit for you.</p>
            <p>Close to the start date, we’ll put you in touch with your tutor.</p>
            <p>If you have questions, <a href="#">contact us</a>.</p>
        </div>
        </div>
    </div>
</article>

<?php 
endwhile; endif; 


$term_ids = array();
$terms = get_the_terms($course, "curriculum_areas");
if($terms) foreach($terms as $term) $term_ids[] = $term->term_id;

$similar_courses = new WP_Query(array(
    "post_type" => "course",
    "posts_per_page" => 3,
    "post__not_in" => array(get_the_ID()),
    "tax_query" => array(
        array(
            "taxonomy" => "curriculum_areas",
            "terms" => $term_ids
        )
    )
)) ?>

<?php if($similar_courses->have_posts()): ?>
    <section class="page-content similar-courses">
        <div class="container container--mid">
            <h2 class="similar-courses__title">Other courses you might like</h2>
            
            <?php foreach($similar_courses->get_posts() as $similar_course): ?>
                
                <article class="similar-courses__course">
                    <h3 class="similar-courses__course-name">
                        <a class="similar-courses__link" href="<?php echo get_the_permalink($similar_course); ?>"><?php echo get_the_title($similar_course); ?></a>
                    </h3>
                    <?php echo truncate(get_field("description", $similar_course), 80); ?>
                    <ul class="similar-courses__tags">
                        <?php if(get_the_terms($similar_course, "curriculum_areas")): foreach(get_the_terms($similar_course, "curriculum_areas") as $term): ?>
                            <li class="similar-courses__tag"><?php echo $term->name ?></li>
                        <?php endforeach; endif; ?>
                    </ul>
                </article>

            <?php endforeach; ?>

        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>


