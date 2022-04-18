<?php 
/*--------------------------------------------------------------
>>> page-about.php：このサイトについて
--------------------------------------------------------------*/
get_header();
$post_id = get_the_ID();
$eyecatch_url = get_eyecatch_url($post_id);?>

<div class="about">
  <div class="wrapper">
    <main class="main">
      <div class="caption --mt-unset-sp">
        <svg class="caption__icon"><use href="#fa-home"/></svg>
        <h1 class="caption__text">このサイトについて</h1>
      </div>
      <img class="about__eyecatch keep-ratio lozad" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" 
              data-src="<?php echo esc_url($eyecatch_url); ?>" alt="">
      <div class="about__content">
        <?php echo the_content(); ?>
      </div>
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