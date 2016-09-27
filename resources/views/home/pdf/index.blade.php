		@include("home.master.head")
		<!--special class-->
		
		<link rel="stylesheet" href="/css/offcanvas.css" /> 
		<link rel="stylesheet" href="/css/pdf.css" /> 
	</head>
	<body>
		@include("home.master.header")
		<div class="container">
			<div class="page-header">
				<h3>文件列表 <small>> 
				{{ $category->title }}
				</small></h3>
			</div>
		</div>
		<div id="content" class="container">
			@include("admin.master.notify")
			<div class="row row-offcanvas  row-offcanvas-right">
				<div class="col-sm-9 left-content">
					<p class="pull-right visible-xs">
						<button class="btn btn-primary btn-xs" data-toggle="offcanvas" type="button">菜单</button>
					</p>
					<div class="jumbotron" style="margin-bottom:10px;">
						<p>{{ Config::get('common.motto')[0] }}</p>
					</div>
					<div class="row" id="pdf-list">
						<ul class="list-unstyled col-12">
							@foreach($pdfs as $item)
							<li class="col-md-6 col-sm-12 col-xs-12">
								<a href="{{ url('donkey/pdf/'.$category->id.'/show').'/'.$item->id }}" target="blank">
									<p class="pull-left">{{ $item->title }}</p> 
									<span class="pull-right">{{ substr($item->created_at,0,11) }}</span>
								</a>
							</li>
							@endforeach
						</ul>
						<div class="col-md-12 col-sm-12 col-xs-12">{!! $pdfs->render() !!}</div>
					</div>	
				</div>
				<div id="sidebar" class="col-sm-3 col-xs-6 sidebar-offcanvas">
					<div class="list-group">
						@foreach($categories as $citem)
							<a href="/donkey/pdf/{{ $citem->id }}" class="list-group-item">{{ $citem->title }}</a>
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