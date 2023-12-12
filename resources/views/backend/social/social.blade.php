@extends('backend.layout.layouts')
@section('content')
@can('social_access')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h3>Social Icon List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Icon</th>
                    <th>Link</th>
                    <th>Action</th>
                </tr>
                @foreach ($socials as $social)
                <tr>
                    <td><i style="font-family: fontawesome" class="{{$social->icon}}"></i></td>
                    <td><a target="_blank" href="{{$social->link}}">{{$social->link}}</a></td>
                    <td>
                        <a href="" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h3>Add Social Icon</h3>
        </div>
        <div class="card-body">
            @php
                $fonts = array (
                    'fa-facebook',
                    'fa-facebook-f',
                    'fa-facebook-official',
                    'fa-facebook-square',
                    'fa-instagram',
                    'fa-twitter',
                    'fa-twitter-square',
                    'fa-linkedin',
                    'fa-linkedin-square',
                    'fa-pinterest',
                    'fa-pinterest-p',
                    'fa-pinterest-square',
                    'fa-dribbble',
                    'fa-github',
                    'fa-github-alt',
                    'fa-youtube',
                    'fa-youtube-play',
                    'fa-youtube-square',
                    );
            @endphp
            <div class="my-3">
                @foreach ($fonts as $icon)
                    <i data-icon="{{$icon}}" class="abc {{$icon}}" style="font-family: fontawesome; margin-left:5px;font-size:30px"></i>
                @endforeach
            </div>
            <form action="{{route('social.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" id="icon" name="icon" class="form-control" placeholder="Icon Class">
                </div>
                <div class="mb-3">
                    <input type="text" name="link" class="form-control" placeholder="Link">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Social</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection

@section('footer_script')
<script>
    $('.abc').click(function(){
        var icon = $(this).attr('data-icon');
        $('#icon').attr('value', icon);
    })
</script>
@endsection
