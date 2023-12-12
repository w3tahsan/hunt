@extends('backend.layout.layouts')

@section('content')
@can('user')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Profile Datatable</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="display min-w850">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $sl=>$user)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>
                                @if (!$user->profile_photo)
                                    <img width="35" src="{{ Avatar::create($user->name)->toBase64() }}" />
                                @else
                                    <img class="rounded-circle" width="35" src="{{ asset('uploads/profile_photo') }}/{{ $user->profile_photo }}" alt="">
                                @endif

                            </td>
                            <td>{{ $user->name }}</td>
                            <td><a href="javascript:void(0);"><strong>{{ $user->email }}</strong></a></td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                @can('user_action')
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                </div>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection
