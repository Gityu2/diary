@extends('layouts.app')

@section('title', 'View all')
    
@section('content')

<form action="" method="get" class="input-group w-25 ms-auto me-5">
  <input type="text" name="keyword" value="{{ $keyword }}" class="form-control">
  {{-- <input type="text" name="key" value="{{ $key }}"> --}}
  <button type="submit" class="btn btn-light btn-outline-secondary" value="search">Search</button>
</form>


<form action="" method="get" class="input-group w-50 mx-auto mt-5">
<select name="period" id="" class="form-control">
  <option value="">Select Review Period</option>
  <option value="month">Month</option>
  <option value="year">Year</option>
</select>

<select name="year_info" id="" class="form-control">
  <option value="">Select Year</option>
  <option value="2022">2022</option>
</select>

  <select name="month_info" id="" class="form-control">
    <option value="">Select Month</option>
    <option value="1">Jan</option>
    <option value="2">Feb</option>
    <option value="3">Mar</option>
    <option value="4">Apr</option>
    <option value="5">May</option>
    <option value="6">Jun</option>
    <option value="7">Jul</option>
    <option value="8">Aug</option>
    <option value="9">Sep</option>
    <option value="10">Oct</option>
    <option value="11">Nov</option>
    <option value="12">Dec</option>
  </select>
  <button type="submit" class="btn btn-secondary">Show</button> 

</form>

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
        <td>{{ date('m', strtotime($year_months->date)) }}</td>
        <td>{{ $year_months->fact }}</td>
        <td>{{ $year_months->discovery }}</td>
        <td>{{ $year_months->lesson }}</td>
        <td>{{ $year_months->next_action }}</td>
        <td>                
          <div class="dropdown d-inline">
            <button class="btn btn-sm" data-bs-toggle="dropdown">
              <i class="fa-solid fa-ellipsis"></i>  
            </button>  

            <div class="dropdown-menu"> 
              <a href="{{ route('month.edit', $year_months->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>

                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-month-{{ $year_months->id }}">
                  <i class="fa-solid fa-trash-can"></i>Reset                
                </button>
            </div>
          </div> 
          {{-- @include('months.modal.status')                 --}}
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
      @foreach ($year_weeks as $week)
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
          {{-- @include('weeks.modal.status')   --}}
        </td>
      </tr>    
      @endforeach
    </tbody>
  </table>
    
      <h1 class="mt-5">Days</h1>
      <form action="{{ route('view.all.index') }}" method="get" class="d-inline">
        <input type="hidden" name="year_info" value="{{ request()->query('year_info') }}
        ">
        <input type="hidden" name="month_info" value="{{ request()->query('month_info') }}
        ">
        <input type="hidden" name="period" value="{{ request()->query('period') }}
        ">
        <button type="submit" class="btn btn-primary">List style</button>
      </form>
      <form action="{{ route('day.show.card') }}" method="get" class="d-inline">
        <input type="hidden" name="year_info" value="{{ request()->query('year_info') }}
        ">
        <input type="hidden" name="month_info" value="{{ request()->query('month_info') }}
        ">
        <input type="hidden" name="period" value="{{ request()->query('period') }}
        ">
        <button type="submit" class="btn btn-primary">Card style</button>
      </form>
    
      <div class="row">
        @foreach ($month_days as $day)
          <div class="col-3 mt-4">
            <div class="card" style="height: 300px;">
              <div class="card-header">
                <p class="d-inline">{{ date('m-d(D)', strtotime($day->date)) }}</p>
    
                @if ($day->like)
                <form action="{{ route('like.destroy', $day->like->id) }}" class="d-inline" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm shadow-none">
                  <i class="fa-solid fa-heart text-danger"></i>        
                  </button>
                </form>
              @else
                <form action="{{ route('like.store', $day->id) }}" class="d-inline" method="post">
                  @csrf
                  <button type="submit" class="btn btn-sm shadow-none d-inline">
    
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
              </div>
              <div class="card-image">
                @if ($day->image)
                  <img src="{{ asset('storage/images/'. $day->image) }}" alt="" class="w-100" style="height: 200px; object-fit:cover;">
                @else
                <div class="text-center mt-5" style="height:200px;">
    
                  <i class="fa-solid fa-image" style="font-size: 7.0rem"></i>
                </div>
                @endif
              </div>
              <div class="card-body">
    
                {{ $day->fact }}
              </div>
            </div>
          </div>
        @endforeach
      </div>
    
    </div>
    </div>
  
  


@endsection