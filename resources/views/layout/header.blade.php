<header>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-6 col-sm-6 col-lg-6">
					<div class="pull-left">
						<i class="fa fa-phone">&nbsp;</i> 0987654321&nbsp;&nbsp;
						<i class="fa fa-envelope"></i>&nbsp;abc@gmail.com
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-sm-6 col-lg-6">
					<div class="pull-right">
						<div class="facebook">
							<a href="#" title="Facebook" target="_blank" class=""><i class="fa fa-facebook"></i></a>
						</div>
						<div class="gplus">
							<a href="#" title="Google Plus" target="_blank" class=""><i class="fa fa-google-plus"></i></a>
						</div>
						<div class="youtube">
							<a href="#" title="Youtube" target="_blank" class=""><i class="fa fa-youtube"></i></a>
						</div>
						
						
						
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="chu">
		<div class="container">
			<div class="row">
				<h1>Phụ tùng ô tô - huyndai thành công</h1>
			</div>
		</div>
	</div>
	<!-- slide -->
	<div class="slide">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-lg-3 col-md-3 logo">
					
					<a href="{{asset('')}}"><img src="{{asset('html/images/logo.jpg')}}" class="img-responsive" alt=""></a>
				</div>
				<div class="col-sm-9 col-md-9 col-lg-9 right">
					<div class="menu1 menu">
						<nav class="navbar navbar-default" role="navigation">
							<div class="container-fluid">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									
								</div>
						
								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse navbar-ex1-collapse">
									<!-- <ul class="nav navbar-nav">
										<li class="active"><a href="#">Link</a></li>
										<li><a href="#">Link</a></li>
									</ul> -->
									<ul class="nav navbar-nav">
										<li><a href="{{asset('')}}">Trang chủ</a></li>
										<li><a href="{{asset('gioi-thieu.html')}}">Giới thiệu</a></li>
										<li><a href="{{asset('san-pham.html')}}">Phụ tùng phổ biến</a></li>
										<li><a href="{{asset('tin-tuc.html')}}">Tin tức</a></li>
										<li><a href="{{asset('lien-he.html')}}">Liên hệ</a></li>
										<li><a href="{{asset('gio-hang')}}"><i class="fa fa-shopping-cart"></i>({{\Cart::count()}})</a></li>
									</ul>
									
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
					<div id="carousel-id" class="carousel slide" data-ride="carousel">
						<!--<ol class="carousel-indicators">
							<li data-target="#carousel-id" data-slide-to="0" class=""></li>
							<li data-target="#carousel-id" data-slide-to="1" class=""></li>
							<li data-target="#carousel-id" data-slide-to="2" class="active"></li>
						</ol>-->
						<div class="carousel-inner">
					
							@for($i=0; $i< count($sliders);$i++)
							<div class="item {{ $i == 0 ? 'active' : ''}}">
								<img src="{{asset('storage/'.$sliders[$i]->largest)}}">
								
							</div>
							@endfor
						</div>
						 <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
						<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- slide2 -->
	<div class="slide2">
		<div class="container">
			<div class="row">
				<div class="block">
                    <ul class="bxslider">
					  <li><img src="{{asset('html/images/grandi10.png')}}" class="img-responsive">
						Grand i10
					  </li>
					  <li><img src="{{asset('html/images/grandi10sedan.png')}}" class="img-responsive">
						Grand i10 sedan
					  </li>
					  <li><img src="{{asset('html/images/120active.png')}}" class="img-responsive">
						I20 Active
					  </li>
					  <li><img src="{{asset('html/images/accent5.png')}}" class="img-responsive">
						Accent 5 cửa
					  </li>
					  <li><img src="{{asset('html/images/accent.png')}}" class="img-responsive">
						Accent
					  </li>
					   <li><img src="{{asset('html/images/elantra.png')}}" class="img-responsive">
						Elantra
					  </li>
					   <li><img src="{{asset('html/images/sonata.png')}}" class="img-responsive">
						Sonata
					  </li>
					  <li><img src="{{asset('html/images/creta.png')}}" class="img-responsive">
						Creta
					  </li>
					   <li><img src="{{asset('html/images/tucson.png')}}" class="img-responsive">
						Tucson	
					  </li>
					  <li><img src="{{asset('html/images/santafe.png')}}" class="img-responsive">
						Santafe
					  </li>
					  <li><img src="{{asset('html/images/h-100.png')}}" class="img-responsive">
						Porter (H-100)
					  </li>
					</ul>
                </div>
			</div>
		</div>
	</div>
	<!-- menu -->
	<div class="menu">
			<div class="container">
				<div class="row">
					<nav class="navbar navbar-default" role="navigation">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								
							</div>
					
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse navbar-ex1-collapse">
								<!-- <ul class="nav navbar-nav">
									<li class="active"><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>
								</ul> -->
								<ul class="nav navbar-nav">
							@foreach($menu as $item)
									<li class="dropdown active-menu">
										<a href="{{url($item->slug)}}.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$item->name}} <span class="caret"></span></a>
										<ul class="dropdown-menu">
										@foreach($item->adapters as $rows)
											<li class="col-sm-6 col-md-6 col-lg-6"><a href="{{url($rows->slug)}}.html" title="">{{$rows->name}}</a></li>
										@endforeach
										</ul>
									</li>
							@endforeach
									<li class="search">
									<form action="tim-kiem.html" method="get">
									
										<input type="text" name="s" class="form-control" value="">
										
									</form>
									</li>
									
								</ul>
								
							</div><!-- /.navbar-collapse -->
						</div>
					</nav>
				</div>
			</div>
	</div>