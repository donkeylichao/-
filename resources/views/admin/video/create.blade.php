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
					<a href="{{ url('donkey/admin/video/index') }}">视频管理</a>
				</li>
				<li class="active">添加视频</li>
			</ul><!-- /.breadcrumb -->
		
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			{{-- dump(Session::all())--}}
			{{-- dump($errors->first())--}}
			
			<form method="post" action="{{ url('donkey/admin/video/store')}}">
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">类型：</label>
					<div class="col-sm-11">
						<select name="category_id" class="col-xs-10 col-sm-4">
							@foreach($categories->child as $v)
							<option value="{{ $v->id }}">{{ $v->name }}</option>
							@endforeach
						</select>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle"></span>
						</span>
					</div>	
				</div>	

				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">小区名称：</label>
					<div class="col-sm-11">
						<input type='text' name='name' class="col-xs-10 col-sm-4" value="{{ old('name') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>
				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">小区位置：</label>
					<div class="col-sm-11">
						<input type="text" name="position"  class="col-xs-10 col-sm-4" value="{{ old('position') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填,例如 "北京市 朝阳区 XX大街"*</span>
						</span>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">房子名称：</label>
					<div class="col-sm-11">
						<input type="text" name="room_name"  class="col-xs-10 col-sm-4" value="{{ old('room_name') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填,例如 "38楼3单元205"*</span>
						</span>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">户型：</label>
					<div class="col-sm-11">
						<input type="text" name="type"  class="col-xs-10 col-sm-4" value="{{ old('type') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填,例如 "三室两厅"*</span>
						</span>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">面积：</label>
					<div class="col-sm-11">
						<input type='text' name="area" placeholder="单位:平米" class="col-xs-10 col-sm-4" value="{{ old('area') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>	
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">价格：</label>
					<div class="col-sm-11">
						<input type='text' name="price" placeholder="单位:元" class="col-xs-10 col-sm-4" value="{{ old('price') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>	
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">备注：</label>
					<div class="col-sm-11">
						<input type='text' name="introduction" class="col-xs-10 col-sm-4" value="{{ old('introduction') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>	
				</div>
			
				<div height="10px">&nbsp;</div>
				
				<div class="col-md-offset-1 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						提交保存
					</button>
				</div>
			</form>
		
			
			@include('admin.master.common_footer')
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		
		<script>
			$('')
		</script>
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

	</body>
</html>
	