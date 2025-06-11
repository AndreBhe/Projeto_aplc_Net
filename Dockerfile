# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instale extensões necessárias (mysqli para MySQL)
RUN docker-php-ext-install mysqli

# Copie os arquivos do projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Dê permissão para o Apache acessar os arquivos
RUN chown -R www-data:www-data /var/www/html

# Habilite o módulo de reescrita do Apache (caso precise futuramente)
RUN a2enmod rewrite

# Exponha a porta padrão do Apache
EXPOSE 80

# Comando padrão para iniciar o Apache
CMD ["apache2-foreground"] 