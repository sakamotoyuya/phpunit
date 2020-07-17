# dockerコマンドチートシート
## コマンド一覧
docker hubにログインする
```.sh
$docker login
```

docker hub からイメージを持ってくる
```.sh
$docker pull <images>
```

Container(Ubuntu) に入るためのコマンド  
```.sh
$docker run -it <image> bash
```

image からコンテナを生成して動作させるコマンド
`-it`は入出力を制御するコマンド。必須。
```.sh
$docker run -it <image> <command>
```

Containerから抜けるためのコマンド
```.sh
$exit
```

ホストにあるcontainerの一覧を全て表示する
※-aがない場合は動いている物しか表示しない。
```.sh
$docker ps -a
```

ホストにあるイメージの一覧を表示する
```.sh
$docker images
```

exit状態のコンテナに入る
```.sh
$docker restart
```

docker のあるコンテナに対してbashのあるコマンドを実行する
```.sh
$docker exec -it <container> bash
```

コンテナから新しいイメージを作る
```.sh
$docker commit <container> <image>
```

docker hubにアップするとき
イメージの名前はリポジトリ名と一致しなければならない。
そのためにtag付けしてリネームするコマンド。
```.sh
$docker tag <source> <target>
```

docker hubにイメージをプッシュするコマンド
```.sh
$docker push <image>
```

イメージを削除するコマンド
```.sh
$docker rmi <image>
```

containerを一つ削除する  
※containerは停止(exit)状態出ないと削除できない
```
$docker rm
```

停止(exit)状態のcontainerを全て削除するコマンド
```
$docker system prune
```

# いろいろなdocker run
コンテナ名の指定をして動作させる方法
```
$docker run -name <container_name> <image>
```

バックグラウンド(detached)モードで動作させるコマンド  
※裏で動かしておくコマンド
```
$docker run -d <images>
```

フォアグラウンドモード(動させた後exitになったらすぐ消す)で動作させるコマンド  
※1回きりしか使わないようなコンテナの場合に使う
```
$docker run -rm <image>
```

## option のいろいろ
```
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
```
FROM <image>・・・ベースとなるドッカーイメージを決める
RUN <instruction>・・・命令を実行する
CMD []
```
必要最低限のイメージを作成するのが良い。

```
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

