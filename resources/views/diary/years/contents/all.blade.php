<h1 class="h2">Year</h1>
<table class="table table-sm align-middle">
    <thead>
        <tr class="table-primary">
        <th class="" style="width: 10%">Year</th>
        <th class="" style="width: 20%">Fact</th>
        <th class="" style="width: 20%">Discovery</th>
        <th class="" style="width: 20%">Lesson</th>
        <th class="" style="width: 20%">Next Action</th>
        <th class="" style="width: 10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($years as $year)
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
                        <a href="{{ route('diary.year.edit', $year->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>

                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-year-{{ $year->id }}">
                            <i class="fa-solid fa-trash-can"></i>Reset                
                        </button>
                    </div>
                    </div> 
                    @include('diary.years.modal.status')                
                </td>
            </tr>           
        @endforeach
    </tbody>
</table>