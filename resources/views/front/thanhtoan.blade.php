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
								Gửi đơn hàng
							</span>
						</h4>
						<div class="col-lg-offset-3 col-sm-6 col-md-6 col-lg-6">
							<h3 style="text-transform: uppercase;">Thông tin liên hệ</h3>
							<form action="{{ url('cart/submit') }}" method="get" class="form-ttdh" accept-charset="utf-8">
								<input type="text" name="fullname" value="" class="form-control" style="margin-bottom: 10px;" placeholder="Họ và tên:" required="required">
								<input type="text" name="mobile" value="" class="form-control" style="margin-bottom: 10px;" placeholder="Số điện thoại:" required="required">
								<input type="email" name="email" value="" class="form-control" style="margin-bottom: 10px;" placeholder="Email:" required="required">
								<input type="text" name="address" value="" class="form-control" style="margin-bottom: 10px;" placeholder="Địa chỉ:" required="required">
								<textarea name="note" placeholder="Ghi chú:" class="form-control"></textarea>
                                <br/>
                                <button type="submit" name="" id="" class="btn btn-dathangx">Đặt hàng</button>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection