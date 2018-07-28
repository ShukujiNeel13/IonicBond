<?php
$database_url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $database_url['host'], substr($database_url['path'], 1));
define('DSN', $dsn);
define('DB_USERNAME', $database_url['user']);
define('DB_PASSWORD', $database_url['pass']);
