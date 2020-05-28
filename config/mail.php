<?php
return [
  "driver" => "smtp",
  "host" => "smtp.mailtrap.io",
  "port" => 2525,
  "from" => array(
      "address" => "from@example.com",
      "name" => "Example"
  ),
  "username" => "01a9bd6f3b0ac0",
  "password" => "a6d39141c8b5ea",
  "sendmail" => "/usr/sbin/sendmail -bs"
];