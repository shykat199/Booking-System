# Laravel University Project

A Laravel-based university management system with advanced search capabilities using Laravel Scout and Meilisearch.

## 🌐 Live Demo

- **Public URL**: [https://test.dnox.xyz/university](https://test.dnox.xyz/university)
- **Admin Panel**: [https://test.dnox.xyz/login](https://test.dnox.xyz/login)

### Admin Credentials
```
Email: admin@gmail.com
Password: 12345678
```

## ✨ Features

- **Advanced Search**: Fuzzy search with prefix matching using Laravel Scout and Meilisearch
- **Filter System**: Filter universities by country
- **Load More**: Pagination with load more functionality
- **Seeded Data**: Pre-populated dummy data for countries, cities, programs, and universities

## 📋 Prerequisites

- PHP >= 8.1
- Composer
- Apache Web Server
- MySQL/MariaDB
- Node.js & NPM
- Meilisearch

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd <project-directory>
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
npm run build
```

### 4. Environment Configuration

Create your environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Update your `.env` file with the following configurations:

```env
APP_NAME="University Management"
APP_URL=https://test.dnox.xyz

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://127.0.0.1:7700
MEILISEARCH_KEY="3a84e01f-0fc7-4685-8553-f2f29f71c333"
```

### 5. Database Setup

Run migrations:

```bash
php artisan migrate
```

### 6. Seed Database with Dummy Data

Run the seeders to populate your database:

```bash
php artisan db:seed --class=CountrySeeder
php artisan db:seed --class=CitySeeder
php artisan db:seed --class=ProgramSeeder
php artisan db:seed --class=UniversitySeeder
```

Or seed all at once:

```bash
php artisan db:seed
```

## 🔍 Laravel Scout & Meilisearch Setup

### Install Laravel Scout

```bash
composer require laravel/scout
```

Publish Scout configuration:

```bash
php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
```

### Install Meilisearch PHP Client

```bash
composer require meilisearch/meilisearch-php
```

### Install Meilisearch Server

#### For Ubuntu/Debian:

```bash
curl -L https://install.meilisearch.com | sh
```

Move to bin directory:

```bash
sudo mv ./meilisearch /usr/local/bin/
```

#### For macOS (using Homebrew):

```bash
brew install meilisearch
```

#### For Windows:

Download the latest release from [Meilisearch GitHub](https://github.com/meilisearch/meilisearch/releases)

### Configure Meilisearch

Start Meilisearch with your master key:

```bash
meilisearch --master-key="3a84e01f-0fc7-4685-8553-f2f29f71c333"
```

### Index Your Data

Import existing data into Meilisearch:

```bash
php artisan scout:import "App\Models\University"
```

Flush and reimport if needed:

```bash
php artisan scout:flush "App\Models\University"
php artisan scout:import "App\Models\University"
```

## 🌐 Apache Configuration

### Enable Required Modules

```bash
sudo a2enmod rewrite
sudo a2enmod ssl
sudo systemctl restart apache2
```

### Virtual Host Configuration

Create a new virtual host file:

```bash
sudo nano /etc/apache2/sites-available/university.conf
```

Add the following configuration:

```apache
<VirtualHost *:80>
    ServerName test.dnox.xyz
    DocumentRoot /path/to/your/project/public

    <Directory /path/to/your/project/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/university_error.log
    CustomLog ${APACHE_LOG_DIR}/university_access.log combined
</VirtualHost>
```

For HTTPS (recommended):

```apache
<VirtualHost *:443>
    ServerName test.dnox.xyz
    DocumentRoot /path/to/your/project/public

    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    SSLCertificateChainFile /path/to/chain.crt

    <Directory /path/to/your/project/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/university_ssl_error.log
    CustomLog ${APACHE_LOG_DIR}/university_ssl_access.log combined
</VirtualHost>
```

Enable the site:

```bash
sudo a2ensite university.conf
sudo systemctl reload apache2
```

### Set Permissions

```bash
sudo chown -R www-data:www-data /path/to/your/project
sudo chmod -R 755 /path/to/your/project
sudo chmod -R 775 /path/to/your/project/storage
sudo chmod -R 775 /path/to/your/project/bootstrap/cache
```

## 🔄 Keep System Running (Production)

### Running Meilisearch as a Service

Create a systemd service file:

```bash
sudo nano /etc/systemd/system/meilisearch.service
```

Add the following:

```ini
[Unit]
Description=Meilisearch
After=network.target

[Service]
Type=simple
User=www-data
ExecStart=/usr/local/bin/meilisearch --master-key="3a84e01f-0fc7-4685-8553-f2f29f71c333" --env production
Restart=on-failure

[Install]
WantedBy=multi-user.target
```

Enable and start the service:

```bash
sudo systemctl daemon-reload
sudo systemctl enable meilisearch
sudo systemctl start meilisearch
sudo systemctl status meilisearch
```

### Running Laravel Queue (if applicable)

If you're using queues, create a supervisor configuration:

```bash
sudo nano /etc/supervisor/conf.d/laravel-worker.conf
```

Add:

```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/your/project/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/path/to/your/project/storage/logs/worker.log
stopwaitsecs=3600
```

Update supervisor:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

## 🔎 Search Features

This project uses **Laravel Scout** with **Meilisearch** to provide:

- **Fuzzy Search**: Handles typos and approximate matches
- **Prefix Search**: Search as you type with instant results
- **Fast Performance**: Meilisearch provides sub-50ms search responses
- **Relevance Ranking**: Automatically ranks results by relevance

### How It Works

The search functionality allows users to find universities with:
- Typo tolerance
- Prefix matching (searching for "har" will match "Harvard")
- Multi-field search across university names, locations, and programs
- Country-based filtering
- Load more pagination for better UX

## 🛠️ Maintenance Commands

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Rebuild Search Index

```bash
php artisan scout:flush "App\Models\University"
php artisan scout:import "App\Models\University"
```

### Check Meilisearch Status

```bash
curl http://127.0.0.1:7700/health
```

## 📝 Notes

- Make sure Meilisearch is running before starting the application
- For production, always use HTTPS and secure your master key
- Keep your `.env` file secure and never commit it to version control
- Regular backups of your database are recommended

## 🐛 Troubleshooting

**Search not working?**
- Check if Meilisearch is running: `sudo systemctl status meilisearch`
- Verify the index exists: Visit `http://127.0.0.1:7700` in browser
- Reimport data: `php artisan scout:import "App\Models\University"`

**Apache issues?**
- Check error logs: `sudo tail -f /var/log/apache2/error.log`
- Verify permissions: Ensure `storage` and `bootstrap/cache` are writable

**Database connection failed?**
- Verify credentials in `.env`
- Check if MySQL is running: `sudo systemctl status mysql`

## 📄 License

[Your License Here]

## 👥 Contributors

[Your Name/Team]
