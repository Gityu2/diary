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
                        <div class="col-6 text-center">
                            @if (request()->is('diary/like/show/*') || request()->is('diary/search/*'))
                                {{ date('n/j', strtotime($day->date)) }}                        
                                <br>
                                <span class="small">({{ date('Y', strtotime($day->date)) }})</span>
                            @else
                                {{ date('n/j', strtotime($day->date)) }}
                            @endif                            
                        </div>

                        <div class="col-6 ps-0">{{ date('D', strtotime($day->date)) }}</div>
                    </div>
                </td>
                <td>{{ $day->fact }}</td>
                <td>{{ $day->discovery }}</td>
                <td>{{ $day->lesson }}</td>
                <td>{{ $day->next_action }}</td>
                <td class="text-center">
                    @include('diary.days.contents.menu') 
                    @include('diary.days.modal.status')
                </td>    
            </tr>    
            @endforeach
            
        </tbody>
    </table>
</div>
