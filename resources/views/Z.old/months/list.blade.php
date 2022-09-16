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
    @foreach ($month_days as $day )

    <tr>
      <td>{{ date('m-d(D)', strtotime($day->date)) }}</td>
      <td>{{ $day->fact }}</td>
      <td>{{ $day->discovery }}</td>
      <td>{{ $day->lesson }}</td>
      <td>{{ $day->next_action }}</td>
      <td>
        
        {{-- Not liked --}}
        <form action="{{ route('like.store') }}" method="post">
          @csrf
          <i class="fa-solid fa-heart text-danger"></i>        
        </form>
        
        {{-- Liked --}}
        <form action="{{ route('like.destroy', $day->id) }}" method="post">
          @csrf
          @method('DELETE')
          <i class="fa-solid fa-heart text-dark"></i>        
        </form>
        

        <div class="dropdown d-inline">
          <button class="btn btn-sm" data-bs-toggle="dropdown">
            <i class="fa-solid fa-ellipsis"></i>  
          </button>  

          <div class="dropdown-menu"> 
            <a href="{{ route('day.edit', $day->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
            <form action="{{ route('day.replace.null', $day->id) }}" method="post">
              @csrf
              @method('PATCH')
              <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hidden-post-">
                <i class="fa-solid fa-trash-can"></i>Reset                
              </button>
            </form>
          </div>
        </div>   
      </td>    
    </tr>    
    @endforeach
    
  </tbody>
</table>