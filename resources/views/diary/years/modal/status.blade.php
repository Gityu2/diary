<div class="modal fade" id="delete-year-{{ $year->id }}" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-danger">
        <div class="modal-header border-danger">
            <h5 class="modal-title">Delete Entry(Year)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Are you sure to delete {{ date('Y', strtotime($year->date)) }} ?</p>
            <table class="table table-sm align-middle">
                <thead>
                    <tr class="table-primary small">
                    <th class="" style="width: 25%">Fact</th>
                    <th class="" style="width: 25%">Discovery</th>
                    <th class="" style="width: 25%">Lesson</th>
                    <th class="" style="width: 25%">Next Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>{{ $year->fact }}</td>
                    <td>{{ $year->discovery }}</td>
                    <td>{{ $year->lesson }}</td>
                    <td>{{ $year->next_action }}</td>
                    </tr>    
                </tbody>
                </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('diary.year.delete', $year->id) }}" method="post">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </div>
        </div>
    </div>
</div>
