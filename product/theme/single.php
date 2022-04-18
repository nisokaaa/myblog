<?php
/*--------------------------------------------------------------
>>> single.php：記事ページ
--------------------------------------------------------------*/
get_header();
/* 各種、記事情報を取得 */
$post_id = get_the_ID();
$category_id = get_category($post->post_category[0])->cat_ID;
$category = get_category_child();
$tags = get_the_tags();
$published_date = get_the_date();
$modified_date = get_the_modified_date();

/* アイキャッチ画像を取得 */
$eyecatch_url = get_eyecatch_url($post_id);

/** 
 * @param mixed $term 条件タグ
 * @param array $not_in_posts : 条件に含めない投稿ID
 * @param string $title : 見出しタイトル
 * @return array $not_in_posts
 */
function get_related_post_by_term($term, $not_in_posts) {
  $the_query = new WP_Query(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 4,
    'post__not_in' => $not_in_posts,
    'tag__in' => $term->term_id,
  ));
  if ($the_query->have_posts()) {
    $args = array();
    $args['option']['style'] = '--main';
    $args['option']['star-style'] = '--post-card';
    
    while ($the_query->have_posts()) { $the_query->the_post();
      $query_post            = $the_query->post;
      $data                  = array();
      $data['tag']           = get_field('post-main-tag', $query_post->ID);
      $data['permalink_url'] = get_permalink($query_post->ID);
      $data['eyecatch_url']  = get_eyecatch_url($query_post->ID);
      $data['title']         = $query_post->post_title;
      $data['category']      = get_category_child($query_post->ID);
      $data['date']          = $query_post->post_date;
      $args['posts'][]       = $data;

      // 次から表示しない投稿リストに追加
      $not_in_posts[] = $query_post->ID;
    }
    echo sprintf( '<div class="caption">
                    <svg class="caption__icon"><use href="#fa-clip"/></svg>
                    <h3 class="caption__text">「%1$s」 の記事</h3>
                  </div>', $term->name);
    get_template_part('template-parts/post-list-card', null, $args);
  }
  wp_reset_postdata();
  return $not_in_posts;
} ?>

<div class="single">
  <div class="wrapper">
    <article class="main">
      <div class="main__inner" id="main__inner">
        <header class="single__header">
          <h1 class="single__title"><?php echo get_the_title(); ?></h1>
          <div class="single__meta">
            <span class="single__date">
              <svg class="single__date-icon"><use href="#fa-clock"/></svg>
              <time class="single__date-text" datetime="<?php echo mysql2date('Y-m-d', $published_date); ?>"><?php echo mysql2date('Y.m.d', $published_date); ?>公開</time>
            </span>
            <span class="single__date">
              <svg class="single__date-icon"><use href="#fa-repeat"/></svg>
              <time class="single__date-text" datetime="<?php echo mysql2date('Y-m-d', $modified_date); ?>"><?php echo mysql2date('Y.m.d', $modified_date); ?>更新</time>
            </span>
          </div>
        </header>
        
        <div class="single__content">
          <?php the_content(); ?>
        </div>

        <footer class="single__footer">
          <div class="term-list">
            <div class="term-list__items">
              <a class="term-list__item --category" href="<?php echo $category['link']; ?>" style="background: <?php echo esc_html($category['color']); ?>;"><?php echo $category['name']; ?></a>
            </div>
            <div class="term-list__items">
              <?php if ($tags) : foreach ($tags as $tag) : ?>
              <a class="term-list__item --tag" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo $tag->name; ?></a>
              <?php endforeach; endif; ?>
            </div>
          </div>
        </footer>

        <aside class="single__appended">
          <?php 
          $not_in = array($post_id); // 次ループでは検索しない投稿
          if (have_rows('post-relation-conf')) :
            while (have_rows('post-relation-conf')) : the_row();
              $relation_tag = get_sub_field('relation-tag');
              if ($relation_tag == null) continue;
              $not_in = get_related_post_by_term($relation_tag, $not_in);
            endwhile;
          endif;

          $main_tag = get_field('post-main-tag');
          if (!empty($main_tag)) :
            get_related_post_by_term($main_tag, $not_in);
          endif; ?>
          <!-- スマホ版 広告 -->
          <?php get_template_part('template-parts/adsence', 'sp-content-bottom'); ?>
        </aside>
      </div>
    </article>

    <aside class="side">
      <div class="side__box">
        <div class="side__box-tab-none">
          <!-- PC・タブレット版 広告 <上部> -->
          <?php get_template_part('template-parts/adsence', 'pc-tab-side-top'); ?>
        </div>
      </div>
      
      <div class="side__box">
        <!-- おすすめ記事一覧 -->
        <?php get_template_part('template-parts/post-list-sidebar-reccomend'); ?>
      </div>
      
      <div class="side__box" id="first-box">
        <div class="side__box-l">
          <div class="side__box-pc-none">
            <!-- PC・タブレット版 広告 <上部> -->
            <?php get_template_part('template-parts/adsence', 'pc-tab-side-top'); ?>
          </div>
        </div>
        <div class="side__box-r">
          <!-- 検索ボックス -->
          <?php get_template_part('template-parts/search-box'); ?>

          <!-- カテゴリ一覧 -->
          <?php get_template_part('template-parts/category-menu'); ?>

          <!-- スマホ版 広告 <下部> -->
          <?php get_template_part('template-parts/adsence', 'sp-footer'); ?>
        </div>
      </div>
      
      <div class="side__box-sticky" id="sticky-box">
        <!-- 新着記事一覧 -->
        <?php get_template_part('template-parts/post-list-sidebar-new'); ?>
      </div>

      <div class="side__box-bottom" id="last-box">
        <!-- PC・タブレット版 広告 <下部> -->
        <?php get_template_part('template-parts/adsence', 'pc-tab-side-bottom'); ?>
      </div>
    </aside>
  </div>
</div>

<?php get_footer(); ?>