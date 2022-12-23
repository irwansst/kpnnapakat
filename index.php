<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Irwan Susanto" >

  <title>Login Moonraker</title>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/favicon-16x16.png"/>
  <link rel="icon" type="image/png" href="http://localhost/moonraker/img/favicon-16x16.png"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/brands.min.css" rel="stylesheet" type="text/css">


 
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  	<script>
	function validasi(form){
	  if (form.username.value == ""){
		alert("Anda belum mengisikan Username.");
		form.username.focus();
		return (false);
	  }

	  if (form.password.value == ""){
		alert("Anda belum mengisikan Password.");
		form.password.focus();
		return (false);
	  }
	  return (true);
	}
	</script>

</head>

<body  style="background-image: url('#'); background-repeat:
no-repeat;  background-attachment: fixed; background-size:75% 100%;">
  <div class="container-fluid">
    <!-- Outer Row -->
    <div class="row d-flex flex-row-reverse my-5">
        <div class="card border-1 shadow-lg my-5 mr-3 ">
          <div class="card-body">
            <!-- Nested Row within Card Body -->
              <div class="col-xl-12">
                <div class="p-0">
                  <div class="text-center" >
                    <h1 class="h4 text-gray-900">KPN NAPAKAT</h1><br>
                    <p style="font-size:12px;"> Koperasi Pegawai Negeri NAPAKAT GKN Banda Aceh</p>
                  </div>
                  <hr>
                  <form class="user" name="login" action="checkv2.php" method="POST" onSubmit="return validasi(this)">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="username" aria-describedby="username"  placeholder="Nama Pengguna">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Kata Sandi">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                      </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Masuk">
                    <br />
                  <!-- Login Teman
                  <div class="text-center">
                    <a href='teman.php' class='btn btn-warning btn-user btn-block'>
                    Login dengan user Teman
                    </a>
                  </div>
                  <br>
                -->
                  <div class="text-center">
                    <a href="modul/mod_daftar/daftar.php" class="btn btn-success btn-user btn-block">
                    Daftar Baru
                    </a>
                  </div>

              </div>
            </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


</body>

</html>
