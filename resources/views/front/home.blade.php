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
                        <span>Sản phẩm bán chạy</span>
                        <div class="pull-right xem-them"><a href="#" title="">Xem thêm</a></div>
                    </h4>
                    <div class="block">
                        <div class = "owl-carousel-pro">
                            @foreach($homeProductSelling as $product)
                                <!-- item -->
                                <div class = "item">
                                    <div class="box-item">
                                        <a href="{{ route('getProduct', [str_slug($product->name).'-'.$product->id]) }}" title="">
                                            <img src="{{ imageThumb($product->images) }}">
                                            <p class="name-product">{{ $product->name }}</p>
                                            <p class="price-product">Giá: {{ $product->price ? $product->price : 'Liên hệ' }}</p>
                                        </a>
                                    </div>
                                </div>
                                <!-- end item -->
                            @endforeach
                        </div>
                    </div>
                </div>
                @foreach($homeCategories as $category)
                <!-- box-product -->
                <div class="box-products">
                    <h4>
                        <i class="fa fa-bars"></i>&nbsp;
                        <span>{{ $category->name }}</span>
                        <div class="pull-right xem-them"><a href="{{ url($category->slug) }}.html" title="">Xem thêm</a></div>
                    </h4>
                    <div class="block">
                        <div class = "owl-carousel-pro">
                            @foreach($category->products as $product)
                                <div class = "item">
                                    <div class="box-item">
                                        <a href="{{ route('getProduct', [str_slug($product->name).'-'.$product->id]) }}" title="">
                                            <img src="{{ imageThumb($product->images) }}">
                                            <p class="name-product">{{ $product->name }}</p>
                                            <p class="price-product">Giá: {{ $product->price ? $product->price : 'Liên hệ' }}</p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection