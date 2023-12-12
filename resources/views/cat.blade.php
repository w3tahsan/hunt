@extends('backend.layout.layouts')

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3>Categories</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Category</th>
                </tr>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td><img width="100" src="{{ env('IMAGE_LINK') }}{{ $category->category_thumbnail }}" alt=""></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
