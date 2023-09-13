== smylink
/home/lsppolri/public_html/simase/laravel/storage/app/public/uploads /home/lsppolri/public_html/simase/storage

== Perintah Cron Job 

/usr/local/bin/php /home/lsppolri/public_html/simase/laravel/artisan schedule:run >> /home/lsppolri/public_html/simase/laravel/storage/logs/laravel.log 2>&1

== .htaccess

Options +FollowSymLinks -Indexes
RewriteEngine On

RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]

# php -- BEGIN cPanel-generated handler, do not edit
# Set the “alt-php81” package as the default “PHP” programming language.
<IfModule mime_module>
  AddHandler application/x-httpd-alt-php81___lsphp .php .php8 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit

== .env

APP_NAME=SIMASE
APP_ENV=local
APP_KEY=base64:RvCOwXK8fOGkD4Kb79pn2lrStYHF7l4K/09V8H+8lhQ=
APP_DEBUG=true
APP_URL=http://simase.lsppolri.id/

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=lsppolri_simase
DB_USERNAME=lsppolri_simase
DB_PASSWORD=*55y$,gj^W6Y

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=kevinalmer.bisnis@gmail.com
MAIL_PASSWORD=szjnbcpcbkpvggte
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=kevinalmer.bisnis@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
