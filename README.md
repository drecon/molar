Molar
============

Moip with Laravel

## Setup

In the `require` key of `composer.json` file add the following

    "drecon/molar": "dev-master"

Run the Composer update comand

    $ composer update

In your `config/app.php` add `'Drecon\Molar\MolarServiceProvider'` to the end of the `$providers` array

    'providers' => array(

        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'Drecon\Molar\MolarServiceProvider',
    ),

