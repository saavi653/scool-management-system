@extends('layout.main')
@section('title', 'Create User')
@section('body')

<div class="container py-5">
  <h3 class="mb-4 text-center" style="font-weight: bold; color: #333;">Registration Form</h3>
    <form action="{{ route('users.store') }}" method="Post" id="myForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{ old('name') }}" name="name">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}" name="email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp" value="{{ old('phone') }}" name="phone">
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                  <label>Gender</label><br>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                      <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                      <label class="form-check-label" for="female">Female</label>
                      <label for="gender" class="error"></label>
                  </div>
                  @error('gender')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
                <div class="mb-3">
                    <label class="form-label">Qualification</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="qualification[]" id="secondary" value="secondary-education">
                        <label class="form-check-label" for="secondary">Secondary Education</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="qualification[]" id="bachelors" value="bachelors">
                        <label class="form-check-label" for="bachelors">Bachelors</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="qualification[]" id="masters" value="masters">
                        <label class="form-check-label" for="masters">Masters</label>
                    </div>
                    <label for="qualification[]" class="error"></label>
                    @error('qualification')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Select Role</label>
                    <select class="form-control" id="role" name="role_id">
                        <option  value="2">Teacher</option>
                        <option value="3">Monitor</option>
                        <option value="4">Student</option>
                    </select>
                    @error('role_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" value="{{ old('cpassword') }}">
                    @error('cpassword')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Image Upload</label>
                    <input type="file" class="form-control"  name="image" value="{{ old('image') }}">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                role_id:'required',
                password:'required',
                cpassword: {
                    required: true,
                    equalTo: '#password'
                },
            }
        });

    });
</script>
@endsection
