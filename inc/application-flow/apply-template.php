<?php get_header(); ?>

Application form here


<form>

<?php 
// global $wp_query;
print_r($wp->query_vars); 
?>

    <input type="text" name="first_name"/>
    <input type="text" name="last_name"/>

    <input type="email" name="email"/>
    <input type="phone" name="phone"/>

    <input name="course" value="<?php echo get_query_var("course"); ?>"/>
    <input name="intake" value="<?php echo get_query_var("intake"); ?>"/>

    <button>Apply</button>

</form>


<script>
    __COURSE_DATA__ = `<?php echo json_encode(get_post(1)) ?>`
</script>

<?php get_footer(); ?>