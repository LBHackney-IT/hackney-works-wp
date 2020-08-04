<?php 
$term_ids = array();
$terms = get_the_terms($post, "curriculum_areas");
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
            <h2 class="similar-courses__title">Similar courses</h2>
            
            <?php foreach($similar_courses->get_posts() as $course): ?>
                
                <article class="similar-courses__course">
                    <h3 class="similar-courses__course-name">
                        <a class="similar-courses__link" href="<?php echo get_the_permalink($course); ?>"><?php echo get_the_title($course); ?></a>
                    </h3>
                    <p><?php echo truncate(get_field("description", $course), 80); ?></p>
                    <ul class="similar-courses__tags">
                        <?php if(get_the_terms($course, "curriculum_areas")): foreach(get_the_terms($course, "curriculum_areas") as $term): ?>
                            <li class="similar-courses__tag"><?php echo $term->name ?></li>
                        <?php endforeach; endif; ?>
                    </ul>
                </article>

            <?php endforeach; ?>

        </div>
    </section>
<?php endif; ?>