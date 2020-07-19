## コマンド一覧
docker hubにログインする

```sh
$docker login
```

docker hub からイメージを持ってくる
```sh
$docker pull <images>
```

Container(Ubuntu) に入るためのコマンド  
```sh
$docker run -it <image> bash
```

image からコンテナを生成して動作させるコマンド
`-it`は入出力を制御するコマンド。必須。
```sh
$docker run -it <image> <command>
```

Containerから抜けるためのコマンド
```sh
$exit
```

ホストにあるcontainerの一覧を全て表示する
※-aがない場合は動いている物しか表示しない。
```sh
$docker ps -a
```

ホストにあるイメージの一覧を表示する
```sh
$docker images
```

exit状態のコンテナに入る
```sh
$docker restart
```

docker のあるコンテナに対してbashのあるコマンドを実行する
```sh
$docker exec -it <container> bash
```

コンテナから新しいイメージを作る
```sh
$docker commit <container> <image>
```

docker hubにアップするとき
イメージの名前はリポジトリ名と一致しなければならない。
そのためにtag付けしてリネームするコマンド。
```sh
$docker tag <source> <target>
```

docker hubにイメージをプッシュするコマンド
```sh
$docker push <image>
```

イメージを削除するコマンド
```sh
$docker rmi <image>
```

containerを一つ削除する  
※containerは停止(exit)状態出ないと削除できない
```sh
$docker rm
```

停止(exit)状態のcontainerを全て削除するコマンド
```sh
$docker system prune
```

# いろいろなdocker run
コンテナ名の指定をして動作させる方法
```sh
$docker run -name <container_name> <image>
```

バックグラウンド(detached)モードで動作させるコマンド  
※裏で動かしておくコマンド
```sh
$docker run -d <images>
```

フォアグラウンドモード(動させた後exitになったらすぐ消す)で動作させるコマンド  
※1回きりしか使わないようなコンテナの場合に使う
```sh
$docker run -rm <image>
```

## option のいろいろ
```sh
$docker run <option>
```
- -v <host/path>:<container/path>
  - ファイルシステムの共有
- -u $(id -u):$(id -g)
  - ファイルへのアクセス権限
- -p <host_port>:<container_port>
  - ポートをつなげる
- --cpus <#ofCPUs> -memory <byte>
  - コンピュータリソースの上限
- $docker inspect <container> | grep -i <something>
  - コンテナの詳細を表示


## dockerファイルについて
```sh
FROM <image>・・・ベースとなるドッカーイメージを決める
RUN <instruction>・・・命令を実行する
CMD []
```
必要最低限のイメージを作成するのが良い。

```sh
FROM ubuntu:latest
RUN apt-get update && apt-get install -y \
    curl \
    cvs \
    git \
    nginx
CMD ["/bin/bash"]
```
エントリポイントを使う時はCMDの形が変わる。
（CMDはドッカーイメージのデフォルトのコマンド）

- Docker daemon
  - ドッカービルドとドッカーファイルをイメージにビルドするときに
    ドッカービルドが置いてあるフォルダを
    ドッカーデーモンに渡してドッカーデーモーンがそのフォルダと
    ドッカーファイルを元にドッカーイメージを作る。
    そのフォルダのことをbuild contextという。
    ドッカーデーモンに命令を送ってビルドを行っていた。
- build context
  - buildcontext の中に何かファイルを置いて、それをイメージファイル  
    で利用可能になる。COPYとADDを利用することで、dockerimageに送る
    ことが可能になる。
- COPY
  - そのままおくる。悩んだらこっちをつかう。ただ重い。
- ADD
  - 圧縮されたtarファイルをdockerimageに送って、  
    さらにそれを解凍する。  
- docker build -f <dockerfile> <build context>
  - -fを指定することで特定のdockerfileを指定してビルドできる。
- ENTRYPOINT
  - docker run したときのデフォルトのコマンドを上書きできなくなる。
    これを指定した場合は、CMDはENTRYPOINTで指定したコマンドの  
    引数を指定する記載方法になる。 
- ENV
  - 環境変数を指定する。パスを通すときに必要。
- WORKDIR
  - 絶対パスの指定。これを指定することで、指定した箇所での作業が可能。

## docker-compose

`docker-compose.yml`ファイルを作って以下のようにする。

```yml
version: '3' #大体3で良い。

services:
  web:
    build: . #Dockerファイルのフォルダを指定する。
    ports: #ポートを指定
      - '3000:3000'
    volumes: #マウント先を指定する
      - '.:/product-register'
    tty: true  #これで-tの標準出力を指定
    stdin_open: true #これで-iの標準入力を指    
```
    
docker-commandを実行するコマンド配下の通り。
- `docker-compose build` 
  - docker imageをビルドするコマンド。  
   本来は`docker build <build contexts>`
   それが`docker-compose build`だけで良くなる。
   指定する先はdocker-compose.ymlに入っているため不要。
- `docker-compose up`
  - `$docker run <image>`と同じ。  
    ただ、imageは不要となる。
- `docker-compose ps`
    `$docker ps`と同じ。
- `docker-compose up --build  `
  - buildしてrun
- `docker-compose down`
  - stopしてrm
- `docker-compose exec web bash`
  - `docker-compose exec <service> <command>`
  - コンテナに入るコマンド。コンテナに入るコマンドはファイル内で定義できないためexecを使う必要がある。


    