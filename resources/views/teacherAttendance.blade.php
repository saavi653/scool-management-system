@extends('layout.main')
@section('title', 'Users')
@include('session')
@section('body')
@include('layout.nav')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Attendance of teachers ({{ \Carbon\Carbon::today()->format('Y-m-d') }})</h5>
                    <table class="table table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>History</th>
                        </tr>
                        <tr>
                            @foreach($teachers as $teacher)
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone }}</td> 
                            @if($teacher->attendanceToday->first())
                            <td class="text-success text-center">Present</td>
                            @else
                            <td class="text-danger text-center">Absent</td>
                            @endif
                            <td>
                                <a href="{{ route('attendanceDetailTeacher', $teacher)}}" class="btn btn-success" >View</a>
                            </td>
                        </tr>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
