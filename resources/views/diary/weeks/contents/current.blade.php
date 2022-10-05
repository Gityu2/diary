<h1 class="mt-5 h3">Weeks</h1>
<div class="table-responsive">
<table class="table table-sm align-middle">
    <thead>
        <tr class="table-primary">
            <th class="table-width-day">Week</th>
            <th class="table-width">Fact</th>
            <th class="table-width">Discovery</th>
            <th class="table-width">Lesson</th>
            <th class="table-width table-wrap" >Next Action</th>
            <th class="px-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($month_weeks as $week)
        <tr>
            <td class="table-wrap">{{ $week->week }} week <br><span class="table-wrap">({{ date('n/j',strtotime('last monday', strtotime($week->date))) }}- {{ date('n/j',strtotime('sunday', strtotime($week->date))) }})</span></td>
            <td><p>{{ $week->fact }} </p></td>
            <td>{{ $week->discovery }}</td>
            <td>{{ $week->lesson }}</td>
            <td>{{ $week->next_action }}</td>
        <td class="text-center">            
            <div class="dropstart d-inline">
                <button class="btn btn-sm" data-bs-toggle="dropdown" >
                    <i class="fa-solid fa-ellipsis"></i>  
                </button>  

                <div class="dropdown-menu"> 
                    <a href="{{ route('diary.week.edit', $week->id) }}" class="dropdown-item text-decorateion-none text-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-week">
                        <i class="fa-solid fa-trash-can"></i>Reset                
                </div>
            </div>  
            @include('diary.weeks.modal.status')  
        </td>
        </tr>    
        @endforeach
    </tbody>
</table>
</div>

