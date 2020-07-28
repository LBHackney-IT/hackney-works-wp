<?php if(get_option("show_cta")): ?>
    <section class="call-to-action">
        <div class="container container--narrow">
            <h2 class="call-to-action__title"><?php echo get_option("cta_title"); ?></h2>
            <p class="call-to-action__message"><?php echo get_option("cta_content"); ?></p>
            <a class="call-to-action__button" href="<?php echo get_option("cta_link"); ?>"> <?php echo get_option("cta_link_label"); ?></a>
        </div>
    </section>
<?php endif; ?>