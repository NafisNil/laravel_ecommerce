@extends('backend.layouts.master')
@section('title')
    Sliders Management - Index
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Sliders</h3>
                    <a href="{{ route('slider.create') }}" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-plus"></i> Create New Slider</a>
                </div>
                <div class="card-body">
                    @include('backend.sessionMsg')
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                    <th>#</th>
                              <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>






                            @foreach ($sliders as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td><img src="{{ !empty($item->image) ? URL::to('storage/' . $item->image) : URL::to('image/no_image.png') }}" alt="{{ $item->title }}" width="100px"></td>
                                    <td>
                                        @if ($item->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>


                                        <a href="{{ route('slider.edit', [$item]) }}" title="Edit"><button
                                                class="btn btn-outline-info btn-sm"><i
                                                    class="fas fa-pen-square"></i></button></a>

                                        <form action="{{ route('slider.destroy', [$item]) }}" method="POST">

                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" title="Delete" onclick="return confirm('Are you sure?')"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                              <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>


                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
