<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'dbpasswprd');
   define('DB_DATABASE', 'xtream_iptvpro');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   ///use ip address
   $panel_url = 'http://1.2.3.4:80/';
?>