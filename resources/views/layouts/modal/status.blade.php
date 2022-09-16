<div class="modal fade" id="delete-account">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title" >Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete your account ?</p>
                <p class="text-danger small">We will permanently delete your account and all associated contents.<br>Please make sure that you want to delete everything on your account before proceeding.We will not be able to recover your contents after you delete your account!</p>

            </div>
            <div class="modal-footer">
                <form action="{{ route('diary.destroy', Auth::user()->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>