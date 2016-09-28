	@include("home.master.head")

	</head>
	<body>
		@include("home.master.header")
		<div class="container">
			<div class="page-header">
				<h3><a href="{{ url('donkey/post').'/'.$post->parent->id}}" style="color:#777;">{{ $post->parent->title }}</a><small> > {{ $post->title }}</small></h3>
			</div>
		</div>
			<div class="container">
				<div class="col-md-12 col-sm-12 col-xs-12 text-center"  style="min-height:440px;">
				{!! $post->content !!}
				</div>
			</div>
		</div>
		<!--container结束-->
		
		@include("home.master.footer")
	</body>
</html>