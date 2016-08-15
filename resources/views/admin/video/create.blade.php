@include('admin.master.common_head')

<body class="no-skin">

@include('admin.master.common_header')

<script src="/fileupload/js/vendor/jquery.ui.widget.js"></script>
<script src="/fileupload/js/jquery.iframe-transport.js"></script>
<script src="/fileupload/js/jquery.fileupload.js"></script>
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
			
			<form method="post" action="{{ url('donkey/admin/video/store')}}" enctype="multipart/form-data">
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">栏目：</label>
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
					<label class="col-sm-1 control-label no-padding-right">标题：</label>
					<div class="col-sm-11">
						<input type='text' name='title' class="col-xs-10 col-sm-4" value="{{ old('title') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>
				</div>

				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">介绍：</label>
					<div class="col-sm-11">
						<input type="text" name="content"  class="col-xs-10 col-sm-4" value="{{ old('content') }}"/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>
				</div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">封面图片：</label>
					<div class="col-sm-11">
						<input type="file" name="cover"  class="col-xs-10 col-sm-4" value=""/>
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必选,只支持jpg,jpeg,png格式*</span>
						</span>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<!--<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">视频：</label>
					<div class="col-sm-11">-->
						<input type="hidden" name="path" id="video_name" class="col-xs-10 col-sm-4" value="{{ old('path') }}"/>
						<input type="hidden" name="duration" id="video_size" class="col-xs-10 col-sm-4" value="{{ old('duration') }}"/>
						<!--<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" style="color:red">*必填*</span>
						</span>
					</div>
				</div>-->
				
				<div id="preview"></div>
				
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right">视频：</label>
                    <div class="col-sm-11">
                        <input id="fileupload" type="file" name="video" class="col-xs-10 col-sm-4"/>
						
						<span class="help-inline col-xs-12 col-sm-7">
							<span class="middle" id="upstatus" style="color:red">*必须,只支持mp4,flv,m4v,avi格式*</span>
						</span>
                    </div>
                </div>
			
				<div height="10px">&nbsp;</div>

                <div id="progress">
                    <div class="bar" style="width: 0%;"></div>
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
			//function uploadfile(){
			//$("#fileupload").change(function(){
				
				$("#fileupload").change().fileupload({
					url: '/donkey/admin/video/uploadv',
					dataType: 'json',	
					formData: function(form){
						var path = $("#video_name").val();
						return [
							{name:"_token",value:"{{ csrf_token() }}"},
							{name:"path",value:path}	
								];
					},
					done: function (e, data) {
						if(data.result.sta) {
							$('#upstatus').html(data.result.msg);
							$('#video_name').val(data.result.previewSrc);
							$('#video_size').val(data.result.duration);
							//$('#fileupload').css('display','none');
							/*$('#preview').html("<video src='"+data.result.previewSrc+"' controls='controls'>您的浏览器不支持预览。</video>");*/
						} else {
							$('#progress .bar').css('width',"0%");
							$('#upstatus').html(data.result.msg);
						}
					},
					progress: function(e,data) {
						var progress = parseInt(data.loaded / data.total * 100, 10);  
						$("#progress .bar").css("width", progress + "%");  
						$("#upstatus").html("正在上传..."); 
					}
				});
			//});
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
	