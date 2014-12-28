yii2-config
===========

Yii2 module for database based configurations editing 

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist wolfguard/yii2-config "*"
```

or add

```
"wolfguard/yii2-config": "*"
```

to the require section of your `composer.json` file.

After running 

```
php composer.phar update
```

run

```
yii migrate --migrationPath=@vendor/wolfguard/yii2-config/migrations
```

After that change your main configuration file ```config/web.php```

```php
<?php return [
    ...
    'modules' => [
        ...
        'config' => [
            'class' => 'wolfguard\config\Module',
        ],
        ...
    ],
    ...
];
```


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \wolfguard\config\widgets\Config::widget(['code' => 'email-from']); ?>
```