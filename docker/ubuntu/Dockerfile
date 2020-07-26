FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y \
    wget \
    sudo \
    gnupg \
    vim
# Jenkinsのインストール
RUN echo "Set disable_coredump false" >> /etc/sudo.conf && \
wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | sudo apt-key add - && \
echo "deb https://pkg.jenkins.io/debian-stable binary/" >> /etc/apt/sources.list && \
sudo apt-get update && \
sudo apt-get install -y jenkins && \
# jdkは-yでインストールコマンドで入れることで解消する。
sudo apt-get install -y openjdk-8-jdk && \
sudo apt-get install -y git && \
sudo apt-get install -y ruby && \
sudo apt-get install -y gem && \
gem install ultrahook

RUN sudo apt-get install -y \
    php \
    php-mbstring \
    php-xml
#echo "api_key: 取得したAPIキー" > ~/.ultrahook
#ultrahook stripe 8080
# jdkをwget似て入れていたがこの方法だとうまく動かなかった
# ADD openjdk-11+28_linux-x64_bin.tar.gz /opt/jdk/
# ENV PATH /opt/jdk/jdk-11/bin:$PATH
# RUN wget https://download.java.net/openjdk/jdk11/ri/openjdk-11+28_linux-x64_bin.tar.gz
# RUN mkdir /opt/jdk
# RUN tar -zxvf openjdk-11+28_linux-x64_bin.tar.gz -C /opt/jdk/
# RUN rm -R openjdk-11+28_linux-x64_bin.tar.gz 

#WORKDIR ./product-register
CMD ["bash"]
