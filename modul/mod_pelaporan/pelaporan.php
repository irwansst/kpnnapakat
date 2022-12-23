<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$aksi="modul/mod_pelaporan/aksi_pelaporan.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>DAFTAR LAPORAN $_SESSION[periode]</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=pelaporan&act=tambahpelaporan'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th >No</th>
				<th width=350px>Laporan</th>
				<th >No. Dasar</th>
				<th >Tgl Dasar</th>
				<th >Tgl Deadline</th>
				<th width=150px>Bidang</th>
				<th width=150px>UIC</th>
				<th width=150px>Output</th>
				<th >Status</th>				
				<th >Aksi</th>
			</tr>
		</thead>
		<tbody>";
		
	$no=1;
	$tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id,laporan,dasar,tgl_mulai,tgl_akhir,(SELECT urbidang FROM rjabatan WHERE kode LIKE CONCAT(LEFT(bidang,4),'00')) AS bidang, (SELECT urbidang FROM rjabatan WHERE kode=bidang) AS uic,output,tgl_output FROM pelaporan WHERE periode LIKE '$_SESSION[periode]' ORDER BY tgl_akhir ASC ");

     while ($r=mysqli_fetch_array($tampil)){
	       echo "<tr>
			 <td align=center>$no</td>
			 <td align=left>$r[laporan]</td>
			 <td align=left>$r[dasar]</td>
			 <td align=center>$r[tgl_mulai]</td>
			 <td align=center>$r[tgl_akhir]</td>
			 <td align=center>$r[bidang]</td>
			 <td align=center>$r[uic]</td>
			 <td align=center>$r[output]</td>
			";

		$skrg=date_create(date('Y-m-d'));
		$deadline=date_create($r[tgl_akhir]);
		/** hitung selisih hari **/
		$sh=date_diff($skrg,$deadline);
		$sd=$sh->format('%R%a days');
		

		$opt=$r[output];
		
		if (empty($opt) AND $sd > 3) {
			echo "<td align=center><img src='images/ONTRACK_0.png'>";
			}elseif(empty($opt) AND $sd < 0){
				echo "<td align=center><img src='images/OFFTRACK_0.png'>";
			}elseif(empty($opt) AND 0 <= $sd AND $sd <= 3){
				echo "<td align=center><img src='images/WARNING!_0.png'>";
		}else{
			echo "<td align=center><img src='images/FINISHED_0.png'></td>";
		}
	 
		
			 echo "<td align='center' width='100px'>";
			
			 echo "
			<a href=?op=pelaporan&act=outputpelaporan&id=$r[id]><img class='masterTooltip'  src='images/report.png' border='0' title='Rekam Output'></a>
			<a href=?op=pelaporan&act=editpelaporan&id=$r[id]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah pelaporan'></a>
			<a href=?op=pelaporan&act=lihatpelaporan&id=$r[id]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat pelaporan'></a>
			";

			
	echo "</td>
			 </tr>";
      $no++;
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahpelaporan":
      echo "<h1>Tambah pelaporan</h1>
			<div class='line'></div>
			<div class='box'>
			";
    echo "	
	        <form method=POST action='$aksi?op=pelaporan&act=input'>
			<label><span>LAPORAN</span><input type='text' name='vlaporan' size='70'></label>
			<label><span>DASAR</span><input type='text' name='vdasar' size='70'></label>
			<label><span>TANGGAL MULAI</span><input type='text' name='vmulai' id='datepicker1' size='15'></label>
			<label><span>TANGGAL AKHIR</span><input type='text' name='vakhir' id='datepicker2' size='15'></label>
			";	
			
			//dropdown Unit In Charge		
			echo "	<label><span>UIC</span>";
		    echo  "<select name='vbidang'>
            <option value=0 selected>- UIC -</option>";
            $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rjabatan WHERE right(kode,2) NOT LIKE '00%' ORDER BY id ASC");
            while($t=mysqli_fetch_array($tampil)){
            echo "<option value='$t[kode]'>$t[kode] | $t[urbidang]</option>";
            }
			echo "</select></label>
			
		
			<input type=submit class=button value=Simpan>
			<input type=button value=Batal class=button onclick=self.history.back()>
        	</form></div>";

    break;
  

  case "editpelaporan":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pelaporan WHERE id='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	
	echo "<h1>Ubah Pelaporan</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=pelaporan&act=update>
        <input type=hidden name=id value=$r[id]>
		
		<label><span>pelaporan</span><input type='text' name='vpelaporan' value='$r[laporan]' size='70'></label>
		<label><span>DASAR HUKUM</span><input type='text' name='vdasar' value='$r[dasar]' size='70'></label>
		<label><span>TANGGAL MULAI</span><input type='text' name='vmulai' value='$r[tgl_mulai]' id='datepicker1' size='15'></label>
		<label><span>TANGGAL AKHIR</span><input type='text' name='vakhir' value='$r[tgl_akhir]' id='datepicker2' size='15'></label>
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;

    case "outputpelaporan":
    $out = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pelaporan WHERE id ='$_GET[id]'");
    $r    = mysqli_fetch_array($out);
	
	echo "<h1>Rekam Output</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=pelaporan&act=output>
        <input type=hidden name=id value=$r[id]>
		<label><span>OUTPUT pelaporan</span><input type='text' name='voutput' value='$r[output]' size='70'></label>
		<label><span>TANGGAL OUTPUT</span><input type='text' name='vtgloutput' value='$r[tgl_output]' id='datepicker1' size='15'></label>
		<input type=submit class=button value=Simpan>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "lihatpelaporan":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id,laporan,dasar,tgl_mulai,tgl_akhir,(SELECT urbidang FROM rjabatan WHERE kode LIKE CONCAT(LEFT(bidang,4),'00')) AS bidang, (SELECT urbidang FROM rjabatan WHERE kode=bidang) AS uic,output,tgl_output,stamp,periode FROM pelaporan WHERE periode LIKE '$_SESSION[periode]'AND id='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	
	echo "<h1>Detail Informasi</h1>
			<div class='line'></div>
			<div class='box'>";
			
    echo "
          <form method=POST action=$aksi?op=pelaporan&act=lihat>
                   
		  <label><span>TERAKHIR DIBUAT/UPDATE</span>: <b>$r[stamp]</b></label>
		  <label><span>PERIODE</span>: <b>$r[periode]</b></label><br>

		  <label><span>pelaporan</span>: <b>".$r[laporan]."</b></label>
		  <label><span>DASAR HUKUM</span>: $r[dasar]</label><br>
		  <label><span>TANGGAL MULAI</span>: $r[tgl_mulai]</label>
		  <label><span>TANGGAL AKHIR </span>: $r[tgl_akhir]</label>
		  <label><span>BIDANG </span>: $r[bidang]</label>
		  <label><span>UIC </span>: $r[uic]</label>
		  <label><span>OUTPUT </span>: $r[output]</label>
		  <label><span>TGL OUTPUT </span>: $r[tgl_output]</label>
		  <br><br><input type=button class=button value=Kembali onclick=self.history.back()></td></tr>
          </form></div>";
    break; 
	
case "lihatpelaporanontrack":
    	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th >No</th>
				<th width=350px>pelaporan</th>
				<th >Dasar</th>
				<th >Tgl Mulai</th>
				<th >Tgl Akhir</th>
				<th width=150px>Bidang</th>
				<th width=150px>UIC</th>
				<th width=150px>Output</th>
				<th >Status</th>				
				<th >Aksi</th>
			</tr>
		</thead>
		<tbody>";
		
	$no=1;
	$tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id,laporan,dasar,tgl_mulai,tgl_akhir,(SELECT urbidang FROM rjabatan WHERE kode LIKE CONCAT(LEFT(bidang,4),'00')) AS bidang, (SELECT urbidang FROM rjabatan WHERE kode=bidang) AS uic,output FROM pelaporan WHERE periode LIKE '$_SESSION[periode]' AND datediff(now(),tgl_akhir) < -3 AND output IS NULL  ORDER BY tgl_akhir ASC ");

     while ($r=mysqli_fetch_array($tampil)){
	       echo "<tr>
			 <td align=center>$no</td>
			 <td align=left>$r[laporan]</td>
			 <td align=left>$r[dasar]</td>
			 <td align=center>$r[tgl_mulai]</td>
			 <td align=center>$r[tgl_akhir]</td>
			 <td align=center>$r[bidang]</td>
			 <td align=center>$r[uic]</td>
			 <td align=center>$r[output]</td>
			";

		$skrg=date_create(date('Y-m-d'));
		$deadline=date_create($r[tgl_akhir]);
		/** hitung selisih hari **/
		$sh=date_diff($skrg,$deadline);
		$sd=$sh->format('%R%a days');
		

		$opt=$r[output];
		
		if (empty($opt) AND $sd > 3) {
			echo "<td align=center><img src='images/ONTRACK_0.png'>";
			}elseif(empty($opt) AND $sd < 0){
				echo "<td align=center><img src='images/OFFTRACK_0.png'>";
			}elseif(empty($opt) AND 0 <= $sd AND $sd <= 3){
				echo "<td align=center><img src='images/WARNING!_0.png'>";
		}else{
			echo "<td align=center><img src='images/FINISHED_0.png'></td>";
		}
	 
		
			 echo "<td align='center' width='100px'>";
			
			 echo "
			<a href=?op=pelaporan&act=outputpelaporan&id=$r[id]><img class='masterTooltip'  src='images/report.png' border='0' title='Rekam Output'></a>
			<a href=?op=pelaporan&act=editpelaporan&id=$r[id]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah pelaporan'></a>
			<a href=?op=pelaporan&act=lihatpelaporan&id=$r[id]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat pelaporan'></a>
			";

			
	echo "</td>
			 </tr>";
      $no++;
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
    break;

    case "lihatpelaporanwarning":
    	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th >No</th>
				<th width=350px>Laporan</th>
				<th >Dasar</th>
				<th >Tgl Mulai</th>
				<th >Tgl Akhir</th>
				<th width=150px>Bidang</th>
				<th width=150px>UIC</th>
				<th width=150px>Output</th>
				<th >Status</th>				
				<th >Aksi</th>
			</tr>
		</thead>
		<tbody>";
		
	$no=1;
	$tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id,laporan,dasar,tgl_mulai,tgl_akhir,(SELECT urbidang FROM rjabatan WHERE kode LIKE CONCAT(LEFT(bidang,4),'00')) AS bidang, (SELECT urbidang FROM rjabatan WHERE kode=bidang) AS uic,output FROM pelaporan WHERE periode LIKE '$_SESSION[periode]' AND DATEDIFF(NOW(),tgl_akhir) >= -3 AND  DATEDIFF(NOW(),tgl_akhir) < 1 AND output IS NULL  ORDER BY tgl_akhir ASC ");

     while ($r=mysqli_fetch_array($tampil)){
	       echo "<tr>
			 <td align=center>$no</td>
			 <td align=left>$r[laporan]</td>
			 <td align=left>$r[dasar]</td>
			 <td align=center>$r[tgl_mulai]</td>
			 <td align=center>$r[tgl_akhir]</td>
			 <td align=center>$r[bidang]</td>
			 <td align=center>$r[uic]</td>
			 <td align=center>$r[output]</td>
			";

		$skrg=date_create(date('Y-m-d'));
		$deadline=date_create($r[tgl_akhir]);
		/** hitung selisih hari **/
		$sh=date_diff($skrg,$deadline);
		$sd=$sh->format('%R%a days');
		

		$opt=$r[output];
		
		if (empty($opt) AND $sd > 3) {
			echo "<td align=center><img src='images/ONTRACK_0.png'>";
			}elseif(empty($opt) AND $sd < 0){
				echo "<td align=center><img src='images/OFFTRACK_0.png'>";
			}elseif(empty($opt) AND 0 <= $sd AND $sd <= 3){
				echo "<td align=center><img src='images/WARNING!_0.png'>";
		}else{
			echo "<td align=center><img src='images/FINISHED_0.png'></td>";
		}
	 
		
			 echo "<td align='center' width='100px'>";
			
			 echo "
			<a href=?op=pelaporan&act=outputpelaporan&id=$r[id]><img class='masterTooltip'  src='images/report.png' border='0' title='Rekam Output'></a>
			<a href=?op=pelaporan&act=editpelaporan&id=$r[id]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah pelaporan'></a>
			<a href=?op=pelaporan&act=lihatpelaporan&id=$r[id]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat pelaporan'></a>
			";

			
	echo "</td>
			 </tr>";
      $no++;
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
    break;

    case "lihatpelaporanofftrack":
    	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th >No</th>
				<th width=350px>Laporan</th>
				<th >Dasar</th>
				<th >Tgl Mulai</th>
				<th >Tgl Akhir</th>
				<th width=150px>Bidang</th>
				<th width=150px>UIC</th>
				<th width=150px>Output</th>
				<th >Status</th>				
				<th >Aksi</th>
			</tr>
		</thead>
		<tbody>";
		
	$no=1;
	$tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id,laporan,dasar,tgl_mulai,tgl_akhir,(SELECT urbidang FROM rjabatan WHERE kode LIKE CONCAT(LEFT(bidang,4),'00')) AS bidang, (SELECT urbidang FROM rjabatan WHERE kode=bidang) AS uic,output FROM pelaporan WHERE periode LIKE '$_SESSION[periode]' AND datediff(now(),tgl_akhir) > 1 AND output IS NULL  ORDER BY tgl_akhir ASC ");

     while ($r=mysqli_fetch_array($tampil)){
	       echo "<tr>
			 <td align=center>$no</td>
			 <td align=left>$r[laporan]</td>
			 <td align=left>$r[dasar]</td>
			 <td align=center>$r[tgl_mulai]</td>
			 <td align=center>$r[tgl_akhir]</td>
			 <td align=center>$r[bidang]</td>
			 <td align=center>$r[uic]</td>
			 <td align=center>$r[output]</td>
			";

		$skrg=date_create(date('Y-m-d'));
		$deadline=date_create($r[tgl_akhir]);
		/** hitung selisih hari **/
		$sh=date_diff($skrg,$deadline);
		$sd=$sh->format('%R%a days');
		

		$opt=$r[output];
		
		if (empty($opt) AND $sd > 3) {
			echo "<td align=center><img src='images/ONTRACK_0.png'>";
			}elseif(empty($opt) AND $sd < 0){
				echo "<td align=center><img src='images/OFFTRACK_0.png'>";
			}elseif(empty($opt) AND 0 <= $sd AND $sd <= 3){
				echo "<td align=center><img src='images/WARNING!_0.png'>";
		}else{
			echo "<td align=center><img src='images/FINISHED_0.png'></td>";
		}
	 
		
			 echo "<td align='center' width='100px'>";
			
			 echo "
			<a href=?op=pelaporan&act=outputpelaporan&id=$r[id]><img class='masterTooltip'  src='images/report.png' border='0' title='Rekam Output'></a>
			<a href=?op=pelaporan&act=editpelaporan&id=$r[id]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah pelaporan'></a>
			<a href=?op=pelaporan&act=lihatpelaporan&id=$r[id]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat pelaporan'></a>
			";

			
	echo "</td>
			 </tr>";
      $no++;
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
    break;



    case "lihatpelaporanfinish":
    	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th >No</th>
				<th width=350px>Laporan</th>
				<th >Dasar</th>
				<th >Tgl Mulai</th>
				<th >Tgl Akhir</th>
				<th width=150px>Bidang</th>
				<th width=150px>UIC</th>
				<th width=150px>Output</th>
				<th >Status</th>				
				<th >Aksi</th>
			</tr>
		</thead>
		<tbody>";
		
	$no=1;
	$tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id,laporan,dasar,tgl_mulai,tgl_akhir,(SELECT urbidang FROM rjabatan WHERE kode LIKE CONCAT(LEFT(bidang,4),'00')) AS bidang, (SELECT urbidang FROM rjabatan WHERE kode=bidang) AS uic,output FROM pelaporan WHERE periode LIKE '$_SESSION[periode]' AND output is NOT NULL  ORDER BY tgl_akhir ASC ");

     while ($r=mysqli_fetch_array($tampil)){
	       echo "<tr>
			 <td align=center>$no</td>
			 <td align=left>$r[laporan]</td>
			 <td align=left>$r[dasar]</td>
			 <td align=center>$r[tgl_mulai]</td>
			 <td align=center>$r[tgl_akhir]</td>
			 <td align=center>$r[bidang]</td>
			 <td align=center>$r[uic]</td>
			 <td align=center>$r[output]</td>
			";

		$skrg=date_create(date('Y-m-d'));
		$deadline=date_create($r[tgl_akhir]);
		/** hitung selisih hari **/
		$sh=date_diff($skrg,$deadline);
		$sd=$sh->format('%R%a days');
		

		$opt=$r[output];
		
		if (empty($opt) AND $sd > 3) {
			echo "<td align=center><img src='images/ONTRACK_0.png'>";
			}elseif(empty($opt) AND $sd < 0){
				echo "<td align=center><img src='images/OFFTRACK_0.png'>";
			}elseif(empty($opt) AND 0 <= $sd AND $sd <= 3){
				echo "<td align=center><img src='images/WARNING!_0.png'>";
		}else{
			echo "<td align=center><img src='images/FINISHED_0.png'></td>";
		}
	 
		
			 echo "<td align='center' width='100px'>";
			
			 echo "
			<a href=?op=pelaporan&act=outputpelaporan&id=$r[id]><img class='masterTooltip'  src='images/report.png' border='0' title='Rekam Output'></a>
			<a href=?op=pelaporan&act=editpelaporan&id=$r[id]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah pelaporan'></a>
			<a href=?op=pelaporan&act=lihatpelaporan&id=$r[id]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat pelaporan'></a>
			";

			
	echo "</td>
			 </tr>";
      $no++;
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
    break;


//PROSEDUR PEREKAMAN ARSIP

 case "tambahsArsip":
	     echo "<h1>PENGARSIPAN SURAT MASUK</h1>
			<div class='line'></div>
			<div class='box'>";
  echo "	
	        <form method='POST' action='modul/mod_sArsip/aksi_sArsip_in.php?op=sArsip&act=input'>
			<input type='hidden' name='id' value='$_GET[id]' size='6'>
			<label><span>TANGGAL REKAM			</span><input type='text' name='tarsip' value='".tgl_indo(date("Y m d"))."' size='15' style='text-align:right;' disabled></label>";	
			
		
			//dropdown klasifikasi arsip		
			echo "	<label><span>KLASIFIKASI ARSIP</span>";
		    echo  "<select name='jklasifikasi' style='width:450px'>
            <option value=0 selected>- KLASIFIKASI -</option>";
            $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rklasifikasi ORDER BY kode ASC");
            while($t=mysqli_fetch_array($tampil)){
            echo "<option value='$t[kode]'>$t[kode]&emsp;&emsp;|&emsp;$t[jenis]</option>";
            }
			echo "</select></label>";
			
			//dropdown jenis arsip
			echo "	<label><span>JENIS ARSIP</span>";
		    echo  "<select name='jarsip' style='width:155px'>
            <option value=0 selected>- JENIS -</option>";
            $metu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rarsip ORDER BY jnsarsip ASC");
            while($m=mysqli_fetch_array($metu)){
            echo "<option value='$m[jnsarsip]'>$m[jnsarsip]</option>";
            }
			echo "</select></label>
			
			<label><span>TANGGAL INAKTIF		</span><input type='text' name='inaktif' id='datepicker' size='15'></label>";
			
			//dropdown bidang pengelola arsip
			echo "	<label><span>BAGIAN/BIDANG</span>";
		    echo  "<select name='bidang' style='width:450px'>
            <option value=0 selected>- BAGIAN/BIDANG -</option>";
            $metu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rjabatan where right(kode,2)='00' ");
            while($m=mysqli_fetch_array($metu)){
            echo "<option value='$m[kode]'>$m[kode]&emsp;|&emsp;$m[urbidang]</option>";
            }
			echo "</select></label>";
			
			//dropdown nomor rak
			echo "	<label><span>NOMOR RAK</span>";
		    echo  "<select name='nrak' style='width:155px'>
            <option value=0 selected>- RAK -</option>";
				$no=0;
				while ($no++ < 20){
					$norak=sprintf("%02d",$no);
					echo "<option value='$norak'>$norak</option>";
				}
			echo "</select></label>";
			
			//dropdown nomor box
			echo "	<label><span>NOMOR BOX</span>";
		    echo  "<select name='nbox' style='width:155px'>
            <option value=0 selected>- BOX -</option>";
				$no=0;
				while ($no++ < 20){
					$nobox=sprintf("%02d",$no);
					echo "<option value='$nobox'>$nobox</option>";
				}
			echo "</select></label>";
			
			//dropdown nomor folder
			echo "	<label><span>NOMOR FOLDER/DOSIR</span>";
		    echo  "<select name='nfolder' style='width:155px'>
            <option value=0 selected>- FOLDER -</option>";
				$no=0;
				while ($no++ < 50){
					$norak=sprintf("%02d",$no);
					echo "<option value='$norak'>$norak</option>";
				}
			echo "</select></label>";
			
			//dropdown nomor baris
			echo "	<label><span>NOMOR BARIS</span>";
		    echo  "<select name='nbaris' style='width:155px'>
            <option value=0 selected>- BARIS -</option>";
				$no=0;
				while ($no++ < 20){
					$nobar=sprintf("%02d",$no);
					echo "<option value='$nobar'>$nobar</option>";
				}
			echo "</select></label>";
			
			//dropdown nomor rak
			echo "	<label><span>NOMOR KOLOM</span>";
		    echo  "<select name='nkolom' style='width:155px'>
            <option value=0 selected>- KOLOM -</option>";
				$no=0;
				while ($no++ < 20){
					$nokol=sprintf("%02d",$no);
					echo "<option value='$nokol'>$nokol</option>";
				}
			
			echo "</select></label>";		
			
	//QUERY UNTUK MENGISI KETERANGAN PADA TEXTAREA	
	$show	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pelaporan WHERE  id='$_GET[id]'");
		
    
	if ($s=mysqli_fetch_array($show)){
		echo "<label ><span >BERKAS FILE</span><input type='text' name='nmFile' value='$s[nfile]'></label>";
		echo "<label><span>KETERANGAN</span><textarea align='left' name='ket' style='width:450px' rows='7'>Surat Masuk \nTanggal Agenda: $s[tMasuk] \nNomor Agenda: $s[nAgenda] \nNomor Surat: $s[nSurat] \nTanggal Surat: $s[tSurat] \nPerihal Surat: $s[hal]</textarea></label>";
		}else{
		echo "<label ><span >BERKAS FILE</span><input type='text' name='nmFile' value='$s[nfile]'></label>";
		echo "<label><span>KETERANGAN</span><textarea align='left' name='ket' cols='58' rows='7'></textarea></label>";
		};		
			
		echo "<input type=submit class=button value=Simpan name=btn-upload>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form> 
		  </div>";
break;

/**
//PROSEDUR UPLOAD FILE
case "uploadFile":
	
	echo "<h1>Upload Berkas File</h1>
			<div class='line'></div>
			<div class='demo-jui'>
			<form method='post' enctype='multipart/form-data' action='$aksi?op=pelaporan&act=upload'>
				<table width=50% cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
				<input type='hidden' name='id' value='$_GET[id]' size='6'>
				<tr>
				<td style='font-size:16px; font-weight:bold;'><font color='red'>Pastikan file yang akan diunggah tidak memiliki spasi!!!</font></td>
				</tr>
				<tr>
				<td><input type='file' name='img' /></td>
				</tr>
				<tr>
				<td><button type='submit' name='btn-upload'>upload</button></td>
				</tr>
				</table>
			</form></div>";
break;
**/
}
}

