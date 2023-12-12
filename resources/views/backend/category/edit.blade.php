@extends('backend.layout.layouts')

@section('content')
<div class="col-lg-8 m-auto">
    <div class="card">
        <div class="card-header">
            <h3>Edit Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Category Name</label>
                    <input type="hidden" class="form-control" name="category_id" value="{{ $category_info->id }}">
                    <input type="text" class="form-control" name="category_name" value="{{ $category_info->category_name }}">
                    @error('category_name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Category Image</label>
                    <input type="file" class="form-control" name="category_photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    @error('category_photo')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <img id="blah" width="100" src="{{ asset('uploads/category') }}/{{ $category_info->category_photo }}" alt="">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
