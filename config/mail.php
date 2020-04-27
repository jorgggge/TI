<?php
return [
  "driver" => "smtp",
  "host" => "smtp.mailtrap.io",
  "port" => 2525,
  "from" => array(
      "address" => "from@example.com",
      "name" => "Example"
  ),
  "username" => "996bb0241aa24b",
  "password" => "3b9b6077e805bd",
  "sendmail" => "/usr/sbin/sendmail -bs"
];