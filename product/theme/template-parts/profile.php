<?php
/*--------------------------------------------------------------
>>> profile.php：プロフィール情報 テンプレートパーツ
--------------------------------------------------------------*/ 
// プロフィール画像を取得
$avatar_img = get_option_field('avatar-img');
// 〔職業上の〕肩書きを取得
$user_job = get_option_field('user-job');
// 名前を取得
$user_name = get_option_field('user-name');
// 紹介文を取得
$user_profile = get_option_field('user-profile');
// TwitterIDを取得
$twitter_id = get_option_field('twitter-id');
?>

<div class="caption --mb-unset">
  <svg class="caption__icon"><use href="#fa-user"/></svg>
  <h2 class="caption__text">プロフィール紹介</h2>
</div>
<div class="profile">
  <?php if($avatar_img) {?>
  <a href="#" class="profile__avatar">
    <img class="profile__avatar-img" src="<?php echo $avatar_img; ?>" alt="">
  </a>
  <?php } ?>
  <p class="profile__name"><?php echo $user_name; ?></p>
  <p class="profile__job"><?php echo $user_job; ?></p>
  <p class="profile__description"><?php echo $user_profile; ?></p>
  <div class="profile__sns">
    <span class="profile__sns-title">＼ Follow me!! ／</span>
    <a class="profile__sns-btn" href="https://twitter.com/<?php echo $twitter_id; ?>" target="_blank" rel="noopener" onclick="gtag('event', 'click', {'event_category':'twitter_link', 'value':'1'});">
      <svg class="profile__sns-icon"><use href="#fa-twitter"/></svg>
      <span class="profile__sns-text">twitterアカウントへ</span>
    </a>
  </div>
</div>