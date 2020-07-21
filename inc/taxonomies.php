<?php

function lbh_create_custom_taxonomies() { 
    register_taxonomy('curriculum_areas', 'course', array(
      "hierarchical" => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true
    ));
  
    register_taxonomy('providers', 'course', array(
      "labels" => array(
          "name" => "Providers",
          "singular_name" => "Provider",
          "add_new_item" => "Add New Course Provider",
          "separate_items_with_commas" => "Separate multiple providers with commas",
          "choose_from_most_used" => "Choose from the most used providers",
          "not_found" => "No providers found"
      ),
      "hierarchical" => false,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true
    ));
  }
  add_action('init', 'lbh_create_custom_taxonomies', 0 );