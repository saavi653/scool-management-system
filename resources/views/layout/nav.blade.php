@if(Auth::user()->role_id == 1)
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="{{ url('/dashboard') }}">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="{{ route('users.index') }}">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="{{ route('users.features') }}">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="{{ route('users.permission') }}">Permissions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="{{ route('subject.index') }}">Subject</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="{{ route('subject.create') }}">Create Subject</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('teachersAttendance') }}">Attendance</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('logout') }}">Logout</a>
          </li>
        </ul>
      </div> 
    </div>
  </nav>
@else
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand text-white" href="#">{{ strtoupper(Auth::user()->name) }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              @if(auth()->user()->role_id==2)
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('teacherDashboard') }}">Home</a>
                </li>
                @elseif(auth()->user()->role_id==3)
                <li class="nav-item">
                  <a class="nav-link text-white" href="{{ route('monitorDashboard') }}">Home</a>
              </li>
                @else
                <li class="nav-item">
                  <a class="nav-link text-white" href="{{ route('studentDashboard') }}">Home</a>
              </li>
                @endif

                @if(Auth()->user()->role_id==2)
                <li class="nav-item">
                  <a class="nav-link text-white" href="{{ route('attendance.show') }}">Attendance</a>
              </li>
              @endif
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div> 
    </div>
</nav>
@endif
