<?php
/*--------------------------------------------------------------
>>> 広告テンプレートパーツ スマホ版 フッター部
--------------------------------------------------------------*/ ?>
<div class="adsense --sp-footer">
  <?php 
  $banners = get_option_banner('sp-footer');
  foreach ($banners as $banner) { ?>
  <div class="adsense__box">
    <?php echo $banner['body']; ?>
  </div>
  <?php } ?>
</div>