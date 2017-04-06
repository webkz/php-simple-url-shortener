<?php  
ini_set('display_errors', 0);

$url_to_shorten = get_magic_quotes_gpc() ? stripslashes(trim($_REQUEST['longurl'])) : trim($_REQUEST['longurl']);

if(!empty($url_to_shorten) && preg_match('|^https?://|', $url_to_shorten))
{
	require('config.php');
 
	
	// Проверить, действителен ли URL-адрес (часто бывают, когда юзеры вводят  ссылок на несуществующие сайты)
	if(CHECK_URL)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_to_shorten);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		$response_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($response_status == '404')
		{
			die('Not a valid URL');
		}
		
	}
	
	// проверка, есть ли данная ссылка в базе данных
	$already_shortened = mysql_result(mysql_query('SELECT id FROM ' . DB_TABLE. ' WHERE long_url="' . mysql_real_escape_string($url_to_shorten) . '"'), 0, 0);
	if(!empty($already_shortened))
	{
		// урл есть в базе данных
		$shortened_url = getShortenedURLFromID($already_shortened);
	}
	else
	{
		// такого урла нету в базе данных, добавляем
		mysql_query('LOCK TABLES ' . DB_TABLE . ' WRITE;');
		mysql_query('INSERT INTO ' . DB_TABLE . ' (long_url, created, creator) VALUES ("' . mysql_real_escape_string($url_to_shorten) . '", "' . time() . '", "' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '")');
		$shortened_url = getShortenedURLFromID(mysql_insert_id());
		mysql_query('UNLOCK TABLES');
	}
	echo BASE_HREF . $shortened_url;
}

function getShortenedURLFromID ($integer, $base = ALLOWED_CHARS)
{
	$length = strlen($base);
	while($integer > $length - 1)
	{
		$out = $base[fmod($integer, $length)] . $out;
		$integer = floor( $integer / $length );
	}
	return $base[$integer] . $out;
}
