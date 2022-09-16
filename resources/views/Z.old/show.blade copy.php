@extends('layouts.app')

@section('title', 'Favorite show')
    
@section('content')
  <div class="row">
    @foreach ($likes as $like)
      <div class="col-3">
        <div class="card mt-5">
          <div class="card-header">
            <div class="row justify-content-between">
              <div class="col-auto">{{ date('n/j(D)', strtotime($like->day->date)) }}</div>
              <div class="col-auto px-0">
                <form action="{{ route('diary.like.destroy', $like->id) }}" class="d-inline" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm shadow-none">
                  <i class="fa-solid fa-heart text-danger"></i>        
                  </button>
                </form>

              <div class="dropdown d-inline">
                <button class="btn btn-sm" data-bs-toggle="dropdown">
                  <i class="fa-solid fa-ellipsis"></i>  
                </button>  
      
                <div class="dropdown-menu"> 
                  <a href="{{ route('diary.day.edit', $like->day->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
  
                    {{-- <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-day-{{ $day->id }}"> --}}
                      <i class="fa-solid fa-trash-can"></i>Reset                
                    </button>
                  </div>
                </div>   
                {{-- @include('diary.days.modal.status')               --}}
              </div>
            </div>
          </div>
          <div class="card-image" class="w-100">
            @if ($like->day->image)
              <img src="" alt="">
            @else
            <img src="{{ asset('storage/images/no_image.png') }}" alt="No image" class="w-100">
            @endif
          </div>
          <div class="card-body" style="min-height: 150px">
            {{ $like->day->fact }}
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection


<div class="row">
  @foreach ($likes as $like)
    <div class="col-3 mt-4">
      <div class="card" style="height: 400px;">
        <div class="card-header">
          <p class="d-inline">{{ date('m-d(D)', strtotime($like->day->date)) }}</p>

          {{-- <form action="{{ route('like.destroy', $like->id) }}" class="d-inline" method="post"> --}}
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm shadow-none">
            <i class="fa-solid fa-heart text-danger"></i>        
            </button>
          </form>

        <div class="dropdown d-inline">
          <button class="btn btn-sm" data-bs-toggle="dropdown">
            <i class="fa-solid fa-ellipsis"></i>  
          </button>  

          <div class="dropdown-menu"> 
            {{-- <a href="{{ route('day.edit', $like->day->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a> --}}

              <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#">
                <i class="fa-solid fa-trash-can"></i>Reset                
              </button>
            </div>
          </div>   
          {{-- @include('days.modal.status') --}}
        </div>
        <div class="card-image">
          @if ($like->day->image)
            <img src="{{ asset('storage/images/'. $like->day->image) }}" alt="" class="w-100" style="height: 200px; object-fit:cover;">
          @else
          <div class="text-center mt-5" style="height:200px;">

            <i class="fa-solid fa-image" style="font-size: 7.0rem"></i>
          </div>
          @endif
        </div>
        <div class="card-body" style="overflow: scroll;">
          <p>{{ $like->day->fact }}</p>
        </div>
      </div>
    </div>
  @endforeach
</div>

