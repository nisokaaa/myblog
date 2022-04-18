<?php
/*--------------------------------------------------------------
>>> カテゴリ別の最新記事（サイドバーエリア）
--------------------------------------------------------------*/ ?>

<?php 
// 管理：カテゴリ別 最新記事の表示オプションを取得
$settings = get_option_post_list_new_by_category();

foreach ($settings as $option) {
  $title = $option['title'];
  $count = $option['count'];
  $category_id = $option['category']; 
  $category_icon = get_field('icon', 'category_'.$category_id);
  
  // 表示件数設定が０件なら何もしない
  if ($count > 0) { 

    // カテゴリごとに最新記事をピックアップ
    $the_query = new WP_Query(array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => $count,
      'category__in' => $category_id,
    ));

    // 記事が見つかったら
    if ($the_query->have_posts()) { ?>
      <div class="caption">
        <svg class="caption__icon"><use href="#<?php echo $category_icon; ?>"/></svg>
        <h2 class="caption__text"><?php echo $title; ?></h2>
      </div>
      <?php
      $args = array();
      $args['option']['style'] = '--side';
      $args['option']['star-style'] = '--post-card';

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
  }
} ?>