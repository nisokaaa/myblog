<?php 
/*--------------------------------------------------------------
>>> search.php：検索結果表示ページ
----------------------------------------------------------------
# 各ケースごとに表示内容を切り替える
## 検索ワードが未入力だった
## 記事が見つからなかった
## 記事が見つかった
--------------------------------------------------------------*/
// 現在のページ番号(1~...)
$paged = get_query_var( 'paged', 0 ) == 0 ? 1 : get_query_var( 'paged', 1 );
get_header();

// 検索結果処理
$result = $EMPTY = 0; $FOUND = 2; $NOT_FOUND = 1; 
if (empty($_GET['s'])) {
  $result = $EMPTY; 
} else if ($wp_query->have_posts()) {
  $result = $FOUND;
} else { 
  $result = $NOT_FOUND;
} ?>

<div class="search">
  <div class="wrapper">
    <main class="main">
      <div class="caption --mt-unset-sp --mb-unset">
        <svg class="caption__icon"><use href="#fa-search"/></svg>
        <h2 class="caption__text"><?php echo sprintf('「 %1$s 」 の検索結果 %2$s 件', $_GET['s'], $result == $EMPTY ? '0' : $wp_query->found_posts); ?></h2>
      </div>
      
      <?php
      if ($result == $EMPTY || $result == $FOUND) {
        // 検索ワードが空 または 記事が見つかった ?>
        <div class="search__result">
          <?php
          if ($result == $EMPTY) : ?>          
            <p class="search__result-message">検索ワードが入力されていません。</p>
            <p class="search__result-message">他のキワード、もしくはカテゴリー名を検索して記事をお探しください。</p>
          <?php endif; ?>
          <div class="search__search-box --search-page">
          <?php 
            $args = array('option' => array('mod' => '--search-page', 'caption' => false));
            get_template_part('template-parts/search-box', null, $args); ?>
          </div>
        </div>
          
      <?php
        $args = array();
        $args['option']['style'] = '--main';
        $args['option']['star-style'] = '--post-card';

        while($wp_query->have_posts()) { $wp_query->the_post();
          $data                  = array();
          $data['tag']           = get_field('post-main-tag', $post->ID);
          $data['permalink_url'] = get_permalink($post->ID);
          $data['eyecatch_url']  = get_eyecatch_url($post->ID);
          $data['title']         = $post->post_title;
          $data['category']      = get_category_child($post->ID);
          $data['date']          = $post->post_date;
          $args['posts'][]       = $data;
        }
        get_template_part('template-parts/post-list-card', null, $args);
        
        if (function_exists('pagination')) {
          pagination( $wp_query->max_num_pages, $paged );
        }
        wp_reset_postdata();
      } else if ($result == $NOT_FOUND) { 
        // 検索ワードがあり 記事見つからない ?>

      <div class="search__result">
        <p class="search__result-message">記事が見つかりませんでした💧</p>
        <p class="search__result-message">他のキワード、もしくはカテゴリー名を検索して記事をお探しください。</p>
        <div class="search__search-box">
          <?php 
          $args = array('option' => array('mod' => '--search-page', 'caption' => false));
          get_template_part('template-parts/search-box', null, $args); ?>
        </div>
      </div>

      <?php } ?>
    </main>

    <aside class="side">
      <div class="side__box">
        <div class="side__box-l">
          <!-- PC・タブレット版 広告 <上部> -->
          <?php get_template_part('template-parts/adsence', 'pc-tab-side-top'); ?>
        </div>
        <div class="side__box-r">
          <!-- 検索ボックス -->
          <?php get_template_part('template-parts/search-box'); ?>

          <!-- カテゴリ一覧 -->
          <?php get_template_part('template-parts/category-menu'); ?>

          <!-- スマホ版 広告 <コンテンツ下部> -->
          <?php get_template_part('template-parts/adsence', 'sp-content-bottom'); ?>
        </div>
      </div>

      <div class="side__box">
        <!-- おすすめ記事一覧 -->
        <?php get_template_part('template-parts/post-list-sidebar-reccomend'); ?>
      </div>

      <div class="side__box">
        <!-- PC・タブレット版 広告 <下部> -->
        <?php get_template_part('template-parts/adsence', 'pc-tab-side-bottom'); ?>

        <!-- スマホ版 広告 <下部> -->
        <?php get_template_part('template-parts/adsence', 'sp-footer'); ?>
      </div>
    </aside>
  </div>
</div>

<?php get_footer(); ?>