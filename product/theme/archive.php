<?php 
/*--------------------------------------------------------------
>>> archive.php：タグ・カテゴリー覧ページ
----------------------------------------------------------------
# 各ページにあるタグやカテゴリーをクリックした遷移先のページとして使用する
# 将来的には「tag.php」「category.php」で分けるかもしれない
--------------------------------------------------------------*/
// 現在のページ番号(1~...)
$paged = get_query_var( 'paged', 0 ) == 0 ? 1 : get_query_var( 'paged', 1 );
get_header(); ?>

<div class="archive">
  <div class="wrapper">
    <main class="main">
      <div class="caption --mt-unset-sp">
        <svg class="caption__icon"><use href="#fa-tag"/></svg>
        <h1 class="caption__text"><?php echo sprintf('「 %1$s 」 の記事一覧 %2$s 件', single_cat_title('', false), $wp_query->found_posts); ?></h1>
      </div>
      <?php
        if ($wp_query->have_posts()) {
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
          } ?>
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