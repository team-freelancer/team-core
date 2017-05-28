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
							Chi tiết sản phẩm
						</span>
					</h4>
					<div class="box-details">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<!-- <img src="images/b2.jpg" class="img-responsive" alt=""> -->
							 <ul class="bxslider-detail">
                                <?php
                                $images = [];
                                if($product->images != ''){
                                    $images = json_decode($product->images);
                                }
                                ?>
                                @foreach($images as $img)
								<li><img src="{{ asset('storage/'.$img->largest) }}" class="img-responsive" /></li>
                                @endforeach
							</ul>
							<div id="bx-pager-detail">
								@for($i=0; $i< count($images); $i++)
								<a data-slide-index="{{$i}}" href=""><img src="{{ asset('storage/'.$images[$i]->largest) }}" /></a>
								@endfor
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<p class="name-products">{{$product->name}}</p>
							<p class="price">Giá: Liên hệ</p>
							<p class="code">Mã sản phẩm: <span style="color: red">{{$product->code}}</span></p>
							<p class="code">Dòng xe: <span style="color: red">kia caren</span></p>
							<div class="formdh">
								<form action="{{ route('cart',[$product->id, str_slug($product->name)]) }}" method="get" accept-charset="utf-8">
									<input type="number" name="" class="soluong" value="1" placeholder="">
									<input type="submit" name="" class="btn-muahang" value="Thêm vào giỏ">
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- box-product -->
				<div class="box-products box-mota">
					<h4>
						<i class="fa fa-bars"></i>&nbsp;
						<span>
							Mô tả sản phẩm
						</span>
					</h4>
					<div class="box-description">
						{!! $product->description !!}
					</div>
				</div>
				<div class="box-products box-splq">
					<h4>
						<i class="fa fa-bars"></i>&nbsp;
						<span>
							Sản phẩm liên quan
						</span>
					</h4>
					<div class="list-products">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="box">
								<img src="images/s1.jpg">
								<p class="name-product">Ốp đèn gầm daewoo laceti</p>
				                <p class="price-product">Giá: Liên hệ</p>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
    </div>
</div>
@endsection