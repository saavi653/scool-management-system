@extends('layout.main')
@section('title', 'Users')
@include('session')
@section('body')
@include('layout.nav')
<div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-secondary sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <h5 class="nav-link font-weight-bold text-light">LIST OF FEATURES</h5>
                </li>
                @foreach ($permissions->features as $feature)    
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">
                            <span class="feather" data-feather="shopping-cart"></span>
                            {{ $feature->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

      <!-- Page Content -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Teacher Portal</h1>
          <div class="btn-group">
            <a href="{{ route('user.attendance') }}" class="btn btn-primary">Time-in</a>
            <a href="{{ route('user.attendance.update') }}" class="btn btn-danger">Time-out</a>
        </div>
        
        
        </div>
          <table class="table table-Light">
          <tr>
            <th>Interested Students</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        @foreach($students->assignedUser as $student)
       
        <tr>
          <td>{{ $student->name }}</td>
          <td>{{ $student->email }}</td>
          <td><a href={{ route('subject.approved',$student->id) }} class="btn btn-success">Approved</a>
          <a href='{{ route('subject.rejected',$student->id) }}' class="btn btn-danger" data-toggle="modal" data-target="#myModal">Rejected</a></td>
              <!-- The Modal -->
          <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Enter reason for rejection</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                  <form action="{{ route('subject.rejected',$student->id) }}" method="post">
                    @csrf
                    @method('GET')
                  <input type="text" name="reason" required>
                  <input type="submit" name="submit" class="btn btn-dark">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </tr> 
          @endforeach 
          </table>
      </main>
    </div>
  </div>

@endsection