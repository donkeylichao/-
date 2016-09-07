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
		@include("home.master.header")
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