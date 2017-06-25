FROM php:7.1.6-alpine
ADD . /../Trial
WORKDIR /../Trial
CMD ["php", "-S", "0.0.0.0:8080", "Web/index.php"]
