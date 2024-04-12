@extends('layout.main')
@section('title', 'Edit User')
@section('body')
@include('layout.nav')
    <form action="{{ route('users.update', $user) }}" method="Post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="textbox" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $user->name}}" name="name">
          </div>
          @error('name')
            <span class="error">{{ $message }}</span>
          @enderror
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $user->email }}" name="email">
          </div>
          @error('email')
          <span class="error">{{ $message }}</span>
            @enderror
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Phone</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $user->phone }}" name="phone">
          </div>
          @error('phone')
          <span class="error">{{ $message }}</span>
      @enderror
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gender: </label>
            <input type="radio" name='gender' value="male" {{  $user->gender == 'male' ? 'checked' : '' }}>
            <label for="exampleInputEmail1" class="form-label">Male</label>
            <input type="radio" name='gender' value="female" {{ $user->gender == 'female' ? 'checked' : ''}}>
            <label for="exampleInputEmail1" class="form-label">Female</label>
          </div>
          @error('gender')
          <span class="error">{{ $message }}</span>
      @enderror
      @php
       $qualification=explode(',',$user->qualification);
   
      @endphp

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Qualification: </label>
          <label for="exampleInputEmail1" class="form-label">Secondary Education</label>
          <input type="checkbox" name="qualification[]" value="secondary_education" {{  in_array('secondary_education',$qualification)  ? 'checked' : '' }}>
          <label for="exampleInputEmail1" class="form-label">Bachelors</label>
          <input type="checkbox" name="qualification[]" value="bachelors" {{  in_array('bachelors',$qualification)  ? 'checked' : '' }}>
          <label for="exampleInputEmail1" class="form-label">Masters</label>
          <input type="checkbox" name="qualification[]" value="masters"  {{  in_array('masters',$qualification)  ? 'checked' : '' }}>
        </div>
        @error('qualification')
        <span class="error">{{ $message }}</span>
    @enderror
  
    <select class="form-control" id="role" name="role_id">
      <option value="2" {{ $user->role_id == '2' ? 'selected' : '' }}>Teacher</option>
      <option value="3" {{ $user->role_id == '3' ? 'selected' : '' }}>Monitor</option>
      <option value="4" {{ $user->role_id == '4' ? 'selected' : '' }}>Student</option>
    </select>
    
    @error('role_id')
    <span class="error">{{ $message }}</span>
@enderror
        
        <button type="submit" class="btn btn-primary">Edit</button>
      </form>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection