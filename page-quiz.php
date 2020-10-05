<?php
/* Template Name: Quiz */

$types = array(
    "Courses" => "course",
    "Events" => "event",
    "Vacancies" => "vacancy"
);

$sectors = get_terms("sectors");
$curriculum_areas = get_terms("curriculum_areas");

get_header();

if(have_posts()): while(have_posts()): the_post(); ?>

<section class="hero hero--with-breadcrumbs">
    <div class="container">
        <div class="hero__content">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__crumb"><a href="/">Home</a></li>
                <li class="breadcrumbs__crumb">Quiz</li>
            </ul>
            <h1 class="hero__title"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<div class="page-content">
    <div class="container with-sidebar">

        <article class="panel panel--more-padding content-area">
            <form method="get" action="/quiz/results">

                <fieldset>
                    <legend>What are you interested in seeing?</legend>
                    <?php foreach($types as $key => $value): ?>
                        <input id="type-<?php echo $value ?>" type="checkbox" name="type[]" value="<?php echo $value ?>" />
                        <label for="type-<?php echo $value ?>"><?php echo $key ?></label>
                        <br/>
                    <?php endforeach; ?>
                </fieldset>

                <fieldset>
                    <legend>What sectors do you want to work in?</legend>
                    <p><small>We'll use this to find relevant vacancies or industry events</small></p>
                    <?php foreach($sectors as $sector): ?>
                        <input id="type-<?php echo $sector->slug ?>" type="checkbox" name="sectors[]" value="<?php echo $sector->slug ?>"/>
                        <label for="type-<?php echo $sector->slug ?>"><?php echo $sector->name ?></label>
                        <br/>
                    <?php endforeach; ?>
                </fieldset>

                <fieldset>
                    <legend>What kinds of skills do you want to improve?</legend>
                    <p><small>We'll use this to find courses for you</small></p>
                    <?php foreach($curriculum_areas as $sector): ?>
                        <input id="type-<?php echo $sector->slug ?>" type="checkbox" name="curriculum_areas[]" value="<?php echo $sector->slug ?>"/>
                        <label for="type-<?php echo $sector->slug ?>"><?php echo $sector->name ?></label>
                        <br/>
                    <?php endforeach; ?>
                </fieldset>

                <button>See results</button>
            </form>

        </article>

        <aside>
            <div class="panel">
                <h2 class="panel__title">Your answers so far</h2>
                <p>Based on your answers, you could be eligible for:</p>
            </div>
        </aside>
    </div>
</div>

<?php endwhile; else: ?>

<p>Nothing to show</p>

<?php endif;
get_footer(); ?>