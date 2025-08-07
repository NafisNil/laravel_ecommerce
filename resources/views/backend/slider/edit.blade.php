@extends('backend.layouts.master')
@section('title')
    Sliders Management - Edit
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Sliders</h3>
                    <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-list"></i> View Sliders</a>
                </div>
                <div class="card-body">
                    @include('backend.sessionMsg')
                    <form action="{{ route('slider.update', [$slider]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Slider Title</label>
                            <input type="text" class="form-control" id="name" name="title" value="{{ $slider->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Slider Description</label>
                            <textarea name="description" id="" cols="30" rows="4" class="form-control">{{ $slider->description }}</textarea>
                        </div>
                        <div class="form-group row">
                            <label for="Image" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">

                                <img id="showImage"
                                    src="{{ !empty($slider->image) ? URL::to('storage/' . $slider->image) : URL::to('image/no_image.png') }}"
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
                            <input type="checkbox" name="status" id="" value="true" {{ $slider->status ? 'checked' : '' }}>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-sm"> <i class="fas fa-check"></i> Update Slider</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
