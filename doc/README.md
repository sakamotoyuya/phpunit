# phpunitの導入方法
`composer install`
`composer dump-autoload`

https://qiita.com/niisan-tokyo/items/8cccec88d45f38171c94

`./doc/composer`を`./web/`にコピーして使用する  
パスを通してない場合は、  
`php ./web/composer install`で実行可能。  
実行にはphpのインストールが必須。


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
#これでjenkinsの起動まで実施可能
docker-compose up -d
#中に入りたいときはこっち
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

## jenkinsとGitHubの連携設定方法
- APIトークンの設定  
  - 画面右上のユーザアイコン > 設定 > APIトークン > Add new token  
  - ユーザID入力 して生成したトークンは保持しておく  
- 新規ジョブ作成（GitHubPush）
  - ソースコード管理 > リポジトリURLに設定
  - ビルド・トリガ > リモートからビルドにチェック > 認証トークンに任意の文字列
- 新規ジョブ作成（RunPhpUnit）
  - ビルド・トリガ > 他プロジェクトの後にビルドにチェック > 対象プロジェクトにGitHubPush(作成済のjob名) > 安定している場合のみ起動にチェック
  - ビルド > `/var/lib/jenkins/workspace/GitHubPush/web/vendor/bin/phpunit /var/lib/jenkins/workspace/GitHubPush/web/tests`
- GitHubの設定
  - 設定 > WebHook > ペイロードURL > `http://[ユーザID]:[APIトークン]@stripe.yuyasakamoto.ultrahook.com/job/GitHubPush/build?token=[トークン]`
  - [ユーザID]と[APIトークン]はAPIトークンの設定で生成したものを指定する。
  - [トークン]はリモートからビルドで設定したトークンを設定する。URLもトークン生成時に生成されたものを指定する。
  - webhookを更新するで登録する。

## jenkinsの文字化け修正について
```
sudo vi /etc/default/jenkins
以下を追加
JAVA_ARGS="-Dfile.encoding=utf-8"
再起動
sudo service jenkins restart
```
参考は以下の通り。
https://shunirr.hatenablog.jp/entry/2013/01/10/175426

## ultrahookについて
公開されたエンドポイントからローカルへ通信を転送してくれるサービス  
http://www.ultrahook.com/  
ここから登録してキーを発行しておく。
