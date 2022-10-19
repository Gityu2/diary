<h1 class="h2">Year</h1>
<div class="table-responsive">
    <table class="table table-sm align-middle">
        <thead>
            <tr class="table-primary">
                <th class="table-width-day">Year</th>
                <th class="table-width">Fact</th>
                <th class="table-width">Discovery</th>
                <th class="table-width">Lesson</th>
                <th class="table-width">Next Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">{{ date('Y', strtotime($year->date)) }}</td>
                <td>{{ $year->fact }}</td>
                <td>{{ $year->discovery }}</td>
                <td>{{ $year->lesson }}</td>
                <td>{{ $year->next_action }}</td>
                <td class="text-center">                
                    <div class="dropstart d-inline">
                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>  
                    </button>  

                    <div class="dropdown-menu"> 
                        <a href="{{ route('diary.year.edit', $year->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>

                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-year">
                            <i class="fa-solid fa-trash-can"></i>Reset                
                        </button>
                    </div>
                    </div> 
                    @include('diary.years.modal.status')                
                </td>
            </tr>    
        </tbody>
    </table>
</div>