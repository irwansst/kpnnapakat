<?php
echo "
<script type='text/javascript'>
  function autoRefreshPage()
  {
    window.location = window.location.href;
  }
  setInterval('autoRefreshPage()', 180000);
</script>";


include "config/koneksi.php";
/**
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";
**/

if ($_GET['op']=='home'){

  if ($_SESSION['leveluser']=='admin'){
  
	//menghitung anggota aktif
  $qja=mysql_query("SELECT COUNT(nip) AS aktif FROM kpn_anggota WHERE LENGTH(nip) > 10 ");
  $ja    = mysql_fetch_array($qja);

    //menghitung anggota aktif
  $qaa=mysql_query("SELECT count(nip) as aktif from kpn_anggota WHERE LENGTH(nip) > 10 AND aktif LIKE 'Y' ");
  $aa    = mysql_fetch_array($qaa);

 	//menghitung anggota tidak aktif
  $qta=mysql_query("SELECT count(nip) as aktif from kpn_anggota WHERE LENGTH(nip) > 10 AND aktif LIKE 'N' ");
  $ta    = mysql_fetch_array($qta);


	echo "
  <div class='row'>           
  
  <!--JUMLAH PEGAWAI -->
   <div class='col-xl-4 col-md-6 mb-3'>
     <div class='card border-left-success shadow h-100 py-2'>
     <div class='card-header font-weight-bold text-light bg-success'>JUMLAH ANGGOTA</div> 
      <div class='card-body'>
         <div class='row no-gutters align-items-center'>
         <div class='col mr-2'>
         <i class='fas fa-users fa-4x text-gray-500'></i>
          </div>  
         
         <div class='col-auto'>
             <div class='text-lg text-right font-weight-bold text-dark bg-light text-uppercase mb-1'><h1>$ja[aktif]</h1></div>
            </div> 
 
             </div>
       </div>
     </div>
   </div>
  
  <!--JUMLAH PEGAWAI AKTIF -->
   <div class='col-xl-4 col-md-6 mb-3'>
     <div class='card border-left-primary shadow h-100 py-2'>
     <div class='card-header font-weight-bold text-light bg-primary'>ANGGOTA AKTIF</div> 
      <div class='card-body'>
      <div class='row no-gutters align-items-center'>
      <div class='col mr-2'>
               <i class='fas fa-user fa-4x text-gray-500'></i>
                </div>    
 
           <div class='col auto'>
             <div class='text-lg text-right  font-weight-bold text-dark bg-light text-uppercase mb-1'><h1>$aa[aktif]</h1></div>
            </div> 
         </div>     

       </div>
     </div>
   </div>

   <!--JUMLAH PEGAWAI TIDAK AKTIF -->
   <div class='col-xl-4 col-md-6 mb-3'>
     <div class='card border-left-danger shadow h-100 py-2'>
     <div class='card-header font-weight-bold text-light bg-danger'>ANGGOTA TIDAK AKTIF</div> 
      <div class='card-body'>
         <div class='row no-gutters align-items-center'>
          <div class='col mr-2'>
            <i class='fas fa-user-times fa-4x text-gray-500'></i>
          </div>
          <div class='col-auto>
          <div class='text-lg text-right font-weight-bold text-dark bg-light text-uppercase mb-1'><h1>$ta[aktif]</h1></div>
         </div> 
       
          
            
       </div>
     </div>
   </div>
   </div>
  ";
		
  }else{
  //menampilkan halaman user
 
$profil = mysql_query("SELECT a.id, a.nip, a.nama_peg, b.uraian, b.roman, c.jabatan 
 			from pegawai a left join golongan b on a.gol=b.kode
 			left join jabatan c on a.jabatan=c.id_jabatan		 			
 			 WHERE nip='$_SESSION[namauser]'");
  		$r    = mysql_fetch_array($profil);

echo "
<div class='card shadow mb-4'>
	<div class='card-header py-3'>
		<h6 class='m-0 font-weight-bold text-primary'>Dashboard</h6>
	</div>
	<div class='card-body'>
		<table width='100%'>
			<tr><td width=15%>NIP</td><td>:</td><td>$r[nip]</td></tr>
			<tr><td>Nama</td><td>:</td><td>$r[nama_peg]</td></tr>
			<tr><td>Pangkat/Gol</td><td>:</td><td>$r[uraian] $r[roman]</td></tr>
			<tr><td>Jabatan</td><td>:</td><td>$r[jabatan]</td></tr>
		</table> 
	</div>
</div> 
";

//cards 

//log mingguan
$week_meniku 	= mysql_query("SELECT count(kegiatan) as jk FROM log WHERE user='$_SESSION[namauser]' AND iku NOT LIKE 'Non%' AND YEARWEEK(waktu) = YEARWEEK(NOW()) AND periode='$_SESSION[periode]' ");
$week_m    	= mysql_fetch_array($week_meniku);
$week_noniku	= mysql_query("SELECT count(kegiatan) as jk FROM log WHERE user='$_SESSION[namauser]' AND iku LIKE 'Non%' AND YEARWEEK(waktu) = YEARWEEK(NOW()) AND periode='$_SESSION[periode]' ");
$week_n			= mysql_fetch_array($week_noniku);

//log bulanan
$month_meniku 	= mysql_query("SELECT count(kegiatan) as jk FROM log WHERE user='$_SESSION[namauser]' AND iku NOT LIKE 'Non%' AND MONTH(waktu) = MONTH(NOW()) AND periode='$_SESSION[periode]' ");
$month_m    	= mysql_fetch_array($month_meniku);
$month_noniku	= mysql_query("SELECT count(kegiatan) as jk FROM log WHERE user='$_SESSION[namauser]' AND iku LIKE 'Non%' AND MONTH(waktu) = MONTH(NOW()) AND periode='$_SESSION[periode]' ");
$month_n			= mysql_fetch_array($month_noniku);

//log tahunan
$year_meniku 	= mysql_query("SELECT count(kegiatan) as jk FROM log WHERE user='$_SESSION[namauser]' AND iku NOT LIKE 'Non%' AND YEAR(waktu) = YEAR(NOW()) AND periode='$_SESSION[periode]' ");
$year_m    	= mysql_fetch_array($year_meniku);
$year_noniku	= mysql_query("SELECT count(kegiatan) as jk FROM log WHERE user='$_SESSION[namauser]' AND iku LIKE 'Non%' AND YEAR(waktu) = YEAR(NOW()) AND periode='$_SESSION[periode]' ");
$year_n			= mysql_fetch_array($year_noniku);


echo " 
			<div class='row'>           
           <!-- Earnings (Monthly) Card Example -->
            <div class='col-xl-4 col-md-6 mb-3'>
              <div class='card border-left-primary shadow h-100 py-2'>
                <div class='card-body'>
                  <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                      <div class='text-s font-weight-bold text-primary text-uppercase mb-1'>Minggu Ini</div>
                        <div class='h6 mb-0 font-weight-normal text-gray-600'>
								          <table border='0'>
								          <tr>
								            <td>IKU</td><td>:</td><td><div class='font-weight-bold text-primary'>$week_m[jk]</div></td>
								          <tr>
								            <td>Non IKU</td><td>:</td><td><div class='font-weight-bold text-danger'>$week_n[jk]</div></td>
								          </tr>
								          </table>                      
                        </div>
                      </div>
                        <div class='col-auto'>
                        <i class='fas fa-calendar fa-4x text-gray-500'></i>
                         </div>
                      </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class='col-xl-4 col-md-6 mb-3'>
              <div class='card border-left-success shadow h-100 py-2'>
                <div class='card-body'>
                  <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                      <div class='text-s font-weight-bold text-success text-uppercase mb-1'>Bulan Ini</div>
                      <div class='h6 mb-0 font-weight-normal text-gray-600'>
                      <table border='0'>
								<tr>
								<td>IKU</td><td>:</td><td><div class='font-weight-bold text-primary'>$month_m[jk]</div></td>
								</tr>
								<tr>
								<td>Non IKU</td><td>:</td><td><div class='font-weight-bold text-danger'>$month_n[jk]</div></td>
								</tr>
								</table> 
                      </div>
                    </div>
                    <div class='col-auto'>
                     <i class='fas fa-calendar-check fa-4x text-gray-500'></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class='col-xl-4 col-md-6 mb-3'>
              <div class='card border-left-info shadow h-100 py-2'>
                <div class='card-body'>
                  <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                      <div class='text-s font-weight-bold text-info text-uppercase mb-1'>Tahun Ini</div>
                      <div class='h6 mb-0 font-weight-normal text-gray-600'>
                      <table border='0'>
								<tr>
								<td>IKU</td><td>:</td><td><div class='font-weight-bold text-primary'>$year_m[jk]</div></td>
								</tr>
								<tr>
								<td>Non IKU</td><td>:</td><td><div class='font-weight-bold text-danger'>$year_n[jk]</div></td>
								</tr>
								</table> 
                      </div>
							</div>                      
                      <div class='col-auto'>
                      <i class='fas fa-calendar-alt fa-4x text-gray-500'></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           
";

	
  }
}

elseif ($_GET['op']=='users'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_users/users.php";
  }
}

elseif ($_GET['op']=='anggota'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_anggota/anggota.php";
  }
}

elseif ($_GET['op']=='bank'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_bank/bank.php";
  }
}

elseif ($_GET['op']=='unit'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_unit/unit.php";
  }
}

//diatas baris ini adalah modul yang dipakai sekarang

elseif ($_GET['op']=='periode'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_periode/periode.php";
  }
}

elseif ($_GET['op']=='Jabatan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_jabatan/Jabatan.php";
  }
}

elseif ($_GET['op']=='nama'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_nama/nama.php";
  }else{
    echo "<p><b>Halaman ini untuk Admin!!!</b></p>";	
	}
}

elseif ($_GET['op']=='log'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_log/log.php";
  }
}

elseif ($_GET['op']=='lembur'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_lembur/lembur.php";
  }
}

elseif ($_GET['op']=='iku'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_iku/iku.php";
  }
}

elseif ($_GET['op']=='conf'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_conf/conf.php";
  }
}



elseif ($_GET['op']=='profile'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_profile/profile.php";
  }
}

else{
  echo "<p><b>Modul tidak ada!!!</b></p>";
}
?>