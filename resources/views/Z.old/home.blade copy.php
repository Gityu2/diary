@extends('layouts.app')

@section('content')

<a href="{{ route('day.create') }}" class="btn btn-primary">Create</a>

<form action="{{ route('day.whole.year.store') }}" method="post">
  @csrf
  <input type="number" name="year" id="">
  <button type="submit" class="btn btn-success">Year create</button>
</form>


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

    <h1>This week</h1>
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
        @foreach ($week_days as $week_day )

        <tr>
          <td>{{ date('m-d(D)', strtotime($week_day->date)) }}</td>
          <td>{{ $week_day->fact }}</td>
          <td>{{ $week_day->discovery }}</td>
          <td>{{ $week_day->lesson }}</td>
          <td>{{ $week_day->next_action }}</td>
          <td><button class="btn btn-warning">Edit</button></td>
        </tr>    
        @endforeach
        
      </tbody>
    </table>
</div>
@endsection
