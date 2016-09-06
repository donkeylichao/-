		@include("home.master.head")
		<!--special class-->
		<link rel="stylesheet" href="/css/video.css" /> 
	</head>
	<body>
		@include("home.master.header")
		<div class="container">
			<div class="page-header">
				<h3>视频列表<small> <em>></em> {{ $category_name }}</small></h3>
			</div>
		</div>
		<div id="content" class="container">
			@include("admin.master.notify")
			<div id="listBox" class="home-flow clearfix masonry" style="position:relative;">
				@foreach($videos as $item)
				<div class="flow-box masonry-brick">
					<div class="img-box">
						<a class="grouped_elements show_img" target="_black" href="{{ url('donkey/video/'.$item->category_id.'/show').'/'.$item->id }}">
							<img src="{{ $item->cover}}"/>
						</a>
					</div>
					<div class="flow-info nounderline">
						<span>{{ $item->title }}</span>
						<p class="little_p">{{ $item->content }}</p>
					</div>
					<div class="comment-box">
						<div class="comment-num">
							<p>评论<font>2</font>条 <small>{{ substr($item->created_at,0,10) }}</small></p>
						</div>
						<div class="comment-btn">
							<a class="GotoComment" target="_blank" href="{{ url('donkey/video/'.$item->category_id.'/show').'/'.$item->id }}">看看</a>
						</div>
					</div>
				</div>
				@endforeach
				<div style="clear:both;">&nbsp;</div>
			</div>
			<div style="clear:both;">&nbsp;</div>
		</div>
		<script src="/js/waterfall.js"></script>
		@include("home.master.footer")
	</body>
</html>