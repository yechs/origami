<?php
if (have_posts()) {
  $blog_post_array = array();
  while (have_posts()) {
    the_post();
    $post_author_id = get_post_field('post_author', $post->ID);
    global $blog_post_array;
    $blog_list_array = array(
      'blog_post_id' => $post->ID,
      'blog_post_title' => get_the_title($post->ID),
      'blog_post_date' => get_the_date(get_option('date_format'), $post->ID),
      'blog_post_comments' => get_comments_number($post->ID),
      'blog_post_link' => get_the_permalink($post->ID),
      'blog_post_image' => wp_get_attachment_url(
        get_post_thumbnail_id($post->ID)
      ),
      'blog_post_image_alt' => get_post_meta(
        get_post_thumbnail_id($post->ID),
        '_wp_attachment_image_alt',
        true
      ),
      'blog_post_author' => get_the_author_meta('nickname', $post_author_id),
      'blog_post_category' => wp_get_post_categories($post->ID),
      'blog_post_tag' => wp_get_post_tags($post->ID),
      'blog_post_excerpt' => get_the_excerpt($post->ID)
    );
    if (
      $blog_list_array['blog_post_image'] == false &&
      origami_get_other_thumbnail($post)
    ) {
      $blog_list_array['blog_post_image'] = origami_get_other_thumbnail($post);
    }
    $blog_post_array[] = $blog_list_array;
  }
}