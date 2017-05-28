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
								<a href="#" title="" style="color: #fff">Trang chủ</a> / {{$category->name}}
							</span>
						</h4>
						<div class="list-products">
                        @foreach($products as $item)
							<div class="col-sm-3 col-md-3 col-lg-3">
								<div class="box">
									<a href="{{ route('getProduct', [str_slug($item->name).'-'.$item->id]) }}"><img src="{{asset('storage/'.json_decode($item->images)[0]->thumb)}}"></a>
									<a href="{{ route('getProduct', [str_slug($item->name).'-'.$item->id]) }}"><p class="name-product">{{$item->name}}</p></a>
					                <p class="price-product">Giá: Liên hệ</p>
								</div>
							</div>
						@endforeach	

						</div>
						<div class="phantrang">
							{!!$products->links()!!}
						</div>
					</div>
					<!-- box-product -->
					
				</div>
			</div>
		</div>
	</div>
@endsection