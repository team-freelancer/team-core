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
								<a href="#" title="" style="color: #fff">Trang chủ</a> / Liên hệ
							</span>
						</h4>
					
						<div class="form-lh">
							<form action="" method="post" accept-charset="utf-8">
								<div class="col-sm-4 co-md-4 col-lg-4">
									<input type="text" name="" class="form-control" required="required" value="" placeholder="Tên:">
								</div>
								<div class="col-sm-4 co-md-4 col-lg-4">
									<input type="text" name="" class="form-control" required="required" value="" placeholder="Số điện thọa:">
								</div>
								<div class="col-sm-4 co-md-4 col-lg-4">
									<input type="text" name="" class="form-control" required="required" value="" placeholder="Email:">
								</div>
								<div class="col-sm-12 col-md-12 col-lg-12 ndlh">
									<textarea name="" placeholder="Ghi chú:"></textarea>
								</div>
								<div class="col-sm-12 col-md-12 col-lg-12 bt-gui">
									<div class="pull-right">
										<input type="submit" name="" class="btn" value="Gửi tin">
									</div>
								</div>
							</form>
						</div>
						<div class="thongtinlienhe">
							<h1>Phụ tùng ô tô Thành Công</h1>
							<p>Địa chỉ: Trụ sở: 9A/2 – Ngõ 283 – Trần Khát Chân – Hà Nội.</p>
							<p>Điện thoại: 0987654321</p>
							<p>Email: abc@gmail.com</p>
						</div>
					</div>
					<!-- box-product -->
					
				</div>
			</div>
		</div>
	</div>
@endsection