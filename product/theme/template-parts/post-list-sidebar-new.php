<?php
/*--------------------------------------------------------------
>>> 新着記事一覧（サイドバーエリア）
--------------------------------------------------------------*/ ?>

<?php 
$the_query = new WP_Query(array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 20,
));

// 記事が見つかったら
if ($the_query->have_posts()) { ?>
  <div class="caption">
    <svg class="caption__icon"><use href="#fa-bell"/></svg>
    <h2 class="caption__text">新着記事一覧</h2>
  </div>
  <?php
  $args = array();
  $args['option']['style'] = '--side';
  $args['option']['star-style'] = '--post-card';
  $args['option']['id'] = 'sticky-box-inner';
  
  while ($the_query->have_posts()) { $the_query->the_post();
    $data                  = array();
    $data['permalink_url'] = get_permalink($post->ID);
    $data['eyecatch_url']  = get_eyecatch_url($post->ID);
    $data['title']         = $post->post_title;
    $data['category']      = get_category_child($post->ID);
    $data['date']          = $post->post_date;
    $args['posts'][]       = $data;
  }
  get_template_part('template-parts/post-list-card', null, $args);
}
wp_reset_postdata();
 ?>