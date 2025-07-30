@extends('backend.layouts.master')
@section('title')
    Category Management - Edit
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Category - {{ $category->name }}</h3>
                    <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-list"></i></a>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', [$category]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $category->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $category->description }}</textarea>
                        </div>
                        <div class="form-group row">
                            <label for="Image" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">

                                <img id="showImage"
                                    src="{{ !empty($category->image) ? URL::to('storage/' . $category->image) : URL::to('image/no_image.png') }}"
                                    style="widows: inherit; width:100px; height:100px; border:1px solid #042b3d"
                                    alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="image">Status</label>
                            <input type="checkbox" name="status" id="" value="true"
                                {{ $category->is_active ? 'checked' : '' }}>
                        </div>
                        <div class="form-group">
                            <label for="name">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="name" class="form-control"
                                value="{{ $category->meta_keywords }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Meta Title</label>
                            <input type="text" name="meta_title" id="name" class="form-control"
                                value="{{ $category->meta_title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Meta Description</label>
                            <textarea name="meta_description" id="description" class="form-control" rows="4" required>{{ $category->meta_description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Update
                            Category</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
