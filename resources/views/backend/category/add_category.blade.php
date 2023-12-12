@extends('backend.layout.layouts')

@section('content')
@can('category_access')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Category List</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('checked.delete') }}" method="POST">
                @csrf
            <table class="table table-stripe">
                <tr>
                    <th><input type="checkbox" id="all_chk"><label for="all_chk">&nbsp; Check all</label> </th>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Category Photo</th>
                    <th>Action</th>
                </tr>
                @foreach ($categories as $sl=>$category)
                <tr>
                    <td><input type="checkbox" class="chkDel" name="category_id[]" value="{{ $category->id }}"></td>
                    <td>{{ $sl+1 }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>
                        <img width="70" src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt="">
                    </td>
                    <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-pencil"></i></a>
                        @can('category_delete')
                        <a href="{{ route('category.soft.delete', $category->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>
            <div>
                <button class="btn btn-danger">Delete Checked</button>
            </div>
            </form>
        </div>
    </div>
</div>
@can('category_add')
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="category_name">
                    @error('category_name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Category Iamge</label>
                    <input type="file" class="form-control" name="category_photo">
                    @error('category_photo')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endcan
@endsection


@section('footer_script')
<script>
    $("#all_chk").on('click', function(){
        this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
    })
</script>
@endsection
