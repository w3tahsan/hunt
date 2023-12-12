@extends('backend.layout.layouts')

@section('content')
@can('logo_access')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h3>Update Main Logo</h3>
        </div>
        <div class="card-body">
            <form action="{{route('mainlogo.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Upload Logo</label>
                    <input type="file" class="form-control" name="logo" onchange="document.getElementById('tahsan').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="my-3">
                    <img width="100" src="{{asset('uploads/logo')}}/{{$main_logo->first()->logo}}" id="tahsan">
                </div>
                <input type="hidden" name="logo_id" value="{{$main_logo->first()->id}}">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update logo</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h3>Update Footer Logo</h3>
        </div>
        <div class="card-body">
            <form action="{{route('footerlogo.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Upload Footer Logo</label>
                    <input type="file" class="form-control" name="logo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="my-3">
                    <img width="100" src="{{asset('uploads/logo')}}/{{$footer_logo->first()->logo}}" id="blah">
                </div>
                <input type="hidden" name="logo_id" value="{{$footer_logo->first()->id}}">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update logo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection
