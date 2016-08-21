@include('admin.master.common_head')
<body class="no-skin">

@include('admin.master.common_header')

<div class="main-container" id="main-container">
	<script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
	
	<!-- #section:basics/sidebar -->
	<div id="sidebar" class="sidebar  responsive">
		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
		</script>
		
		@include('admin.master.common_left')
		
		<!-- #section:basics/sidebar.layout.minimize -->
		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>

		<!-- /section:basics/sidebar.layout.minimize -->
		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
		</script>
	</div>
	<div class="main-content">
		<!-- #section:basics/content.breadcrumbs -->
		
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>

			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="{{ url('donkey/admin/music/index') }}">音频管理</a>
				</li>
				<li class="active">查看音频</li>
			</ul><!-- /.breadcrumb -->
		
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			
			<div>
				<table id="sample-table-1" class="table table-striped table-bordered table-hover center">
					<thead>
						<tr>
							<td colspan="6" class="center"><h4>视频详细信息</h4></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong>标题</strong></td>
							<td>{{ $music->title }}</td>
							<td><strong>发布者</strong></td>
							<td>{{ $music->user->name }}</td>
							<td><strong>所属栏目</strong></td>
							<td>{{ $music->category->name }}</td>
						</tr>
						<tr>
							<td><strong>作者</strong></td>
							<td>{{ $music->author or ''}}</td>
							<td><strong>时长</strong></td>
							<td>{{ $music->duration or ''}}</td>
							<td><strong>文件大小</strong></td>
							<td>{{ $music->size or ''}}</td>
						</tr>
						<tr>
							<td><strong>介绍内容</strong></td>
							<td colspan="5"><strong>{{ $music->content }}</strong></td>
						</tr>
						<tr>
							<td><strong>图片</strong></td>
							<td colspan="5">								
								<ul class="ace-thumbnails clearfix">
									<li>
										<a href="{{ $music->cover }}" data-rel="colorbox">
											<img width="150" height="150" alt="150x150" src="{{ $music->cover }}" />
											<div class="text">
												<div class="inner">点击查看大图</div>
											</div>
										</a>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td><strong>音频</strong></td>
							<td colspan="5">
								<video style="width:200px" controls="controls">
									您的浏览器不支持video标签
									<source src="{{ $music->path }}"></source>
								</video>
							</td>
						</tr>
						<tr>
							<td><strong>下载</strong></td>
							<td>
								<a href="{{ url('donkey/download/music/' . $music->id) }}">下载到本地</a>
								<br><br>
								<span>或者扫描右方二维码下载到手机</span>
							</td>
							<td colspan="4">
								<span class="qrcode">{!! QrCode::size(150)->margin(0)->generate(url("donkey/download/music/" . $music->id)) !!}</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			@include('admin.master.common_footer')
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		
	
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		
		<script src="/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="/assets/js/jquery.colorbox-min.js"></script>
		
		<script type="text/javascript">
			jQuery(function($) {
			var $overflow = '';
			var colorbox_params = {
				rel: 'colorbox',
				reposition:true,
				scalePhotos:true,
				scrolling:false,
				previous:'<i class="ace-icon fa fa-arrow-left"></i>',
				next:'<i class="ace-icon fa fa-arrow-right"></i>',
				close:'&times;',
				current:'{current} of {total}',
				maxWidth:'100%',
				maxHeight:'100%',
				onOpen:function(){
					$overflow = document.body.style.overflow;
					document.body.style.overflow = 'hidden';
				},
				onClosed:function(){
					document.body.style.overflow = $overflow;
				},
				onComplete:function(){
					$.colorbox.resize();
				}
			};

			$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
			$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange'></i>");//let's add a custom loading icon
		})
		</script>

		<!--[if lte IE 8]>
		  <script src="/assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="/assets/js/jquery-ui.custom.min.js"></script>
		<script src="/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="/assets/js/jquery.easypiechart.min.js"></script>
		<script src="/assets/js/jquery.sparkline.min.js"></script>
		<script src="/assets/js/flot/jquery.flot.min.js"></script>
		<script src="/assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="/assets/js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="/assets/js/ace-elements.min.js"></script>
		<script src="/assets/js/ace.min.js"></script>
</html>
	
