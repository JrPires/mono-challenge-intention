FROM php:8.1-apache

# Instala as dependências do sistema
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP
RUN docker-php-ext-install pdo pdo_pgsql

# Copia o código-fonte do projeto PHP para o contêiner
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Porta em que o Apache estará ouvindo
EXPOSE 8000

# Comando para iniciar o servidor web (Apache)
CMD ["apache2-foreground"]
