<?php if(get_option("show_announcement")): ?>
    <div class="container covid">
        <h2><?php echo get_option("announcement_title"); ?></h2>
        <p><?php echo get_option("announcement_content"); ?></p>
    </div>
<?php endif; ?>