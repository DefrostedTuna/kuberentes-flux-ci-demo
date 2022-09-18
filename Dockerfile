FROM defrostedtuna/php-nginx:8.0

# Copy the project files to the container.
COPY . /app

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set the application permissions.
RUN chown -R www:www /app
RUN chmod -R ug+rwx /app/storage /app/bootstrap/cache
RUN chmod -R 774 /app/storage/logs