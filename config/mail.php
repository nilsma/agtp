<?php

return [

    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => ['address' => "nilsma231@gmail.com", 'name' => "nilsma"],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '/usr/bin/sendmail -bs',

    /*
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.webhuset.no'),
    'port' => env('MAIL_PORT', 587),
    'from' => ['address' => 'admin@austegardstoppen.no', 'name' => 'Admin'],
    'encryption' => env('MAIL_ENCRYPTION', ''),
    'username' => env('admin@austegardstoppen.no'),
    'password' => env('pGxD5c5V'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => env('MAIL_PRETEND', false),
    */

];
