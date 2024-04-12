@extends('layout.main')
@section('title', 'Create User')
@include('layout.nav')
@include('session')
@section('body')
<table class="table">
    <thead>
        <tr>
            <th></th>
            @foreach ($features as $feature)
            <th scope="col">{{ $feature->name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <th>{{ $role->name }}</th>
            @foreach($features as $feature)
            <td>
                <form method="post" action="{{ route('store.permission') }}">
                    @csrf
                    <input type="checkbox" value="{{ $role->id }}_{{ $feature->id }}" name='permission[]' id="{{ $role->id }}_{{ $feature->id }}">
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
<input type="submit" class="btn btn-dark">
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $.ajax({
                    url: '/checked/permission',
                    type: 'get',
                   
                    success: function(response) {
                   $.each(response,function(index,permission) {
    
                        $('#' + permission).prop("checked", true);

                    });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
         
        </script>
    
   
@endsection