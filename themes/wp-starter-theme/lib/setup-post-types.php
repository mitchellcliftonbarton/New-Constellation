<?php

/*
----------------
Setup All Post Types
----------------
*/

function setup_post_types() {
  // Add post types here
  
  // create_projects();
  // create_project_types();
}

/*
----------------
Projects
----------------
*/

// function create_projects() {
//   register_post_type( 'project',
//     array(
//       'labels' => array(
//         'name' => __( 'Projects' ),
//         'singular_name' => __( 'Project' ),
//         'search_items' =>  __( 'Search Projects' ),
//         'all_items' => __( 'All Projects' ),
//         'parent_item' => __( 'Parent Project' ),
//         'parent_item_colon' => __( 'Parent Project:' ),
//         'edit_item' => __( 'Edit Project' ),
//         'update_item' => __( 'Update Project' ),
//         'add_new' => __( 'Add New Project' ),
//         'add_new_item' => __( 'Add New Project' ),
//         'new_item_name' => __( 'New Project Name' ),
//         'menu_name' => __( 'Projects' ),
//       ),
//       'public' => true,
//       'publicly_queryable' => true,
//       'has_archives' => false,
//       'has_archive' => false,
//       'show_in_rest' => true,
//       'show_in_nav_menus' => true,
//       'supports' => array('title', 'thumbnail'),
//       'menu_icon' => 'dashicons-portfolio'
//     )
//   );
// }

/*
----------------
Project Types
----------------
These apply to Projects only. They have a slug of 'project-type'.
----------------
*/

// function create_project_types() {
//   $category_labels = array(
//     'name' => _x( 'Types', 'taxonomy general name' ),
//     'singular_name' => _x( 'Type', 'taxonomy singular name' ),
//     'search_items' =>  __( 'Search Types' ),
//     'all_items' => __( 'All Types' ),
//     'parent_item' => __( 'Parent Type' ),
//     'parent_item_colon' => __( 'Parent Type:' ),
//     'edit_item' => __( 'Edit Type' ), 
//     'update_item' => __( 'Update Type' ),
//     'add_new_item' => __( 'Add Type' ),
//     'new_item_name' => __( 'New Type Name' ),
//     'menu_name' => __( 'Types' ),
//   );

//   register_taxonomy('project-type', array('project'), array(
//     'hierarchical' => true,
//     'labels' => $category_labels,
//     'show_ui' => true,
//     'show_in_rest' => true,
//     'show_admin_column' => true,
//     'query_var' => true,
//     'rewrite' => array( 'slug' => 'project-type' ),
//   ));
// }
