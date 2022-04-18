<?php
/*--------------------------------------------------------------
>>> カテゴリー覧メニューテンプレートパーツ
    表示カテゴリ・タグは管理画面より設定したもの
--------------------------------------------------------------*/ ?>
<?php
$caption = isset($args['option']['caption']) ? $args['option']['caption'] : true;

// 各カテゴリーの記事件数を取得、データ準備(カスタム投稿以外の件数)
$categories = array();
foreach (get_categories() as $category) {
  $the_query = new WP_Query(array('post_type' => 'post','post_status' => 'publish','cat'=>$category->term_id)); 
  if ($the_query->have_posts()) {
    $categories[] = array(
      'link' => esc_url(get_category_link($category->term_id)),
      'name' => $category->name,
      'count' => $the_query->found_posts
    );
  }
  wp_reset_postdata();
}

// 管理画面で設定したカテゴリだけ表示
$tags = get_option_field('category-menu-terms');
?>

<?php if ($caption) { ?>
<div class="caption --mb-unset">
  <svg class="caption__icon"><use href="#fa-folder"/></svg>
  <h2 class="caption__text">カテゴリ一覧</h2>
</div>
<?php } ?>

<ul class="category-menu">

<?php
if (count($categories) > 0) { 
  foreach ($categories as $category) { ?>
  <li class="category-menu__item">
    <a class="category-menu__link" href="<?php echo $category['link']; ?>">
      <span class="category-menu__text"><?php echo $category['name']; ?></span>
      <span class="category-menu__count"><?php echo $category['count']; ?></span>
    </a>
  </li>
<?php 
  }
} ?>

<?php
if ($tags) { 
  foreach ($tags as $tag) {
    $link = esc_url(get_tag_link($tag->term_id));
    $name = $tag->name;
    $count = $tag->count; ?>
  <li class="category-menu__item">
    <a class="category-menu__link" href="<?php echo $link; ?>">
      <span class="category-menu__text"><?php echo $name; ?></span>
      <span class="category-menu__count"><?php echo $count; ?></span>
    </a>
  </li>
<?php 
  }
} ?>

</ul>
