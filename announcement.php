<?php if(get_option("show_announcement")): ?>
    <section class="announcement">
        <h2><?php echo get_option("announcement_title"); ?></h2>
        <p><?php echo get_option("announcement_content"); ?></p>
    </section>
<?php endif; ?>