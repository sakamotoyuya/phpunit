# phpunitの導入方法
`composer install`
`composer dump-autoload`

https://qiita.com/niisan-tokyo/items/8cccec88d45f38171c94

## phpunitの実行方法
`./vendor/bin/phpunit tests`

## dockerの構築について
予め以下のサイトから
以下をインストールしておく
wget https://download.java.net/openjdk/jdk11/ri/openjdk-11+28_linux-x64_bin.tar.gz

ビルドして開始する方法
```
cd ./docker/ubuntu/
docker-compose build
docker-compose up -d
docker-compose exec web bash
```
停止する方法
`docker-compose stop`  

jenkinsの開始
`service jenkins start`  
IP:8080にアクセスすることでjenkins利用可能

## 備忘録
jenkinsのインストール  
https://pkg.jenkins.io/debian-stable/