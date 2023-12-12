@extends('backend.layout.layouts')
@section('content')
<div class="col-lg-8"></div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add New Tag</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('tag.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Tag Name</label>
                    <input type="text" name="tag_name" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
