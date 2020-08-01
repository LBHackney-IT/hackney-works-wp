<?php 

wp_redirect("/find-a-course/?topic[]=" . get_query_var("curriculum_areas") . "#results" );