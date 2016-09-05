<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>donkeyli index</title>
		<meta name="description" content="" />
		<meta name="keyword" content="" />
		
		<!--响应式布局手机是否缩放-->
		<meta name="viewport" content="width=device-width;initial-scale=1.0"/>
		
		<!-- bootstrap & fontawesome -->
		<!--<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />-->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="/css/common.css" /> 
		
		<script src="/assets/js/jquery.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		
		<!--special script and style-->
		<link rel="stylesheet" href="/css/iview.css" />
		<link rel="stylesheet" href="/css/skin2/style.css" />
		<script type="text/javascript" src="/js/raphael-min.js"></script>
		<script type="text/javascript" src="/js/jquery.easing.js"></script>

		<script src="/js/iview.js"></script>
		<script>
			$(document).ready(function(){
				$('#iview2').iView({
					pauseTime: 7000,
					pauseOnHover: true,
					directionNav: true,
					directionNavHide: false,
					controlNav: true,
					controlNavNextPrev: false,
					controlNavTooltip: false,
					nextLabel: "Próximo",
					previousLabel: "Anterior",
					playLabel: "Jugada",
					pauseLabel: "Pausa",
					timer: "360Bar",
					timerBg: "#EEE",
					timerColor: "#000",
					timerDiameter: 40,
					timerPadding: 4,
					timerStroke: 8,
					timerPosition: "bottom-right"
				});
			});
		</script>
	</head>
	<body>
		<nav class="navbar navbar-inverse" style="margin-bottom:0px">
		    <div class="container">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/donkey/home/index">DonkeyLi</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="/donkey/room">房源 <span class="sr-only">(current)</span></a></li>
							<li><a href="/donkey/video">视频 <span class="sr-only">(current)</span></a></li>
							<li><a href="/donkey/post">日记 <span class="sr-only">(current)</span></a></li>
							<!--<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">视频 <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">日记 <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">php</a></li>
									<li><a href="#">js</a></li>
									<li><a href="#">apache</a></li>
								</ul>
							</li>-->
							<li><a href="#">不知道</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</div>
		</nav>
			<div id="iview2">
				<div data-iview:image="/img/photo11.jpg">
					<div class="iview-caption caption1" data-x="100" data-y="300" data-transition="fade">hello world</div>
				</div>

				<div data-iview:image="/img/photo12.jpg">
					<div class="iview-caption caption2" data-x="50" data-y="320" data-transition="wipeRight">你好</div>
				</div>

				<div data-iview:image="/img/photo13.jpg">
					<div class="iview-caption caption3" data-x="350" data-y="300" data-transition="wipeLeft">哈哈哈</div>
				</div>

				<div data-iview:image="/img/photo14.jpg"></div>
			</div>
		<script>
		
		</script>
		@include("home.master.footer")
	</body>
</html>