@extends('layout.main')
@section('title', 'Users')
@include('session')
@section('body')
@include('layout.nav')

<div class="container py-5">
  <h3 class="mb-4 text-center" style="font-weight: bold; color: #333;">Edit Subject</h3>
    <form action="{{ route('subject.update',$subject) }}" method="Post" id="myForm">
        @csrf
        <div class="row">
            
            <div class="col-md-6 offset-md-3">
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" aria-describedby="nameHelp" value="{{ $subject->subject }}" name="subject">
                    @error('subject')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $subject->description }}">
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Select Teacher</label>
                    <select class="form-control" id="teacher_id" name="teacher_id">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $teacher->id == $subject->teacher_id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
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
                subject: "required",
                description:'required',
                teacher_id:'required',
            }
        });

    });
</script>
@endsection
