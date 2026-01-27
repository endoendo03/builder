# PHPの公式イメージ (PHP-FPM、Alpine Linuxベース)
FROM php:8.2-fpm-alpine

# 必要なパッケージと拡張機能をインストール
RUN apk update && apk add \
    git \
    curl \
    icu-dev \
    libxml2-dev \
    sqlite-dev \
    $PHPIZE_DEPS \
    && rm -rf /var/cache/apk/*

# PHP拡張機能のインストール (CI4でよく使われるもの)
RUN docker-php-ext-install pdo pdo_mysql opcache \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_sqlite

# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 開発用設定
WORKDIR /var/www/html

# ユーザー権限の設定（任意）
RUN adduser -D -u 1000 appuser
RUN chown -R appuser:appuser /var/www/html
USER appuser

# PHP-FPMを実行
CMD ["php-fpm"]
