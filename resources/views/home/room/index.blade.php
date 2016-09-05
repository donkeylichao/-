		@include("home.master.head")
		<!--special class-->
		
		<link rel="stylesheet" href="/css/offcanvas.css" /> 
		<link rel="stylesheet" href="/css/room.css" /> 
	</head>
	<body>
		@include("home.master.header")
	<div class="container">
			<div class="page-header">
				<h3>房源列表 <small>> 出租</small></h3>
			</div>
		</div>
		<div id="content" class="container">
			<div class="row row-offcanvas  row-offcanvas-right">
				<div class="col-sm-9 left-content">
					<p class="pull-right visible-xs">
						<button class="btn btn-primary btn-xs" data-toggle="offcanvas" type="button">菜单</button>
					</p>
					<div class="jumbotron" style="margin-bottom:10px;">
						<p>hello world</p>
					</div>
					<div class="row">
						<ul id="houselist-mod" class="houselist-mod col-sm-12">
							<div class="row"> 
								@foreach($rooms as $item)
								<li class="list-item col-sm-12">
									<div class="item-img">
										<img style="width:180px;height:135px;" src="{{ $item->photos->first()->path }}">
										<div class="icon-duotu">
											<span class="dt-bg"></span>
											<i>多图</i>
										</div>
									</div>
									<div class="house-details">
										<div class="house-title">
											<a class="houseListTitle" target="_blank" href="{{ url('donkey/room/'.$type.'/show') .'/'. $item->id }}" title="{{ $item->name}}">{{ $item->name }}</a>
										</div>
										<div class="details-item">
											<span class="hidden-xs">{{ $item->area }}平方米</span>
											<em class="hidden-xs">|</em>
											<span>{{ $item->type }}</span>
											<em class="hidden-xs">|</em>
											<span class="hidden-xs">押一付三</span>
										</div>
										<div class="details-item">
											<span class="comm-address" title="{{ $item->position }}"> {{ $item->position }} </span>
										</div>
										<div class="details-item details-bottom">
											<span class="broker-name hidden-xs">整租</span>
										</div>
									</div>
									<div class="pro-price">
									<span class="price-det">
										<strong>{{ $item->price }}</strong>
										元/月
										</span>
									</div>
								</li>
								@endforeach
							</div>	
						</ul>
					</div>	
				</div>
				<div id="sidebar" class="col-sm-3 col-xs-6 sidebar-offcanvas">
					<div class="list-group">
						<a href="#" class="list-group-item disabled">类型</a>
						@foreach(Config::get("common.house_types") as $key=>$value)
							<a href="/donkey/room/{{$key or ''}}" class="list-group-item">{{ $value }}</a>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<script>
			$(".list-group a").click(function(){
				$(".list-group a").removeClass('active');
				$(this).addClass('active');
			});
			$(document).ready(function () {
				$('[data-toggle="offcanvas"]').click(function () {
					$('.row-offcanvas').toggleClass('active')
				});
			});
			$(".list-item").hover(function(){
				$(this).addClass('over-bg');
			},
			function(){
				$(this).removeClass("over-bg");
			})
		</script>
		@include("home.master.footer")
	</body>
</html>