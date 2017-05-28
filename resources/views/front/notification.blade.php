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
								Thông báo
							</span>
						</h4>
						<div class="col-lg-offset-3 col-sm-6 col-md-6 col-lg-6">
							<p class="text-center">{{ session('message') }}</p>
                            <p class="text-center">
                                <a href="{{url('/')}}">Về trang chủ</a>
                            </p>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection