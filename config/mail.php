<?php
return [
'driver'     => env('MAIL_DRIVER', 'smtp'),
'host'       => env('MAIL_HOST', 'smtp.gmail.com'),
'port'       => env('MAIL_PORT', 587),
'from'       => ['address' =>'icacom044@gmail.com', 'name' => 'ICA'],
'encryption' => env('MAIL_ENCRYPTION', 'tls'),
'username'   => env('MAIL_USERNAME','icacom044@gmail.com'),
'password'   => env('MAIL_PASSWORD','vmwitpmewdylxrck'),
'sendmail'   => '/usr/sbin/sendmail -bs',
];