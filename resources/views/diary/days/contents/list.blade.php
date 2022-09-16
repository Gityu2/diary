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
        @foreach ($month_days as $day )
        <tr>
        <td>{{ date('n/j', strtotime($day->date)) }}</td>
        <td>{{ date('D', strtotime($day->date)) }}</td>
        <td>{{ $day->fact }}</td>
        <td>{{ $day->discovery }}</td>
        <td>{{ $day->lesson }}</td>
        <td>{{ $day->next_action }}</td>
        <td>
            @include('diary.days.contents.menu') 
            @include('diary.days.modal.status')
        </td>    
        </tr>    
        @endforeach
        
    </tbody>
</table>
