@extends('layouts.app')

@section('content')


<div class="px-5">
    <h1>Month</h1>
    <table class="table">
      <thead>
        <tr class="">
          <th class="" style="width: 10%">Month</th>
          <th class="" style="width: 20%">Fact</th>
          <th class="" style="width: 20%">Discovery</th>
          <th class="" style="width: 20%">Lesson</th>
          <th class="" style="width: 20%">Next Action</th>
          <th class="" style="width: 10%"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ date('m', strtotime($month->date)) }}</td>
          <td>{{ $month->fact }}</td>
          <td>{{ $month->discovery }}</td>
          <td>{{ $month->lesson }}</td>
          <td>{{ $month->next_action }}</td>
          <td>                
            <div class="dropdown d-inline">
              <button class="btn btn-sm" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>  
              </button>  

              <div class="dropdown-menu"> 
                <a href="{{ route('month.edit', $month->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>

                  <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-month-{{ $month->id }}">
                    <i class="fa-solid fa-trash-can"></i>Reset                
                  </button>
              </div>
            </div> 
            @include('months.modal.status')                
          </td>
        </tr>    
      </tbody>
    </table>

    <h1 class="mt-5">Weeks</h1>
    <table class="table">
      <thead>
        <tr>
          <th class="" style="width: 10%">Week</th>
          <th class="" style="width: 20%">Fact</th>
          <th class="" style="width: 20%">Discovery</th>
          <th class="" style="width: 20%">Lesson</th>
          <th class="" style="width: 20%">Next Action</th>
          <th class="" style="width: 10%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($month_weeks as $week)
        <tr>
          <td>{{ $week->week }} week</td>
          <td>{{ $week->fact }}</td>
          <td>{{ $week->discovery }}</td>
          <td>{{ $week->lesson }}</td>
          <td>{{ $week->next_action }}</td>
          <td>            
            <div class="dropdown d-inline">
              <button class="btn btn-sm" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>  
              </button>  

              <div class="dropdown-menu"> 
                <a href="{{ route('week.edit', $week->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                  <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-week-{{ $week->id }}">
                    <i class="fa-solid fa-trash-can"></i>Reset                
              </div>
            </div>  
            @include('weeks.modal.status')  
          </td>
        </tr>    
        @endforeach
      </tbody>
    </table>

    <h1 class="mt-5">Days</h1>
    <a href="{{ route('month.index') }}" class="btn btn-primary">List style</a>
    <a href="{{ route('month.index.card') }}" class="btn btn-primary">Card style</a>

    <table class="table">
      <thead>
        <tr>
          <th class="" style="width: 10%">Day</th>
          <th class="" style="width: 20%">Fact</th>
          <th class="" style="width: 20%">Discovery</th>
          <th class="" style="width: 20%">Lesson</th>
          <th class="" style="width: 20%">Next Action</th>
          <th class="" style="width: 10%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($month_days as $day )
    
        <tr>
          <td>{{ date('m-d(D)', strtotime($day->date)) }}</td>
          <td>{{ $day->fact }}</td>
          <td>{{ $day->discovery }}</td>
          <td>{{ $day->lesson }}</td>
          <td>{{ $day->next_action }}</td>
          <td>
            
            @if ($day->like)
              <form action="{{ route('like.destroy', $day->like->id) }}" class="d-inline" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm shadow-none  ">
                <i class="fa-solid fa-heart text-danger"></i>        
                </button>
              </form>
            @else
              <form action="{{ route('like.store', $day->id) }}"class="d-inline" method="post">
                @csrf
                <button type="submit" class="btn btn-sm shadow-none">
                <i class="fa-regular fa-heart text-dark"></i>        
                </button>
              </form>
                
            @endif
            
            
    
            <div class="dropdown d-inline">
              <button class="btn btn-sm" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>  
              </button>  
    
              <div class="dropdown-menu"> 
                <a href="{{ route('day.edit', $day->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
 
                  <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-day-{{ $day->id }}">
                    <i class="fa-solid fa-trash-can"></i>Reset                
                  </button>
                </div>
              </div>   
              @include('days.modal.status')
          </td>    
        </tr>    
        @endforeach
        
      </tbody>
    </table>
</div>
</div>
{{-- </div> --}}



<!-- Button trigger modal -->




@endsection
