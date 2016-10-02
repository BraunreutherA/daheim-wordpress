FROM tutum/apache-php:latest
MAINTAINER Gergo Ertli <egergo@gmail.com>

ENV WORDPRESS_VER=4.6.1 \
    DB_HOST="**LinkMe**" \
    DB_PORT="**LinkMe**" \
    DB_NAME=wordpress \
    DB_USER=admin \
    DB_PASS="**ChangeMe**"

RUN cd /tmp && \
    curl -s https://download.newrelic.com/548C16BF.gpg | apt-key add - && \
    echo "deb http://apt.newrelic.com/debian/ newrelic non-free" > /etc/apt/sources.list.d/newrelic.list && \
    sudo apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 16126D3A3E5C1192 && \
    apt-get update && \
    apt-get -yq install mysql-client curl unzip newrelic-php5 && \
    newrelic-install install && \
    rm -rf /app && \
    curl -0L http://wordpress.org/wordpress-${WORDPRESS_VER}.tar.gz | tar zxv && \
    mv wordpress /app && \
    rm -rf /app/wp-content/plugins/* && \
    rm -rf /app/wp-content/themes/* && \
    rm -rf /var/lib/apt/lists/* && \
    sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf && \
    a2enmod rewrite && \
    chown -R root:root /app && \
    mkdir /app/wp-content/uploads && \
    chown -R www-data:www-data /app/wp-content/uploads && \
    ln -sf /dev/stderr /var/log/apache2/error.log && \
    ln -sf /dev/stderr /app/wp-content/debug.log

ENV ARCADE_BASIC_VER=1.0.7 \
    AZURE_STORAGE_VER=3.0.1 \
    SHORTCODES_ULTIMATE_VER=4.9.9 \
    SVG_SUPPORT_VER=2.2.3.2 \
    WP_MAIL_SMTP_VER=0.9.5 \
    DEBUG_BAR_VER=0.8.4 \
    IHAF_VER=1.3.3 \
    RAW_HTML_VER=1.5

RUN cd /app/wp-content/plugins && \
    curl -otmp.zip https://downloads.wordpress.org/plugin/windows-azure-storage.${AZURE_STORAGE_VER}.zip && \
    unzip tmp.zip && \
    rm tmp.zip && \
    curl -otmp.zip https://downloads.wordpress.org/plugin/shortcodes-ultimate.${SHORTCODES_ULTIMATE_VER}.zip && \
    unzip tmp.zip && \
    rm tmp.zip && \
    curl -otmp.zip https://downloads.wordpress.org/plugin/svg-support.${SVG_SUPPORT_VER}.zip && \
    unzip tmp.zip && \
    rm tmp.zip && \
    curl -otmp.zip https://downloads.wordpress.org/plugin/wp-mail-smtp.${WP_MAIL_SMTP_VER}.zip && \
    unzip tmp.zip && \
    rm tmp.zip && \
    curl -otmp.zip https://downloads.wordpress.org/plugin/debug-bar.${DEBUG_BAR_VER}.zip && \
    unzip tmp.zip && \
    rm tmp.zip && \
    curl -otmp.zip https://downloads.wordpress.org/plugin/insert-headers-and-footers.${IHAF_VER}.zip && \
    unzip tmp.zip && \
    rm tmp.zip && \
    curl -otmp.zip https://downloads.wordpress.org/plugin/raw-html.${RAW_HTML_VER}.zip && \
    unzip tmp.zip && \
    rm tmp.zip && \

    cd /app/wp-content/themes && \
    curl -otmp.zip https://downloads.wordpress.org/theme/arcade-basic.${ARCADE_BASIC_VER}.zip && \
    unzip tmp.zip && \
    rm tmp.zip

COPY daheim /app/wp-content/themes/daheim
COPY wordpress.conf \
     wp-config.php \
     run.sh \
     daheim-google-analytics.php \
     daheim-image-url.php \
     .htaccess \
     /tmp/

RUN rm -rf /etc/apache2/sites-enabled/000-default.conf && \
    mv /tmp/wordpress.conf /etc/apache2/sites-enabled/ && \
    mv /tmp/wp-config.php /app/ && \
    mv /tmp/.htaccess /app/ && \
    mv /tmp/run.sh / && \
    mv /tmp/daheim-google-analytics.php /app/wp-content/plugins/ && \
    mv /tmp/daheim-image-url.php /app/wp-content/plugins/ && \
    chmod +x /run.sh
