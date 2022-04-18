import * as scroll from '../lib/scroll';
// singleページ、PCのときだけ使用

// ------------------------------------------------------------
// DOMツリー構築が完了した時点で発火
// ------------------------------------------------------------
document.addEventListener("DOMContentLoaded", function() 
{
  const firstElem = document.getElementById('first-box');
  const stickyElem = document.getElementById('sticky-box');
  const stickyElemInner = document.getElementById('sticky-box-inner');
  const lastElem = document.getElementById('last-box');
  let stickyStartPos; // "固定" 開始位置
  let stickyEndPos;   // "固定" 終了位置
  let currentState = '';  // 現フレームの状態
  let prevState = '';     // 前フレームの状態

  // ------------------------------------------------------------
  // DOMツリー構築に加え、画像やスクリプトのロードが完了した時点で発火
  // ------------------------------------------------------------
  window.addEventListener('load', function() {
    adjustStyle();
    resetParams();
    checkSticky();
  }, {passive: true});

  // ------------------------------------------------------------
  // スクロール イベント時
  // ------------------------------------------------------------
  window.addEventListener('scroll', function() {
    checkSticky();
  }, {passive: true});

  // ------------------------------------------------------------
  // ウィンドウリサイズ イベント時
  // ------------------------------------------------------------
  let timer;
  window.addEventListener('resize', function() {
    clearTimeout(timer);
    timer = setTimeout(function() {
      resetParams();
      adjustStyle();
      checkSticky();
    }, 100);
  }, {passive: true});

  // ------------------------------------------------------------
  // リセット関数
  // ------------------------------------------------------------
  function resetParams() {
    stickyStartPos = firstElem.getBoundingClientRect().bottom + scroll.getScrolled();
    stickyEndPos = lastElem.getBoundingClientRect().top + scroll.getScrolled();
  }

  // ------------------------------------------------------------
  // 固定追従させるか監視する関数
  // ------------------------------------------------------------
  function checkSticky() {
    if (stickyStartPos < scroll.getScrolled()) {
      if (scroll.getScrolled() + stickyElem.clientHeight > stickyEndPos) {
        currentState = 'release';
      } else {
        currentState = 'sticky';
      }
    } else {
      currentState = '';
    }
    setState(currentState);
  }

  // ------------------------------------------------------------
  // 何もしないか、固定追従か、最下部くっつきか、状態を変更する関数
  // ------------------------------------------------------------
  function setState(state) {
    if (currentState !== prevState) {
      currentState = state;
      if (prevState !== '') stickyElem.classList.remove('--' + prevState);
      if (currentState !== '') stickyElem.classList.add('--' + currentState);
      switch (state) {
        case 'sticky':
          stickyElem.style.bottom = 'unset';
          break;
        case 'release':
          stickyElem.style.bottom = lastElem.clientHeight + 'px';
          break;
      }
    }
    prevState = currentState; // 次のフレームに受け継ぐ
  }

  // ------------------------------------------------------------
  // Sticky要素の横幅・高さを整える関数
  // ------------------------------------------------------------
  function adjustStyle() {
    /* 横幅を調整 */
    stickyElem.style.width = stickyElem.parentNode.clientWidth + 'px';
    /* 高さを調整 */
    // 見出しの高さ
    const captionHeight = stickyElemInner.getBoundingClientRect().top - stickyElem.getBoundingClientRect().top;
    // 表示領域の高さ (水平スクロールバー含まず) 
    const screenHeight = document.documentElement.clientHeight;
    // 追従ボックス高さ
    const boxHeight = screenHeight - captionHeight - 17.5;
    stickyElemInner.style.setProperty('height', boxHeight + 'px');
  }

  // ------------------------------------------------------------
  // デバッグ用 関数
  // ------------------------------------------------------------
  //function debug(message) {
  //  console.log(message + ': start:' + stickyStartPos + ', bottom:' + stickyElem.clientHeight + ', end:' + stickyEndPos);
  //}

}, {passive: true});