# Описание

TODO

# Настройка окружения

1. Установка (уберете ненужные команды):

```shell
git clone https://github.com/Terqaz/Zephyr.git && \
    cd Zephyr && \
    sudo apt update && \
    sudo apt upgrade && \ 
    sudo apt install apache2 && \
    sudo apt install php8.3 libapache2-mod-php8.3 php8.3-common php8.3-curl php8.3-intl php8.3-mbstring php8.3-bcmath php8.3-cli && \
    sudo apt install composer && \
    composer install && \
    npm install
```

2. Создать файл ```/etc/apache2/sites-available/имя_конфига.conf``` с таким содержимым:

```
<VirtualHost *:80>
    ServerName zephyr.local
    ServerAlias www.zephyr.local

    # Uncomment the following line to force Apache to pass the Authorization
    # header to PHP: required for "basic_auth" under PHP-FPM and FastCGI
    #
    # SetEnvIfNoCase ^Authorization$ "(.+)" HTTP_AUTHORIZATION=$1

    <FilesMatch \.php$>
        # when using PHP-FPM as a unix socket
      #   SetHandler proxy:unix:/var/run/php/php8.3-fpm.sock|fcgi://dummy

        # when PHP-FPM is configured to use TCP
        # SetHandler proxy:fcgi://127.0.0.1:9000
    </FilesMatch>

    DocumentRoot /путь/от/корня/до/public
    <Directory /путь/от/корня/до/public>
        AllowOverride None
      #   AllowOverride All
      # Options FollowSymlinks
        Require all granted
        FallbackResource /index.php
    </Directory>

    # uncomment the following lines if you install assets as symlinks
    # or run into problems when compiling LESS/Sass/CoffeeScript assets
    # <Directory /var/www/project>
    #     Options FollowSymlinks
    # </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

Указать вместо ```/путь/от/корня/до/public``` путь до папки public в проекте

3. Активировать конфиг:

```shell
sudo a2ensite имя_конфига.conf
```

Если Apache уже был запущен, то перезапустить:

```shell
service apache2 reload
```

или

```shell
sudo systemctl restart apache2.service
```

4. Добавить в ```/etc/hosts``` строку:

```
127.0.0.1 zephyr.local
```

# Запуск

## Apache

```shell
service apache2 start
```

Также можно добавить в автозагрузку при запуске ОС:

```shell
sudo systemctl enable apache2
```

Можно проверить статус сервиса Apache:

```shell
sudo systemctl status apache2.service
```

## dev-окружение

1. Установить в .env.local параметр (он по-умолчанию в проекте):

```env
APP_ENV=dev
```

2. Запуск в watch:
   
```shell
npm run watch
```

3. Просто сборка dev:
   
```shell
npm run dev
```

## prod-окружение

1. Установить в .env.local параметр:

```env
APP_ENV=prod
```

2. Собрать фронт:

```shell
npm run build
```
