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
					<a href="{{ url('donkey/admin/comment') }}">评论管理</a>
				</li>
				<li class="active">查看评论</li>
			</ul><!-- /.breadcrumb -->


			<!-- /section:basics/content.searchbox -->
		
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			
			<div>
				<a class="btn btn-xs btn-success" href="{{ url('donkey/admin/comment/destroy') .'/'. $comments->id}}" style="float:right; margin-bottom:5px;" >
					删除评论和子评论
				</a>
                <table id="sample-table-1" class="table table-striped table-bordered table-hover center">
                    <tr>
                        <th colspan="4" class="center">详细信息</th>
                    </tr>
                    <tr>
                        <td class="center">资源名称</td>
                        <td class="center">{{ $comments->resource->title }}</td>
                        <td class="center">评论人</td>
                        <td class="center">{{ $comments->user->name }}</td>

                    </tr>
                    <tr>
                        <td class="center">评论时间</td>
                        <td class="center">{{ $comments->created_at }}</td>
                        <td class="center">评论内容</td>
                        <td class="center">{!! $comments->content !!}</td>
                    </tr>
                </table>
                @if($comments->childs->count() > 0)
                <p>子评论</p>
			
				<table id="sample-table-1" class="table table-striped table-bordered table-hover center">
					<thead>

						<?php $num = 1 ?>
						<tr>
							<th class="center">序号</th>
							<th class="center">资源名称</th>
							<th class="center hidden-xs">评论内容</th>
							<th class="center">评论人</td>
							<th class="center hidden-xs">时间</th>
							<th class="center">操作</th>
						</tr>
					</thead>

					<tbody>
						@foreach($comments->childs as $item)
						<tr>
							<td>{{ $num ++ }}</td>
							<td>{{ $item->resource->title }}</td>
							<td class="hidden-xs">{!! $item->content !!}</td>
							<td>{{ $item->user->name }}</td>
							<td class="hidden-xs">{{ $item->created_at  }}</td>
							<td>
								<div class="btn-group">
									
									<a class="btn btn-xs btn-warning" href="{{ url('donkey/admin/comment/show') .'/'. $item->id }}" title="查看">
										<i class="ace-icon fa fa-eye bigger-120"></i>
									</a>
					
									<a class="btn btn-xs btn-info" href="{{ url('donkey/admin/comment/edit') .'/'. $item->id }}" title="编辑">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</a>

									<a class="btn btn-xs btn-danger" href="{{ url('donkey/admin/comment/destroy') .'/'. $item->id }}" title="删除">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</a>

								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
                @endif
				
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

		<!--[if lte IE 8]>
		  <script src="../assets/js/excanvas.min.js"></script>
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
	