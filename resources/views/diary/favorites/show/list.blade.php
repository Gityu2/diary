@extends('layouts.app')

@section('content')
    @if ($likes->isNotEmpty())
        <div class="px-5 mt-3"   style="">
            <h1 class="h2">Days</h1>
            <a href="{{ route('diary.like.show.list') }}" class="btn btn-primary my-2">List style</a>
            <a href="{{ route('diary.like.show.card') }}" class="btn btn-primary">Card style</a>

        <table class="table table-sm align-middle">
        <thead>
            <tr class="table-primary" style="border-bottom: hidden;">
            <th style="width: 2%">Day</th>
            <th style="width: 8%"></th>
            <th style="width: 20%">Fact</th>
            <th style="width: 20%">Discovery</th>
            <th style="width: 20%">Lesson</th>
            <th style="width: 20%">Next Action</th>
            <th style="width: 10%"></th>
            </tr>
        </thead>
        <tbody class="">
            @foreach ($likes as $like )
            <tr>
            <td>{{ date('n/j', strtotime($like->day->date)) }}</td>
            <td>{{ date('D', strtotime($like->day->date)) }}</td>
            <td>{{ $like->day->fact }}</td>
            <td>{{ $like->day->discovery }}</td>
            <td>{{ $like->day->lesson }}</td>
            <td>{{ $like->day->next_action }}</td>
            <td>
                
                @if ($like)
                <form action="{{ route('diary.like.destroy', $like->id) }}" class="d-inline" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm shadow-none  ">
                <i class="fa-solid fa-heart text-danger"></i>        
                </button>
                </form>
            @else
                <form action="{{ route('diary.like.store', $like->id) }}"class="d-inline" method="post">
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
                    <a href="{{ route('diary.day.edit', $like->day->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>

                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-day-{{ $like->id }}">
                        <i class="fa-solid fa-trash-can"></i>Reset                
                    </button>
                    </div>
                </div>   
                @include('diary.favorites.modal.status')
            </td>    
            </tr>    
            @endforeach
            
        </tbody>
        </table>
        </div>
    @else
        <div class="text-center mt-5">
            <h1 class="h2">We're sorry, your diary doesn't have any favorites.</h1>
            <p class="fs-4">Please add your favorite.</p>
        </div>
    @endif

@endsection

