@extends('backend.layout.layouts')
@section('content')
<div class="col-lg-8 m-auto">
    <div class="card">
        <div class="card-header">
            <h3>Edit Sub Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('subcategory.update', $subcategory_info->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <select name="category_id" class="form-control" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $subcategory_info->category_id  == $category->id?'selected':''}}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sub Category Name</label>
                    <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategory_info->subcategory_name}}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sub Category Image</label>
                    <input type="file" class="form-control" name="subcategory_photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="mb-3">
                    <img width="150" id="blah" src="{{ asset('uploads/subcategory') }}/{{ $subcategory_info->subcategory_photo }}" alt="">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Update Sub Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
@if (session('update'))
<script>
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: '{{ session('update') }}',
    showConfirmButton: false,
    timer: 1500
    })
</script>
@endif
@endsection
