		@include("home.master.head")
		
		<!--special class-->
		<link rel="stylesheet" href="/css/room.css" /> 
		<link rel="stylesheet" href="/css/room-detail.css" /> 
	</head>
	<body>
		@include("home.master.header")
		<div class="container">
			<div class="page-header">
				<h3>房源列表 <small>> 
				@if($room->h_type == 1)
				<a href="{{ url('donkey/room').'/'.$room->h_type }}">出租</a></small></h3>
				@else
				<a href="{{ url('donkey/room').'/'.$room->h_type }}">买卖</a></small></h3>
				@endif
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-9 col-xs-12">
					<div class="ban" id="demo1">
						<div class="ban2" id="ban_pic1">
							<div class="prev1" id="prev1"><img src="/images/index_tab_l.png" width="28" height="51"  alt=""></div>
							<div class="next1" id="next1"><img src="/images/index_tab_r.png" width="28" height="51"  alt=""></div>
							<ul>
								@foreach($room->photos as $item)
								<li><a href="javascript:;"><img src="{{ $item->path }}" class="ban2-big-img" alt=""></a></li>
								@endforeach
							</ul>
						</div>
						<div class="min_pic">
							<div class="prev_btn1" id="prev_btn1"><img src="/images/feel3.png" width="9" height="18"  alt=""></div>
							<div class="num clearfix" id="ban_num1">
								<ul>
									@foreach($room->photos as $item1)
									<li><a href="javascript:;"><img src="{{ $item1->path }}" class="small-img" alt=""></a></li>
									@endforeach
								</ul>
							</div>
							<div class="next_btn1" id="next_btn1"><img src="/images/feel4.png" width="9" height="18"  alt=""></div>
						</div>
					</div>

					<div class="pop_up" id="demo2">
						<div class="pop_up_xx"><img src="/images/chacha3.png" width="40" height="40"  alt=""></div>
						<div class="pop_up2" id="ban_pic2">
							<div class="prev1" id="prev2"><img src="/images/index_tab_l.png" width="28" height="51"  alt=""></div>
							<div class="next1" id="next2"><img src="/images/index_tab_r.png" width="28" height="51"  alt=""></div>
							<ul>
								@foreach($room->photos as $item2)
								<li><a href="javascript:;"><img src="{{ $item2->path }}" class="ban2-big-img" alt=""></a></li>
								@endforeach
							</ul>
						</div>
					</div>
					
				</div>
				<div class="right-box col-md-5 col-sm-3 col-xs-12">
					
					<div class="room-detail">
						<div class="row">	
							<dl class="col-md-6 col-sm-12 col-xs-6">
								<dt>小区：</dt>
								<dd>{{ $room->name }}</dd>
							</dl>
							<dl class="col-md-6 col-sm-12 col-xs-6"> 
								<dt>户型：</dt>
								<dd>{{ $room->type }}</dd>
							</dl>
							<dl class="col-md-6 col-sm-12 col-xs-6">
								<dt>面积：</dt>
								<dd>{{ $room->area ."平方米"}}</dd>
							</dl>
							@if($room->h_type == 1)
							<dl class="col-md-6 col-sm-12 col-xs-6">
								<dt>价格：</dt>
								<dd>{{ $room->price }}元/月</dd>
							</dl>
							<dl class="col-md-6 col-sm-12 col-xs-6">
								<dt>付款：</dt>
								<dd>押一付三</dd>
							</dl>
							<dl class="col-md-6 col-sm-12 col-xs-6">
								<dt>楼号：</dt>
								<dd>{{ $room->room_name}}</dd>
							</dl>
							@else
							<dl class="col-md-6 col-sm-12 col-xs-6">
								<dt>价格：</dt>
								<dd>{{ substr_replace($room->price,'万',strlen($room->price)-4) }}元</dd>
							</dl>
							<dl class="col-md-6 col-sm-12 col-xs-6">
								<dt>单价：</dt>
								<dd>{{ $room->univalence }}元/平米</dd>
							</dl>
							<dl class="col-md-6 col-sm-12 col-xs-6">
								<dt>税率：</dt>
								<dd>{{ $room->tax_rate }}</dd>
							</dl>
							@endif
							<dl class="col-md-6 col-sm-12 col-xs-12"> 
								<dt>位置：</dt>
								<dd>{{ $room->position }}</dd>
							</dl>
							<dl class="col-md-12 col-sm-12 col-xs-12">
								<dt>介绍：</dt>
								<p class="description">
									{{ $room->introduction }}
								</p>
							</dl>
						</div>	
					</div>
				</div>
				<div class="right-box col-md-5 col-sm-12 col-xs-12" style="margin-top:20px;">
					<iframe width='100%' height='400px' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='{{ $room->position_url }}'></iframe>
				</div>
				<div class="mhc"></div>
			</div>
		</div>
		<script src="/js/pic_tab.js"></script>
		<script type="text/javascript">
			jq('#demo1').banqh({
				box:"#demo1",//总框架
				pic:"#ban_pic1",//大图框架
				pnum:"#ban_num1",//小图框架
				prev_btn:"#prev_btn1",//小图左箭头
				next_btn:"#next_btn1",//小图右箭头
				pop_prev:"#prev2",//弹出框左箭头
				pop_next:"#next2",//弹出框右箭头
				prev:"#prev1",//大图左箭头
				next:"#next1",//大图右箭头
				pop_div:"#demo2",//弹出框框架
				pop_pic:"#ban_pic2",//弹出框图片框架
				pop_xx:".pop_up_xx",//关闭弹出框按钮
				mhc:".mhc",//朦灰层
				autoplay:true,//是否自动播放
				interTime:5000,//图片自动切换间隔
				delayTime:400,//切换一张图片时间
				pop_delayTime:400,//弹出框切换一张图片时间
				order:0,//当前显示的图片（从0开始）
				picdire:true,//大图滚动方向（true为水平方向滚动）
				mindire:true,//小图滚动方向（true为水平方向滚动）
				min_picnum:5,//小图显示数量
				pop_up:true//大图是否有弹出框
			})
		</script>
		<footer class="footer">
			<p>©donkeyLi</p>
		</footer>
	</body>
</html>