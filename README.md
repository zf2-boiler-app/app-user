ZF2 BoilerApp User module
=====================

Created by Neilime

NOTE : This module is in heavy development, it's not usable yet.
If you want to contribute don't hesitate, I'll review any PR.

Introduction
------------

__ZF2 BoilerApp User module__ is a Zend Framework 2 module

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master)

Installation
------------

### Main Setup

#### By cloning project

1. Clone this project into your `./vendor/` directory.

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "zf2-boiler-app/app-user": "dev-master"
    }
    ```

2. Now tell composer to download __ZF2 BoilerApp User module__ by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling BoilerAppUser, BoilerAppDb and Doctrine modules in your `application.config.php` file.

    ```php
    return array(
        'modules' => array(
            // ...
            'BoilerAppUser',
            'BoilerAppDb',
            'DoctrineModule',
    		'DoctrineORMModule',
    		// ...
        ),
        // ...
    );
    ```

## Features