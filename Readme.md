# Описание

TODO

# Настройка окружения

1. Установка (уберете ненужные команды):

```shell
git clone https://github.com/Terqaz/Zephyr.git && \
    cd Zephyr && \
    sudo apt update && \
    sudo apt upgrade && \ 
    sudo apt install apache2 postgresql && \
    sudo apt install php8.3 libapache2-mod-php8.3 php8.3-common php8.3-curl php8.3-intl php8.3-mbstring php8.3-bcmath php8.3-cli php8.3-pdo php8.3-pgsql && \
    sudo apt install composer && \
    composer install && \
    npm install
```

2. Создать файл ```/etc/apache2/sites-available/имя_конфига.conf``` с таким содержимым:

```
<VirtualHost *:80>
    ServerName zephyr.local
    ServerAlias www.zephyr.local

    SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1

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

5. Подключиться к postgres и установить пароль для пользователя postgres:

```shell
sudo -u postgres psql template1
ALTER USER postgres with encrypted password 'супер_сложный_пароль';
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

## БД

1. Указать в файле .env.local строку:

```shell
DATABASE_URL="postgresql://postgres:супер_сложный_пароль@127.0.0.1:5432/zephyr?serverVersion=16&charset=utf8"
```

2. Выполнить команды:

```shell
php bin/console doctrine:database:create && \
  php bin/console doctrine:migrations:migrate -n
```

## JWT

1. Запустить команду:

```shell
php bin/console lexik:jwt:generate-keypair
```

2. Указать в ```.env.local```:

```
JWT_PASSPHRASE=длинная_строка_по_типу_bb4ac3630b73a6de1075e76
```

3. Указать внутри ```<VirtualHost>``` в конфиге ```/etc/apache2/sites-available/имя_конфига.conf```, если еще не указали:
   
```
SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1
```

и перезапустить Apache

```shell
service apache2 reload
```

### Тест

1. Выполнить команду для добавления фикстур в БД, содержащих акк. админа (!!! данные в БД будут удалены):

```shell
php bin/console doctrine:fixtures:load --env=dev -n
```

Чтобы данные в БД не удалились нужно использовать команду:

```shell
php bin/console doctrine:fixtures:load --env=dev -n --append
```

2. Выполнить ```/api/login_check``` в ApiPlatform ```http://zephyr.local/api/docs``` с данными админа. Должен прийти ```token``` и ```refresh_token```

3. Проверка токена в ApiPlatform:
   1. Открыть Authorize
   2. Вставить ```token``` и сохранить
   3. Проверить какой-нибудь запрос к API

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
