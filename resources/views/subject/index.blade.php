@extends('layout.main')
@section('title', 'Users')
@include('session')
@section('body')
@include('layout.nav')
    <table class="table table-Light">
        <tr>
            <th>Subject</th>
            <th>Description</th>
            <th>Teacher</th>
            <th>Actions</th>
        </tr>
        <tr>
            @foreach($subjects as $subject)
            <td>{{ $subject->subject }}</td>
            <td>{{ $subject->description }}</td>
            <td>{{ $subject->teacher->name }}</td>
            <td><a href={{ route('subject.edit',$subject) }} class="btn btn-success">Edit</a>
                <form action="{{ route('subject.delete', $subject) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
            @endforeach
        </tr>
    </table>
@endsection
