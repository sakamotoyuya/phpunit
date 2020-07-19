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
RUN sudo apt-get install -y jenkins
#WORKDIR ./product-register
CMD ["bash"]
