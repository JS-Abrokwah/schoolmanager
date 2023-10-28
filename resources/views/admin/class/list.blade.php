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
              (Total: {{ $classRecords->total() }})
              <span class="mx-3">
                <a href="{{ url('admin/class/list') }}" class="btn btn-sm btn-outline-success"><i class="fas fa-recycle"></i> Refresh</a>
              </span>
            </p>
          </div>
          <div class="col-sm-6 text-right">
            <a class="btn btn-sm btn-primary mr-3" data-toggle="modal" data-target="#newClassModal"><i class="fas fa-plus"></i> New Class</a>
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
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-info">
                <p class="h5  text-center font-weight-bold">Class List</p>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-hover table-sm">
                    <thead class="thead-info">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>No. Students</th>
                        <th>Programme</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="border-bottom border-muted">
                      @foreach ($classRecords as $class)
                        <tr>
                          <td>{{ $class->id }}</td>
                          <td>{{ $class->name }}</td>
                          <td class="{{ ($class->status == 1)?"text-success":"text-danger" }}">{{ ($class->status == 1)?"Active":"Inactive" }}</td>
                          <td>{{ $class->students->count() }}</td>
                          {{-- <td></td> --}}
                          <td>{{ $class->programme->name }}</td>
                          <td>{{ $class->admin->first_name.' '.$class->admin->last_name }}</td>
                          <td>{{ date('d-m-Y H:i A', strtotime($class->created_at)) }}</td>
                          <td>
                            <a href="{{ url('admin/class/view_class/'.$class->id) }}" class="btn btn-sm btn-info m-1 px-3"><i class="fas fa-eye"></i></a>
                            <a href="{{ url('admin/class/edit/'.$class->id) }}" class="btn btn-sm btn-primary m-1 px-3"><i class="fas fa-pen"></i></a>
                            <a href="{{ url('admin/class/delete/'.$class->id)}}" class="btn btn-sm btn-danger m-1 px-3"><i class="fas fa-trash"></i></a >
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="mr-3" style="float: right">
                  {{ $classRecords->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
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
    <div class="modal fade" id="newClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered"  role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <p class="font-weight-bold h5" id="exampleModalLongTitle">Add New Class</p>
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
                <form action="{{ url('admin/class/add-class') }}" method="post" class="form-horizontal" id="newAdmin">
                  @csrf
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Class Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" placeholder="Class Name">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <input type="text" name="created_by" value="{{ Auth::user()->id }}" hidden>
                    <div class="form-group row">
                      <label for="status" class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="status">
                            <option value="" selected>Nothing selected</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="programme" class="col-sm-3 col-form-label">Programme</label>
                      <div class="col-sm-9">
                        @if (!empty($programmes) && $programmes->count() > 0)
                          <select class="form-control" name="programme">
                            <option value="" selected>Select Programme</option>
                              @foreach ($programmes as $programme)
                                <option value="{{ $programme->id }}">{{ $programme->name }}</option>
                              @endforeach
                          </select>
                        @else
                          <p>Nothing to select from... <a href="{{ url('admin/programmes/list') }}">Click here</a> to add programmes</p>
                        @endif
                        @error('programme')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
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
  @if (!empty(session('class')))
    <div class="modal fade" id="editClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <p class="font-weight-bold h5" id="exampleModalLongTitle">Edit Class</p>
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
                  <form action="{{ url('admin/class/edit') }}" method="post" class="form-horizontal" id="newAdmin">
                    @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Class Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="name" value="{{ session('class')->name }}" placeholder="Class Name" required>
                        </div>
                      </div>
                      <input type="text" name="id" value="{{ session('class')->id }}" hidden>
                      <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="status" required>
                              <option value="">Nothing selected</option>
                              <option value="1" {{ (session('class')->status == 1)?'selected':'' }}>Active</option>
                              <option value="0" {{ (session('class')->status == 0)?'selected':'' }}>Inactive</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3 my-1"></div>
                        <div class="col-sm-6 my-1 row">
                          <div class="col-6 text-center">
                            <button type="button" class="btn btn-sm btn-secondary px-3 rounded-pill" data-dismiss="modal">Cancel</button>
                          </div>
                          <div class="col-6 text-center">
                            <button type="submit" class="btn btn-sm btn-success px-3 rounded-pill" id="submitBtn">Save</button>
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
  @endif

    {{-- Delete Warning Modal --}}
    <div class="modal fade" id="warnDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <p class="font-weight-bold h5" id="exampleModalLongTitle">Warning</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @if (!empty(session('warnClass'))) 
            <div class="modal-body">
              <div class="my-3 text-center">
                <p class="h5 ">
                  Are you sure you want to remove {{ session('warnClass')->name}}?
                </p>
                <p class="text-danger">This action cannot be undone!</p>
              </div>
                <form action="{{ url('admin/class/delete') }}" method="post">
                  @csrf
                  <input type="text" name="id" value="{{ session('warnClass')->id }}" id="adminIDField" hidden>
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


  @if ($errors->has('name') || $errors->has('status') ||!empty(session('error')))
      <script type="text/javascript">
          setTimeout(() => {
          $('#newClassModal').modal('show');
          }, 500);
      </script>
  @endif

  @if (!empty(session('warnClass')))
    <script type="text/javascript">
      setTimeout(() => {
      $('#warnDeleteModal').modal('show');
      }, 500);
    </script>
  @endif

  @if (!empty(session('class')))
    <script type="text/javascript">
      setTimeout(() => {
      $('#editClassModal').modal('show');
      }, 500);
    </script>
  @endif
@endsection