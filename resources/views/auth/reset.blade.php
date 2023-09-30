<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ !empty($page_title)?$page_title.' - ':'' }}Nimdie School Manager</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page" style="background-image: url('/images/bg-classroom.png')">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline">
    <div class="card-header text-center bg-info">
      <a href="{{ url('#') }}" class="h2"><b>Nimdie</b> <span class="h3">School Manager</span></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg h5 font-italic">{{ $page_title }}</p>
      @include('_message')
      <form action="{{ url("reset-password/$user->remember_token") }}" method="post">
        @csrf
        <div class="input-group">
          <input type="password" class="form-control form-control-sm" name="new_password" placeholder="New Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('new_password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="input-group mt-3">
            <input type="password" class="form-control form-control-sm" name="confirm_password" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
        </div>
        @error('confirm_password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @if (!empty(session('not_match')))
            <span class="text-danger">{{ session('not_match') }}</span>
        @endif
        <div class="row mt-3">
          <!-- /.col -->
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm">Reset</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="{{ url('login') }}" class="text-primary">Login</a>
      </p>
      <div class="mt-3">
        @include('layouts.modal-footer')
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/dist/js/adminlte.min.js') }}"></script>
</body>
</html>