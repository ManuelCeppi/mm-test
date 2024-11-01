FROM ubuntu:20.04

RUN apt-get update && \
    apt-get -y install sudo

RUN sudo apt-get -y install curl
RUN sudo apt-get install -y mysql-client

COPY install-dbmate.sh /install-dbmate.sh
RUN chmod +x /install-dbmate.sh
RUN /install-dbmate.sh