@extends('layout.layoutDashboard')
@section('title', 'Home')

@section('konten')
    <div class="card">
        <div class="card-header">
            user
        </div>
        <div class="card-body">
            @can('role', ['admin'])
                <h1>Admin : {{ auth()->user()->email }}</h1>
            @else
                <h1>user</h1>
            @endcan
        </div>
    </div>
    <script>

    </script>
@endsection
