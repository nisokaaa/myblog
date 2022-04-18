/**
 * 小数点以下を切り捨てます
 * @param {number} x 切り捨てたい値
 * @param {number} n 小数点第何位まで残すか(default：0)
 */
export function round(x, n=0) {
  return Math.round( x * Math.pow( 10, n ) ) / Math.pow( 10, n );
}