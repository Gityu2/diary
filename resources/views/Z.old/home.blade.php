@extends('layouts.app')

@section('content')


{{-- <div class="row">
  <div class="col-2 bg-dark bg-opacity-75">
    <div class="list-group  bg-dark bg-opacity-75">
      <a href="{{ route('day.create') }}" class="list-group-item"><i class="fa-solid fa-file-circle-plus"></i> New Entry</a>
      <a href="" class="list-group-item"><i class="fa-solid fa-calendar-days"></i> Reglarly Reveiw</a>
      <a href="" class="list-group-item"><i class="fa-solid fa-calendar-days"></i> Monthly  Reveiw</a>
      <a href="" class="list-group-item"><i class="fa-solid fa-calendar-days"></i> Yearly   Reveiw</a>
      <a href="" class="list-group-item"><i class="fa-solid fa-list"></i> View all</a>
      <a href="" class="list-group-item"><i class="fa-solid fa-heart"></i> Favorite</a>
    </div>
  </div>
  <div class="col-10"> --}}

<div class="container">
    <h1>This month</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Day</th>
          <th>Fact</th>
          <th>Discovery</th>
          <th>Lesson</th>
          <th>Next Action</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $now->format('m') }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><button class="btn btn-warning">Edit</button></td>
        </tr>    
      </tbody>
    </table>

    <table class="table">
      <thead>
        <tr>
          <th>Day</th>
          <th>Fact</th>
          <th>Discovery</th>
          <th>Lesson</th>
          <th>Next Action</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($month_weeks as $week)
        <tr>
          <td>{{ $week->format('W') }} week</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><button class="btn btn-warning">Edit</button></td>
        </tr>    
        @endforeach
      </tbody>
    </table>

    <h1>Days</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Day</th>
          <th>Fact</th>
          <th>Discovery</th>
          <th>Lesson</th>
          <th>Next Action</th>
          <th></th>
        </tr>
      </thead>
      {{-- <tbody>
        @foreach ($month_days as $week_day )

        <tr>
          <td>{{ date('m-d(D)', strtotime($week_day->date)) }}</td>
          <td>{{ $week_day->fact }}</td>
          <td>{{ $week_day->discovery }}</td>
          <td>{{ $week_day->lesson }}</td>
          <td>{{ $week_day->next_action }}</td>
          <td><button class="btn btn-warning">Edit</button></td>
        </tr>    
        @endforeach
        
      </tbody> --}}
    </table>


{{-- </div> --}}

@endsection
