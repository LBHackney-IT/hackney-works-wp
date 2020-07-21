<?php

function lbh_register_announcement_settings(){
    register_setting( "lbh-announcement", "show_announcement", array(
        "type" => "boolean",
        "show_in_rest" => true
    ));
    register_setting( "lbh-announcement", "announcement_title", array(
        "type" => "string",
        "show_in_rest" => true
    ));
    register_setting( "lbh-announcement", "announcement_content", array(
        "type" => "string",
        "show_in_rest" => true
    ));
}
add_action( 'admin_init', 'lbh_register_announcement_settings' );


function lbh_announcement_menu() {
    add_options_page( 
        "Announcement Settings", 
        "Announcement", 
        "manage_options", 
        "lbh-announcement",
        "lbh_announcement_options"
    );
}
add_action( "admin_menu", "lbh_announcement_menu" );


function lbh_announcement_options() {
	if (!current_user_can( "manage_options" ) )  {
		wp_die( __( "You do not have sufficient permissions to access this page." ) );
    }
    ob_start();
    ?>

        <div class='wrap'>
            <h1>Announcement Settings</h1>
            <p>Control the site-wide announcement that appears at the top of most pages.</p>
            <form method="post" action="options.php"> 

                <?php settings_fields( "lbh-announcement" ); ?>
                <?php do_settings_sections( "lbh-announcement" ); ?>

                <table class="form-table">

                    <tr valign="top">
                        <td>
                            <input type="checkbox" name="show_announcement" id="show_announcement" <?php if(get_option('show_announcement')): ?>checked<?php endif; ?> "/>
                            <label for="show_announcement">Show announcement?</label>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">
                            <label for="announcement_title">Title</label>
                        </th>
                        <td>
                            <input type="text" class="regular-text" id="announcement_title" name="announcement_title" value="<?php echo esc_attr( get_option('announcement_title') ); ?>"/>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">
                            <label for="announcement_title">Content</label>
                        </th>
                        <td>
                            <textarea name="announcement_content" class="regular-text" id="announcement_content" rows="4"><?php echo esc_attr( get_option('announcement_content') ); ?></textarea>
                        </td>
                    </tr>
                </table>

                <?php submit_button(); ?>

            </form>
        </div>
    
    <?php
    ob_end_flush();
    // ob_end_clean();
}
