<?php

/*
----------------
Remove default content editor
----------------
*/

function remove_textarea() {
  // Add any post types that shouldn't have the editor
}

function remove_editor() {
  remove_post_type_support('page', 'editor');
  remove_post_type_support('post', 'editor');
  remove_post_type_support('page', 'page-attributes');
  remove_post_type_support('page', 'thumbnail');
}

/*
----------------
Remove comments from admin
----------------
*/

function remove_admin_menus() {
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}

function remove_comment_support() {
  remove_post_type_support('post', 'comments');
  remove_post_type_support('page', 'comments');
}

function remove_comments_admin_bar() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}
