@extends('backend.layouts.master')
@section('title')
    Colors Management - Create
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Colors</h3>
                    <a href="{{ route('color.index') }}" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-list"></i> View Color</a>
                </div>
                <div class="card-body">
                    @include('backend.sessionMsg')
                     <form action="{{ route('color.update', [$color]) }}" method="post">
                         @csrf
                         @method('PUT')
                         <div class="mb-3">
                             <label for="name" class="form-label">Color Name</label>
                             <input type="text" class="form-control" id="name" name="name" value="{{ @$color->name }}">
                         </div>
                         <div class="mb-3">
                             <label for="hex" class="form-label">Color Hex Code</label>
                             <input type="text" class="form-control" id="hex" name="code" value="{{ @$color->code }}">
                         </div>
                         <div class="mb-3">
                             <label for="div" class="form-label">Status </label>
                              <input type="checkbox" name="status" id="" value="true" {{ @$color->status ? 'checked' : '' }}>
                         </div>
                         <button type="submit" class="btn btn-outline-primary btn-sm">Update Color</button>
                     </form>
                </div>
            </div>

        </div>
    </div>
@endsection
