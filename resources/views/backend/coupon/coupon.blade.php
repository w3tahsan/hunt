@extends('backend.layout.layouts')

@section('content')
@can('coupon_access')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Coupon List</h3>
        </div>
        <div class="card-body">
            <table class="table table-border">
                <tr>
                    <th>Coupon</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Validity</th>
                    <th>Action</th>
                </tr>
                @foreach ($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->coupon_name }}</td>
                    <td>{{ $coupon->type==1?'Percentage':'Solid' }}</td>
                    <td>{{ $coupon->amount}}</td>
                    <td>
                        @if (Carbon\Carbon::now() > $coupon->validity)
                            <span class="badge badge-warning">Expired {{ Carbon\Carbon::now()->diffInDays($coupon->validity)}} Days Ago</span>
                            @else
                            <span class="badge badge-success">{{ Carbon\Carbon::now()->diffInDays($coupon->validity)}} Days Remaining</span>
                        @endif
                    </td>
                    <td>
                        @can('coupon_delete')
                        <a href="" class="btn btn-danger">Delete</a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@can('coupon_add')
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add New Coupon</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('coupon.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Coupon Name</label>
                    <input type="text" class="form-control" name="coupon_name">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Coupon Type</label>
                    <select name="type" class="form-control">
                        <option value="1">Percentage</option>
                        <option value="2">Solid</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Amount</label>
                    <input type="text" name="amount" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Validity</label>
                    <input type="date" name="validity" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Coupon</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endcan
@endsection
