@extends('layouts.app')

@section('title', 'Admin Dashboard')
    
@section('content')
    <div class="container px-5 mt-3">
        <h1>Dashboard</h1>

        <div class="card-body py-4 display-6 fw-bold"><span class="text-primary">{{ $numbers->last() }}</span> Users</div>
        <div class="mt-5"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script>
        const numbers = @json($numbers);
        const dates   = @json($dates);
    </script>

    <script src="{{ asset('js/chart-area.js') }}"></script>
@endsection


