<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel Dusk

Laravel is a automation testing package prvided with laravel framwork.

## Installation steps

To get started, you should add the laravel/dusk Composer dependency to your project:

``composer require --dev laravel/dusk``
If you are manually registering Dusk's service provider, you should never register it in your production environment, as doing so could lead to arbitrary users being able to authenticate with your application.

After installing the Dusk package, run the dusk:install Artisan command:

``php artisan dusk:install``
A Browser directory will be created within your tests directory and will contain an example test. Next, set the *APP_URL* environment variable in your .env file. This value should match the URL you use to access your application in a browser.

To run your tests, use the dusk Artisan command. The dusk command accepts any argument that is also accepted by the phpunit command:

``php artisan dusk``
If you had test failures the last time you ran the dusk command, you may save time by re-running the failing tests first using the dusk:fails command:

``php artisan dusk:fails``

## Few More Dusk commands

`php artisan dusk C:/wamp64/www/laravel-dusk-demo/tests/Browser/InstallationTest.php`

`php artisan dusk`

`php artisan dusk --log-junit junit.xml`

