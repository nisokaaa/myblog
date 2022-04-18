<?php
/*--------------------------------------------------------------
>>> 広告テンプレートパーツ スマホ版 記事コンテンツ終端
--------------------------------------------------------------*/ ?>
<div class="adsense --sp-content-bottom">
  <?php 
  $banners = get_option_banner('sp-content-bottom');
  foreach ($banners as $banner) { ?>
  <div class="adsense__box">
    <?php echo $banner['body']; ?>
  </div>
  <?php } ?>
</div>