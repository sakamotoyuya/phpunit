FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y \
    wget \
    sudo \
    gnupg \
    vim
RUN echo "Set disable_coredump false" >> /etc/sudo.conf
RUN wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | sudo apt-key add -
RUN echo "deb https://pkg.jenkins.io/debian-stable binary/" >> /etc/apt/sources.list
RUN sudo apt-get update
RUN sudo apt-get install -y jenkins &&\
# jdkは-yでインストールコマンドで入れることで解消する。
 sudo apt-get install -y openjdk-8-jdk

# jdkをwget似て入れていたがこの方法だとうまく動かなかった
# ADD openjdk-11+28_linux-x64_bin.tar.gz /opt/jdk/
# ENV PATH /opt/jdk/jdk-11/bin:$PATH
# RUN wget https://download.java.net/openjdk/jdk11/ri/openjdk-11+28_linux-x64_bin.tar.gz
# RUN mkdir /opt/jdk
# RUN tar -zxvf openjdk-11+28_linux-x64_bin.tar.gz -C /opt/jdk/
# RUN rm -R openjdk-11+28_linux-x64_bin.tar.gz 

#WORKDIR ./product-register
CMD ["bash"]
