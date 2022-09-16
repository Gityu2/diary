<div class="modal fade" id="force-delete-account">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title" >Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this account ?</p>
                <p class="text-danger small">You will permanently delete this account and all associated contents.<br>Please make sure that you want to delete everything on this account before proceeding.You will not be able to recover this user contents after you delete this account!</p>

            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.destroy.force', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>