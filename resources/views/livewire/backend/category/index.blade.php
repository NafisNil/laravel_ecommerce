<div>
    {{-- The whole world belongs to you. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category List</h3>
                    <a href="{{ route('category.create') }}" class="btn btn-success btn-sm float-right"><i
                            class="fas fa-plus"></i></a>
                </div>
                <div class="card-body">
                    @include('backend.sessionMsg')
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Photo</th>

                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>






                            @foreach ($categories as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td> <img
                                            src="{{ !empty($item->image) ? URL::to('storage/' . $item->image) : URL::to('image/no_image.png') }}"
                                            alt="" style="max-height:64px"></td>

                                    <td>


                                        <a href="{{ route('category.edit', [$item]) }}" title="Edit"><button
                                                class="btn btn-outline-info btn-sm"><i
                                                    class="fas fa-pen-square"></i></button></a>

                                        <a href="#" wire:click="confirmDelete({{ $item->id }})"
                                            title="Delete" data-toggle="modal" data-target="#exampleModal"><button
                                                class="btn btn-outline-danger btn-sm"><i
                                                    class="fas fa-trash"></i></button></a>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Photo</th>

                                <th>Action</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="deleteCategory">
                <div class="modal-body">
                    <h6>Are you sure you want to delete this category?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes !</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@push('script')
    <script>
        window.addEventListener('closeModal', event => {
            $('#exampleModal').modal('hide');
        });
    </script>
@endpush

