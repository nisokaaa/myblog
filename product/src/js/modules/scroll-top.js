import * as scroll from '../lib/scroll';

document.addEventListener("DOMContentLoaded", function() 
{
  // スクロールボタン共通
  const scrollBtnElems = Array.prototype.slice.call(document.getElementsByClassName('scroll-btn'));

  // 追従型ボタン
  const scrollBtnSticky = document.getElementById('scroll-btn-sticky');

  // ボタンを出現させる位置
  const appearPosY = 300;

  // ------------------------------------------------------------
  // ページ読み込み後にボタンを出現させる
  // ------------------------------------------------------------
  if (scroll.getScrolled() > appearPosY) {
    if (!scrollBtnSticky.classList.contains('--show')) scrollBtnSticky.classList.add('--show');
  }

  // ------------------------------------------------------------
  // すべてのスクロールボタンにイベント登録
  // ------------------------------------------------------------
  for (let i=0; i < scrollBtnElems.length; i++) {
    scrollBtnElems[i].addEventListener('click', btn => {
      btn.preventDefault();

      // 最上部までスクロール
      scroll.scrollTo(0);

      // 追従型ボタンを非表示に
      if (scrollBtnSticky.classList.contains('--show')) {
        scrollBtnSticky.classList.remove('--show');
      }
    });
  }

  // ------------------------------------------------------------
  // スクロール中にボタンを出現させる
  // ------------------------------------------------------------
  window.addEventListener('scroll', function() {

    // 上部から300px以上の位置でスクロールしたらボタン出現
    if (scroll.getScrolled() > appearPosY) {
      if (!scrollBtnSticky.classList.contains('--show')) scrollBtnSticky.classList.add('--show');
    } else {
      if (scrollBtnSticky.classList.contains('--show')) scrollBtnSticky.classList.remove('--show');
    }
  });
});