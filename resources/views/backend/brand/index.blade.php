@extends('backend.layout.layouts')
@section('content')
@can('brand_access')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Brand List</h3>
        </div>
        <div class="card-body">
            <table class="table table-stripe">
                <tr>
                    <th>SL</th>
                    <th>Brand Name</th>
                    <th>Brand Photo</th>
                    <th>Action</th>
                </tr>
                @foreach ($brands as $sl=>$brand)
                <tr>
                    <td>{{ $sl+1 }}</td>
                    <td>{{ $brand->brand_name }}</td>
                    <td>
                        <img width="70" src="{{ asset('uploads/brand') }}/{{ $brand->brand_photo }}" alt="">
                    </td>
                    <td>

                        <a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
            <h3>Add Brand</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" name="brand_name">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Brand Image</label>
                    <input type="file" class="form-control" name="brand_photo">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Add Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<h4>You dont have permission to access this page</h4>
@endcan
@endsection
