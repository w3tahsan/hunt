@extends('backend.layout.layouts')

@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Upcoming Offer List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Discount %</th>
                    <th>After Discount</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                @foreach ($upcoming_offers as $upcoming_offer)
                <tr>
                    <td><img width="100" src="{{asset('uploads/upcoming_offer')}}/{{$upcoming_offer->image}}"></td>
                    <td>{{$upcoming_offer->product_name}}</td>
                    <td>{{$upcoming_offer->price}}</td>
                    <td>{{$upcoming_offer->discount}}</td>
                    <td>{{$upcoming_offer->after_discount}}</td>
                    <td>{{$upcoming_offer->date}}</td>
                    <td>
                        <a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add New Upcoming Offer</h3>
        </div>
        <div class="card-body">
            <form action="{{route('upcoming.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Discount</label>
                    <input type="number" name="discount" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Upcoming Date</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Offer image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Offer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection