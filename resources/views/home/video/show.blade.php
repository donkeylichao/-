	@include("home.master.head")
		<!--special class-->
		<link rel="stylesheet" href="/video/video-js.css" /> 
		<link rel="stylesheet" href="/css/video-detail.css" /> 
		<script src="/video/video.js"></script>
		
		<script>
			_V_.options.flash.swf = "/video/video-js.swf";
		</script>
	</head>
	<body>
		@include("home.master.header")
		<div class="container">
			<div class="page-header">
				<h3>视频列表<small> > 视频播放</small></h3>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 xs-sm-12 fixed" style="margin-bottom:20px;">		
					<video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="100%" height="320"
						poster=""
						data-setup="{}">
						<source src="{{ $resource->path }}" type='video/mp4' />
						<source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
						<source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
						<track kind="captions" src="captions.vtt" srclang="en" label="English" />
					</video>
				</div>
				<div class="col-md-6 col-sm-12 xs-sm-12" style="margin-bottom:20px;">
					
				</div>				
				<div class="col-md-6 col-sm-12 xs-sm-12 fixed-right" style="margin-bottom:20px;">
					<p class="comment"><em>评论列表</em></p>
					<div class="media">
						<a class="pull-left" href="#">
							<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Media heading</h4>
							Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
							scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
							in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
							vulputate fringilla. Donec lacinia congue felis in faucibus. 
							<div class="media">
								<a class="pull-left" href="#">
									<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
								</a>
								<div class="media-body">
									<h4 class="media-heading">Media heading</h4>
									Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
									scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
									in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
									vulputate fringilla. Donec lacinia congue felis in faucibus. 
								</div>
							</div>
						</div>
						<div class="media">
							<a class="pull-left" href="#">
								<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
							</a>
							<div class="media-body">
								<h4 class="media-heading">Media heading</h4>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
								scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
								in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
								vulputate fringilla. Donec lacinia congue felis in faucibus. 
							</div>
						</div>
						<div class="media">
							<a class="pull-left" href="#">
								<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
							</a>
							<div class="media-body">
								<h4 class="media-heading">Media heading</h4>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
								scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
								in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
								vulputate fringilla. Donec lacinia congue felis in faucibus. 
							</div>
						</div>
						<div class="media">
							<a class="pull-left" href="#">
								<img src="/images/b5.jpg" style="width:64px;height:64px;" alt="...">
							</a>
							<div class="media-body">
								<h4 class="media-heading">Media heading</h4>
								Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
								scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum 
								in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
								vulputate fringilla. Donec lacinia congue felis in faucibus. 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="footer">
			<p>©donkeyLi</p>
		</footer>
	</body>
</html>