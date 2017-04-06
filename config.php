<?php
// данные от базы данных
define('DB_NAME', 'db-name');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_TABLE', 'ssylki');

// подключение к базе данных
mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME);

// путь к скрипту
define('BASE_HREF', 'http://' . $_SERVER['HTTP_HOST'] . '/');
 
// отслеживание рефералов
define('TRACK', FALSE);

//  сначала проверить, существует ли URL-адрес
define('CHECK_URL', TRUE);

// сокращать урл этими символами
define('ALLOWED_CHARS', '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

// использовать кэш?
define('CACHE', TRUE);

// путь к папке, где будут хранятся кэш файлы
define('CACHE_DIR', dirname(__FILE__) . '/cache/');
 