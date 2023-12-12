@extends('backend.layout.layouts')
@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Edit Role for <b>{{ $role->name }}</b></h3>
        </div>
        <div class="card-body">
            <form action="{{ route('update.role') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="role_id" value="{{ $role->id }}">
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        @foreach ($permissions as $permission)
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" {{($role->hasPermissionTo($permission->name))?'checked':''}} name="permission_name[]" class="form-check-input" value="{{ $permission->id }}">{{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="my-2">
                    <button type="submit" class="btn btn-primary">Update Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
