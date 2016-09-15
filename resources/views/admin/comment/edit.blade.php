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
				<li class="active">编辑评论</li>
			</ul><!-- /.breadcrumb -->
		
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			
			@include('admin.master.notify')
			{{-- dump(Session::all())--}}
			{{-- dump($errors->first())--}}
			
			<form method="post" action="{{ url('donkey/admin/comment/update')}}">
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">资源：</label>
					<div class="col-sm-11">
						<input type='text' name='resource' disabled class="col-xs-10 col-sm-4" value="{{ $comment->resource->title}}"/>
					</div>
				</div>

				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">评论人：</label>
					<div class="col-sm-11">
                        <input type='text' name='user_name' disabled class="col-xs-10 col-sm-4" value="{{ $comment->user->name }}"/>
					</div>
				</div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{ $comment->id }}" />

				<div height="10px">&nbsp;</div>
				
				<div class="form-group">
					<label class="col-sm-1 control-label no-padding-right">内容：</label>
					<div class="col-sm-11">
                        <textarea class='col-sm-11' id='content' name="content">{{ $comment->content }}</textarea>
					</div>
				</div>
				
				<div height="10px">&nbsp;</div>
				
				<div class="col-md-offset-1 col-md-9" style="margin-top:20px;">
					<button class="btn btn-info" onclick="return getcontent()" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						提交保存
					</button>
				</div>
			</form>
		
			<script>

				function getcontent(){
					var content = $("#content").html();
					if(title == '') {
						alert('评论内容不能为空!');
						return false;
					}

				}
			</script>
			@include('admin.master.common_footer')
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
	
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
		<script src="/froala_editor/js/froala_editor.min.js"></script>
		<!--[if lt IE 9]>
			<script src="../js/froala_editor_ie8.min.js"></script>
		<![endif]-->
		<script src="/froala_editor/js/plugins/tables.min.js"></script>
		<script src="/froala_editor/js/plugins/lists.min.js"></script>
		<script src="/froala_editor/js/plugins/colors.min.js"></script>
		<script src="/froala_editor/js/plugins/media_manager.min.js"></script>
		<script src="/froala_editor/js/plugins/font_family.min.js"></script>
		<script src="/froala_editor/js/plugins/font_size.min.js"></script>
		<script src="/froala_editor/js/plugins/block_styles.min.js"></script>
		<script src="/froala_editor/js/plugins/video.min.js"></script>

		<script>
			$(function(){
				$('#edit').editable({inlineMode: false, alwaysBlank: true})
							
				var content = $("#post_content").val();

				$("#edit").children(".froala-element").html(content);
			});
		</script>
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
	