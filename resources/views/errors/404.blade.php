<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nimdie School Manager</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition" style="background-image: url('/images/bg-classroom.png')">
<div class="row mt-5 mx-0"></div>
<div class="row mt-5 mx-0">
  <div class="col-md-3"></div>
  <div class="col-md-6 text-center">
    <h2><span style="font-size: 1.5em; font-weight:800;font-style:oblique">Nimdie</span> School Manager</h2>
  </div>
  <div class="col-md-3"></div>
</div>
<div class="row mt-3 mx-0 text-center">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <a href="{{ url('') }}">
      <img src="{{ url('/images/logo.png') }}" alt="" class="brand-image elevation-3" style="width:100px; height:100px;border-radius:50%"> <br>
      <span style="color: black; font-size:1.7em;">Nimdie</span>
    </a>
  </div>
  <div class="col-md-4"></div>

</div>

<div class="row mt-3 mx-0">
  <div class="col-md-3"></div>
  <div class="col-md-6 text-center bg-danger p-5 rounded">
    <h1>Oops😢...</h1>
    <h5>Resource cannot be found in the system!!!</h5>
  </div>
  <div class="col-md-3"></div>

</div>
<div class="row my-5 mx-0"></div>

<!-- jQuery -->
<script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/dist/js/adminlte.min.js') }}"></script>
</body>
</html>