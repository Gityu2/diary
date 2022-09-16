<h1 class="mt-5 h2">Months</h1>
<table class="table">
    <thead>
        <tr class="table-primary" style="border-bottom: hidden;">
            <th style="width: 10%">Month</th>
            <th style="width: 20%">Fact</th>
            <th style="width: 20%">Discovery</th>
            <th style="width: 20%">Lesson</th>
            <th style="width: 20%">Next Action</th>
            <th style="width: 10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($year_months as $month)
        <tr class="">
            <td>{{ date('M', strtotime($month->date)) }}</td>
            <td>{{ $month->fact }} </td>
            <td>{{ $month->discovery }}</td>
            <td>{{ $month->lesson }}</td>
            <td>{{ $month->next_action }}</td>
            <td>            
                <div class="dropdown d-inline">
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