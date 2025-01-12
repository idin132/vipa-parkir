<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="assets/login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="assets/login/css/style.css">

    <title>Login Admin VIPA</title>
  </head>
  <body>
  

  <img style="width: 200px; margin-top: 20px; margin-left: 40px" src="assets/login/css/images/logo-vipa.png" alt="">
  <div style="margin-top: -50px" class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
            <h1 class="text-white" style="text-align: center">PARKING SYSTEM RFID</h1>
         <div class="col-md-12">
            <div class="card-deskripsi p-4">
                <p class="text-white">IoT Parking System berbasis RFID adalah sistem parkir otomatis yang menggunakan kartu RFID untuk identifikasi kendaraan. Pengguna dapat mendaftar melalui website dengan mengisi data kartu RFID dan kendaraan. Saat kartu RFID dikenali oleh pembaca di gerbang parkir, waktu masuk/keluar kendaraan dicatat secara otomatis. Notifikasi waktu masuk dan keluar dikirimkan ke pengguna melalui Telegram menggunakan Telegram Bot API. Sistem ini meningkatkan efisiensi, keamanan, dan kenyamanan dalam pengelolaan parkir</p>
            </div>
         </div>
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3 class="text-center">Login Admin VIPA</h3>
            </div>
            <form action="{{ route('actionlogin')}}" method="post">
            @csrf
              <div class="form-group first">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email">
              </div>
              <br>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <!-- <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label> -->
                <!-- <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>  -->
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

              <!-- <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>
              
              <div class="social-login">
                <a href="#" class="facebook">
                  <span class="icon-facebook mr-3"></span> 
                </a>
                <a href="#" class="twitter">
                  <span class="icon-twitter mr-3"></span> 
                </a>
                <a href="#" class="google">
                  <span class="icon-google mr-3"></span> 
                </a> -->
              </div>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="assets/login/js/jquery-3.3.1.min.js"></script>
    <script src="assets/login/js/popper.min.js"></script>
    <script src="assets/login/js/bootstrap.min.js"></script>
    <script src="assets/login/js/main.js"></script>
  </body>
</html>