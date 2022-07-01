### Initial Setup

# Dependencies
composer install

# Create .env file


# Generate the application key
php artisan key:generate

# Database (migration and seeder)
php artisan migrate
php artisan db:seed
# or merge
php artisan migrate --seed

# Encryption keys
php artisan passport:install