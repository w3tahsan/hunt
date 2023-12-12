@extends('backend.layout.layouts')

@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Trash Category List</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('checked.delete.permanent') }}" method="POST">
                @csrf
                <table class="table table-stripe">
                    <tr>
                        <th>
                            <label for="all_chk"></label>
                            <input type="checkbox" id="all_chk"> Checked All
                        </th>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Category Photo</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($trash_categories as $sl=>$category)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="chkDel">
                        </td>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <img width="100" src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('category.restore', $category->id) }}" class="btn btn-success shadow btn-xs sharp"><i title="restore" class="fa fa-reply"></i></a>
                            <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="3">No Data Found</td>
                    </tr>
                    @endforelse
                </table>
                @if ($trash_categories->count() != 0)
                    <button name="btn" value="1" type="submit" class="btn btn-danger">Delete Checked</button>
                    <button name="btn" value="2" type="submit" class="btn btn-info">Restore Checked</button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $("#all_chk").on('click', function(){
        this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
    })
</script>
@endsection
