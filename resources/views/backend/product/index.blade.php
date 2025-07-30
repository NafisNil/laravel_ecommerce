@extends('backend.layouts.master')
@section('title')
    Product Management - Index
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Products</h3>
                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-plus"></i> Create New Product</a>
                </div>
                <div class="card-body">
                    @include('backend.sessionMsg')
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Photo</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>






                            @foreach ($products as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>{{ $item->quantity }}</td>

                                    <td>
                                        @if ($item->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ !empty($item->productImages[0]->image) ? URL::to('storage/' . $item->productImages[0]->image) : URL::to('image/no_image.png') }}"
                                            alt="" style="max-height:64px">
                                    </td>




                                    <td>


                                        <a href="{{ route('product.edit', [$item]) }}" title="Edit"><button
                                                class="btn btn-outline-info btn-sm"><i
                                                    class="fas fa-pen-square"></i></button></a>

                                        <form action="{{ route('product.destroy', [$item]) }}" method="POST">

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
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
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
@endsection
