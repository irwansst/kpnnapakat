<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$aksi="modul/mod_sMasuk/aksi_sMasuk.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>Surat Masuk periode $_SESSION[periode]</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=sMasuk&act=tambahsMasuk'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th width=20px align=center>No</th>
				<th >Tanggal Agenda</th>
				<th >Nomor Agenda</th>
				<th >Jenis Surat</th>
				<th >Sifat Surat</th>				
				<th >Nomor Surat</th>
				<th >Tanggal Surat</th>		
				<th>Dari</th>
				<th>Perihal Surat</th>
				<th>Disp</th>
				<th>File</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>";
		
	$no=1;
	$tampil	= mysql_query("SELECT * FROM smasuk WHERE  periode='$_SESSION[periode]' AND nArsip IS NULL ORDER BY stamp DESC");
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr>
			 <td align=center>$no</td>
			 <td align=center>$r[tMasuk]</td>
			 <td align=center>$r[nAgenda]</td>
			 <td align=center>$r[jSurat]</td>
			 <td align=center>$r[uSifat]</td>
             <td align=left>$r[nSurat]</td>
             <td align=center>$r[tSurat]</td>   
             <td>$r[dari]</td>
             <td>$r[hal]</td>
             <td><a href=?op=sMasuk&act=uploadFile&id=$r[id_sMasuk]><img class='masterTooltip'  src='images/cascade.png' border='0' title='Disposisi'></a></td>";
			 
// PILIHAN UNTUK UPLOAD FILE
			if (empty($r[nfile])){
				echo "<td><a href=?op=sMasuk&act=uploadFile&id=$r[id_sMasuk]><img class='masterTooltip'  src='images/upload_file.png' border='0' title='Upload File'></a></td>";
				}else{
				echo "<td><a href='arsip/$r[nfile]' target='_blank'><img class='masterTooltip'  src='images/berkas.png' border='0' title='Lihat File'></a></td>";
				}					     
