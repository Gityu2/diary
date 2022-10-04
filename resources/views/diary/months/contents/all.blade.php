<h1 class="mt-5 h2">Months</h1>
<div class="table-responsive">
    <table class="table table-sm align-middle">
        <thead>
            <tr class="table-primary">
                <th class="table-width-day">Month</th>
                <th class="table-width">Fact</th>
                <th class="table-width">Discovery</th>
                <th class="table-width">Lesson</th>
                <th class="table-width">Next Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($year_months as $month)
            <tr>
                <td>{{ date('M', strtotime($month->date)) }}</td>
                <td>{{ $month->fact }} </td>
                <td>{{ $month->discovery }}</td>
                <td>{{ $month->lesson }}</td>
                <td>{{ $month->next_action }}</td>
                <td>            
                    <div class="dropstart d-inline">
                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>  
                    </button>  

                    <div class="dropdown-menu"> 
                        <a href="{{ route('diary.month.edit', $month->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-month-{{ $month->id }}">
                            <i class="fa-solid fa-trash-can"></i>Reset                
                    </div>
                    </div>  
                    @include('diary.months.modal.status')  
                </td>
            </tr>    
            @endforeach
        </tbody>
    </table>
</div>