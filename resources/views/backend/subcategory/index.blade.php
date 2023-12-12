@extends('backend.layout.layouts')
@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Subcategory List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                @foreach ($subcategories as $sl=>$subcategory)
                <tr>
                    <td>{{ $sl+1 }}</td>
                    <td>{{ $subcategory->rel_to_category->category_name }}</td>
                    <td>{{ $subcategory->subcategory_name }}</td>
                    <td>
                        <img width="70" src="{{ asset('uploads/subcategory') }}/{{ $subcategory->subcategory_photo }}" alt="">
                    </td>
                    <td>
                        <a href="{{ route('subcategory.edit', $subcategory->id) }}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-pencil"></i></a>
                        <button data-link="{{ route('subcatgory.delete', $subcategory->id) }}" class="btn btn-danger shadow btn-xs sharp del_btn"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add Sub Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" style="color:#000">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sub Category Name</label>
                    <input type="text" class="form-control" name="subcategory_name">
                    @error('subcategory_name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sub Category Image</label>
                    <input type="file" class="form-control" name="subcategory_photo">
                    @error('subcategory_photo')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Add Sub Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $('.del_btn').click(function(){
        var link = $(this).attr('data-link');

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href=link;
        }
        })
    })
</script>

@if (session('soft_del'))
    <script>
        Swal.fire(
        'Deleted!',
        '{{ session('soft_del') }}',
        'success'
        )
    </script>
@endif
@endsection
