@extends('backend.layout.layouts')
@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Charge List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                @foreach ($charges as $charge)
                <tr>
                    <td>{{ $charge->type == 1?'Inside City':'Outside city' }}</td>
                    <td>{{ $charge->amount }}</td>
                    <td><a href="" class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add Delivery charge</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('delivery.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <select name="type" class="form-control">
                        <option value="">Select Type</option>
                        <option value="1">Inside City</option>
                        <option value="2">Outside City</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Amount</label>
                    <input type="text" name="amount" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Charge</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
