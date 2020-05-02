# Codeigniter-REST-API-Startup-Kit
`Codigniter v3.1.11`

*It's a codeigniter framwork with setup all preloaded basic configuration. some utility helpers and library included.*

[Source Code](https://github.com/patelnwd/Codeigniter-REST-API-Startup-Kit)

[Videos](https://www.youtube.com/watch?v=PilQwFEcJXY)

## Requirements

- XAMPP
- PHP >= 5.6.8

## Libraries

- [Rest Server](https://github.com/chriskacerguis/codeigniter-restserver)
- [php-jwt](https://github.com/firebase/php-jwt)


## Configuration
- **Virtual Host** : Configure your vertual hosting and give the server name `ci-conf.local` Now access with given demo url.
- **Database** : import the database given in repository under Docs folder named with `restserver.sql`.

## Virtual host settings [Windows]
- Add a domain name in your windows host file.
  Goto this path with RUN command or windows explorer `c:\Windows\System32\drivers\etc` then find the file name `host` and open it in notepad as **administrator**.

  Add this line there in last `127.0.0.1 ci-conf.local www.ci-conf.local` and **save** it.

- Map this domain name in you XAMPP virtual host.
  Goto to path `c:\xampp\apache\conf\extra\` open the file `httpd-vhosts.conf` with notepad ad administrator.

  Add this given virtual hosting code in last line of the file.
  ```code
    <VirtualHost *:80>
        ServerAdmin admin@ci-conf.local
        DocumentRoot "E:/projects/Self/Codeigniter-REST-API-Startup-Kit/public_html"
        ServerName ci-conf.local
        ServerAlias www.ci-conf.local
        ErrorLog "E:/projects/Self/Codeigniter-REST-API-Startup-Kit/logs/ci-conf.local-error.log"
        CustomLog "E:/projects/Self/Codeigniter-REST-API-Startup-Kit/logs/ci-conf.local-access.log" common
        <Directory "E:/projects/Self/Codeigniter-REST-API-Startup-Kit/public_html">
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
    ```

## Documentation

You can find the PDF `Docs\Codigniter REST API Documentation.pdf` in repository to understand the API calls. Once you download this repository and setup your virtual host with XAMPP you can access it through given url `http://ci-conf.local/api-demo`

## Demo

- [http://ci-conf.local/](http://ci-conf.local/)
- [http://ci-conf.local/api-demo](http://ci-conf.local/api-demo)

## Demo API
- *Register User*: it takes post data and register user with post data.
- *Login User*: login with given username and password. It returns a token which require to request any further API call in header in `Authorization` key. 
- *Create Article*: It can create article with Autorization.
- *Get Article*: It can get requested article or all article.

## Note

It is important to understand that the purpose of using JWT is NOT to hide or obscure data in any way. The reason why JWT are used is to prove that the sent data was actually created by an authentic source.

Since JWT are signed and encoded only, and since JWT are not encrypted, JWT do not guarantee any security for sensitive data.


## Copyright and License ©️

Code copyright 2020 patelworld. Code released under the [MIT license](http://www.opensource.org/licenses/MIT)