FROM docker_base_image

# Configure timezone
RUN ln -fs /usr/share/zoneinfo/Europe/Madrid /etc/localtime

# Install php
RUN add-apt-repository ppa:ondrej/php
RUN mkdir /run/php
RUN apt-get install -y \
    imagemagick \
    pdftk \
    php8.2 \
    php8.2-apcu \
    php8.2-curl \
    php8.2-fpm \
    php8.2-gd \
    php8.2-intl \
    php8.2-mbstring \
    php8.2-mysql \
    php8.2-xml \
    php8.2-zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add some configuration
ADD filesystem/ /

CMD ["php-fpm8.2", "-F"]
