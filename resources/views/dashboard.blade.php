@extends('layout.main')
@section('title', 'Users')
@include('session')
@section('body')
@include('layout.nav')
<div class="container">
   <form action="{{ route('dashboard') }}" method="get" class="mb-3">
      <label for="role">Select Role:</label>
      <select class="form-control selected" name="role_id" id="role">
         <option value=''>All</option>
         <option value="2" {{ isset($_GET['role_id']) && $_GET['role_id'] == '2' ? 'selected' : '' }}>Teacher</option>
         <option value="3" {{ isset($_GET['role_id']) && $_GET['role_id'] == '3' ? 'selected' : '' }}>Monitor</option>
         <option value="4" {{ isset($_GET['role_id']) && $_GET['role_id'] == '4' ? 'selected' : '' }}>Student</option>
     </select>
     
      <button type="submit" class="btn btn-dark">Filter</button>
  </form>
  <div class="d-flex align-items-center mb-2">
      <span class="me-2">Teacher: </span>
      <span class="badge bg-dark">{{ $teacher }}</span>

      <span class="me-2">Monitor: </span>
      <span class="badge bg-dark">{{ $monitor }}</span>
      <span class="me-2">Student: </span>
      <span class="badge bg-dark">{{ $student }}</span>
  </div>
  
   <table class="table table-striped table-bordered" id="myTable"> 
      <thead class="table-dark">
      <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Gender</th>
          <th>Qualification</th>
          <th>Role</th>
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
      </tr>
      @endforeach
   </tbody>
  </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script>
 $(document).ready( function () {
 
  $('#myTable').DataTable();

// //   listing according to the role
//    $('#role').on('change',function(){
//       var selected = $(this).val(); 
      
//       console.log(selected);
//       $.ajax({
//             url: '/dashboard/selectedRole',
//             type: 'GET',
//             data:{selected: selected}, 
//             success: function(response) {
//                console.log(response);
//                // window.location.href = '/users';
//             },
//             error: function(xhr, status, error) {
//                console.error(error);
//             }
//       });
//       })

 });
 </script>
@endsection
