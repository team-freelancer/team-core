@extends('layout.index')
@section('content')
    <div class="content">
    <div class="container">
        <div class="row">
            @include('layout.left')
            <div class="col-sm-9 col-md-9 col-lg-9">

                <div class="box-detail-news">
                    <h1>{{$tintuc->title}}</h1>
                    {!!$tintuc->content!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
