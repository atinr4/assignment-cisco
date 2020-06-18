# Assignment

Assignment using Laravel

## Installation

Use the package manager [composer](https://getcomposer.org/) to install the application.

```bash
composer install
```

## Setup

```php
Basic installation:
1. Setup .env file

2. Run this commands
php artisan migrate
php artisan db:seed

3.Run server
php artisan serve


```

## Usage
```php
Sample Data generator Command: php artisan generate:sample-data {count}

Script Execution Command: php artisan script:execute

Dynamic file and Zip creation command: php artisan zip:create {count}

```
### Important Notes
SQL View is called: routerView

Application is mainly accisible by the navigation above other than the artisan commands
