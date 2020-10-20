<?php if(get_option("show_announcement")): ?>
    <div class="container container--mid">
        <div class="alert">
            <h2 class="alert__title"><?php echo get_option("announcement_title"); ?></h2>
            <p class="alert__content"><?php echo get_option("announcement_content"); ?></p>
        </div>
    </div>
<?php endif; ?>