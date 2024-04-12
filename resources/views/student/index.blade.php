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
          <h1 class="h2">Student Portal</h1>
          <div class="btn-group">
            <a href="{{ route('user.attendance') }}" class="btn btn-primary">Time-in</a>
            <a href="{{ route('user.attendance.update') }}" class="btn btn-danger">Time-out</a>
        </div>
        </div>
        <!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Subjects</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('subject.seleted') }}" method="POST">
          @csrf
          <table class="table table-light">
            <thead>
              <tr>
                <th>SELECT SUBJECTS</th>
                <th>STATUS</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($subjects as $subject)
              <tr>
                <td>
                  <input type="checkbox" value="{{ $subject->id }}" name="subject_id[]">{{ $subject->subject }}
                </td>
                <td>
                  @if ($subject->stdSub->isNotEmpty())
                  {{ $subject->stdSub->first()->pivot->status }}
                  @else
                  not selected
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @error('subject_id')
          <div class="error">{{ $message }}</div>
          @enderror
          <input type="submit" name="submit" class="btn btn-dark" id="submit">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<table class="table table-light">
  <thead>
    <tr>
      <th>Subject Details</th>
      <th>STATUS</th>
      <th>REASON</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($subjects as $subject)
    <tr>
      <td>
      {{ $subject->subject }}
      </td>
      <td>
        @if ($subject->stdSub->isNotEmpty())
        {{ $subject->stdSub->first()->pivot->status }}
        @else
        not selected
        @endif
      </td>
      <td>
      {{$subject->stdSub->isNotEmpty()? $subject->stdSub->first()->pivot->reason : ''}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<script>
  $(document).ready(function() {
    @if(!session('success') && !session('error'))
      $('#myModal').modal('show');
    @endif
  });
</script>
      </main>
    </div>
  </div>
@endsection