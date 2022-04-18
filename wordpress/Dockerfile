FROM centos:7

# update yum & 必要な物をインストール
RUN yum -y update
RUN yum -y install yum-utils openssl tar wget epel-release
RUN yum clean all

# 今回はphp7をインストールしたいので、必要なremiリポジトリをインストール
RUN wget http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN rpm -Uvh remi-release-7*.rpm
RUN yum-config-manager --enable remi-php74

RUN \
    yum -y install \
    httpd \
    php \
    php-common \
    php-mbstring \
    php-mcrypt \
    php-devel \
    php-xml \
    php-mysqlnd \
    php-pdo \
    php-opcache --nogpgcheck \
    php-bcmath \
    php-gd

RUN yum clean all

RUN mkdir /app
WORKDIR /app

# WordPress日本語版を公式サイトからインストール
RUN curl -LO https://ja.wordpress.org/latest-ja.tar.gz
RUN tar xvzf latest-ja.tar.gz -C /var/www/html --strip-components=1     
RUN rm latest-ja.tar.gz  

RUN chown -R apache:apache /var/www/                                    
RUN echo "ServerName localhost" >> /etc/httpd/conf/httpd.conf

EXPOSE 80

CMD ["/usr/sbin/httpd","-D","FOREGROUND"]