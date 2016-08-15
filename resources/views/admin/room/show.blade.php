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
					<a href="{{ url('donkey/admin/room/index/1') }}">房源管理</a>
				</li>
				<li class="active">查看房源</li>
			</ul><!-- /.breadcrumb -->
		
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			
			<div>
				<table id="sample-table-1" class="table table-striped table-bordered table-hover center">
					<thead>
						<tr>
							<td colspan="6" class="center"><h4>房子详细信息</h4></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong>小区名称</strong></td>
							<td>{{ $room->name }}</td>
							<td><strong>小区位置</strong></td>
							<td>{{ $room->position }}</td>
							<td><strong>价格</strong></td>
							<td>@if($room->price) {{$room->price.'元'}} @endif</td>
						</tr>
						@if($room->h_type == 2)
						<tr>
							<td><strong>买卖单价</strong></td>
							<td>{{ $room->univalence ? $room->univalence.'元/平米' : ''}}</td>
							<td><strong>买卖税率</strong></td>
							<td>{{ $room->tax_rate }}</td>
							<td><strong>税费</strong></td>
							<td>{{ $room->taxes ? $room->taxes.'元' : ''}}</td>
						</tr>
						@endif
						<tr>
							<td><strong>房子名称</strong></td>
							<td>{{ $room->room_name }}</td>
							<td><strong>户型</strong></td>
							<td>{{ $room->type }}</td>
							<td><strong>面积</strong></td>
							<td>{{ $room->area ? $room->area.'平米' : ''}}</td>
						</tr>
						<tr>
							<td><strong>图片</strong></td>
							<td colspan="4">								
								<ul class="ace-thumbnails clearfix">
									
									@foreach( $room->photos as $item)
									<li>
										<a href="{{ $item->path }}" data-rel="colorbox">
											<img width="100" height="100" src="{{ $item->path }}" />
										</a> 
					
										<div class="tools">
											<a href="#">
												<i class="ace-icon fa fa-link"></i>
											</a>

											<a href="#">
												<i class="ace-icon fa fa-paperclip"></i>
											</a>

											<a href="#">
												<i class="ace-icon fa fa-pencil"></i>
											</a>

											<a href="{{ url('donkey/admin/room/del_pic').'/'.$item->id }}">
												<i class="ace-icon fa fa-times red"></i>
											</a>
										</div>
									</li>
									@endforeach
								</ul>
							</td>
							<td>
								<a href="javascript:upload_image()">
									<i class="fa fa-cloud-upload">上传图片</i>
								</a>
							</td>
						</tr>
						<tr>
							<td><strong>备注</strong></td>
							<td colspan="5">{{ $room->introduction }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<form action="{{ url('donkey/admin/room/upload') }}" method="post" enctype="multipart/form-data">
				<input id="uploads" type="file" name="picture[]" value="" style="display:none" multiple="multiple"/>
				<input type="hidden" name="_token" value="{{ csrf_token() }}" style="display:none"/>
				<input type="hidden" name="id" value="{{ $room->id }}" style="display:none"/>
				<button id="sub" type="submit" style="display:none;"></button>
			</form>
			
			<script>
				function upload_image(){
					$('#uploads').click();
				}
				$('#uploads').change(function(){
					$('#sub').click();
				})
			</script>
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
	
