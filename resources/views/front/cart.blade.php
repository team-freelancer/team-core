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
								Giỏ hàng
							</span>
						</h4>
					</div>
					<!-- box-product -->
					<div class="giohang">
						
							<div class="cart">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Ảnh</th>
												<th>Tên sản phẩm</th>
												<th>Giá</th>
												<th>Số lượng</th>
												<th>Action</th>
												<th>Tổng tiền</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<form action="" method="post" accept-charset="utf-8">
												<input type="hidden" name="_token" value="{{csrf_token()}}">
												@foreach($cart as $item)
													<tr>
														<td><img src="{{imageThumb($item->options->images)}}" class="cart-img-pro" width="80px" alt=""></td>
														<td>{{$item->name}}</td>
														<td><span>0 </span></td>
														<td><input class="qty" type="number" min='0' max='100' value="{{$item->qty}}" name="" id=""></td>
														<td><a href="" class="btnupdate fa fa-refresh" id="{{$item->rowId}}" title=""></a>&nbsp;&nbsp;<a href="{{url('xoa-gio-hang',$item->rowId)}}" rel="" class="btndel fa fa-times"></a></td>

													</tr>
												@endforeach
											</form>
										</tbody>
									</table>
								</div>
								<div class="update pull-right">
								
									<a href="{{ url('gui-don-hang') }}.html" class="btn btn-danger">Gửi đơn hàng</a>
								</div>
							</div>
						
					</div>
					<!-- box-product -->
					
				</div>
			</div>
		</div>
	</div>
@endsection