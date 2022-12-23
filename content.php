<?php
echo "
<!--
<script type='text/javascript'>
  function autoRefreshPage()
  {
    window.location = window.location.href;
  }
  setInterval('autoRefreshPage()', 180000);
</script>
-->
";


include "config/koneksi.php";

/**
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";
**/

if ($_GET['op']=='home'){

  if ($_SESSION['leveluser']=='admin'){
    echo "<table width='100%' ><tr><td width='50%'>";
      //include "modul/mod_pengumuman/pengumuman.php";
    echo "</td><td width='50%'>";
      //include "modul/mod_llat/llat.php";
    echo "</td></tr></table>";

  }else{
  //menampilkan halaman user
  echo "<table width='100%'><tr><td width='50%'>";
    //include "modul/mod_pengumuman/pengumuman.php";
  echo "</td><td width='50%'>";
    //include "modul/mod_llat/llat.php";
  echo "</td></tr></table>";


  }
}

//Pendaftaran routing modul

/*
elseif ($_GET['op']=='shout'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "shout/index.php";
  }
}
*/

elseif ($_GET['op']=='upsaldo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_upsaldo/upsaldo.php";
  }
}

elseif ($_GET['op']=='cetak_lap_saldo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_cetak/cetak_lap_saldo.php";
  }
}

elseif ($_GET['op']=='pengumuman'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_pengumuman/pengumuman.php";
  }
}

elseif ($_GET['op']=='llat'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_llat/llat.php";
  }
}

elseif ($_GET['op']=='saldo'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_saldo/saldo.php";
  }
}

elseif ($_GET['op']=='video'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_video/video.php";
  }
}

elseif ($_GET['op']=='elpj'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_elpj/elpj.php";
  }
}

elseif ($_GET['op']=='elpj_out'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_elpj_out/elpj_out.php";
  }
}

elseif ($_GET['op']=='elpj_blu'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_elpj_blu/elpj_blu.php";
  }
}

elseif ($_GET['op']=='bas'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_bas/bas.php";
  }
}

elseif ($_GET['op']=='blangko'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_blangko/blangko.php";
  }
}

elseif ($_GET['op']=='tolakan_spm'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_tolakan/tolakan_spm.php";
  }
}

elseif ($_GET['op']=='tolakan_kontrak'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_tolakan/tolakan_kontrak.php";
  }
}



elseif ($_GET['op']=='uraian'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_uraian/uraian.php";
  }
}

elseif ($_GET['op']=='blokir'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_blokir/blokir.php";
  }
}

elseif ($_GET['op']=='supplier'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_supplier/supplier.php";
  }
}

elseif ($_GET['op']=='kontrak'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_kontrak/kontrak.php";
  }
}

elseif ($_GET['op']=='cekthr'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_cekthr/cekthr.php";
  }
}

elseif ($_GET['op']=='cekthrppnpn'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_cekthrppnpn/cekthrppnpn.php";
  }
}

elseif ($_GET['op']=='cekgaji'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_cekgaji/cekgaji.php";
  }
}

elseif ($_GET['op']=='cekppnpn'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_cekppnpn/cekppnpn.php";
  }
}



elseif ($_GET['op']=='session'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_session/session.php";
  }
}

elseif ($_GET['op']=='tagihan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_tagihan/tagihan.php";
  }
}

elseif ($_GET['op']=='pnbp'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_pnbp/pnbp.php";
  }
}

elseif ($_GET['op']=='kewajiban'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_kewajiban/kewajiban.php";
  }
}

elseif ($_GET['op']=='koreksi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_koreksi/koreksi.php";
  }
}

elseif ($_GET['op']=='kontak'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_kontak/kontak.php";
  }
}

elseif ($_GET['op']=='satker'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_satker/satker.php";
  }
}

elseif ($_GET['op']=='revisi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_revisi/revisi.php";
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

elseif ($_GET['op']=='anggota'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_anggota/anggota.php";
  }
}

elseif ($_GET['op']=='simpanan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_simpanan/simpanan.php";
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

elseif ($_GET['op']=='header'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_header/header.php";
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
