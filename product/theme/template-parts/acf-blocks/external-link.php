<?php
/*--------------------------------------------------------------
>>> [AFC block] 「商品リンク」ブロック
--------------------------------------------------------------*/ ?>

<?php 
// ※ACF blockに情報が紐づいてるので、$post_idは必要ない。
//   ACF blockはpost_meta DB領域にデータを保持せず、すべて投稿コンテンツに埋め込まれる設計。
// この記事で紹介してる商品情報を取得
$image = get_field('external-link-image');
$name = get_field('external-link-name');
$url = get_field('external-link-url');
$button_text = get_field_object('external-link-button-text'); ?>

<?php if ($image) : ?>
<div class="external-link">
  <a class="external-link__link" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="商品ページリンク"
      onclick="gtag('event', 'click', {'event_category':'asp_link', 'event_label':'<?php echo $name; ?>', 'value':'1'});">
    <img class="external-link__eyecatch" src="<?php echo esc_url($image['url']); ?>" alt="">
  </a>
  <div class="external-link__body">
    <p class="external-link__name"><?php echo $name; ?></p>
    <a class="external-link__btn" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="商品ページリンク" 
        onclick="gtag('event', 'click', {'event_category':'asp_link', 'event_label':'<?php echo $name; ?>', 'value':'1'});">
      <span class="external-link__btn-text"><?php echo $button_text['value']; ?></span>
      <svg class="external-link__btn-icon"><use href="#fa-chevron"/></svg>
    </a>
  </div>
</div>
<?php endif; ?>