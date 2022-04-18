/**
 * スマートフォンかどうか判定する(タブレットはPC扱い)
 */
export function isSmartPhone() {
  if (window.matchMedia && window.matchMedia('(max-device-width: 959px)').matches) {
    return true;
  } else {
    return false;
  }
}