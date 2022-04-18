import * as animate from './animation';
import * as calc from './calc';

const animateSec = 500;  // アニメーション時間(ミリ秒)
const animateFrame = 60; // フレーム数

/**
 * 移動先を決めてスクロールさせる
 * @param {number} endPos 移動後のスクロール値
 * @param {Function} onComplete 終了後に一度おこなう処理
 * @param {string} easing イージング関数の名称(default：easeOutQuint)
 */
export function scrollTo(endPos, onComplete=null, easing='easeOutQuint') {
  const startPos = getScrolled(); // 現在のスクロール値を取得
  const ease = animate.getEasing(easing); // イージング関数を取得

  let progress = 0; // アニメーション進捗率(開始：0 ～ 終了：1)
  let easeProgress;
  let scrolled;

  // 現在値と終了値の差分を算出(動かす絶対量)
  const diff = startPos - endPos;
  
  animate.setTimer('scrollTop', animateSec, animateFrame,
    function(steps) {
      // 進捗率を算出
      progress += calc.round(1 / steps, 6);
      
      // 進捗率が100%を超えないよう丸める
      progress = Math.min(progress, 1);

      // 進捗率からイージング関数を通した変化割合を算出
      easeProgress = ease(progress);

      // スクロール位置を算出
      scrolled = startPos - (diff * easeProgress);
      
      // 小数点以下切り捨て
      scrolled = calc.round(scrolled);

      // スクロールする
      window.scrollTo(0, scrolled);

    }, function(steps, count){
      if (onComplete != null) onComplete();
    }
  );
}

/**
 * リンク元と対応するリンク先の要素にスクロール移動する関数
 *    ※リンク元:href属性名、リンク先:id属性名は一致させておく必要があります
 * @param {HTMLElement} fromElem リンク元となる要素
 */
export function scrollToTarget(fromElem) {

  // aタグのhref属性名を取得する
  const toElemId = fromElem.hash;

  // href属性名とID名が一致する要素を探す
  const toElem = document.querySelector(toElemId);

  // 見つかった要素のスクロール値を算出
  const toElemRectTop = getScrolled() + toElem.getBoundingClientRect().top;

  // スクロール移動
  scrollTo(toElemRectTop);
}

/**
 * 現在のスクロール値を取得する関数
 */
export function getScrolled() {
  return ( window.pageYOffset !== undefined ) ? window.pageYOffset: document.documentElement.scrollTop;
}

/**
 * コンテンツ全体の最大高さを取得する関数
 */
export function getContentHeight() {
  return Math.max.apply(null, [document.body.clientHeight , document.body.scrollHeight, document.documentElement.scrollHeight, document.documentElement.clientHeight]);
}

/**
 * 上下スクロール方向を取得する
 * ※必ずscrollイベント中に呼ぶ必要があります
 */
let lastScrollTop = 0;
export function getDirection() {
  let st = getScrolled();
  let direction = st > lastScrollTop ? "down" : "up";
  lastScrollTop = st <= 0 ? 0 : st;
  return direction;
}

/**
 * 毎計算ごとのスクロール差分を取得する
 * ※スクロール感度やブラウザによって、計算回数は異なる
 */
let scrolled = getScrolled();
export function getDifferencePerSteps(){
  let difference = scrolled - getScrolled();
  scrolled = getScrolled();
  return difference;
}