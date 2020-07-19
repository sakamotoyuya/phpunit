# phpunitの導入方法
`composer install`
`composer dump-autoload`

https://qiita.com/niisan-tokyo/items/8cccec88d45f38171c94

## phpunitの実行方法
`./vendor/bin/phpunit tests`

## dockerの構築について
ビルドして開始する方法
```
cd ./docker/ubuntu/
docker-compose build
docker-compose up -d
docker-compose exec web bash
```
停止する方法

## 備忘録
jenkinsのインストール
https://pkg.jenkins.io/debian-stable/