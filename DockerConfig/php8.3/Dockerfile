FROM php:8.3-apache

# Install System Dependencies
RUN apt-get update -y \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
	software-properties-common \
	&& apt-get update -y \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -y \
	nodejs \
    yarn \
	libfreetype6-dev \
	libicu-dev \
    libssl-dev \
	libjpeg62-turbo-dev \
	libmcrypt-dev \
	libedit-dev \
	libedit2 \
	libxslt1-dev \
	libzip-dev \
	apt-utils \
	gnupg \
	mariadb-client \
	zlib1g-dev \
	libpng-dev \
	libjpeg-dev \
	git \
	vim \
	wget \
	curl \
	lynx \
	psmisc \
	unzip \
	tar \
	cron \
	bash-completion \
	zsh \
	&& apt-get clean

# Yarn
RUN curl https://deb.nodesource.com/setup_12.x | bash
RUN curl https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

# Install PHP Extensions
RUN docker-php-ext-configure \
  	gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/; \
  	docker-php-ext-install \
  	opcache \
  	bcmath \
  	gd \
  	intl \
  	mysqli \
  	pdo_mysql \
  	soap \
  	xsl \
  	zip \
  	sockets

# Install Composer
RUN	curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Install Oh MyZSH
RUN wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | zsh || true

# Install Symfony CLI
WORKDIR /root
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Configuring system
ADD /DockerConfig/config/php.ini /usr/local/etc/php/php.ini

# Commandes pour installer ssmtp
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y wget
RUN wget https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64

# Configuration de mhsendmail
RUN chmod +x mhsendmail_linux_amd64 && mv mhsendmail_linux_amd64 /usr/local/bin/mhsendmail


# Permissions / Shell par défaut / Activation de modules apache
RUN chmod 777 -Rf /var/www /var/www/.* \
	&& chown -Rf www-data:www-data /var/www /var/www/.* \
	&& usermod -u 1000 www-data \
	&& chsh -s /bin/zsh www-data\
	&& a2enmod rewrite \
	&& a2enmod headers

VOLUME /var/www/html
WORKDIR /var/www/html


# Copie des sources
COPY ./app/ /var/www/html

# Dépendances Composer
#RUN cd /var/www/html
#RUN composer install --no-dev --no-interaction --no-autoloader --no-scripts
#RUN composer dump-autoload --optimize