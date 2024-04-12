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
<h5 class="text-center">LIST OF PRESENT-STUDENT ({{ \Carbon\Carbon::today()->format('Y-m-d') }})</h5>
<table class="table table-light">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>History</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
       
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            @if($student->attendanceToday->first())
                <td class="text-success">Present</td>
            @else
                <td class="text-danger">Absent</td>
            @endif
            <td>
                <a href="{{ route('attendanceDetail', $student)}}" class="btn btn-success" >View</a>
            </td>
        </tr>
    @endforeach
    
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
@endsection