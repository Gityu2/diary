<div class="modal fade" id="delete-month-{{ $month->id }}" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-danger">
        <div class="modal-header border-danger">
            <h5 class="modal-title">Delete Entry(Month)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Are you sure to delete "{{ date('M', strtotime($month->date)) }}" ?</p>
            <table class="table table-sm align-middle">
            <thead>
                <tr class="table-primary small">
                <th class="col-3">Fact</th>
                <th class="col-3">Discovery</th>
                <th class="col-3">Lesson</th>
                <th class="col-3">Next Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{ $month->fact }}</td>
                <td>{{ $month->discovery }}</td>
                <td>{{ $month->lesson }}</td>
                <td>{{ $month->next_action }}</td>
                </tr>    
            </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('diary.month.delete', $month->id) }}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </div>
        </div>
    </div>
</div>
