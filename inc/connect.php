<?php

    $hostname = defined('HOSTNAME') ? HOSTNAME : '';
    $username = defined('USERNAME') ? USERNAME : '';
	$password = defined('PASSWORD') ? PASSWORD : '';
	$dbname   = defined('DBNAME')   ? DBNAME : '';
	$charset  = defined('CHARSET')  ? CHARSET : '';

    $Database = new Database($hostname, $username, $password, $dbname, $charset);