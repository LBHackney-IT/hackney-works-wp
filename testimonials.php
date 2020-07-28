<?php $slides = get_field("testimonials");
if($slides): ?>
    <aside class="testimonials">
        <div class="testimonials__background" style="background-image: url('<?php echo get_stylesheet_directory_uri() . "/assets/canal.jpg" ?>')"></div>
        <h2 class="testimonials__title">What people say</h2>
        <ul class="testimonials__list container">
            <?php foreach($slides as $slide): ?>

                <li>
                    <div class="testimonials__slide">
                        <?php echo get_the_post_thumbnail($slide); ?>
                        <blockquote>
                            <q class="testimonials__quote"><?php echo $slide->post_content ?></q>
                            <cite class="testimonials__citation"><?php echo $slide->post_title ?></cite>
                        </blockquote>
                    </div>
                </li>

            <?php endforeach; ?>
        </ul>
    </aside>
<?php endif; ?>