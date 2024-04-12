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
<h5 class="text-center">Attendance Record</h5>
<table class="table table-light">
    <thead>
        <tr>
            <th>Date</th>
            <th>Time-in</th>
            <th>Time-out</th>
            <th>Study Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attendances as $attendance)
        <tr>
            <td>{{ $attendance->date }}</td>
            <td>{{ $attendance->timein }}</td>
            <td>{{ $attendance->timeout }}</td>
            <td>{{ $attendance->difference }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
<a href="{{ route('attendance.show') }}" class="btn btn-dark">Return Back</a>
</div>
</div>
</div>
@endsection