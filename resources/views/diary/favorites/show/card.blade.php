@extends('layouts.app')

@section('title', 'Favorite show')
    
@section('content')
<div class="px-5 mt-3"   style="">
  <h1 class="h2">Days</h1>
  <a href="{{ route('diary.like.show.list') }}" class="btn btn-primary my-2">List style</a>
  <a href="{{ route('diary.like.show.card') }}" class="btn btn-primary">Card style</a>

  <div class="row">
    @foreach ($likes as $like)
      <div class="col-3">
        <div class="card mb-5">
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
  
                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-day-{{ $like->id }}">
                      <i class="fa-solid fa-trash-can"></i>Reset                
                    </button>
                  </div>
                </div>   
                @include('diary.favorites.modal.status')              
              </div>
            </div>
          </div>
          <div class="card-image" class="w-100">
            @if ($like->day->image)
              <img src="" alt="">
            @else
            <img src="{{ asset('storage/images/no_image.png') }}" alt="No image" class="feature_img">
            @endif
          </div>
          <div class="card-body feature_body">
            {{ $like->day->fact }}
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection

