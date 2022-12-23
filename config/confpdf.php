<?php
define("server", "127.0.0.1");
define("user", "root");
define("pass", "k124t05");
define("db", "db_moonraker");

$id_mysql = ($GLOBALS["___mysqli_ston"] = mysqli_connect(server, user, pass));
if(!$id_mysql)
	die("Gagal1");

	$db_ku = mysqli_select_db( $id_mysql, constant('db'));
	if(!$db_ku)
	die("Gagal2");
?>
