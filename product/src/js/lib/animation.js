// タイマー管理
let timer = {};

/**
 * イージング関数を取得します
 * @param {string} easingType イージング関数の名称
 */
export function getEasing(easingType) {
  let ease;
  switch (easingType) {
    case 'easeOutQuint':
      ease = function(x) {
        return 1 - Math.pow(1 - x, 5);
      };
    break;
    case 'easeInOutCirc':
      ease = function(x) {
        return x < 0.5 ? (1 - Math.sqrt(1 - Math.pow(2 * x, 2))) / 2 
                       : (Math.sqrt(1 - Math.pow(-2 * x + 2, 2)) + 1) / 2;
      };
    break;
  }
  return ease;
}

/**
 * CPU処理遅延時間を考慮しつつ、正確にステップ動作する自動調整タイマーです
 * @param {string} timer_id タイマーを識別するID
 * @param {number} time アニメーションさせる時間ミリ秒）
 * @param {number} frame 1秒あたりのフレーム数
 * @param {Function} onInstance ステップごとに一度おこなう処理
 * @param {Function} onComplete 終了後に一度おこなう処理
 */
export function setTimer(timer_id, time, frame, onInstance, onComplete) {
  var steps = (time / 100) * (frame / 10),
      speed = time / steps,
      count = 0,
      start = new Date().getTime();

  window.clearTimeout(timer[timer_id]);

  function instance() {
    if(count++ == steps) {
      onComplete(steps, count);
    } else {
      onInstance(steps, count);
      var diff = (new Date().getTime() - start) - (count * speed);
      timer[timer_id] = window.setTimeout(instance, (speed - diff));
    }
  }
  timer[timer_id] = window.setTimeout(instance, speed);
}