@extends('layouts.app')

@section('content')


<div class="px-5">
    <h1>Year</h1>
    <table class="table">
      <thead>
        <tr>
          <th class="" style="width: 10%">Year</th>
          <th class="" style="width: 20%">Fact</th>
          <th class="" style="width: 20%">Discovery</th>
          <th class="" style="width: 20%">Lesson</th>
          <th class="" style="width: 20%">Next Action</th>
          <th class="" style="width: 10%"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ date('Y', strtotime($year->date)) }}</td>
          <td>{{ $year->fact }}</td>
          <td>{{ $year->discovery }}</td>
          <td>{{ $year->lesson }}</td>
          <td>{{ $year->next_action }}</td>
          <td>                
            <div class="dropdown d-inline">
              <button class="btn btn-sm" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>  
              </button>  
              <div class="dropdown-menu"> 
                <a href="" class="dropdown-item text-decoration-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>

                  <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-year-{{ $year->id }}">
                    <i class="fa-solid fa-trash-can"></i>Reset                
                  </button>
              </div>
            </div> 
            {{-- @include('years.modal.status')                 --}}
          </td>
        </tr>    
      </tbody>
    </table>

    <h1 class="mt-5">Months</h1>
    <table class="table">
      <thead>
        <tr>
          <th class="" style="width: 10%">Months</th>
          <th class="" style="width: 20%">Fact</th>
          <th class="" style="width: 20%">Discovery</th>
          <th class="" style="width: 20%">Lesson</th>
          <th class="" style="width: 20%">Next Action</th>
          <th class="" style="width: 10%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($year_months as $month)
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
                <a href="{{ route('diary.month.edit', $month->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                  <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-month-{{ $month->id }}">
                    <i class="fa-solid fa-trash-can"></i>Reset                
              </div>
            </div>  
            {{-- @include('months.modal.status')   --}}
          </td>
        </tr>    
        @endforeach
      </tbody>
    </table>

    <h1 class="mt-5">Weeks</h1>
    {{-- <a href="{{ route('month.index') }}" class="btn btn-primary">List style</a>
    <a href="{{ route('month.index.card') }}" class="btn btn-primary">Card style</a> --}}

    <table class="table">
      <thead>
        <tr>
          <th class="" style="width: 10%">Weeks</th>
          <th class="" style="width: 20%">Fact</th>
          <th class="" style="width: 20%">Discovery</th>
          <th class="" style="width: 20%">Lesson</th>
          <th class="" style="width: 20%">Next Action</th>
          <th class="" style="width: 10%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($year_weeks as $week )
    
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
                <a href="{{ route('diary.week.edit', $week->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
 
                  <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-week-{{ $week->id }}">
                    <i class="fa-solid fa-trash-can"></i>Reset                
                  </button>
                </div>
              </div>   
              {{-- @include('weeks.modal.status') --}}
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
