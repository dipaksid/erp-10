<!-- DELETE confirm Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close pr-4" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this
                @isset($title)
                    "{{ $title }}"
                @else
                    row
                @endisset
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="removeModalBackdrop()">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
            </div>
        </div>
    </div>
</div>
