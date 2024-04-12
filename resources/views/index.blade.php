@extends('layout.main')
@section('title', 'Users')
@include('session')
@section('body')
@include('layout.nav')
<div class="container mt-4">
    <div class="input-group">
       
        <input type="text" class="form-control" placeholder="Search By Name" id="search">
       
    </div>
</div>
<table class="table table-Light" id="user-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Qualification</th>
            <th>Role</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->qualification }}</td>
            <td>
                {{ $user->role_id == '2' ? 'Teacher' : ($user->role_id == '3' ? 'Monitor' : 'Student') }}
            </td>
          
            <td><img src="{{ Storage::url($user->image) }}" alt="Image" width='100px' height="100px"></td>
            <td><a href={{ route('users.edit',$user->id) }} class="btn btn-success">Edit</a>
                <form action="{{ route('users.delete', $user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#search').keyup(function(){
            
            var search = $(this).val();
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: 'user/search',
                type: 'POST', 
                data: { search: search, _token: token },
                success: function(response){
    // Update table with search results
    var tableBody = $('#user-table tbody');
    tableBody.empty(); // Clear existing table r ows
    
    // Loop through each user in the response
    $.each(response, function(index, user){
        // Construct HTML for new row using string interpolation
        var newRow = `
            <tr>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.phone}</td>
                <td>${user.gender}</td>
                <td>${user.qualification}</td>
                <td>${user.role_id == '2' ? 'Teacher' : (user.role_id == '3' ? 'Monitor' : 'Student')}</td>
                <td>
                    <a href="{{ route('users.edit', ':id') }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('users.delete', ':id') }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>`;
        
        // Replace placeholder with actual user ID
        newRow = newRow.replace(/:id/g, user.id);
        
        // Append new row to table
        tableBody.append(newRow);
    });
},

                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        });
    });
</script>

@endsection
