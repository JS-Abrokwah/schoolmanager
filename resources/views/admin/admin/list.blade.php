@extends('layouts.app')
 
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ !empty($page_title)?$page_title:'' }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ Auth::user()->user_type }}</a></li>
              <li class="breadcrumb-item active">{{ !empty($page_title)?$page_title:'' }}</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <p class="h5 font-weight-bold">
              (Total: {{ $adminsRecord->total() }})
              <span class="mx-3">
                <a href="{{ url('admin/admin/list') }}" class="btn btn-sm btn-outline-success"><i class="fas fa-recycle"></i> Refresh</a>
              </span>
            </p>
          </div>
          <div class="col-sm-6 text-right">
            {{-- <div class="col-6"> --}}
              <a class="btn btn-sm btn-primary mr-3" data-toggle="modal" data-target="#newAdminModal"><i class="fas fa-plus"></i> New Admin</a>
            {{-- </div> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if (!empty(session('success')))
      @include('_message')
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-info">
                <p class="h5 font-weight-bold">Admin List</p>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-hover table-sm">
                    <thead class="thead-info">
                      <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="border-bottom border-muted">
                      @foreach ($adminsRecord as $admin)
                        <tr>
                          <td>{{ $admin->id }}</td>
                          <td>{{ $admin->first_name }}</td>
                          <td>{{ $admin->last_name }}</td>
                          <td>{{ $admin->email }}</td>
                          <td>{{ date('d-m-Y H:i A', strtotime($admin->created_at)) }}</td>
                          <td>
                            <a href="{{ url('admin/admin/edit/'.$admin->id) }}" class="btn btn-sm btn-primary m-1 px-3"><i class="fas fa-pen"></i></a>
                            <a href="{{ url('admin/admin/delete/'.$admin->id)}}" class="btn btn-sm btn-danger m-1 px-3"><i class="fas fa-trash"></i></a >
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="mr-3" style="float: right">
                  {{ $adminsRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    {{-- New Admin Modal --}}
    <div class="modal fade" id="newAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <p class="font-weight-bold h5" id="exampleModalLongTitle">Add New Admin</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if (!empty(session('error')))
              @include('_message')
            @endif
            <div class="row">
              <div class="col-md-12">
                <form action="{{ url('admin/admin/add-admin') }}" method="post" class="form-horizontal" id="newAdmin">
                  @csrf
                    <div class="form-group row">
                      <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="first_name" placeholder="First Name">
                      </div>
                      @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group row">
                      <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                      </div>
                      @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" placeholder="New Admin's email">
                      </div>
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="row">
                      <div class="col-sm-3 my-1"></div>
                      <div class="col-sm-6 my-1 row">
                        <div class="col-6 text-center">
                          <button type="button" class="btn btn-sm btn-secondary px-3 rounded-pill" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-6 text-center">
                          <button type="submit" class="btn btn-sm btn-success px-3 rounded-pill" id="submitBtn">Add</button>
                        </div>
                      </div>
                      <div class="col-sm-3 my-1"></div>
                    </div>
                </form>
              </div>
            </div>
          </div>
            @include('layouts.modal-footer')
        </div>
      </div>
    </div>

    {{-- Edit Admin Modal --}}
  @if (!empty(session('editAdmin')))
    <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <p class="font-weight-bold h5" id="exampleModalLongTitle">Edit Admin</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if (!empty(session('error')))
              @include('_message')
            @endif

              <div class="row">
                <div class="col-md-12">
                  <form action="{{ url('admin/admin/edit') }}" method="post" class="form-horizontal" id="newAdmin">
                    @csrf
                      <input type="text" name="id" value="{{ session('editAdmin')->id }}" hidden>
                      <div class="form-group row">
                        <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                        <div class="col-sm-9">
                          <input type="text" required class="form-control" name="upfirst_name" value="{{ session('editAdmin')->first_name }}" placeholder="First Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                        <div class="col-sm-9">
                          <input type="text" required class="form-control" name="uplast_name" value="{{ session('editAdmin')->last_name }}" placeholder="Last Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" required class="form-control" name="upemail" value="{{ session('editAdmin')->email }}" placeholder="Admin's email">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6 text-center">
                          <button type="button" class="btn btn-sm btn-secondary px-3 rounded-pill" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-6 text-center">
                          <button type="submit" id="submitBtn" class="btn btn-sm btn-success px-3 rounded-pill">Save Changes</button>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
          </div>
            @include('layouts.modal-footer')
        </div>
      </div>
    </div>
  @endif

    {{-- Delete Warning Modal --}}
    <div class="modal fade" id="warnDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <p class="font-weight-bold h5" id="exampleModalLongTitle">Warning</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @if (!empty(session('warnAdmin'))) 
            <div class="modal-body">
              <div class="my-3 text-center">
                <p class="h5 ">
                  Are you sure you want to remove {{ session('warnAdmin')->first_name.' '.session('warnAdmin')->last_name}}?
                </p>
                <p class="text-danger">This action cannot be undone!</p>
              </div>
                <form action="{{ url('admin/admin/delete/') }}" method="post">
                  @csrf
                  <input type="text" name="id" value="{{ session('warnAdmin')->id }}" id="adminIDField" hidden>
                  <div class="row">
                    <div class="col-6 text-center">
                      <button type="button" class="btn btn-sm btn-secondary px-3 rounded-pill" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-6 text-center">
                      <button type="submit" id="submitBtn" class="btn btn-sm btn-success px-3 rounded-pill">Continue</button>
                    </div>
                  </div>
                </form>       
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
 <!-- /.content-wrapper -->


  @if ($errors->has('email') || $errors->has('first_name') || $errors->has('last_name')||!empty(session('error')))
      <script type="text/javascript">
          setTimeout(() => {
          $('#newAdminModal').modal('show');
          }, 500);
      </script>
  @endif

  @if (!empty(session('warnAdmin')))
    <script type="text/javascript">
      setTimeout(() => {
      $('#warnDeleteModal').modal('show');
      }, 500);
    </script>
  @endif

  @if (!empty(session('editAdmin')))
    <script type="text/javascript">
      setTimeout(() => {
      $('#editAdminModal').modal('show');
      }, 500);
    </script>
  @endif
@endsection