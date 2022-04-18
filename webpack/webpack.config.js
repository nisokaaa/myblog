/* ---------------------------------------
  使用モジュール一覧
--------------------------------------- */
// webpack                            ：
// webpack-cli                        ：
// fibers                             ：コンパイル速度の向上
// clean-webpack-plugin               ：ビルド時に既存ファイルを削除する
// terser-webpack-plugin              ：JavaScript用のminify（圧縮）プラグイン（optimization.minimizerを上書きする）
// css-minimizer-webpack-plugin       ：CSS用のminify（圧縮）プラグイン（optimization.minimizerを上書きする）
// mini-css-extract-plugin            ：js変換したCSSを通常のCSSファイルとして吐き出す(本プロジェクトでは[sass→css]と[plugin関連css]の2つを1つのcssファイルにbundleして出力してる)

// @babel/core                        ：
// @babel/preset-env                  ：
// babel-loader                       ：ES2015（ES6）のコードをES5(IE5)のコードに変換

// css-loader                         ：CSSをjsとして読み込む
// style-loader                       ：js変換したCSSを<style>タグとして埋め込むjsコードを生成する
//                                      (出力形式はあくまでCSSをバンドルしたjsであり、CSSが肥大化すると同時にjsファイルサイズも大きくなるため、CSSは別ファイルとして出力することを推奨)
// sass                               ：Sassコンパイラー(DartSass)
// sass-loader                        ：メタCSS言語をコンパイルする役割(CSSの文字列に変換してるだけ)

// postcss-loader                     ：PostCSSモジュールを使うためのローダー
// autoprefixer                       ：CSSにベンダープレフィックスを付与(PostCSSモジュール)
// css-declaration-sorter             ：CSSプロパティのソート(PostCSSモジュール)
// postcss-sort-media-queries         ：CSSのメディアクエリ記述をひとまとめにする(PostCSSモジュール)


/* ---------------------------------------
  モジュールの変数定義
--------------------------------------- */
// ファイル出力時の絶対パス指定に使用
const path = require('path');
// js圧縮
const TerserPlugin = require('terser-webpack-plugin');
// css圧縮
const OptimizeCSSAssetsPlugin = require('css-minimizer-webpack-plugin');  
// jqueryで使用
const webpack = require('webpack');
// 出力フォルダのクリーンアップ
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
// CSSを別ファイルとして生成し<link>タグとして埋め込むプラグイン
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

/* ---------------------------------------
  モジュールバンドル設定
--------------------------------------- */
// production モードなら圧縮する
const enabledCompress = process.env.NODE_ENV == 'production';

module.exports = {

  /* ---------------------------------------
    入力設定
  --------------------------------------- */
  entry: {
    // TOPページ
    front_mobile: "./src/js/front.entry.mobile.js",   
    front_desktop:  "./src/js/front.entry.desktop.js",

    // 記事ページ
    single_mobile: "./src/js/single.entry.mobile.js",
    single_desktop: "./src/js/single.entry.desktop.js",

    // 一覧ページ
    list_mobile: "./src/js/list.entry.mobile.js",
    list_desktop: "./src/js/list.entry.desktop.js",
  },

  
  /* ---------------------------------------
    出力設定
  --------------------------------------- */
  output: {
    // 出力ファイル名
    filename: "js/[name].bundle.js",
    // 出力先パス（絶対パスを指定必須）
    path: path.resolve(__dirname, 'dist'),
  },


  /* ---------------------------------------
    ローダー設定
  --------------------------------------- */
  module: {
    rules: [
      // Webpackプラグインのcssをjsでロードするセット
      {
        // node_module内のcssのみ対象(Swiperプラグインのbundle.cssとか)
        test: /node_modules\/(.+)\.css$/,
        use: [
          // [処理2] CSSファイルを別ファイル出力する
          {
            loader: MiniCssExtractPlugin.loader,
          },
          // [処理1] CSSをバンドルするローダー
          {
            loader: "css-loader",
            options: { url: false },
          },
        ]
      },

      /* ES2015(ES6)コードのトランスコンパイル処理するセット
        (javascriptコードをどのブラウザでも動作させるため) */
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
        options: {
          presets: [['@babel/preset-env', { modules: false }]]
        }
      },
      
      // Sassファイルを通常CSSファイルとして別途出力するセット
      {
        test: /\.scss$/,
        use: [
          // [処理4] CSSファイルを別ファイル出力する
          {
            loader: MiniCssExtractPlugin.loader,
          },
          // [処理3] CSSをjsとして読み込む、バンドルする
          {
            loader: "css-loader",
            options: {
              //URL の解決を無効に
              url: false,
              // css-loader の前に適用されるローダーの数（2）を設定
              importLoaders: 2,
              // ソースマップを有効に
              sourceMap: true,
            }
          },
          // [処理2] CSSを整理する
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                plugins: [
                  // ベンダープレフィックスを自動付与
                  "autoprefixer",
                  //  メディアクエリをひとまとめにする（mobile-first でソート）
                  ['postcss-sort-media-queries', { sort: 'mobile-firstl' }],
                ],
              },
              // PostCSS側でもソースマップを有効に
              sourceMap: true,
            },
          },
          // [処理1] メタ言語をコンパイルする(CSSの文字列に変換してる)
          {
            loader: "sass-loader",
            options: {
              // dart-sass を優先
              implementation: require('sass'),
              sassOptions: {
                // fibers コンパイル速度向上
                fiber: require('fibers'),
              },
              // ソースマップを有効に
              sourceMap: true,
            },
          },
        ],
      },
    ]
  },


  /* ---------------------------------------
    圧縮設定
  --------------------------------------- */
  optimization: {
    minimize: true,
    // mode:puroductionでビルドした場合のファイル圧縮
    minimizer: enabledCompress ? [ 
      new TerserPlugin({
        extractComments: false, // LICENSE.txtの出力OFF
        parallel: true,
        terserOptions: {
          ecma: 6,
          compress: { 
            drop_console: true  // console出力除去
          },
          output: {
            comments: false,    // コメント削除
            beautify: false
          }
        },
      }),
      new OptimizeCSSAssetsPlugin()
    ] : []
  },


  /* ---------------------------------------
    プラグイン設定
  --------------------------------------- */
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: "jquery",
    }),
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: 'css/[name].bundle.css',
    }),
  ],


  /* ---------------------------------------
    その他設定
  --------------------------------------- */
  // パフォーマンス限界設定
  performance: {
    maxEntrypointSize: 500000,
    maxAssetSize: 500000,
  },
  //source-map タイプのソースマップを出力
  devtool: 'source-map',
  // node_modules を監視（watch）対象から除外
  watchOptions: {
    ignored: /node_modules/,  //正規表現で指定
    poll: 100,
  },

};