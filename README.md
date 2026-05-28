# user-management

# Start Docker environment
docker-compose up -d --build

# Open Browser and access app at
http://localhost:8080

# Database Initialization
Database is automatically created on first docker-compose build. Database schema is here docker/mysql/init.sql

# Run PHPUnit
docker exec -it php_app composer test

# Rebuild autoload (if needed)
docker exec -it php_app composer dump-autoload
