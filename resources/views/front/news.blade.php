@extends('layout.index')
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            @include('layout.left')
            <div class="col-sm-9 col-md-9 col-lg-9">

                <div class="box-products">
                    <h4>
                        <i class="fa fa-bars"></i>&nbsp;
                        <span>
                            <a href="#" title="" style="color: #fff">Trang chủ</a> / Tin tức
                        </span>
                    </h4>
                    <!-- item list-news -->
                    @foreach($news as $item)
                    <div class="list-news">
                        <div class="col-sm-5 col-md-5 col-lg-5">
                            <a href="{{ route('getNews', [str_slug($item->title).'-'.$item->id]) }}"><img src="{{imageThumb($item->image)}}" class="img-responsive"></a>
                        </div>
                        <div class="col-sm-7 col-md-7 col-lg-7">
                            <a href="{{ route('getNews', [str_slug($item->title).'-'.$item->id]) }}" title=""><p class="name-news">{{$item->title}}</p>
                            </a>
                            <p class="create_time">{{$item->created_at}}</p>
                            <div class="description">
                                {{$item->description}}
                            </div>
                            <div class="chitiet"><a href="{{ route('getNews', [str_slug($item->title).'-'.$item->id]) }}" title="">Đọc tiếp</a></div>
                        </div>
                    </div>
                   @endforeach
                    
                    <!-- item list-news -->
                    <div class="phantrang">
                        {!!$news->links()!!}
                    </div>
                </div>
                <!-- box-product -->
                
            </div>
        </div>
    </div>
</div>
@endsection