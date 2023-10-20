<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('#') }}" class="nav-link h5">{{ Auth::user()->school->name.', '.Auth::user()->school->town}}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
         <i class="fas fa-search"></i> Search
        </a>
        <div class="navbar-search-block" style="display: none;">
          <form action="" method="get" class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" name="search" placeholder="Search {{ $page_title }}" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      {{-- User Profile Pannel --}}
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{ url('/images/user2-avatar.jpg') }}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{ Auth::user()->first_name." ".Auth::user()->last_name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-info ">
            <img src="{{ url('/images/user2-avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
            <p>
              {{ Auth::user()->first_name." ".Auth::user()->last_name }}
              <small>You're logged in as <span class="font-weight-bold font-italic"> {{ (Auth::user()->user_type=='Admin')?'Administrator': Auth::user()->user_type }}</span></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="text-center">
              <button class="btn btn-sm btn-link w-100" data-toggle="modal" data-target="#passwordModal">Change Password</button>
            </div>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ url('logout') }}" class="btn btn-sm btn-link text-danger float-right">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <span>
                Logout
              </span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
      <img src="{{ url('/images/logo.png') }}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold font-italic h4">Nimdie</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class=" my-5  ">
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          {{-- Admin sidenav content --}}
          @if (Auth::user()->user_type === "Admin")
            <li class="nav-item ">
              <a href="{{ url('admin/dashboard') }}" class="nav-link @if (Request::segment(2)=="dashboard") active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/admin/list') }}" class="nav-link @if (Request::segment(2)=="admin") active @endif">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Admins
                </p>
              </a>
            </li>
            <li class="nav-item @if (Request::segment(3)=="view_student")
            menu-is-opening menu-open
            @endif">
              <a href="{{ url('admin/students/list') }}" class="nav-link @if (Request::segment(2)=="students") active @endif">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Students
                  @if (Request::segment(3)=="view_student")
                  <i class="right fas fa-angle-left"></i>
                  @endif
                </p>
              </a>
              @if (Request::segment(3)=="view_student")
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link @if (Request::segment(3)=="view_student") active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      @foreach ($students as $student)
                        <p>{{ $student->first_name }}</p>
                      @endforeach
                    </a>
                  </li>
                </ul>
              @endif
            </li>
            <li class="nav-item @if (Request::segment(3)=="view_class")
            menu-is-opening menu-open
            @endif">
              <a href="{{ url('admin/class/list') }}" class="nav-link @if (Request::segment(2)=="class") active @endif">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Classes
                  @if (Request::segment(3)=="view_class")
                  <i class="right fas fa-angle-left"></i>
                  @endif
                </p>
              </a>
              @if (Request::segment(3)=="view_class")
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link @if (Request::segment(3)=="view_class") active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      @foreach ($class as $cls)
                        <p>{{ $cls->name }}</p>
                      @endforeach
                    </a>
                  </li>
                </ul>
              @endif
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/subject/list') }}" class="nav-link @if (Request::segment(2)=="subject") active @endif">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Subjects
                </p>
              </a>
            </li>

            {{-- Parent sidenav content --}}
          @elseif (Auth::user()->user_type === "Parent")
            <li class="nav-item">
              <a href="{{ url('parent/dashboard') }}" class="nav-link @if (Request::segment(2)=="dashboard") active @endif"">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            
            {{-- Teacher sidenav content --}}
          @elseif (Auth::user()->user_type === "Teacher")
            <li class="nav-item">
              <a href="{{ url('teacher/dashboard') }}" class="nav-link @if (Request::segment(2)=="dashboard") active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            {{-- Student sidenav content --}}
          @elseif (Auth::user()->user_type === "Student")
            <li class="nav-item">
              <a href="{{ url('student/dashboard') }}" class="nav-link @if (Request::segment(2)=="dashboard") active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
          @endif
          
          <li class="nav-item mt-5 border-bottom border-top border-danger">
            <a href="{{ url('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm " role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <p class="font-weight-bold h5" id="exampleModalLongTitle">Change Password</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @include('_message')
        <div class="modal-body">
          <form action="{{ url("change-password") }}" method="post">
            @csrf
            <div class="input-group">
              <input type="password" class="form-control form-control-sm" name="reset_old_password" placeholder="Old Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            @error('reset_old_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="input-group mt-3">
              <input type="password" class="form-control form-control-sm" name="reset_new_password" placeholder="New Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            @error('reset_new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="input-group mt-3">
                <input type="password" class="form-control form-control-sm" name="reset_confirm_password" placeholder="Confirm Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
            </div>
            @error('reset_confirm_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @if (!empty(session('reset_not_match')))
                <span class="text-danger">{{ session('reset_not_match') }}</span>
            @endif
            <div class="row mt-3">
              <!-- /.col -->
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
              </div>
              <!-- /.col -->
            </div>
          </form>      
        </div>
      </div>
    </div>
  </div>

  @if ($errors->has('reset_new_password') || $errors->has('reset_old_password') || $errors->has('reset_confirm_password')||!empty(session('reset_error'))||!empty(session('reset_success')) ||!empty(session('reset_not_match')))
      <script type="text/javascript">
          setTimeout(() => {
          $('#passwordModal').modal('show');
          }, 500);
      </script>
  @endif