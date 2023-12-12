@extends('backend.layout.layouts')

@section('content')
@can('subscribe_access')
<div class="col-lg-8"></div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Update Subsribe Content</h3>
        </div>
        <div class="card-body">
            <form action="{{route('subs.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="hidden" name="id" class="form-control" value="{{$subs_content->first()->id}}">
                    <input type="text" name="title" class="form-control" value="{{$subs_content->first()->title}}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="my-3">
                    <img width="200" src="{{asset('uploads/subs')}}/{{$subs_content->first()->image}}" alt="">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection
