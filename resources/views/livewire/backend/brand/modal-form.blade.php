<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" role="dialog"
    aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrandModalLabel">Add Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="storeBrand">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Brand Name</label>
                        <input type="text" wire:model.defer="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Status</label>
                        <input type="checkbox" wire:model.defer="status" id="status">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>


{{-- update --}}
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editBrandModal" tabindex="-1" role="dialog"
    aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading>
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>

                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Brand Name</label>
                            <input type="text" wire:model.defer="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Status</label>

                            <input type="checkbox" wire:model.defer="status" id="status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        $('#editBrandModal').on('hidden.bs.modal', function() {
            Livewire.dispatch('resetForm');
        });
        $('#addBrandModal').on('hidden.bs.modal', function() {
            Livewire.dispatch('resetForm');
        });
    });
</script>
