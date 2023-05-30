FROM php:8.1-fpm

# Instala as dependências do sistema
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP
RUN docker-php-ext-install pdo pdo_pgsql

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia o código-fonte do projeto PHP para o contêiner
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

RUN composer install --no-interaction --no-plugins --no-scripts

EXPOSE 9000

# Comando para iniciar o servidor web 
ENTRYPOINT ["php-fpm"]
