
@extends('layout.main')
@section('title', 'Create User Through Ajax')
@section('body')
@include('layout.nav')
    <form action="" method="Post" id="myForm">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" id="" aria-describedby="emailHelp" value="{{ old('name') }}" name="name" >
          </div>
          @error('name')
            <span class="error">{{ $message }}</span>
          @enderror
          <div class="mb-3">
            <label for="" class="form-label">Email address</label>
            <input type="text" class="form-control" id="" aria-describedby="emailHelp"  name="email">
          </div>
          @error('email')
          <span class="error">{{ $message }}</span>
            @enderror
          <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="text" class="form-control" id="" aria-describedby="emailHelp" value="{{ old('phone') }}" name="phone">
          </div>
          @error('phone')
          <span class="error">{{ $message }}</span>
      @enderror
          <div class="mb-3">
            <label>Gender</label>
            <input type="radio" name='gender' value="male">
            <label for="exampleInputEmail1" class="form-label">Male</label>
            <input type="radio" name='gender' value="female">
            <label for="exampleInputEmail1" class="form-label">Female</label>
            <label for="gender" class="error"></label>
          </div>
          @error('gender')
          <span class="error">{{ $message }}</span>
      @enderror
        <div class="mb-3">
          <label for="" class="form-label">Qualification: </label>
          <label for="" class="form-label">Secondary Education</label>
          <input type="checkbox" name="qualification[]" value="secondary-education">
          <label for="" class="form-label">Bachelors</label>
          <input type="checkbox" name="qualification[]" value="Bachelors">
          <label for="" class="form-label">Masters</label>
          <input type="checkbox" name="qualification[]" value="Masters">
          <label for="qualification[]" class="error"></label>
        </div>
        @error('qualification')
        <span class="error">{{ $message }}</span>
    @enderror
        <div class="mb-3">
          <label for="" class="form-label">Password</label>
          <input type="password" class="form-control" id="pass" name="password" value="{{ old('password') }}">
        </div>
        @error('password')
        <span class="error">{{ $message }}</span>
    @enderror
        <div class="mb-3">
            <label for="" class="form-label">Confirm-Password</label>
            <input type="password" class="form-control" id="" value="{{ old('cpassword') }}" name="cpassword">
          </div>
          @error('cpassword')
          <span class="error">{{ $message }}</span>
      @enderror
        
        <button type="submit" class="btn btn-primary" id="submit">Create</button>
      </form>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src='https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js'></script> --}}
    <script src='https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js'></script>
    <script>
        $(document).ready(function(){

          $("#myForm").validate({
          rules: {
            name: "required",
            email: {
              required: true,
              email: true
            },
            phone:'required',
            gender:'required',
            'qualification[]':'required',
            password:'required',
            cpassword: {
                        required: true,
                        equalTo: '#pass'
                    },
          }
        });

           $('#myForm').submit(function(event){
            event.preventDefault();
            var formData = $('#myForm').serialize(); 
            
            $.ajax({
                url: '/users/create/ajax',
                type: 'POST',
                data: formData, 
                success: function(response) {
                    console.log(response);
                    // window.location.href = '/users';
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
           })
        })
    </script>

@endsection