@if ($day->like)
<form action="{{ route('diary.like.destroy', $day->like->id) }}" class="d-inline" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm shadow-none  ">
    <i class="fa-solid fa-heart text-danger"></i>        
    </button>
</form>
@else
<form action="{{ route('diary.like.store', $day->id) }}"class="d-inline" method="post">
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
    <a href="{{ route('diary.day.edit', $day->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>

    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-day-{{ $day->id }}">
        <i class="fa-solid fa-trash-can"></i>Reset                
    </button>
    </div>
</div>   