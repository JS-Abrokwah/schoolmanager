@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>{{ !empty($page_title)?$page_title:'' }}</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ Auth::user()->user_type }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/class/list') }}">{{ Request::segment(2) }}</a> </li>
                <li class="breadcrumb-item active">{{ !empty($page_title)?$page_title:'' }}</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ url('admin/class/list') }}" class="btn btn-sm btn-outline-info">
                    Go Back
                </a> 
            </div>
            <div class="col-sm-6 text-right">
              <p class="h5 font-weight-bold">
                (Total Students: {{ '' }})
              </p>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title font-weight-bold">Class Teacher's Profile</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title font-weight-bold">Subjects</h3>
                  <div class="float-right dropdown">
                      <a class="btn btn-sm btn-primary mr-3"  data-toggle="dropdown"><i class="fas fa-plus"></i> New</a>
                      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="text-center py-2">
                          <p class="h6 font-weight-bold text-secondary">Subjects</p>
                        </div>
                        <div class="dropdown-divider"></div>
                        @if ($subjects->count() != 0)
                          <form action="{{ url('admin/class/add_subject') }}" method="post">
                            @csrf
                            <input type="text" name="class_id" value="{{ $classId }}" hidden>
                            
                              @foreach ($subjects as $subject)
                              <div class="px-5">
                                <label class="text-primary font-weight-normal" for="{{ $subject->name }}">
                                  <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}" id="{{ $subject->name }}">
                                  {{ $subject->name }}
                                </label>
                              </div>
                              @endforeach
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2">
                              <button type="submit" class="btn btn-sm btn-info px-5 rounded-pill">OK</button>
                            </div>
                          </form>
                        @else
                          <p class="text-center p-3 text-muted">Nothing to add... &lt; <a href="{{ url('admin/subject/list') }}">Click here</a> &gt; to create new subject</p>
                        @endif
                      </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Subject ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    @foreach ($class as $cls)
                    @foreach ($cls->subjects as $subject) 
                        @if ($subject->is_delete == false)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->type }}</td>
                                <td class="{{ ($subject->status == 1) ? 'text-success':'text-danger' }}">{{ ($subject->status == 1)?'Active':'Inactive' }}</td>
                                <td>
                                    <a href="{{ url('admin/class/view_subject/'.$subject->id) }}" class="btn btn-sm btn-info m-1 px-3"><i class="fas fa-eye"></i></a>
                                    <a href="{{ url('admin/class/del_subject/'.$classId.'/'.$subject->id)}}" class="btn btn-sm btn-danger m-1 px-3"><i class="fas fa-trash"></i></a >
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @endforeach
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title font-weight-bold">Students</h3>

                <div class="card-tools d-flex">
                    <div>
                        <a class="btn btn-sm btn-primary mr-3" data-toggle="modal" data-target="#newStudentModal"><i class="fas fa-plus"></i> New Student</a>
                    </div>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right py-3" placeholder="Search">

                    <span class="input-group-append">
                      <button type="submit" class="btn btn-sm btn-default" style="--">
                        <i class="fas fa-search"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Reason</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>219</td>
                      <td>Alexander Pierce</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-warning">Pending</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>657</td>
                      <td>Bob Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-primary">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>175</td>
                      <td>Mike Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-danger">Denied</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>134</td>
                      <td>Jim Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>494</td>
                      <td>Victoria Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-warning">Pending</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>832</td>
                      <td>Michael Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-primary">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>982</td>
                      <td>Rocky Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-danger">Denied</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection