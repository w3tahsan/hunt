@extends('backend.layout.layouts')
@section('content')
@can('role_access')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Role List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Role</th>
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach ($role->getPermissionNames() as $permission)
                            <span class="badge badge-primary my-2">{{ $permission }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('edit.role', $role->id) }}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>User List</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($users as $user)
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-between">
                            <h3>
                                {{ $user->name }}
                            </h3>
                            <h4 class="text-center">
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="badge badge-success mb-1">{{ $role }}</span>
                                    <br>
                                    <a href="{{ route('remove.role', $user->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                @empty
                                    Not Assigned
                                @endforelse
                            </h4>
                        </div>
                        <div class="card-body">
                            <p>
                                @foreach ($user->getAllPermissions() as $permission)
                                    <span class="badge badge-info m-1">{{ $permission->name }}</span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add New Permission</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Permission Name</label>
                    <input type="text" name="permission_name" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Permission</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Add New Role</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Role Name</label>
                    <input type="text" name="role_name" class="form-control">
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        @foreach ($permissions as $permission)
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" name="permission_name[]" class="form-check-input" value="{{ $permission->id }}">{{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Assign Role</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('assign.role') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Select User</label>
                    <select name="user_id" class="form-control">
                        <option value="">Selecty User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Select Role</label>
                    <select name="role_id" class="form-control">
                        <option value="">Selecty Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Assign Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection
