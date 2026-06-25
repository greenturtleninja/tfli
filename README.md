# TFLI
url shortener - cause everyone likes shortening

## sqlite setup

Download sqlite tools [here](https://sqlite.org/download.html)

Extract to `c:\sqlite`. When the above app is running it'll create a tfli.db in the database folder. Should be able to create the
tfli database using the sqlite3.exe and the scripts 
```
>cd database
>c:\sqlite\sqlite3.exe tfli.db
sqlite>.read create_table_tfli.sql
sqlite>.exit

The above will create the tfli databse and table
```

## Install and setup php nginx for windows

Download [nginx](https://nginx.org/en/download.html)
Download [PHP](https://www.php.net/downloads.php)

Extract the nginx to `c:\nginx`
Extract PHP to `c:\nginx\php`

So you should have `c:\nginx\nginx.exe` and `c:\nginx\php\php-cgi.exe`

Create an ini file in `c:\nginx\php\php.ini` with the below
``` ini
[PHP]
engine = On
short_open_tag = Off
implicit_flush = Off
zend.enable_gc = On
expose_php = Off
max_execution_time = 30
max_input_time = 60
memory_limit = 512M
error_reporting = E_ALL
display_errors = On
display_startup_errors = On
log_errors = On
variables_order = "GPCS"
request_order = "GP"
register_argc_argv = Off
auto_globals_jit = On
post_max_size = 8M
default_mimetype = "text/html"
default_charset = "UTF-8"
include_path = "."
extension_dir = "c:\nginx\php\ext"
enable_dl = Off
file_uploads = On
upload_max_filesize = 2M
max_file_uploads = 20
allow_url_fopen = On
allow_url_include = Off
default_socket_timeout = 60

extension=curl
extension=fileinfo
extension=gd
extension=gettext
extension=intl
extension=mbstring
extension=mysqli
extension=openssl
extension=pdo
extension=pdo_mysql
extension=sqlite3

[Session]
session.save_handler = files
session.save_path = "c:\nginx\temp"
session.use_strict_mode = 0
session.use_cookies = 1
session.use_only_cookies = 1
session.name = PHPSESSID
session.auto_start = 0
session.cookie_lifetime = 0
session.cookie_path = /
session.cookie_domain =
session.cookie_httponly =
session.cookie_samesite =
session.serialize_handler = php
session.gc_probability = 1
session.gc_divisor = 1000
session.gc_maxlifetime = 1440
session.cache_limiter = nocache
session.cache_expire = 180
session.use_trans_sid = 0
```

Edit the `c:\nginx\conf\nginx.conf` and replace the `server {}` with the below server section. 

```
server {
        listen 80;
        server_name localhost;
        index index.php;
        error_log c:/nginx/logs/error.log;
        access_log c:/nginx/logs/access.log;
        root ***The root of the php files goes here***
        location / {
            try_files $uri /index.php$is_args$args;
        }

        location ~ \.php {
            try_files $uri =404;
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param SCRIPT_NAME $fastcgi_script_name;
            fastcgi_index index.php;
            fastcgi_pass 127.0.0.1:9123;
        }
    }
```

Open the command prompt and run the following
```
c:\nginx\php>php-cgi.exe -b 127.0.0.1:9123

c:\nginx>start nginx
```
Check logs for errors, you may have some around missing extensions in PHP

Some helpful commands for nginx 
```
nginx -s stop fast shutdown
nginx -s quit graceful shutdown
nginx -s reload changing configuration, starting new worker processes with a new configuration, graceful shutdown of old worker processes
nginx -s reopen re-opening log files
taskkill /IM nginx.exe /F Close all nginx processes
```

#### Glossary

Nginx-php setup - [link](https://gist.github.com/odan/b5f7de8dfbdbf76bef089776c868fea1)

PHP.net - checking combatibilty of php functions and parameter placement
