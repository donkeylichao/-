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
					<a href="{{ url('donkey/admin/category') }}">分类管理</a>
				</li>
				<li class="active">分类列表</li>
			</ul><!-- /.breadcrumb -->
		
		</div>

		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			
			<div>
				<a class="btn btn-xs btn-success" href="{{ url('donkey/admin/category/create') }}" style="float:right; margin-bottom:5px;" >
					<i class="ace-icon fa fa-plus bigger-120"></i>添加分类
				</a>
				
				<table id="sample-table-1" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="center">分类ID</th>
							<th class="center">分类树</th>
							<th class="center">操作</th>
						</tr>
					</thead>

					<tbody>
						@foreach($categories as $item)
						<tr>
							<td class="center">{{ $item->id }}</td>
							<td>
								<input type='text' class='changeName' value="{{ $item->name }}" data="{{ $item->id }}" name="name"/>
							</td>
							<td class="center">
								<div class="btn-group">
									<a style="text-decoration:none; color:#fff" class="btn btn-xs btn-danger"
									onclick="return confirm('确定删除吗?删除后将不能恢复')"
									href="{{ url('donkey/admin/category/destroy').'/'.$item->id }}">删除</a>
								</div>
							</td>
						</tr>
							@foreach($item->child as $item1)
							<tr>
								<td class="center">{{ $item1->id }}</td>
								<td>
									<img src="/assets/images/tree_1.png"/>
									<input type='text' class='changeName' value="{{ $item1->name }}" data="{{ $item1->id}}" name="name"/>
								</td>
								<td class="center">
									<div class="btn-group">
										<a style="text-decoration:none; color:#fff" class="btn btn-xs btn-danger"
										onclick="return confirm('确定删除吗?删除后将不能恢复')"
										href="{{ url('donkey/admin/category/destroy').'/'.$item1->id }}">删除</a>
									</div>
								</td>
							</tr>
							@endforeach
						@endforeach	
						<script>
							$(function(){
								$(':text').change(function(){
									var v = $(this).val();
									var id = $(this).attr("data").toString();
									var url = "{{ url('donkey/admin/category/update')}}";
									var token = "{{ csrf_token() }}";
									//alert(url);
									$.ajax({
										type : "POST",
										url  :  url,
										data : {"name" : v, "id" : id , "_token" : token},
										success : function(da){
											if(da.message == "success"){
												success();
											} else {
												error();
											}
										}
									});
								});
								function error() {
									$('#error').css('display','block');
									setTimeout(function(){
										$('#error').css('display','none');
									},2000);
								}
								function success() {
									$('#success').css('display','block');
									setTimeout(function(){
										$('#success').css('display','none');
									},2000);
								}
							});
						</script>
						<!--<tr>
							<td>
								
							</td>
							<td>
								<img src="/assets/images/tree_4.png"/>
								<input type='text' class='changeName' value="haha" name="name"/>
							</td>
							<td>
								<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
									<a style="text-decoration:none; color:#fff" class="btn btn-xs btn-danger"
									onclick="return confirm('确定删除吗?删除后将不能恢复')"
									href="">删除</a>
								</div>
							</td>
						</tr>--> 
							
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
	