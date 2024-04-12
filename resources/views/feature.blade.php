@extends('layout.main')
@section('title', 'Create User')
@include('layout.nav')
@include('session')
@section('body')
<div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
    
      <nav class="col-md-3 col-lg-2 d-md-block bg-secondary sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <h5 class="nav-link font-weight-bold text-light">LIST OF FEATURES</h5>
                </li>
                @foreach ($features as $feature)      
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">
                            <span class="feather" data-feather="shopping-cart"></span>
                            {{ $feature->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

  
      <!-- Page Content -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Add Features</h1>
        </div>
        <form action="{{ route('store.feature') }}" method='post'>
            @csrf
            <label>Name</label>
            <input type='text' name="name">
            <input type="submit" name="Add" class="btn btn-dark">
        </form>
      </main>
    </div>
  </div>
@endsection
