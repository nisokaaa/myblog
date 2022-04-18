<?php
/*--------------------------------------------------------------
>>> おすすめ記事（サイドバーエリア）
--------------------------------------------------------------*/ ?>

<?php 
// 管理：おすすめ記事の投稿リストデータ取得
$post_list = get_option_post_list_reccomend();

if (count($post_list) > 0) { ?>

<div class="caption">
  <svg class="caption__icon"><use href="#fa-star"/></svg>
  <h2 class="caption__text">おすすめ記事</h2>
</div>

<?php 
  $args = array();
  $args['option']['style'] = '--side';
  $args['option']['star-style'] = '--post-card';

  foreach ($post_list as $post) {
    $data                  = array();
    $data['permalink_url'] = get_permalink($post->ID);
    $data['eyecatch_url']  = get_eyecatch_url($post->ID);
    $data['title']         = $post->post_title;
    $data['category']      = get_category_child($post->ID);
    $data['date']          = $post->post_date;
    $args['posts'][]       = $data;
  }
  get_template_part('template-parts/post-list-card', null, $args);
  wp_reset_postdata();
}