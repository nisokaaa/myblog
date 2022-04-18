<?php
/*--------------------------------------------------------------
>>> [AFC block] 「動画メディア」ブロック
--------------------------------------------------------------*/ ?>

<?php
// ※ACF blockに情報が紐づいてるので、$post_idは必要ない。
//   ACF blockはpost_meta DB領域にデータを保持せず、すべて投稿コンテンツに埋め込まれる設計。
$url = esc_url(get_field('video-url'));

if ($url) { ?>

<video class="video-js vjs-big-play-centered sample-video" data-setup={} controls playsinline>
  <source src="<?php echo $url; ?>#t=0.001" type="video/mp4">
</video>

<?php } ?>

