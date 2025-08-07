@extends('backend.layouts.master')
@section('title')
    Product Create - Index
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Products</h3>
                    <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-list"></i> product list</a>
                </div>
                <div class="card-body">
                    @include('backend.sessionMsg')
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">SEO</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                                    type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color"
                                    type="button" role="tab" aria-controls="color" aria-selected="false">Color</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="mb-3 mt-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select form-control" id="category" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>

                                <div class="mb-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <select class="form-select form-control" id="brand" name="brand">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" step="any" class="form-control" id="price"
                                        name="original_price">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Selling Price</label>
                                    <input type="number" step="any" class="form-control" id="price"
                                        name="selling_price">
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="trending" name="trending">
                                    <label for="trending" class="form-label">Trending</label>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="status" name="status">
                                    <label for="status" class="form-label">Status</label>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input type="file" multiple class="form-control" id="image" name="image[]">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
                                <div class="mb-3">
                                    <label for="color" class="form-label">Product Color</label>
                                    <br>
                                        @foreach ($colors as $color)
                                        <div class="px-3">
                                            <input type="checkbox" class="form-check-input" id="color_{{ $color->id }}" name="colors[{{ $color->id }}]"
                                                value="{{ $color->id }}"> <label for="color_{{ $color->id }}" class="form-check-label">{{ $color->name }}</label> <br>
                                                <input type="text" class="form-control mt-2" name="color_quantity[{{ $color->id }}]" placeholder="Enter quantity for {{ $color->name }}">
                                        </div>
                                        @endforeach
                                   
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i>
                                Create Product</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'));
            triggerTabList.forEach(function(triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl);
                triggerEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });
        });
    </script>
@endsection
