import * as animate from '../lib/animation';
import * as calc from '../lib/calc';

const animateSec = 500;  // アニメーション時間(ミリ秒)
const animateFrame = 60; // フレーム数

document.addEventListener("DOMContentLoaded", function() 
{
  const triggerElem = document.getElementById("accordion-trigger");
  const containElem = document.getElementById("accordion-contain");
  const innerElem = document.getElementById("accordion-inner");

  if(triggerElem != null) {
    triggerElem.addEventListener('click', function() {
      
      // コンテナ―を表示に
      containElem.classList.add('--show');
      
      // ボタンを非表示に
      triggerElem.classList.add('--hide');

      // 高さだんだん変える
      changeContainHeight(containElem, innerElem);
    }, {passive: true});
    
    function changeContainHeight(containElem, innerElem, onComplete=null, easing='easeOutQuint') {
      const ease = animate.getEasing(easing); // イージング関数を取得
      
      let progress = 0; // アニメーション進捗率(開始：0 ～ 終了：1)
      let easeProgress;
      let height;
      const offsetHeight = containElem.clientHeight;
      const maxHeight = innerElem.clientHeight - offsetHeight;

      animate.setTimer('scrollTop', animateSec, animateFrame,
        function(steps) {
          // 進捗率を算出
          progress += calc.round(1 / steps, 6);
          
          // 進捗率が100%を超えないよう丸める
          progress = Math.min(progress, 1);
    
          // 進捗率からイージング関数を通した変化割合を算出
          easeProgress = ease(progress);
    
          // 進捗率を加味した高さを算出
          height = maxHeight * easeProgress;
          
          // 小数点以下切り捨て
          height = calc.round(height) + offsetHeight;
    
          containElem.style.height = height + 'px';

        }, function(steps, count){
          if (onComplete != null) onComplete();
        }
      );
    }
  }
}, {passive: true});