<?php
/*--------------------------------------------------------------
>>> [AFC block] 「埋め込み要素」ブロック
--------------------------------------------------------------*/ ?>
<?php 
$embed_script = get_field('embed-script');
$embed_msg = get_field('embed-msg');
?>

<div class="embed">
  <?php echo $embed_script; ?>
  <?php if ($embed_msg) { ?>
  <span class="embed__msg"><?php echo $embed_msg; ?></span>
  <?php } ?>
</div>