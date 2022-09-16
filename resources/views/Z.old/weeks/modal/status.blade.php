<!-- Modal -->
<div class="modal fade" id="delete-week-{{ $week->id }}" >
  <div class="modal-dialog" role="document">
    <div class="modal-content border-danger">
      <div class="modal-header border-danger">
        <h5 class="modal-title">Delete Entry(Week)</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure to delete {{ $week->week }}week ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ route('week.replace.null', $week->id) }}" method="post">
          @csrf
          @method('PATCH')
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
      </div>
    </div>
  </div>
</div>
