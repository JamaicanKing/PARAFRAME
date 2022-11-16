
# PARAFRAME SECURITY ADMINISTRATIVE TOOL
## ABOUT PARAFRAME

Paraframe is a security adinistrative tool for small enclosed areas example:- gated communities and gated apartments.

## Features:
* Keeps census of residents in an gated community or apartment.
* Residents are able to blacklist,whitelist and schedule single visits for visitors.
* Shortend interaction with security guards, residents  and visitors.
* Administrators can keep track of security guards login and logout times.

## How To Install

1. In your terminal open the folder you would like to save the app to then run:
```bash
    $ git clone https://github.com/JamaicanKing/paraFrame.git
```
2. to download required packages and recreate vendor file run:
```bash
    $ composer install
```
3. copy .env.example and change name to .env then update with database login information.
4. run migrations
```bash
    php artisan migrate
```
5. you should be all set, to go live run:
```bash
    php artisan serve
```