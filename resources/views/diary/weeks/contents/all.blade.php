<h1 class="mt-5 h2">Weeks</h1>
<div class="table-responsive">
    <table class="table table-sm align-middle">
        <thead>
            <tr class="table-primary">
            <th class="table-width-day">Week</th>
            <th class="table-width">Fact</th>
            <th class="table-width">Discovery</th>
            <th class="table-width">Lesson</th>
            <th class="table-width">Next Action</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($year_weeks as $week )
            <tr>
                <td>{{ $week->week }} week <br><span class="small">({{ date('n/j',strtotime('last monday', strtotime($week->date))) }}- {{ date('n/j',strtotime('sunday', strtotime($week->date))) }})</span></td>
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
                    @include('diary.weeks.modal.status')
                </td>    
            </tr>    
            @endforeach
        </tbody>
    </table>
</div>