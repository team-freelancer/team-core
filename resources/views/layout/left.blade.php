<div class="col-sm-3 col-md-3 col-lg-3 left">
    <div class="support">
        <h4><i class="fa fa-bars"></i>&nbsp;Hỗ trợ trực tuyến</h4>
        <img src="{{asset('html/images/hotro.jpg')}}" class="img-responsive">
        <p class="hotline"><span style="color: #0000ff;">Hotline:</span> <span style="color: #ff0000; font-family: HelveM">0987 654 321</span></p>
    </div>
    <div class="category">
        <h4 style="margin-bottom: 3px"><i class="fa fa-bars"></i>&nbsp;Các dòng xe</h4>
        <ul>
        @foreach($car_left as $car)
            <li class="dropdown">
                <a href="{{url($car->slug)}}.html">{{$car->name}}</a>
                <div class="m1">
                    <ul class="">
                    @foreach($menu as $item)
                        <li class="li-m1">
                            <a href="{{ route('getByCarGroup', [str_slug($car->name) , str_slug($item->name)]) }}">{{$item->name}}</a>
                            <div class="m2">
                                <ul>
                              @foreach($item->adapters as $rows)
                                    <li class="col-sm-6 col-md-6 col-lg-6"><a href="{{ route('getByCarGroup', [str_slug($car->name) , str_slug($item->name), str_slug($rows->name)]) }}">{{$rows->name}}</a></li>
                              @endforeach
                                </ul>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </li>
       @endforeach
        </ul>
    </div>
    <div class="list-pro-new">
        <h4><i class="fa fa-bars"></i>&nbsp;Sản phẩm mới</h4>
        <!-- item -->
        @foreach($producs_left as $rows)
        <div class="media">
            <a class="pull-left" href="{{ route('getProduct', [str_slug($rows->name).'-'.$rows->id]) }}">
                <img class="media-object" src="{{asset('html/images/b1.jpg')}}" alt="Image">
            </a>
            <div class="media-body">
                <a href="{{ route('getProduct', [str_slug($rows->name).'-'.$rows->id]) }}" title=""><p class="media-heading name-pro">{{$rows->name}}</p></a>
                <p style="color: red;font-weight: bold; font-size: 15px">Giá: Liên hệ</p>
            </div>
        </div>
        @endforeach
        <!-- end item -->
    </div>


    <div class="list-pro-new">
        <h4><i class="fa fa-bars"></i>&nbsp;Bài viết mới nhất</h4>
        <!-- item -->
        @foreach($news_left as $item)
        <div class="media">
            <a class="pull-left" href="{{ route('getNews', [str_slug($item->title).'-'.$item->id]) }}">
                <img class="media-object" src="{{imageThumb($item->image)}}" alt="Image">
            </a>
            <div class="media-body">
                <a href="" title=""><p class="media-heading name-pro">{{$item->title}}</p></a>
                <p style="">{{$item->created_at}}</p>
            </div>
        </div>
        @endforeach
        <!-- end item -->
        
        <!-- end item -->
    </div>
</div>