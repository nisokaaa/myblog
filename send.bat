@echo off

rem webpackビルド
docker-compose up -d
docker exec -it webpack npm run b

rem productディレクトリへ移動
rem themeフォルダを圧縮し、「file.tar.gz」を出力
cd ./product
tar -zcf ./file.tar.gz theme

rem ビルドで消されたファイル復元
type nul > .gitkeep
move .gitkeep ./theme/public/js

rem サーバのWordpressテーマフォルダへ転送
scp ./file.tar.gz wpX:~/mazoboy.com/public_html/wp-content/themes > nul
del .\*.tar.gz

rem 対象ディレクトリへ移動
rem ファイル解凍
rem 既存テーマファイル削除
rem フォルダリネーム
rem 転送ファイル削除
ssh wpX "cd ~/mazoboy.com/public_html/wp-content/themes; rm -rf ./my_theme; tar zxf ./file.tar.gz; mv ./theme ./my_theme; rm -rf ./file.tar.gz;"