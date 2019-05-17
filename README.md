## Ji1 Link Shorter Script in php

Demo: https://ji1.ir

ji1 is a simple object oriented script written in php that allows you to make shorter link 
without losing your seo. with 301 redirect.

### Install

you can deploy script in your server.
this package uses Macaw package for routes.

first you need clone the project in your server and you must install required composer package by this command:
```PHP
    Composer install
```
### Configure web server
#### Apache
if you use apache you don't need to do anything because apache's configuration
has stored in .htaccess file.

#### Nginx

if you use nginx you need to put this lines in your website configuration to redirects all routes into index.php file

```PHP
    autoindex off;
    
    location / {
        try_files $uri $uri/ /index.php?/$uri;
    }
            
    rewrite ^/(.*)/$ /$1 redirect;

    if (!-e $request_filename){
        rewrite ^(.*)$ /index.php break;
    }

```


### Finish Installation

you need edit Config file that stored in Controller\Config and then you must change the variables to your database
details.

```PHP
    public static $siteUrl = "http://ji1.test/";  //put your current path url
    public static $mysqlHost = "localhost"; //put your server host here
    public static $databaseName = "ji1"; //put your database name that you crated
    public static $databaseUser = "root"; //put your database username that you created
    public static $databasePassword = "";//put your database password that you crated
```
#### And 

run http://yourDomain.test/install.php to import database