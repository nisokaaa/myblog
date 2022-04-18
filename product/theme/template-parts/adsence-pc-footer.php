<?php
/*--------------------------------------------------------------
>>> 広告テンプレートパーツ PC版 フッター部
--------------------------------------------------------------*/ ?>
<div class="adsense --pc-footer">
  <?php 
  $banners = get_option_banner('pc-footer');
  foreach ($banners as $banner) { ?>
  <div class="adsense__box" style="max-width:<?php echo round(100/count($banners), 2); ?>%;">
    <?php echo $banner['body']; ?>
  </div>
  <?php } ?>
</div>