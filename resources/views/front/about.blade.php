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
                            <span>Giới thiệu</span>
                            <!--<div class="pull-right xem-them"><a href="#" title="">Xem thêm</a></div>-->
                        </h4>
                        <div class="content-about">
                            {!!$gioithieu!!}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection