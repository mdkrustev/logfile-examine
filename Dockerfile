# Use the official PHP image as the base image
FROM php:latest

# Install Nginx and other required tools
RUN apt-get update && \
    apt-get install -y nginx && \
    rm -rf /var/lib/apt/lists/* && \
    apt-get clean

# Copy the Nginx configuration file
COPY nginx.conf /etc/nginx/nginx.conf

# Set the working directory
WORKDIR /var/www/html

# Copy the PHP application files from the host to the container
COPY ./src/ .

# Expose the necessary ports
EXPOSE 80

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm

# Use the official Nginx image as the base image
FROM nginx:latest

# Copy the Nginx configuration file
COPY default.conf /etc/nginx/sites-available/default.conf

# Copy the PHP application files from the host to the container
COPY ./src/ /usr/share/nginx/html/src/

# Expose the necessary port
EXPOSE 80
