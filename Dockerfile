FROM ubuntu:22.04
#this is to remove the interactive questions
ENV DEBIAN_FRONTEND=noninteractive

RUN apt update && \
    apt install -y apache2 php libapache2-mod-php php-mysql && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite (useful for PHP)
RUN a2enmod rewrite
WORKDIR /var/www/html

# Copy your project files into the container
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]