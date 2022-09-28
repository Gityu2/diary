<div class="table-responsive">
    <table class="table table-sm align-middle">
        <thead>
            <tr class="table-primary">
                <th class="table-width-day">Day</th>
                <th class="table-width">Fact</th>
                <th class="table-width">Discovery</th>
                <th class="table-width">Lesson</th>
                <th class="table-width table-wrap">Next Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($month_days as $day )
            <tr>
                <td>
                    <div class="row">
                        <div class="col-6">{{ date('n/j', strtotime($day->date)) }}</div>
                        <div class="col-6 ps-0">{{ date('D', strtotime($day->date)) }}</div>
                    </div>
                </td>
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
</div>