// BATAS UNTUK SCRIPT UPLOAD FILE			
			
			 echo "<td align='center' width='250px'>";
			 
			 if (empty($r[nArsip])){
			 echo "<a href='modul/mod_laporan/cetak_disposisi.php?id=$r[id_sMasuk]' target='_blank' ><img class='masterTooltip'  src='images/printer.png' border='0' title='Cetak Disposisi'></a>
			 <a href=?op=sMasuk&act=lihatsMasuk&id=$r[id_sMasuk]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat Data'></a>
			 <a href=?op=sMasuk&act=editsMasuk&id=$r[id_sMasuk]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah Data'></a>
			 <a href=?op=sMasuk&act=tambahsArsip&id=$r[id_sMasuk]><img class='masterTooltip'  src='images/arsip.png' border='0' title='Simpan Arsip'></a>";
			}else{
			echo "
			<a href='modul/mod_laporan/cetak_disposisi.php?id=$r[id_sMasuk]' target='_blank' ><img class='masterTooltip'  src='images/printer.png' border='0' title='Cetak Disposisi'></a>
			 <a href=?op=sMasuk&act=lihatsMasuk&id=$r[id_sMasuk]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat Data'></a>
			 <a href=?op=sMasuk&act=editsMasuk&id=$r[id_sMasuk]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah Data'></a>
			 <a href=?op=sMasuk&act=lihatsMasuk&id=$r[id_sMasuk]><img class='masterTooltip'  src='images/drawer.png' border='0' title='Lihat Arsip'></a>";
			 }
			
	echo "</td>
			 </tr>";
      $no++;
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahsMasuk":
      echo "<h1>Tambah SURAT MASUK</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "	
	        <form method=POST action='$aksi?op=sMasuk&act=input'>
			<label><span>TANGGAL REKAM			</span><input type='text' value='".tgl_indo(date("Y m d"))."' size='15' style='text-align:right;' disabled></label>";	
			
			//membuat nomor agenda baru secara otomatis
			$nom = mysql_query("SELECT nAgenda from smasuk ORDER BY id_sMasuk DESC LIMIT 1");
			while($t=mysql_fetch_array($nom)){
            $int=(float)$t[nAgenda];
			$agdbaru=$int+1;
			$noagd=sprintf("%06d", $agdbaru);
			echo "	<label><span>NOMOR AGENDA			</span><input type='text' value='$noagd' name='nagenda' size='6'></label>";
            }	
			
			//dropdown jenis surat			
			echo "	<label><span>JENIS SURAT</span>";
		    echo  "<select name='jsurat'>
            <option value=0 selected>- JENIS SURAT -</option>";
            $tampil=mysql_query("SELECT * FROM jenis ORDER BY kodejenis ASC");
            while($t=mysql_fetch_array($tampil)){
            echo "<option value='$t[kodejenis]'>$t[kodejenis]</option>";
            }
			echo "</select></label>";
			
			//dropdown sifat surat
			echo "	<label><span>SIFAT SURAT</span>";
		    echo  "<select name='usifat'>
            <option value=0 selected>- SIFAT SURAT -</option>";
            $metu=mysql_query("SELECT * FROM rSifat ORDER BY id ASC");
            while($m=mysql_fetch_array($metu)){
            echo "<option value='$m[sifat]'>$m[sifat]</option>";
            }
			echo "</select></label>
			
			<label><span>NOMOR SURAT			</span><input type='text' name='nsurat' size='40'></label>
			<label><span>TANGGAL SURAT			</span><input type='text' name='tsurat' id='datepicker' size='15'></label>
			<label><span>LAMPIRAN			</span><input type='text' name='jlampiran' size='15'></label>					
		
		
		<div class='autocomplete'><label for='kantor'><span>SURAT TERIMA DARI			</span><input type='text' name='dari' size='70' id='kantor'></label></div>
			
			<label><span>PERIHAL SURAT			</span><input type='text' name='hal' size='70'></label>

			<label><span>DISPOSISI SURAT KEPADA	</span>";
			
			//dropdown disposisi surat
			echo "<select name='dispo'>
					<option value=0 selected>- DAFTAR PEJABAT -</OPTION>";
					$kueri=mysql_query("SELECT * FROM rJabatan ORDER BY kode ASC");
					while ($k=mysql_fetch_array($kueri)){
					echo "<option value='$k[jabatan]'>$k[jabatan]</option>";		
					}
			echo "</select></label>
			
			
			<label><span>STATUS			</span>";
			
			//dropdown status surat
			echo "<select name='status'>
					<option value=0 selected>- STATUS -</OPTION>";
					$status=mysql_query("SELECT * FROM rStatus ORDER BY id ASC");
					while ($st=mysql_fetch_array($status)){
					echo "<option value='$st[status]'>$st[status]</option>";		
					}
			echo "</select></label>
			
			
		
		<input type=submit class=button value=Simpan>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form></div>";

    break;
  

  case "editsMasuk":
    $edit = mysql_query("SELECT * FROM sMasuk WHERE id_sMasuk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
	
	echo "<h1>Ubah sMasuk</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=sMasuk&act=update>
        <input type=hidden name=id value=$r[id_sMasuk]>
		
		<label><span>TANGGAL SURAT MASUK	</span><input type='text' name='tmasuk' value='$r[tMasuk]' id='datepicker' size='15' style='text-align:right;' ></label>
		<label><span>NOMOR AGENDA			</span><input type='text' name='nagenda' value='$r[nAgenda]' size='6'></label>
		<label><span>JENIS SURAT</span>";
		    echo  "<select name='jsurat'>
            <option value=$r[jSurat] selected>$r[jSurat]</option>";
            $tampil=mysql_query("SELECT * FROM jenis ORDER BY kodejenis ASC");
            while($t=mysql_fetch_array($tampil)){
            echo "<option value='$t[kodejenis]'>$t[kodejenis]</option>";
            }
		  echo "</select></label>";
		  
			//dropdown sifat surat
			echo "	<label><span>SIFAT SURAT</span>";
		    echo  "<select name='usifat'>
            <option value='$r[uSifat]' selected>$r[uSifat]</option>";
            $metu=mysql_query("SELECT * FROM rSifat ORDER BY id ASC");
            while($m=mysql_fetch_array($metu)){
            echo "<option value='$m[sifat]'>$m[sifat]</option>";
            }
			echo "</select></label>
		
		<label><span>NOMOR SURAT			</span><input type='text' name='nsurat' value='$r[nSurat]' size='40'></label>
		<label><span>TANGGAL SURAT			</span><input type='text' name='tsurat' value='$r[tSurat]' id='datepicker' size='15'></label>
			<label><span>LAMPIRAN			</span><input type='text' name='jlampiran' value='$r[jLampiran]' size='10'></label>
		
		<div class='autocomplete'><label for='kantor'><span>SURAT TERIMA DARI			</span><input type='text' name='dari' size='70' id='kantor' value='$r[dari]'></label></div>		
					
		
		<label><span>PERIHAL SURAT			</span><input type='text' name='hal' value='$r[hal]' size='70'></label>
		
		<label><span>DISPOSISI SURAT KEPADA	</span>";
			
			//dropdown disposisi surat
			echo "<select name='dispo'>
					<option value='$r[dispo]' selected>$r[dispo]</OPTION>";
					$jabatan=mysql_query("SELECT * FROM rJabatan ORDER BY kode ASC");
					while ($jb=mysql_fetch_array($jabatan)){
					echo "<option value='$jb[jabatan]'>$jb[jabatan]</option>";		
					}
			echo "</select></label>
			
			<label><span>STATUS	</span>";
			
			//dropdown status surat
			echo "<select name='status'>
					<option value=$r[status] selected>$r[status]</OPTION>";
					$status=mysql_query("SELECT * FROM rStatus ORDER BY id ASC");
					while ($st=mysql_fetch_array($status)){
					echo "<option value='$st[status]'>$st[status]</option>";		
					}
			echo "</select></label>
	 
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "lihatsMasuk":
    $edit = mysql_query("SELECT * FROM sMasuk WHERE id_sMasuk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
	$tgl	= tgl_indo($r[tSurat]);
	$tgl1	= tgl_indo($r[tMasuk]);
	
	
	echo "<h1>Detail Informasi</h1>
			<div class='line'></div>
			<div class='box'>";
			
    echo "
          <form method=POST action=$aksi?op=sMasuk&act=update>
                   
		  <label><span>TERAKHIR DIBUAT/UPDATE</span>: <b>$r[stamp]</b></label>
		  <label><span>PERIODE</span>: <b>$r[periode]</b></label><br>

		  <label><span>NOMOR SURAT</span>: <b>".$r[nSurat]."</b></label>
		  <label><span>TANGGAL SURAT</span>: $tgl</label><br>
		  
		  <label><span>TANGGAL SURAT DITERIMA</span>: $tgl1</label>
		  <label><span>SURAT DARI </span>: $r[dari]</label>
		  <label><span>PERIHAL SURAT</span>: $r[hal]</label>
		  <label><span>SURAT DITUJUKAN KEPADA</span>: $r[dispo]</label>
		  <label><span>STATUS SURAT</span>: $r[status]</label>
		  
         

          <br><br><input type=button class=button value=Kembali onclick=self.history.back()></td></tr>
          </form></div>";
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
            $tampil=mysql_query("SELECT * FROM rklasifikasi ORDER BY kode ASC");
            while($t=mysql_fetch_array($tampil)){
            echo "<option value='$t[kode]'>$t[kode]&emsp;&emsp;|&emsp;$t[jenis]</option>";
            }
			echo "</select></label>";
			
			//dropdown jenis arsip
			echo "	<label><span>JENIS ARSIP</span>";
		    echo  "<select name='jarsip' style='width:155px'>
            <option value=0 selected>- JENIS -</option>";
            $metu=mysql_query("SELECT * FROM rarsip ORDER BY jnsarsip ASC");
            while($m=mysql_fetch_array($metu)){
            echo "<option value='$m[jnsarsip]'>$m[jnsarsip]</option>";
            }
			echo "</select></label>
			
			<label><span>TANGGAL INAKTIF		</span><input type='text' name='inaktif' id='datepicker' size='15'></label>";
			
			//dropdown bidang pengelola arsip
			echo "	<label><span>BAGIAN/BIDANG</span>";
		    echo  "<select name='bidang' style='width:450px'>
            <option value=0 selected>- BAGIAN/BIDANG -</option>";
            $metu=mysql_query("SELECT * FROM rjabatan where right(kode,2)='00' ");
            while($m=mysql_fetch_array($metu)){
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
	$show	= mysql_query("SELECT * FROM smasuk WHERE  id_sMasuk='$_GET[id]'");
		
    
	if ($s=mysql_fetch_array($show)){
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

//PROSEDUR UPLOAD FILE
case "uploadFile":
	
	echo "<h1>Upload Berkas File</h1>
			<div class='line'></div>
			<div class='demo-jui'>
			<form method='post' enctype='multipart/form-data' action='$aksi?op=sMasuk&act=upload'>
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
}
}

