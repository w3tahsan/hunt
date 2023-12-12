@extends('backend.layout.layouts');

@section('content')
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Update Information</h3>
            </div>
            <div class="card-body">
                @if (session('wrong_old'))
                    <div class="alert alert-danger">{{ session('wrong_old') }}</div>
                @endif
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="old_password" class="form-control" placeholder="Current password">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Profile Photo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="file" name="photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('photo')
                            <strong class="text-danger"> {{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="my-3">
                        <img id="blah"  width="200"  src="{{ asset('uploads/profile_photo') }}/{{ Auth::user()->profile_photo }}" alt="">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
