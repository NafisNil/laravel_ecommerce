@extends('backend.layouts.master')
@section('title')
    Sliders Management - Create
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Sliders</h3>
                    <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-list"></i> View Sliders</a>
                </div>
                <div class="card-body">
                    @include('backend.sessionMsg')
                    <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Slider Title</label>
                            <input type="text" class="form-control" id="name" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Slider Description</label>
                            <textarea name="description" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group row">
                            <label for="Image" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">

                                <img id="showImage"
                                    src="{{ !empty($category->photo) ? URL::to('storage/' . $category->photo) : URL::to('image/no_image.png') }}"
                                    style="widows: inherit; width:100px; height:100px; border:1px solid #042b3d"
                                    alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="div" class="form-label">Status </label>
                            <input type="checkbox" name="status" id="" value="true" checked>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-sm"> <i class="fas fa-check"></i> Create Slider</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
