@extends('backend.layout.layouts')

@section('content')
@can('offer_access')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Upcoming Offer List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Sub Title</th>
                    <th>Percentage </th>
                    <th>Action</th>
                </tr>
                @foreach ($newyear_offers as $newyear_offer)
                <tr>
                    <td><img width="100" src="{{asset('uploads/newyear_offer')}}/{{$newyear_offer->image}}"></td>
                    <td>{{$newyear_offer->title}}</td>
                    <td>{{$newyear_offer->sub_title}}</td>
                    <td>{{$newyear_offer->percentage}}</td>
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
            <h3>Add New Year Offer</h3>
        </div>
        <div class="card-body">
            <form action="{{route('newyear.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">sub title</label>
                    <input type="text" name="sub_title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Offer Percentage</label>
                    <input type="number" name="percentage" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Offer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection
