<?php
/*--------------------------------------------------------------
>>> 広告テンプレートパーツ PC・タブレット版 サイドバー上部
--------------------------------------------------------------*/ ?>
<div class="adsense --pc-tab-side-top">
  <?php 
  $banners = get_option_banner('pc-tab-side-top');
  foreach ($banners as $banner) { ?>
  <div class="adsense__box">
    <?php echo $banner['body']; ?>
  </div>
  <?php } ?>
</div>