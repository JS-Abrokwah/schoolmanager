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
<body class="hold-transition m-0 p-0" style="background-image: url('/images/bg-classroom.png')">
<div class="row m-0 p-0">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="mt-3" style="width: 100%">
      <!-- /.login-logo -->
      <div class="card card-outline">
        <div class="card-header text-center bg-info">
          <a href="{{ url('#') }}" class="h2"><b>Nimdie</b> <span class="h3">School Manager</span></a>
        </div>
      <div class="login-box-msg">
        <div class="py-3">
         <span class="h5 py-3 text-muted font-weight-bold">Digitalize Your School!</span> <span class="float-right"><a href="#">Pricing Policy</a></span>
        </div>
      </div>
        <div class="card card-secondary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item font-weight-bold">
                <a class="nav-link active" id="school-tab" data-toggle="pill" href="#school-info" role="tab" aria-controls="school-info" aria-selected="true">School Information</a>
              </li>
              <li class="nav-item font-weight-bold">
                <a class="nav-link" id="personal-tab" data-toggle="pill" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="false">Personal Information</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <form action="{{ url('create-school') }}" method="post">
                @csrf
                @include('_message')
                {{-- School Information --}}
                <div class="tab-pane active" id="school-info" role="tabpanel" aria-labelledby="school-info">
                  <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-center">School Name: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="name" placeholder="School Name">
                      @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="waec_id" class="col-sm-3 col-form-label text-center">WAEC ID: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="waec_id" placeholder="WAEC ID">
                      @error('waec_id')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ownership" class="col-sm-3 col-form-label text-center">Ownership: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <select class="form-control form-control-sm" name="ownership" >
                        <option value="" selected>Select ownership type</option>
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                      </select>
                      @error('ownership')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="gender" class="col-sm-3 col-form-label text-center">Gender: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <select class="form-control form-control-sm" name="gender" >
                        <option value="" selected>Select students gender type</option>
                        <option value="Boys">Boys</option>
                        <option value="Girls">Girls</option>
                        <option value="Mix">Mix</option>
                      </select>
                      @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="town" class="col-sm-3 col-form-label text-center">Town/City: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="town" placeholder="Town">
                      @error('town')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="district" class="col-sm-3 col-form-label text-center">District: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="district" placeholder="District">
                      @error('district')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="Region" class="col-sm-3 col-form-label text-center">Region: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="region" placeholder="Region">
                      @error('region')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="text-right">
                    <button type="button" id="nextTab" class="btn btn-sm btn-outline-primary">Next</button>
                  </div>
                </div>
                {{-- Personal Information --}}
                <div class="tab-pane" id="personal-info" role="tabpanel" aria-labelledby="personal-info">
                  <div class="form-group row">
                    <label for="first_name" class="col-sm-3 col-form-label text-center">First Name: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="first_name" placeholder="First_name">
                      @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="last_name" class="col-sm-3 col-form-label text-center">Last Name: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="last_name" placeholder="Last Name">
                      @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <input type="text" name="user_type" value="Admin" hidden>
                  <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-center">Email: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="email" placeholder="Email">
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label text-center">Password: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control form-control-sm" name="password" placeholder="Password">
                      @error('password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="phone_no" class="col-sm-3 col-form-label text-center">Phone No. <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm" name="phone_no" placeholder="Eg. 054*******  or  +233*********">
                      @error('phone_no')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="sex" class="col-sm-3 col-form-label text-center">Sex: <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <select class="form-control form-control-sm" name="sex">
                        <option value="" selected>Select</option>
                        <option value="Male" >Male</option>
                        <option value="Female" >Female</option>
                      </select>
                      @error('sex')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="termsCheck">
                      <label class="custom-control-label" for="termsCheck">I agree to our <a href="#">terms of service</a>.</label>
                    </div>
                    @if(!empty(session('terms-warning')) || $errors->has('first_name')||$errors->has('last_name')||$errors->has('email')||$errors->has('password')||$errors->has('phone_no')||$errors->has('sex'))
                      <script type="text/javascript">
                         setTimeout(() => {
                          $('#personal-tab').click()
                         }, 100);
                      </script>
                      <span class="text-danger">Kindly read and accept our terms of services</span>
                    @endif
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 mr-5">Submit</button>
                  </div>
                  <div class="text-left">
                    <button type="button" id="prevTab" class="btn btn-sm btn-outline-primary">Back</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="text-left pt-3 text-muted">
              Already have account? <span class="font-weight-bold"><a href="{{ url('login') }}">Login</a></span> 
            </div>
          </div>
          @include('layouts.modal-footer')
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>  
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#school-info').show()
    $('#personal-info').hide()
    $('#school-tab').click(function(){
      $('#school-info').show()
      $('#personal-info').hide()
    })
    $('#personal-tab').click(function(){
      $('#personal-info').show()
      $('#school-info').hide()
    })
    $('#prevTab').click(function(){
      $('#school-tab').click()
    })
    $('#nextTab').click(function(){
      $('#personal-tab').click()
    })
  })
</script>
</body>
</html>