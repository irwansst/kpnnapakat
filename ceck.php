<?php
include "config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  echo "Sekarang loginnya tidak bisa di injeksi lho.";
}
else{
$login=mysql_query("SELECT * FROM kpn_users WHERE username='$username' AND password='$pass' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

	$edit=mysql_query("SELECT * FROM kpn_header WHERE id_nama='1'");
    $s=mysql_fetch_array($edit);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  include "timeout.php";
  $y = date("Y");

  $_SESSION[namauser]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[leveluser]    = $r[level];
  $_SESSION[periode]      = $y;
  $_SESSION[lembaga]      = $s[nama];
 
  
  // session timeout
  $_SESSION[login] = 1;
  timer();

	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();

  mysql_query("UPDATE kpn_users SET id_session='$sid_baru' WHERE username='$username'");
  header('location:show.php?op=home');
}
else{
 
	echo "
		<html>
		<head>
		<title></title>
		<link href='vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
  		<link href='https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>

 		<!-- Custom styles for this template-->
  		<link href='css/sb-admin-2.min.css' rel='stylesheet'>
		</head>
		<body class='bg-gradient-primary'>		
		<div class='card shadow mb-4' style='width:400px; margin:auto; text-align:center'>
		<div class='card-header py-3'>
		<h6 class='m-0 font-weight-bold text-warning'>Peringatan!!!</h6>
		</div>
		<div class='card-body'>
			Username atau Password yang Anda isikan salah!!!<br>
			atau Account Anda sedang diblokir Admin.<br><br>
			<a href='index.php' class='btn btn-primary'>Ulangi Lagi</a>
		</div>
</div> 
		</body>
		</html>
	";		
		
	
	/**  
  echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda tidak benar.<br>
        Atau account Anda sedang diblokir.<br>";
  echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
  **/
}
}
