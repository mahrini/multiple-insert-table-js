<?php
require_once('/opt/lampp/htdocs/trx/vendor/autoload.php');


ORM::configure('mysql:host=localhost;dbname=transaksi');
ORM::configure('username', 'root');
ORM::configure('password', '');
ORM::configure('logging', true);
?>
