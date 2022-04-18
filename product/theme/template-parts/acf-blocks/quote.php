<?php
/*--------------------------------------------------------------
>>> [AFC block] 「引用」ブロック
--------------------------------------------------------------*/ ?>
<?php 
$contents = get_field('quote-contents'); 
$author = get_field('quote-author');
?>
<blockquote class="quote">
  <p class="quote__content"><?php echo $contents; ?></p>
  <cite class="quote__author"><?php echo $author; ?></cite>
  <svg class="quote__icon"><use href="#fa-quote"/></svg>
</blockquote>